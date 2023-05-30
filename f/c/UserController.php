<?php
require_once 'm/DB.php';

class UserController {

    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function index() {
        $this->login();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Register the user
        } else {
            // Display the registration form
            include 'v/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Authenticate the user
            $username = $this->db->escape($_POST['username']);
            $password = $_POST['password']; // Do not escape password; this could interfere with password verification

            $result = $this->db->query("SELECT * FROM `member` WHERE `username` = '$username'");

            if ($result->num_rows > 0) {
                $user = $result->row;

                if (password_verify($password, $user['password'])) {
                    // Start the session and store user data
                    session_start();
                    $_SESSION['user'] = $user;

                    // Redirect to profile page
                    header('Location: index.php?controller=User&action=profile');
                    exit;
                } else {
                    echo "Incorrect password.";
                    // Here, you could redirect back to the login page with a message about the error
                }
            } else {
                echo "No user found with this username.";
                // Here, you could redirect back to the login page with a message about the error
            }
        } else {
            // Display the login form
            include 'v/login.php';
        }
    }

    public function profile() {
        // Start the session
        session_start();

        if (isset($_SESSION['user'])) {
            // If user is logged in, display the profile page
            include 'v/profile.php';
        } else {
            // If user is not logged in, redirect to the login page
            header('Location: index.php?controller=User&action=login');
            exit;
        }
    }
}