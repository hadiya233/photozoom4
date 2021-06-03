
<?php 
session_start();

    include_once("conn.php");
$id_post=$_GET['id_post'];
$username=$_SESSION["username"];

$sql = "DELETE FROM post WHERE post_id=$id_post and post_by='$username'";

if ($conn->query($sql) === TRUE) {
   header('location:profile.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

 ?>