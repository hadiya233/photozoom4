
<?php 

session_start();
 include_once("conn.php");
       $id=  $_SESSION["userid"];
       $last= date("Y-m-d h:i:sa");
     $sql = "UPDATE `users` SET `user_status` = 'offline',`last_seen` = '$last' WHERE `user_id` = $id";
                            $conn->query($sql);


session_destroy();

header('location:index.php');
?>