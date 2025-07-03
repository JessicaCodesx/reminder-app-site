<?php

class Reminders extends Controller {

    // user is authenticated and get user_id
    private function checkAuth() {
        if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 1) {
            header('Location: /login');
            die;
        }

        // user_id is not in session (for existing sessions) get it from database
        if (!isset($_SESSION['user_id'])) {
            $user = $this->model('User');
            $_SESSION['user_id'] = $user->getUserId($_SESSION['username']);
        }

        return $_SESSION['user_id'];
    }

    // all reminders for the loggedin user
    public function index() {
        $user_id = $this->checkAuth();

        $reminder = $this->model('Reminder');
        $reminders = $reminder->getUserReminders($user_id);

        $data = ['reminders' => $reminders];
        $this->view('reminders/index', $data);
    }

    //form to create new reminder
    public function create() {
        $this->checkAuth();
        $this->view('reminders/create');
    }

    public function store() {
        $user_id = $this->checkAuth();

        // Debug: check if user_id is valid
        error_log("DEBUG: user_id = " . var_export($user_id, true));

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $due_date = $_POST['due_date'] ?? null;

            // debug: Log the input values
            error_log("DEBUG: title = " . var_export($title, true));
            error_log("DEBUG: description = " . var_export($description, true));
            error_log("DEBUG: due_date = " . var_export($due_date, true));

            // basic validation
            if (empty($title)) {
                $_SESSION['reminder_error'] = 'Title is required';
                header('Location: /reminders/create');
                die;
            }

            if (empty($due_date)) {
                $due_date = null;
            }

            // debug: check if we can create the model
            $reminder = $this->model('Reminder');
            error_log("DEBUG: Reminder model created: " . var_export($reminder, true));

            $result = $reminder->createReminder($user_id, $title, $description, $due_date);
            error_log("DEBUG: createReminder result = " . var_export($result, true));

            if ($result) {
                $_SESSION['reminder_success'] = 'Reminder created successfully!';
                header('Location: /reminders');
                die;
            } else {
                $_SESSION['reminder_error'] = 'Failed to create reminder - check error logs';
                header('Location: /reminders/create');
                die;
            }
        }

        header('Location: /reminders/create');
        die;
    }

    // form to edit existing reminder
    public function edit($id) {
        $user_id = $this->checkAuth();

        $reminder = $this->model('Reminder');
        $reminderData = $reminder->getReminder($id, $user_id);

        if (!$reminderData) {
            $_SESSION['reminder_error'] = 'Reminder not found';
            header('Location: /reminders');
            die;
        }

        $data = ['reminder' => $reminderData];
        $this->view('reminders/edit', $data);
    }

    //updating existing reminder
    public function update($id) {
        $user_id = $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $due_date = $_POST['due_date'] ?? null;

            if (empty($title)) {
                $_SESSION['reminder_error'] = 'Title is required';
                header('Location: /reminders/edit/' . $id);
                die;
            }

            if (empty($due_date)) {
                $due_date = null;
            }

            $reminder = $this->model('Reminder');
            if ($reminder->updateReminder($id, $user_id, $title, $description, $due_date)) {
                $_SESSION['reminder_success'] = 'Reminder updated successfully!';
                header('Location: /reminders');
                die;
            } else {
                $_SESSION['reminder_error'] = 'Failed to update reminder';
                header('Location: /reminders/edit/' . $id);
                die;
            }
        }

        header('Location: /reminders');
        die;
    }

    //deleting reminder
    public function delete($id) {
        $user_id = $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reminder = $this->model('Reminder');
            if ($reminder->deleteReminder($id, $user_id)) {
                $_SESSION['reminder_success'] = 'Reminder deleted successfully!';
            } else {
                $_SESSION['reminder_error'] = 'Failed to delete reminder';
            }
        }

        header('Location: /reminders');
        die;
    }

    // toggling completion status
    public function toggle($id) {
        $user_id = $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reminder = $this->model('Reminder');
            if ($reminder->toggleComplete($id, $user_id)) {
                $_SESSION['reminder_success'] = 'Reminder status updated!';
            } else {
                $_SESSION['reminder_error'] = 'Failed to update reminder status';
            }
        }

        header('Location: /reminders');
        die;
    }
}