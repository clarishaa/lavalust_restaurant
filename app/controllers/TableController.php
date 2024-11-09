<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'app/vendor/autoload.php';
class TableController extends Controller
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
        $data = $this->Table_model->getTables();
        $this->call->view('admin/tables', $data);
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

    public function tableupdate($id)
    {
        if (isset($id)) {
            $tableno = $this->io->post('tableNo');
            $desc = $this->io->post('description');
            $availability = $this->io->post('availability');
            $capacity = $this->io->post('capacity');
            $price = $this->io->post('price');


            $data = [
                "table_number" => $tableno,
                "description" => $desc,
                "is_available" => $availability,
                "capacity" => $capacity,
                "price" => $price
            ];
            $this->LAVA->db->table('tables')->where("table_id", $id)->update($data);
            redirect('/tables');
        }
    }

    public function tableadd()
    {
        $tableno = $this->io->post('tableNo');
        $desc = $this->io->post('description');
        $availability = $this->io->post('availability');
        $capacity = $this->io->post('capacity');
        $price = $this->io->post('price');


        $data = [
            "table_number" => $tableno,
            "description" => $desc,
            "is_available" => $availability,
            "capacity" => $capacity,
            "price" => $price
        ];
        $this->LAVA->db->table('tables')->insert($data);
        redirect('/tables');
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




    public function tabledelete($id)
    {
        if (isset($id)) {
            $this->db->table('tables')->where("table_id", $id)->delete();
            redirect('/tables');
        } else {
            redirect('/tables');
        }
    }
}
