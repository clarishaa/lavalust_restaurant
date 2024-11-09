<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class User_model extends Model
{
    public function getInfo()
    {
        return $this->db->table('users')->get_all();
    }

    public function getStaff()
    {
        return $this->db->table('users')->where('user_type', 'staff')->get_all();
    }
    public function getCustomer()
    {
        return $this->db->table('users')->where('user_type', 'customer')->get_all();
    }
}
