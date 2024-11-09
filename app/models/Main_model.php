<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Main_model extends Model
{
    public function getInfo()
    {
        return $this->db->table('users')->get_all();
    }
    public function cart()
    {
        return $this->db->table('cart')->get_all();
    }
    public function cartid($cartId)
    {
        return $this->db->table('cart')
            ->where('cart_id', $cartId)
            ->get();
    }
    public function menu()
    {
        return $this->db->table('items')->get_all();
    }
    public function searchInfo($id)
    {
        return $this->db->table('items')->where('item_id', $id)->get();
    }
    public function category()
    {
        return $this->db->table('categories')->get_all();
    }
    public function mycart()
    {
    }

    public function sales()
    {
        return $this->db->table('orders')->select_sum('total_amount', 'total')->get();
    }
    public function salescount()
    {
        return $this->db->table('orders')
            ->select('DATE_FORMAT(order_time, "%Y-%m") as order_month, COUNT(order_id) as order_count')
            ->group_by('order_month')
            ->get_all();
    }
    public function BookingsCount()
    {
        return $this->db->table('table_book')
            ->select('DATE_FORMAT(booktime, "%Y-%m") as book_month', 'COUNT(book_id) as booking_count')
            ->group_by('book_month')
            ->get_all();
    }

    public function salesr(){
        return $this->db->table('orders')
        ->join('order_items', 'order_items.order_id = orders.order_id')
        ->join('items', 'items.item_id = order_items.item_id')
        ->join('categories', 'categories.category_id = items.category_id')
        ->select('orders.*, order_items.*, items.name as item_name, categories.name as category_name, items.*, categories.*, order_items.quantity as order_quantity, orders.status as ostatus')
        ->get_all();
    
    }
}
