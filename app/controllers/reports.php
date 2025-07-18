<?php

class Reports extends Controller {

    // check if user is admin
    private function checkAdmin() {
        if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 1) {
            header('Location: /login');
            die;
        }

        if (!isset($_SESSION['username']) || strtolower($_SESSION['username']) !== 'admin') {
            $_SESSION['reminder_error'] = 'Access denied. Admin privileges required.';
            header('Location: /home');
            die;
        }

        return true;
    }