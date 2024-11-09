<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Category_model extends Model {
    public function getCategory()
    {
        return $this->db->table('categories')->get_all();
    }
    public function itemCategory(){
        return $this->db->table('items')
        ->join('categories', 'categories.category_id = items.category_id')
        ->select('items.*, categories.name AS category_name')
        ->get_all();
    }
   
}
?>
