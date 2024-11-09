<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'app/vendor/autoload.php';
class SalesController extends Controller
{
    private $LAVA;

    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_model');
        $this->call->model('Main_model');
        $this->call->model('Table_model');
        $this->call->library('session');
        $this->call->library('email');
        $this->LAVA = &lava_instance();
        $this->LAVA->call->database();
        $this->LAVA->call->library('session');
    }
    // No.	First Name	Last Name	Email	Mobile
    public function myPosCart()
    {
        $user_id = 82;

        $menu_data = $this->Main_model->menu();
        $category_data = $this->Main_model->category();

        $cart_data = $this->db->table('cart as c')
            ->select('c.*, i.*, cat.name as category_name, i.name as product_name, c.quantity as cart_quantity')
            ->join('items as i', 'c.item_id = i.item_id')
            ->join('categories as cat', 'cat.category_id = i.category_id')
            ->where('c.user_id', $user_id)
            ->get_all();

        $view_data = [
            'menu_data' => $menu_data,
            'category_data' => $category_data,
            'cart_data' => $cart_data,
        ];

        $this->call->view('admin/sales', $view_data);
    }

    public function poscart()
    {
        $usr = 82;
        $item = $this->io->post('item');
        $existingItem = $this->LAVA->db->table('cart')
            ->where('user_id', $usr)
            ->where('item_id', $item)
            ->get();

        if ($existingItem) {
            $this->LAVA->db->raw("UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND item_id = ?", [$usr, $item]);
        } else {
            $data = array(
                'user_id' => $usr,
                'item_id' => $item,
                'quantity' => 1,
            );
            $this->LAVA->db->table('cart')->insert($data);
        }
        redirect('/pos');
    }
    public function deletepos($cartid)
    {
        if (isset($cartid)) {
            $this->db->table('cart')->where("cart_id", $cartid)->delete();
            redirect('/pos');
        } else {
            redirect('/pos');
        }
    }

    public function checkoutpos()
    {
        $total = $this->io->post('total');
        $items = $this->io->post('cart_ids');
        $receiptno = $this->io->post('receipt_number');

        $orders = [
            "user_id" => 82,
            "delivery_address" => '',
            "order_details" => '',
            "total_amount" => $total,
        ];

        $this->LAVA->db->table('orders')->insert($orders);

        $order_id = $this->LAVA->db->table('orders')
            ->select('order_id')
            ->order_by('order_id', 'DESC')
            ->limit(1)
            ->get();


        $receipt = [
            "user_id" => 82,
            "receipt_number" => $receiptno,
        ];

        $this->LAVA->db->table('receipts')->insert($receipt);
        foreach ($items as $cartItem) {
            $itemInfo = $this->LAVA->db
                ->table('items')
                ->join('cart', 'cart.item_id = items.item_id')
                ->select('items.*, cart.quantity as cart_quantity')
                ->where('cart.cart_id', $cartItem)
                ->get_all();
        
            if ($itemInfo) {
                foreach ($itemInfo as $row) {
                    $ordersitems = [
                        "user_id" => 82,
                        "item_id" => $row['item_id'],
                        "quantity" => $row['cart_quantity'],
                        "total_price" => $row['cart_quantity'] * $row['price'],
                        "order_id" => $order_id['order_id'],
                    ];
        
                    $this->LAVA->db->table('order_items')->insert($ordersitems);
        
                    $updatedQuantity = $row['quantity'] - $row['cart_quantity'];
        
                    $this->LAVA->db->table('items')
                        ->where('item_id', $row['item_id'])
                        ->update(['quantity' => $updatedQuantity]);
                }
        
                // Delete cart items
                $this->LAVA->db->table('cart')->where('user_id', 82)->delete();
                redirect('/pos');
            } else {
                echo "Item info not found for item ID: $cartItem";
            }
        }
        
    }
    public function posdel()
    {
        $items = $this->io->post('cart_ids');
        foreach ($items as $cartItem) {
            $itemInfo = $this->LAVA->db
                ->table('items')
                ->join('cart', 'cart.item_id = items.item_id')
                ->select('items.*, cart.quantity as cart_quantity')
                ->where('cart.cart_id', $cartItem)
                ->get_all();
            if ($itemInfo) {
                $this->LAVA->db->table('cart')->where('user_id', 82)->delete();
                redirect('/pos');
            } else {
            }
        }
    }

    public function pay(){
        $invoice = $this->io->post('invoice');
        $order = $this->LAVA->db
        ->table('invoices')
        ->join('orders', 'orders.order_id = invoices.order_id')
        ->join('order_items', 'order_items.order_id = orders.order_id')
        ->join('items', 'items.item_id = order_items.item_id')
        ->join('cart', 'cart.item_id = items.item_id')
        ->select('cart.quantity as cart_quantity, orders.*, items.item_id, items.quantity as item_quantity')
        ->where('invoices.invoice_number', $invoice)
        ->get_all();
    if ($order) {

        $this->LAVA->db->table('orders')
            ->where('order_id', $order[0]['order_id'])
            ->update(['status' => 'completed']);
    
        $receipt = [
            "user_id" => $order[0]['user_id'],
            "receipt_number" => $invoice,
        ];
        $this->LAVA->db->table('receipts')->insert($receipt);
    
        $this->LAVA->db->table('invoices')->where('invoice_number', $invoice)->delete();
    
        $updatedQuantity = $order[0]['item_quantity'] - $order[0]['cart_quantity'];
        $this->LAVA->db->table('items')
            ->where('item_id', $order[0]['item_id'])
            ->update(['quantity' => $updatedQuantity]);
    } else {
        echo "Invoice not found.";
    }
                redirect('/pos');

    }
}
