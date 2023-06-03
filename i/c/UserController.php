<?php
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
                echo "User registered successfully. Please <a href='index.php'>login.</a>";
                // Here, you could redirect to the login page
            } else {
                echo "Error: " . $result;
                // Here, you could redirect back to the registration page with a message about the error
            }
        } else {
            // Display the registration form
            load_view('user/register');
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
                    $_SESSION['id'] = $user['id'];
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
            load_view('user/login');
        }
    }

    public function profile() {
        // Start the session
        session_start();

        if (isset($_SESSION['username'])) {
            // If user is logged in, display the profile page
            load_view('user/profile');
        } else {
            // If user is not logged in, redirect to the login page
            header('Location: index.php?controller=User&action=login');
            exit;
        }
    }

    public function resetPasswordRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $user = $this->user->find($username);
            
            if ($user) {
                $resetLink = "index.php?controller=User&action=resetPassword&username=" . urlencode($username) . "&code=" . urlencode($user['code']);
                echo "A password reset link has been sent to your email: " . $resetLink;
            } else {
                echo "No user found with this username.";
            }
        } else {
            load_view('user/reset_password_request');
        }
    }

    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $code = $_POST['code'];
            $newPassword = $_POST['password'];
            $user = $this->user->find($username);
            
            if ($user && $user['code'] == $code) {
                $result = $this->user->updatePassword($username, $newPassword);
                
                if ($result === TRUE) {
                    echo "Password updated successfully. Please <a href='index.php?controller=User&action=login'>login</a>.";
                } else {
                    echo "Error: " . $result;
                }
            } else {
                echo "Invalid reset link.";
            }
        } else {
            load_view('user/reset_password');
        }
    }

    public function userList() {
        $users = $this->user->getAllUsers();

        if (!$users) {
            echo "No users found.";
            exit;
        }

        load_view('user/user_list', ['users' => $users]);
    }

    public function updateUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $status = $_POST['status'];
            $role = $_POST['role'];

            $result = $this->user->updateUser($username, $status, $role);

            if ($result === TRUE) {
                echo "User updated successfully.";
            } else {
                echo "Error: " . $result;
            }
        } else {
            load_view('user/user_list', ['users' => $users]);
        }
    }
}