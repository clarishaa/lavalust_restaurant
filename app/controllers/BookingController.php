<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'app/vendor/autoload.php';
class BookingController extends Controller
{
    private $LAVA;

    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_model');
        $this->call->model('Main_model');
        $this->call->model('Table_model');
        $this->call->model('Booking_model');
        $this->call->library('session');
        $this->call->library('email');
        $this->LAVA = &lava_instance();
        $this->LAVA->call->database();
        $this->LAVA->call->library('session');
    }
    // No.	First Name	Last Name	Email	Mobile
    public function tables()
    {
        $data['tables'] = $this->Table_model->getTable();
        $this->call->view('user/index', $data);
    }

    public function bookings()
    {
        $data = $this->Booking_model->getBookings();
        $this->call->view('admin/booking', $data);
    }
    public function bookpay($id)
    {
        if (isset($id)) {
            $data = [
                "book_status" => 'completed',
            ];
        }

        $this->db->table('table_book')->where("booking_id", $id)->update($data);
        redirect('/bookings');
    }
    public function bookcancel($id)
    {
        if (isset($id)) {
            $data = [
                "book_status" => 'cancelled',
            ];
        }

        $this->db->table('table_book')->where("booking_id", $id)->update($data);
        redirect('/bookings');
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


    public function book($id)
    {
        $message = $this->io->post('message');
        $booktime = $this->io->post('time');
        $bookdate = $this->io->post('date');
        $user_id = $_SESSION['user_id'];

        $data = [
            "message" => $message,
            "booktime" => $booktime,
            "bookdate" => $bookdate,
            "user_id" => $user_id,
            "table_id" => $id
        ];


        $insertResult = $this->LAVA->db->table('table_book')->insert($data);
        echo '<script>alert("Table booked."); window.location.href = "/book";</script>';
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
