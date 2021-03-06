<?php 
class User {
    private $user;
    private $con;

    public function __construct($con, $user) {
        $this->con = $con;
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
        $this->user = mysqli_fetch_array($user_details_query);
    }

    public function getFullName() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return ucfirst($row['first_name']) . " " . ucfirst($row['last_name']);
    }

    public function getNumPosts() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];
    }

    public function getUsername() {
        return $this->user['username'];
    }

    public function isClosed() {
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT user_closed FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['user_closed'] == 'yes';
    }

    public function isFriend($username_to_check) {
        $usernameComma = "," .$username_to_check.",";
        return strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username'];
    }
}
?>