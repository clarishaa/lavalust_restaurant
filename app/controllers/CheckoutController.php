<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'app/vendor/autoload.php';
class CheckoutController extends Controller
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

    // Full texts
    // order_id	
    // user_id	
    // order_type	
    // delivery_address	
    // order_details	
    // order_time	
    // status	
    // total_amount


    // Full texts
    // orders_item_id	
    // item_id	
    // quantity	
    // total_price	
    // user_id	
    // order_id
    public function checkout()
    {
        $order_type = $this->io->post('order_type');
        $delivery_add = $this->io->post('address');
        $mess = $this->io->post('message');
        $total = $this->io->post('total');
        $user_id = $_SESSION['user_id'];
        $itemsJson = $this->io->post('items');
        $items = json_decode($itemsJson, true);

        $orders = [
            "user_id" => $user_id,
            "order_type" => $order_type,
            "delivery_address" => $delivery_add,
            "order_details" => $mess,
            "total_amount" => $total,
        ];

        $this->LAVA->db->table('orders')->insert($orders);

        $order_id = $this->LAVA->db->table('orders')
            ->select('order_id')
            ->order_by('order_id', 'DESC')
            ->limit(1)
            ->get();

        $uniqueIdentifier = time();

        $invoiceNumber = "LMCC" . $uniqueIdentifier;

        $invoice = [
            "user_id" => $user_id,
            "order_id" => $order_id['order_id'],
            "invoice_number" => $invoiceNumber,
        ];

        $this->LAVA->db->table('invoices')->insert($invoice);
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
                        "user_id" => $user_id,
                        "item_id" => $row['item_id'],
                        "quantity" => $row['cart_quantity'],
                        "total_price" => $row['cart_quantity'] * $row['price'],
                        "order_id" => $order_id['order_id'],
                    ];
                    $this->LAVA->db->table('order_items')->insert($ordersitems);
                }
            } else {
                echo "Item info not found for item ID: $cartItem";
            }
        }

        $id = $order_id['order_id'];
        $invoiceInfo = $this->LAVA->db
            ->table('orders')
            ->join('invoices', 'invoices.order_id = orders.order_id')
            ->join('order_items', 'order_items.order_id = orders.order_id')
            ->join('items', 'items.item_id = order_items.item_id')
            ->join('users', 'users.user_id = orders.user_id')
            ->select('orders.*, invoices.*, order_items.*, items.*, users.*, order_items.quantity as order_quantity, orders.status as ostatus')
            ->where('orders.order_id', $id)
            ->get_all();

        $items = [];
        foreach ($invoiceInfo as $itemInfo) {
            $items[] = $itemInfo;
        }
        $this->call->view('user/invoice', ['invoiceInfo' => $invoiceInfo, 'items' => $items]);
    }
    public function invoice()
    {
        $user_id = $_SESSION['user_id'];
        $items = ['42', '44'];
        $order_id = $this->LAVA->db->table('orders')
            ->select('order_id')
            ->order_by('order_id', 'DESC')
            ->limit(1)
            ->get();

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
                        "user_id" => $user_id,
                        "item_id" => $row['item_id'],
                        "quantity" => $row['cart_quantity'],
                        "total_price" => $row['cart_quantity'] * $row['price'],
                        "order_id" => $order_id['order_id'],
                    ];
                    $this->LAVA->db->table('order_items')->insert($ordersitems);
                }
            } else {
                echo "Item info not found for item ID: $cartItem";
            }
        }
    }
}
