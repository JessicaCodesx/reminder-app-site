<?php
class Create extends Controller {

    public function index() {		
	    $this->view('create/index');
    }

    public function signup() {
          // Handle the signup form submission
          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              // get and santize the input
              $username = trim($_POST['username'] ?? '');  // trim the whitespace
              $password = $_POST['password'] ?? ''; // get pass
              $confirmPassword = $_POST['confirm_password'] ?? ''; // get pass confirmation

              // check passwords match
              if ($password !== $confirmPassword) {
                  // if they don't redirect to signup with error message
                  $_SESSION['signup_error'] = 'Passwords do not match :(';
                  header('Location: /create');
                  die;
              }

              // load user model to access methods
              $user = $this->model('User');

             // attempt to create a new account
              if ($user->createUser($username, $password)) {
                  // success - redirect to login
                  header('Location: /login');
                  die;
              } else {
                  // error - redirect back to signup form
                  header('Location: /create');
                  die;
              }
          } else {
              // If requets isnt a post redirect to signup form
              header('Location: /create');
              die;
          }
      }
  }