<?php
// (A) STARS CLASS
class Stars {
  // (A1) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo;
  private $stmt;
  public $error;
  function __construct () {
    try {
      $this->pdo = new PDO(
        "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
        DB_USER, DB_PASSWORD,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );
    } catch (Exception $ex) {
      die($ex->getMessage());
    }
  }

  // (A2) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  // (A3) SAVE/UPDATE USER STAR RATING
  function save ($pid, $uid, $stars) {
    try {
      $this->stmt = $this->pdo->prepare(
        "REPLACE INTO `star_rating` (`product_id`, `user_id`, `rating`) VALUES (?,?,?)"
      );
      $this->stmt->execute([$pid, $uid, $stars]);
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
    return true;
  }

  // (A4) GET USER STAR RATINGS
  function get ($uid) {
    $this->stmt = $this->pdo->prepare(
      "SELECT * FROM `star_rating` WHERE `user_id`=?"
    );
    $this->stmt->execute([$uid]);
    $ratings = [];
    while ($row = $this->stmt->fetch(PDO::FETCH_NAMED)) {
      $ratings[$row['product_id']] = $row['rating'];
    }
    return $ratings;
  }

  // (A5) GET AVERAGE STAR RATING
  function avg () {
    $this->stmt = $this->pdo->prepare(
      "SELECT `product_id`, ROUND(AVG(`rating`), 2) `avg` FROM `star_rating` GROUP BY `product_id`"
    );
    $this->stmt->execute();
    $average = [];
    while ($row = $this->stmt->fetch(PDO::FETCH_NAMED)) {
      $average[$row['product_id']] = $row['avg'];
    }
    return $average;
  }
  
}

// (B) DATABASE SETTINGS
// ! CHANGE TO YOUR OWN !
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// (C) NEW STARS OBJECT
$_STARS = new Stars();
