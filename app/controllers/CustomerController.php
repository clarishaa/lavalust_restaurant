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
    // No.	First Name	Last Name	Email	Mobile
    public function customer()
    {
        $data['customers'] = $this->User_model->getCustomer();
        $this->call->view('admin/users', $data);
    }

    public function customerupdate($id)
    {
        if (isset($id)) {
            $fname = $this->io->post('fname');
            $lname = $this->io->post('lname');
            $email = $this->io->post('email');
            $mobile = $this->io->post('mobile');
            $password = $this->io->post('password');
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


            $data = [
                "first_name" => $fname,
                "last_name" => $lname,
                "email" => $email,
                "mobile" => $mobile,
                "password" => $hashedPassword
            ];
        }

        $this->db->table('users')->where("user_id", $id)->update($data);

        redirect('/manage-customer');
    }


    public function addcustomer()
    {
        $fname = $this->io->post('fname');
        $lname = $this->io->post('lname');
        $email = $this->io->post('email');
        $mobile = $this->io->post('mobile');
        $password = $this->io->post('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $email_token = md5(uniqid(rand(), true));

        $data = [
            "first_name" => $fname,
            "last_name" => $lname,
            "email" => $email,
            "mobile" => $mobile,
            "password" => $hashedPassword,
            "user_type" => 'customer',
            "token" => $email_token
        ];

        $insertResult = $this->LAVA->db->table('users')->insert($data);
        if ($insertResult) {
            echo "Data inserted successfully!";
        } else {
            echo "Error inserting data: " . $this->db->error()['message'];
        }
        redirect('/manage-customer');
    }



    public function customerdelete($id)
    {
        if (isset($id)) {
            $this->db->table('users')->where("user_id", $id)->delete();
            redirect('/manage-customer');
        } else {
            redirect('/manage-customer');
        }
    }
}
