<?php

class ACL {

    /**
     * check if user is logged in
     */
    public static function requireLogin() {
        if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 1) {
            header('Location: /login');
            die;
        }
        return true;
    }

    /**
     * check if user is admin (must be logged in first)
     */
    public static function requireAdmin() {
        // First check if logged in
        self::requireLogin();

        // Then check if admin
        if (!isset($_SESSION['username']) || strtolower($_SESSION['username']) !== 'admin') {
            $_SESSION['reminder_error'] = 'Access denied. Admin privileges required.';
            header('Location: /home');
            die;
        }
        return true;
    }

    /**
     * cheeck if user is logged in (returns boolean, doesn't redirect)
     */
    public static function isLoggedIn() {
        return isset($_SESSION['auth']) && $_SESSION['auth'] === 1;
    }

    /**
     * check if user is admin (returns boolean, doesn't redirect)
     */
    public static function isAdmin() {
        return self::isLoggedIn() && 
               isset($_SESSION['username']) && 
               strtolower($_SESSION['username']) === 'admin';
    }
}