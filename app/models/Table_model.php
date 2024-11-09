<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Table_model extends Model
{
    public function getBookings()
    {
        return $this->db->table('table_book')->get_all();
    }
    public function getTables()
    {
        $tables = $this->db->table('tables')->get_all();
        foreach ($tables as &$table) {
            $table['availability'] = ($table['is_available'] == 1) ? 'Available' : 'Not Available';
        }

        return $tables;
    }
    public function getTable()
    {
        $tables = $this->db->table('tables')->get_all();
        return $tables;
    }
}
