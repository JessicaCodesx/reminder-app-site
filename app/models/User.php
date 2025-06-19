<?php
session_start();

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        
    }

    public function test () {
      $db = db_connect();
      $statement = $db->prepare("select * from users;");
      $statement->execute();
      $rows = $statement->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }

    public function authenticate($username, $password) {
        /*
         * if username and password good then
         * $this->auth = true;
         */
		$username = strtolower($username);
		$db = db_connect();
        $statement = $db->prepare("select * from users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
		
		if (password_verify($password, $rows['password'])) {
			$_SESSION['auth'] = 1;
			$_SESSION['username'] = ucwords($username);
			unset($_SESSION['failedAuth']);
			header('Location: /home');
			die;
		} else {
			if(isset($_SESSION['failedAuth'])) {
				$_SESSION['failedAuth'] ++; //increment
			} else {
				$_SESSION['failedAuth'] = 1;
			}
			header('Location: /login');
			die;
		}
    }

  // user signup logic
  // check if username is taken 
  public function usernameExists($username){
    $username = strtolower($username);
    $db = db_connect();
    $statement = $db->prepare("SELECT COUNT(*) as count FROM users WHERE username = :name;");
    $statement->bindValue(':name', $username);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
  }

  // create a new account
  public function createUser($username, $password) {
    // validate the input first
    if (empty($username) || empty($password)) {
      $_SESSION['signup_error'] = 'Username and password are required'; 
      return false;
  }

    // check if the username already exists
    if ($this->usernameExists($username)) {
        $_SESSION['signup_error'] = 'Username already exists';
        return false;
    }

    // simulate generic password validaton
    if (strlen($password) < 8) {
        $_SESSION['signup_error'] = 'Password must be at least 8 characters long';
        return false;
    }

    try {
      $username = strtolower($username);
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $db = db_connect();
      $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password);");
      $statement->bindValue(':username', $username);
      $statement->bindValue(':password', $hashedPassword);

      if ($statement->execute()) {
        $_SESSION['signup_success'] = 'Account created successfully';
        return true;
      } else {
        $_SESSION['signup_error'] = 'Failed to create account';
        return false;
      }
    } catch (PDOException $e) {
        $_SESSION['signup_error'] = 'Database error: ' . $e->getMessage();
        return false;
    }
  }
}
