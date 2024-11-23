<?php

// file upload
$target_dir = "uploads/";
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//FUNCTION UPLOAD ALLOWS THE FILE TO BE UPLOADED ONLY AFTER VERIFICATION
function upload($target_file){ 
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {}
}
// instantiate or retrieve user session
session_start();
$user = $_SESSION['userDetails'];
$_SESSION['errors'] = array();
// Set Non-Persistent database connection
$server=  'localhost';
$database='cloudybossnet_cs';
$username='cloudybossnet_cs';
$password='csp@ssw0rd1';
$driver_options=array(PDO::ATTR_PERSISTENT => false);
$pdo=new PDO("mysql:host={$server};dbname={$database};",$username,$password,$driver_options);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        // Redirect to the login page
        header('Location:index.php?msg=' . urlencode('No permission to access this page.'));
        exit();
}
//Define variables with user details from the database
$userid = $user['userid'];
$userlogin = $user['userlogin'];
$userpassword = $user['userpassword'];
$user_name = $user['username'];
$userbankaccount = $user['userbankaccount'];
$userprofile = $user['userprofile'];
$userfileName = $user['userfilename']; 
$userphotosize = $user['userphotosize'];
// Validation of user input, if data has been changed
if(!empty($_POST))
{
        if($user['userid'] != $_POST['userid']){
                if(!empty($_POST['userid']) && (strlen($_POST['userid']) <= 5 && is_numeric($_POST['userid']))) {
                        $userid = filter_var(trim($_POST['userid']), FILTER_SANITIZE_NUMBER_INT);
                } else $_SESSION['errors'][] = 'ID must be 1-5 numbers long.';
        } else 
        if($user['userlogin'] != $_POST['userlogin']){
                if(!empty($_POST['userlogin']) && strlen($_POST['userlogin']) <= 30) {
                        $userlogin = filter_var(trim($_POST['userlogin']), FILTER_SANITIZE_STRING);
                } else $_SESSION['errors'][] = 'Login must be 1-30 characters long.';
        } 
        if($user['userpassword'] !== $_POST['userpassword']){
                if(!empty($_POST['userpassword']) && strlen($_POST['userpassword']) <= 30) {
                        // Hash the new password
                        $userpassword = password_hash($_POST['userpassword'], PASSWORD_BCRYPT);
                } else $_SESSION['errors'][] = 'Password must be 1-30 characters long.';
        }
        if($user['username'] != $_POST['username']){
                if(!empty($_POST['username']) && (strlen($_POST['username']) <= 100 && preg_match('/^[a-zA-Z\-\'\s]+$/', $_POST['username']))) {
                        $user_name = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
                } else $_SESSION['errors'][] = 'Name must be 1-100 characters long.';
        }
        if($user['userbankaccount'] != $_POST['userbankaccount']){
                if(preg_match('/^[A-Z]{2}-\d{4,17}$/', $_POST['userbankaccount'])) {
                        $userbankaccount = filter_var(trim($_POST['userbankaccount']), FILTER_SANITIZE_STRING);
                } else $_SESSION['errors'][] = 'Bank account must match the format (LT-0001) and cannot be more than 20 characters long.';
        }
        if($user['userprofile'] != $_POST['userprofile']){
                if(strlen($_POST['userprofile']) <= 500) {
                        $userprofile = filter_var(trim($_POST['userprofile']), FILTER_SANITIZE_STRING);
                } else $_SESSION['errors'][] = 'Profile must be up to 500 characters long.';
        }        
} else $_SESSION['errors'][] = 'Form was uploaded incorrectly.';
//Validation of the file upload
$imageTypes = ['jpg', 'jpeg', 'png',];
if(!empty($_FILES)){
        if(!empty($_FILES["fileToUpload"]["name"]) && $user['userfilename'] != $target_file) {
                if(in_array($imageFileType, $imageTypes, true)) {
                        $userfileName = $target_file;
                        $userphotosize = $_FILES["fileToUpload"]["size"];
                        upload($target_file);
                } else $_SESSION['errors'][] = 'Invalid image type. Accepted types are: jpg, jpeg, png.';
        }    
} else $_SESSION['errors'][] = 'File is too large or invalid.';
// Redirect back with a list of errors, if data was not valid
if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
        header('Location:details.php?userid='.$userid);
        exit();
}
else {
        //Update the database with the new data
        $result=false;
        $querystring='REPLACE INTO users 
                        (userid, userlogin, userpassword, username, userbankaccount, userprofile, userfilename, userphotosize) 
                        VALUES ( '.$userid.',
                                "'.$userlogin.'", 
                                "'.$userpassword.'", 
                                "'.$user_name.'", 
                                "'.$userbankaccount.'", 
                                "'.$userprofile.'", 
                                "'.$userfileName.'",
                                "'.$userphotosize.'")';
        $statement=$pdo->prepare($querystring);
        $result=$statement->execute();
        if($result) header('Location:details.php?userid='.$userid);
        else        header('Location:index.php?msg=error');
}
?>