<?php
require_once 'm/User.php';

class UserController {

    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function index() {
        $this->login();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $result = $this->user->create($username, $password);

            if ($result === TRUE) {
                echo "User registered successfully. Please login.";
                // Here, you could redirect to the login page
            } else {
                echo "Error: " . $result;
                // Here, you could redirect back to the registration page with a message about the error
            }
        } else {
            // Display the registration form
            include 'v/register.php';
        }
    }

    public function login() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Authenticate the user
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->user->find($username);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // Store user data in the session
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['status'] = $user['status'];
                    // Redirect to the profile page
                    header('Location: index.php?controller=User&action=profile');
                    exit();
                } else {
                    $_SESSION['error'] = "Incorrect password.";
                    header('Location: index.php?controller=User&action=login');
                    exit();
                }
            } else {
                $_SESSION['error'] = "No user found with this username.";
                header('Location: index.php?controller=User&action=login');
                exit();
            }
        } else {
            include 'v/login.php';
        }
    }

    public function profile() {
        // Start the session
        session_start();

        if (isset($_SESSION['username'])) {
            // If user is logged in, display the profile page
            include 'v/profile.php';
        } else {
            // If user is not logged in, redirect to the login page
            header('Location: index.php?controller=User&action=login');
            exit;
        }
    }


    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Only allow root or admin users to update status
            if ($_SESSION['role'] === 'root' || $_SESSION['role'] === 'admin') {
                $status = $_POST['status'];
                $result = $this->user->updateStatus($status);

                if ($result === TRUE) {
                    echo "Status updated successfully.";
                } else {
                    echo "Error: " . $result;
                }
            } else {
                echo "You are not authorized to update status.";
            }
        } else {
            include 'v/profile.php';
        }
    }


}