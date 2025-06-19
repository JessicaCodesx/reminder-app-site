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

  // log log in attempts > including ip address like a real swe B)
  public function logLoginAttempt($username, $result) {
      try {
          $db = db_connect();
          $statement = $db->prepare("INSERT INTO login_attempts (username, attempt_result, ip_address, user_agent) VALUES (:username, :result, :ip, :user_agent)");

          $statement->bindValue(':username', strtolower($username));
          $statement->bindValue(':result', $result);
          $statement->bindValue(':ip', $_SERVER['REMOTE_ADDR'] ?? 'unknown');
          $statement->bindValue(':user_agent', $_SERVER['HTTP_USER_AGENT'] ?? 'unknown');

          $statement->execute();
      } catch (PDOException $e) {
          // Log error but dont break login process
          error_log("Failed to log login attempt: " . $e->getMessage());
      }
  }

  // check if user is locked out
  public function isUserLockedOut($username) {
      try {
          $db = db_connect();
          $username = strtolower($username);

          // check failed attempts in the last 5 mins
          $statement = $db->prepare("
              SELECT COUNT(*) as failed_count, 
                     MAX(attempt_time) as last_attempt_time
              FROM login_attempts 
              WHERE username = :username 
              AND attempt_result = 'bad' 
              AND attempt_time > DATE_SUB(NOW(), INTERVAL 5 MINUTE)
          ");
          $statement->bindValue(':username', $username);
          $statement->execute();
          $result = $statement->fetch(PDO::FETCH_ASSOC);

          $failedCount = $result['failed_count'];
          $lastAttempt = $result['last_attempt_time'];

          // 3 or more failed attempts and last attempt was within last 60 seconds
          if ($failedCount >= 3 && strtotime($lastAttempt) > strtotime('-60 seconds')) {
              return [
                  'locked' => true,
                  'last_attempt' => $lastAttempt,
                  'failed_count' => $failedCount
              ];
          }

          return [
              'locked' => false,
              'failed_count' => $failedCount
          ];

      } catch (PDOException $e) {
          error_log("Failed to check lockout status: " . $e->getMessage());
          return ['locked' => false, 'failed_count' => 0]; // dont lock out if we cant check
      }
  }

  //  get time remaining for lockout
  public function getLockoutTimeRemaining($username) {
      try {
          $db = db_connect();
          $username = strtolower($username);

          $statement = $db->prepare("
              SELECT MAX(attempt_time) as last_attempt_time
              FROM login_attempts 
              WHERE username = :username 
              AND attempt_result = 'bad' 
              AND attempt_time > DATE_SUB(NOW(), INTERVAL 60 SECOND)
          ");
          $statement->bindValue(':username', $username);
          $statement->execute();
          $result = $statement->fetch(PDO::FETCH_ASSOC);

          if ($result['last_attempt_time']) {
              $lastAttempt = new DateTime($result['last_attempt_time']);
              $now = new DateTime();
              $lockoutEnd = $lastAttempt->add(new DateInterval('PT60S')); // add 60 seconds

              if ($now < $lockoutEnd) {
                  $diff = $now->diff($lockoutEnd);
                  return $diff->s + ($diff->i * 60); // return seconds remaining
              }
          }
          return 0;
      } catch (Exception $e) {
          error_log("Failed to get lockout time: " . $e->getMessage());
          return 0;
      }
  } 

  // authenticate user
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
