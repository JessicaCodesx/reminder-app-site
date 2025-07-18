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

    public function index() {
            $this->checkAdmin();

            // all data for reports
            $user = $this->model('User');
            $reminder = $this->model('Reminder');

            // all reminders with user info
            $allReminders = $reminder->getAllRemindersWithUsers();

            // user with most reminders
            $mostReminders = $reminder->getUserWithMostReminders();

            // login counts by username
            $loginCounts = $user->getLoginCountsByUsername();

            // stats
            $stats = [
                'total_reminders' => count($allReminders),
                'total_users' => $user->getTotalUsers(),
                'completed_reminders' => count(array_filter($allReminders, function($r) { return $r['completed']; })),
                'pending_reminders' => count(array_filter($allReminders, function($r) { return !$r['completed']; }))
            ];

            $data = [
                'all_reminders' => $allReminders,
                'most_reminders' => $mostReminders,
                'login_counts' => $loginCounts,
                'stats' => $stats
            ];

            $this->view('reports/index', $data);
        }
    }