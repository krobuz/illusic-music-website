<?php
require_once 'config/Database.php';
require_once 'models/User.php';

class AuthController
{
    private $db;
    private $user;

    public function __construct($db)
    {
        $this->db = $db;
        $this->user = new User($this->db);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($password !== $confirmPassword) {
                echo "Passwords do not match. Please try again.";
                return;
            }

            $registrationSuccess = $this->user->register($username, $password, $confirmPassword);

            if ($registrationSuccess) {
                error_log("Registration successful, redirecting to login page.");
                header("Location: /music_website/login");
                exit();
            } else {
                error_log("Registration failed.");
                echo "Registration failed. Please try again.";
            }
        }

        // include 'views/register.php';
    }


    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $loggedInUser = $this->user->login($_POST['username'], $_POST['password']);
            if ($loggedInUser) {
                $_SESSION['user'] = $loggedInUser;
                error_log("Login successful, redirecting to dashboard.");
                header("Location: /music_website/views/home.php");
                exit();
            } else {
                error_log("Invalid credentials.");
                echo "Invalid credentials!";
                header("Location: /music_website/login");
                exit();
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        error_log("Logout successful, redirecting to login page.");
        header("Location: /music_website/login");
        exit();
    }
}
