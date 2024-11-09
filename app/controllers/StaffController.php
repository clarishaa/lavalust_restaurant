<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'app/vendor/autoload.php';
class StaffController extends Controller
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
    public function staff()
    {
        $data['staff'] = $this->User_model->getStaff();
        $this->call->view('admin/staff', $data);
    }

    public function staffupdate($id)
    {
        if (isset($id)) {
            $fname = $this->io->post('fname');
            $lname = $this->io->post('lname');
            $email = $this->io->post('email');
            $mobile = $this->io->post('mobile');
            $position = $this->io->post('position');
            $password = $this->io->post('password');
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


            $data = [
                "first_name" => $fname,
                "last_name" => $lname,
                "email" => $email,
                "mobile" => $mobile,
                "position" => $position,
                "password" => $hashedPassword
            ];
        }

        $this->db->table('users')->where("user_id", $id)->update($data);

        redirect('/manage-staff');
    }


    public function addstaff()
    {
        $fname = $this->io->post('fname');
        $lname = $this->io->post('lname');
        $email = $this->io->post('email');
        $mobile = $this->io->post('mobile');
        $position = $this->io->post('position');
        $password = $this->io->post('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $email_token = md5(uniqid(rand(), true));

        $data = [
            "first_name" => $fname,
            "last_name" => $lname,
            "email" => $email,
            "mobile" => $mobile,
            "password" => $hashedPassword,
            "position" => $position,
            "token" => $email_token
        ];

        $insertResult = $this->LAVA->db->table('users')->insert($data);
        if ($insertResult) {
            echo "Data inserted successfully!";
        } else {
            echo "Error inserting data: " . $this->db->error()['message'];
        }
        redirect('/manage-staff');
    }



    public function staffdelete($id)
    {
        if (isset($id)) {
            $this->db->table('users')->where("user_id", $id)->delete();
            redirect('/manage-staff');
        } else {
            redirect('/manage-staff');
        }
    }
}
