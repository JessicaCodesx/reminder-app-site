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





  
}