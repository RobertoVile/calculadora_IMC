<?php
namespace Controller;

use Model\User;
use Exception;

class UserController {
    private $UserModel;

    public function __construct() {
        $this->UserModel = new User();
    }

    public function registerUser($user_fullname, $email, $password) {
        if (empty($user_fullname) || empty($email) || empty($password)) {
            return false; 
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        return $this->UserModel->post($user_fullname, $email, $hashed_password);
    }

    public function loginUser($email, $password) {
        $user = $this->UserModel->getUserByEmail($email);

        if ($user) {
            if (crypt($password, $user['password']) === $user['password']) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['password'] = $user['password'];
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function isLoggedIn() {
        return isset($_SESSION['id']);
    }

    public function getUser($user_id, $user_fullname, $email) {
        $user_id = $_SESSION['id'];
        return $this->UserModel->getUserInfo($user_id, $user_fullname, $email); 
    }
}
