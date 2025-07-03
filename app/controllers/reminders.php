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



  
}