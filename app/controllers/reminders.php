<?php

class Reminders extends Controller {

  // check if user is authenticated
  private function checkAuth() {
      if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== 1) {
          header('Location: /login');
          die;
      }
  }

  //list reminders for the logged-in user
  public function index() {
      $this->checkAuth();

      $reminder = $this->model('Reminder');
      $reminders = $reminder->getUserReminders($_SESSION['username']);

      $data = ['reminders' => $reminders];
      $this->view('reminders/index', $data);
  }

  // handle del a reminder
    public function delete($id) {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reminder = $this->model('Reminder');
            if ($reminder->deleteReminder($id, $_SESSION['username'])) {
                $_SESSION['reminder_success'] = 'Reminder deleted successfully!';
            } else {
                $_SESSION['reminder_error'] = 'Failed to delete reminder';
            }
        }
        header('Location: /reminders');
        die;
    }
  
    //toggling completion status
    public function toggle($id) {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reminder = $this->model('Reminder');
            if ($reminder->toggleComplete($id, $_SESSION['username'])) {
                $_SESSION['reminder_success'] = 'Reminder status updated!';
            } else {
                $_SESSION['reminder_error'] = 'Failed to update reminder status';
            }
        }
        header('Location: /reminders');
        die;
    }

    // form for creating new reminder
    public function create() {
        $this->checkAuth();
        $this->view('reminders/create');
    }

    // handle creating new reminder
    public function store() {
        $this->checkAuth();

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $due_date = $_POST['due_date'] ?? null;

        // bsic val
        if (empty($due_date)) {
          $due_date = null;
        }

        $reminder = $this->model('Reminder');
        if ($reminder->createReminder($_SESSION['username'], $title, $description, $due_date)) {
            $_SESSION['reminder_success'] = 'Reminder created successfully!';
            header('Location: /reminders');
            die;
        } else {
            $_SESSION['reminder_error'] = 'Failed to create reminder';
            header('Location: /reminders/create');  
            die;
        }
      }

      header('Location: /reminders/create');
      die;
    }


    // form for editing reminder
    public function edit($id) {
        $this->checkAuth();
        $reminder = $this->model('Reminder');
        $reminderData = $reminder->getReminder($id, $_SESSION['username']);

       if (!$reminderData) {
         $_SESSION['reminder_error'] = 'Reminder not found';
            header('Location: /reminders');
            die;
        }

      $data = ['reminder' => $reminderData];
      $this->view('reminders/edit', $data);
    }

    // handle updating reminder
    public function update($id) {
        $this->checkAuth();

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
        if ($reminder->updateReminder($id, $_SESSION['username'], $title, $description, $due_date)) {
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
}