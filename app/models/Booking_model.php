<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Booking_model extends Model
{
    public function getBookings()
    {
        return $this->db->table('table_book')
        ->join('users', 'users.user_id = table_book.user_id')
        ->join('tables', 'tables.table_id = table_book.table_id')
        ->select('users.*, table_book.*, tables.*, table_book.book_status as booking_status')
        ->get_all();
    }
    public function getTables()
    {
        $tables = $this->db->table('tables')->get_all();
        foreach ($tables as &$table) {
            $table['availability'] = ($table['is_available'] == 1) ? 'Available' : 'Not Available';
        }

        return $tables;
    }
    
}
