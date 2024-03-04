<?php
session_start();
include('connect.php');

$votes = $_POST['gvotes'];
$totalVotes = $votes+1;
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];

$updateVotes = mysqli_query($connect, "UPDATE user SET votes='$totalVotes' WHERE id='$gid' ");
$updateUserStatus = mysqli_query($connect, "UPDATE user SET status=1 WHERE id='$uid'");

if($updateVotes and $updateUserStatus){
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role=2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;
    echo '
    <script>
       alert("Voted Sucessfully!!");
       window.location = "../routes/dashboard.php";
      </script>
    ';
}else{
    echo '
    <script>
       alert("Some Error Occured!!");
       window.location = "../routes/dashboard.php";
      </script>
    ';
}
?>