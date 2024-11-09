<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'app/vendor/autoload.php';
class Welcome extends Controller
{
    private $LAVA;

    public function __construct()
    {
        parent::__construct();
        $this->call->model('User_model');
        $this->call->model('Main_model');
        $this->call->model('Category_model');
        $this->call->model('Table_model');
        $this->call->library('session');
        $this->call->library('email');
        $this->LAVA = &lava_instance();
        $this->LAVA->call->database();
        $this->LAVA->call->library('session');
    }

    public function mycart()
    {
        $user_id = $_SESSION['user_id'];
        $data = $this->db->table('cart as c')
            ->select('c.*, i.*, cat.name as category_name, i.name as product_name, c.quantity as cart_quantity')
            ->join('items as i', 'c.item_id = i.item_id')
            ->join('categories as cat', 'cat.category_id = i.category_id')
            ->where('c.user_id', $user_id)
            ->get_all();
        $this->call->view('user/cart', $data);
    }
    public function cart()
    {
        $usr = $_SESSION['user_id'];
        $item = $this->io->post('item');
        $existingItem = $this->LAVA->db->table('cart')
            ->where('user_id', $usr)
            ->where('item_id', $item)
            ->get();

        if ($existingItem) {
            $this->LAVA->db->raw("UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND item_id = ?", [$usr, $item]);
        } else {
            $data = array(
                'user_id' => $usr,
                'item_id' => $item,
                'quantity' => 1,
            );
            $this->LAVA->db->table('cart')->insert($data);
        }

        echo '<script>alert("Added to cart."); window.location.href = "/menu";</script>';
    }
    public function decQuantity($cartId)
    {
        $existing = $this->db->table('cart')->where('cart_id', $cartId)->get();

        if ($existing && $existing['quantity'] > 1) {
            $updateResult = $this->db->table('cart')->where('cart_id', $cartId)->update(['quantity' => $existing['quantity'] - 1]);

            if ($updateResult) {
                $response = ['success' => true, 'message' => 'Quantity decremented successfully.'];
            } else {
                $response = ['success' => false, 'message' => 'Failed to update quantity.'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Quantity is already at the minimum.'];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function incQuantity($cartId)
    {
        $existing = $this->db->table('cart')->where('cart_id', $cartId)->get();

        if ($existing && $updateResult = $this->db->table('cart')->where('cart_id', $cartId)->update(['quantity' => $existing['quantity'] + 1])) {
            redirect('/mycart');
        } else {
        }
    }

    public function user()
    {
        $this->call->view('User');
    }
    public function admin()
    {
        $customers = $this->db->table('users')->where('user_type', 'customer')->get_all();
        $staffs = $this->db->table('users')->where('user_type', 'staff')->get_all();
        $res = $this->db->table('table_book')->get_all();
        $data['tableBookings'] = $this->Main_model->BookingsCount();
        $data['salesreport'] = $this->Main_model->salesr();
        $data['sales'] = $this->Main_model->sales();
        $data['orders'] = $this->Main_model->salescount();
        $data['customers'] = $customers;
        $data['staffs'] = $staffs;
        $data['res'] = $res;

        $this->call->view('admin/admin', $data);
    }


    public function about()
    {
        $this->call->view('user/about');
    }
    public function menum()
    {
        $data['category'] = $this->Category_model->getCategory();
        $data['items'] = $this->Category_model->itemCategory();

        $this->call->view('admin/menum', $data);
    }
    public function getCategories()
    {
        $categories = $this->db->table('categories')->get_all();
        echo json_encode($categories);
    }
    public function itemupdate($id)
    {
        if (isset($id)) {
            $name = $this->io->post('name');
            $category = $this->io->post('category');
            $description = $this->io->post('description');
            $price = $this->io->post('price');

            if (!empty($_FILES['image']['name'])) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check === false) {
                    echo "<script>alert('File is not an image.');</script>";
                    $uploadOk = 0;
                }

                if (file_exists($target_file)) {

                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        echo ("The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been overwritten.");
                    } else {
                        echo ("Sorry, there was an error overwriting your file.");
                    }
                } else {
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if ($check === false) {
                        $uploadOk = 0;
                        echo ("File is not an image.");
                    }
                }
                if ($_FILES["image"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                        $data = [
                            "name" => $name,
                            "category_id" => $category,
                            "description" => $description,
                            "img_path" => $target_file,
                            "price" => $price,
                        ];
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                        $data = [
                            "name" => $name,
                            "category_id" => $category,
                            "description" => $description,
                            "price" => $price,
                        ];
                    }
                }
            } else {
                $data = [
                    "name" => $name,
                    "category_id" => $category,
                    "description" => $description,
                    "price" => $price,
                ];
            }

            $this->db->table('items')->where("item_id", $id)->update($data);

            redirect('/manage-menu');
        }
    }

    public function addItem()
    {
        $name = $this->io->post('name');
        $category = $this->io->post('category');
        $description = $this->io->post('description');
        $price = $this->io->post('price');


        if (!empty($_FILES['image']['name'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                echo "<script>alert('File is not an image.');</script>";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                echo "<script>alert('Sorry, file already exists.');</script>";
                $uploadOk = 0;
            }

            if ($_FILES["image"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                    $data = [
                        "name" => $name,
                        "category_id" => $category,
                        "description" => $description,
                        "img_path" => $target_file,
                        "price" => $price
                    ];
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    $data = [
                        "name" => $name,
                        "category_id" => $category,
                        "description" => $description,
                        "price" => $price

                    ];
                }
                $insertResult = $this->LAVA->db->table('items')->insert($data);
                if ($insertResult) {
                    echo "Data inserted successfully!";
                } else {
                    echo "Error inserting data: " . $this->db->error()['message'];
                }
                redirect('/manage-menu');
            }
        }
    }


    public function itemdelete($id)
    {
        if (isset($id)) {
            $this->db->table('items')->where("item_id", $id)->delete();
            redirect('/manage-menu');
        } else {
            redirect('/manage-menu');
        }
    }
    public function itemedit($id)
    {
        $data['employee'] = $this->Main_model->menu();
        $data['edit'] = $this->Main_model->searchInfo($id);
    }
    public function book()
    {
        $data['tables'] = $this->Table_model->getTables();
        $this->call->view('user/book', $data);
    }
    public function menu()
    {
        $data = $this->Main_model->menu();
        $categ = $this->Main_model->category();
        $this->call->view('user/menu', ['menu_data' => $data, 'category_data' => $categ]);
    }


    public function index()
    {
        if (!isset($_SESSION['user_data'])) {
            redirect(site_url('/login'));
        }
        $data['tables'] = $this->Table_model->getTables();
        $data['menu_data'] = $this->Main_model->menu();
        $data['category_data'] = $this->Main_model->category();
        $this->call->view('user/index', $data);
    }
    public function register()
    {
        $this->call->view('register');
    }
    public function login()
    {
        $this->call->view('login');
    }
    public function logout()
    {
        session_destroy();
        redirect('/login');
    }
    public function delete($cartid)
    {
        if (isset($cartid)) {
            $this->db->table('cart')->where("cart_id", $cartid)->delete();
            redirect('/mycart');
        } else {
            redirect('/mycart');
        }
    }
    public function verification()
    {
        $email = $_SESSION['email'];
        $user = $this->db->table('users')->where(array('email' => $email))->get();
        if ($user) {
            $status = $user['status'];
            if ($status == "active") {
                redirect('/');
            } else {
                $this->call->view('verify');
            }
        }
    }
    public function signin()
    {
        $email = $this->io->post('email');
        $enteredPassword = $this->io->post('password');
        $user = $this->db->table('users')->where(array('email' => $email))->get();

        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_data'] = $user;
            $_SESSION['email'] = $email;

            $status = $user['status'];
            $hashedPassword = $user['password'];

            if (password_verify($enteredPassword, $hashedPassword)) {
                if ($status == "active") {
                    if ($user['user_type'] == 'admin') {
                        redirect('/admin');
                    } else {
                        redirect('/');
                    }
                } else {
                    $email_token = $user['token'];
                    $this->verify($email, $email_token);
                    $this->call->view('verify');
                }
            } else {
                echo '<script>alert("Incorrect password"); window.location.href = "/login";</script>';
            }
        } else {
            echo '<script>alert("Email does not exist"); window.location.href = "/login";</script>';
        }
    }




    public function insert()
    {
        $this->call->library('form_validation');
        $this->form_validation
            ->name('firstname')
            ->required()
            ->min_length(5)
            ->max_length(20)
            ->name('lastname')
            ->required()
            ->min_length(5)
            ->max_length(20)
            ->name('password')
            ->required()
            ->min_length(8)
            ->name('confirmpassword')
            ->matches('password')
            ->required()
            ->min_length(8)
            ->name('email')
            ->valid_email();
        if ($this->form_validation->run() == FALSE) {
            echo '<script>alert("Form validation failed.");</script>';
            $this->call->view('register');
        } else {
            $firstname = $this->io->post('firstname');
            $lastname = $this->io->post('lastname');
            $email = $this->io->post('email');
            $password = $this->io->post('password');

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $email_token = md5(uniqid(rand(), true));

            $this->LAVA->db->transaction();

            $existingUser = $this->LAVA->db->table('users')->where('email', $email)->get();

            if ($existingUser) {
                $this->LAVA->db->roll_back();
                echo '<script>alert("Email already in use."); window.location.href = "/login";</script>';
                return false;
            }

            $data = array(
                'first_name' => $firstname,
                'last_name' => $lastname,
                'password' => $hashedPassword,
                'email' => $email,
                'token' => $email_token
            );

            $res = $this->LAVA->db->table('users')->insert($data);

            if ($res) {
                $this->verify($email, $email_token);
                $this->LAVA->db->commit();
                $_SESSION['email'] = $email;
                $this->call->view('verify');
                return true;
            } else {
                $this->LAVA->db->roll_back();
                return false;
            }
        }
    }

    public function verify($to, $email_token)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jrishh2902@gmail.com';
            $mail->Password   = 'iypm jrms vvnq wqhp';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('algorithmphp@gmail.com', 'Clarish');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $mail->Body    = 'Click the following link to verify your email: <a href="http://localhost:8080/verify?token=' . $email_token . '">Verify Email</a>';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function verify_email()
    {
        $token = $_GET['token'];
        $email_token = $this->db->table('users')->where(array('token' => $token))->get();
        if ($email_token) {
            $email = $email_token['email'];
            if ($email) {
                $this->db->table('users')->where('email', $email)->update(['status' => 'active']);
                redirect('/');
            } else {
                echo '<script>alert("Invalid verification link."); window.location.href = "/verification";</script>';
            }
        } else {
            echo '<script>alert("This email is not registered."); window.location.href = "/verification";</script>';
        }
    }
}
