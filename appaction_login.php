<?php
// instantiate or retrieve user session
session_start();
// Set Non-Persistent database connection
$server=  'localhost';
$database='cloudybossnet_cs';
$username='cloudybossnet_cs';
$password='csp@ssw0rd1';
$driver_options=array(PDO::ATTR_PERSISTENT => false);
$pdo=new PDO("mysql:host={$server};dbname={$database};",$username,$password,$driver_options);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// attempt login
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    // Redirect to the login page
    header('Location:index.php?msg=' . urlencode('No permission to access this page.'));
    exit();
}
// Validation of user input
if ((!empty($_POST['userlogin']) && strlen($_POST['userlogin']) <= 30) 
    && (!empty($_POST['userpassword']) && strlen($_POST['userpassword']) <= 30)) {

    $querystring = 'SELECT userid, userpassword FROM users WHERE userlogin = :userlogin';
    $statement = $pdo->prepare($querystring);
    $statement->bindParam(':userlogin', $_POST['userlogin'], PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Verification that password matches the hash
    if ($user && password_verify($_POST['userpassword'], $user['userpassword'])) {
        // if login successfull, go to details 
        header('Location:details.php?userid=' . $user['userid']);
        exit();
    }
}
// if login unsuccesfull, go back with a msg
header('Location:index.php?msg=' . urlencode('Login ID or Password is incorrect.'));
exit();
?>
