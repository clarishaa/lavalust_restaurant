<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'app/vendor/autoload.php';
class CustomerController extends Controller
{
    private $LAVA;

    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_model');
        $this->call->model('Main_model');
        $this->call->model('Category_model');
        $this->call->library('session');
        $this->call->library('email');
        $this->LAVA = &lava_instance();
        $this->LAVA->call->database();
        $this->LAVA->call->library('session');
    }
    
    public function customers(){
        $customers = $this->db->table('users')->where('user_type', 'customer')->count_all();
        $this->call->view('admin/admin', $customers);
    }
}
