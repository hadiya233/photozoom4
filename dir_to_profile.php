
<?php 
session_start();


  $user_id=$_GET['user'];

if ($user_id== $_SESSION["username"]) {
   header('location:profile.php');
} else {
 header('location:other_profile.php?user='.$user_id);
}



 ?>