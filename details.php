<?php
session_set_cookie_params ([
    //SETS $httponly FOR THE PHP SESSION COOKIES
    'httponly' => true,
    //SETS $samesite TO PREVENT CROSS SITE SCRIPTING
    'samesite' => 'Strict'
]);
session_start();
// Set Non-Persistent database connection
$server=  'localhost';
$database='cloudybossnet_cs';
$username='cloudybossnet_cs';
$password='csp@ssw0rd1';
$driver_options=array(PDO::ATTR_PERSISTENT => false);
$pdo=new PDO("mysql:host={$server};dbname={$database};",$username,$password,$driver_options);
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// retrieve details
$result=array();
$querystring='SELECT * FROM users WHERE userid = '.$_GET['userid'].';';
$statement=$pdo->prepare($querystring);
$statement->setFetchMode(PDO::FETCH_ASSOC);
$statement->execute();
$result=$statement->fetchAll();
// Store the result in the session
if ($result && count($result) > 0) {
    $_SESSION['userDetails'] = $result[0];
    $user = $_SESSION['userDetails'];
}
// Check for errors
if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
} else {$errors = array();}
// print details 
if($result && count($result)>0) 
//UPGRADED TO BOOSTRAP 5 FROM BOOTSTRAP 4 
    {
    echo '  <!DOCTYPE html>
            <html>
            <head>
                <title>CyberSecurity Sandpit</title>
                <!-- CSP HEADER TO PREVENT CROSS SITE SCRIPTING -->
                <script src="some_custom_lib.js"></script>
                <meta http-equiv="Content-Security-Policy" content="default-src \'self\'; style-src https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css; script-src https://code.jquery.com/jquery-3.6.0.min.js \'self\'; form-action  \'self\'">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <body>';
            // Print error messages
            if (!empty($errors)) {
                echo '<div class="alert alert-danger">';
                foreach ($errors as $error) {
                    echo '<p>'.$error.'</p>';
                }
                echo '</div>';
            }
            echo '<form name="loginform" action="appaction_details.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div>
                        <table class="table table-condensed">
                            <tr>
                                <th scope="row">ID</th>
                                <td>
                                    <input type="text" class="input form-control" id="userid" name="userid" spellcheck="no" translate="no" placeholder="ID" value="'.$user['userid'].'" maxlength="5" required>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Login</th>
                                <td>
                                    <input type="text" class="input form-control" id="userlogin" name="userlogin" spellcheck="no" translate="no" placeholder="Login" value="'.$user['userlogin'].'" maxlength="30" required>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Password</th>
                                <td>
                                    <input type="password" class="input form-control" id="userpassword" name="userpassword" spellcheck="no" translate="no" placeholder="Password" value="'.$user['userpassword'].'" maxlength="30" required>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Name</th>
                                <td>
                                    <input type="text" class="input form-control" id="username" name="username" spellcheck="no" translate="no" placeholder="Name" value="'.$user['username'].'" maxlength="100" required>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Bank Account</th>
                                <td>
                                <input type="text" class="input form-control" id="userbankaccount" name="userbankaccount" spellcheck="no" translate="no" placeholder="Bank account" value="'.$user['userbankaccount'].'" maxlength="20" required>
                            </td>
                            </tr>
                            <tr>
                                <th scope="row">Profile</th>
                                <td>
                                    <label for="text">Enter text for your profile here:</label><br>
		                            <textarea id="userprofile" name="userprofile" rows="4" cols="50" maxlength="500">'.$user['userprofile'].'</textarea>
                                    <br>
                                    <a href="profile.php" target="_blank">See Profile Page in a different tab</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Profile photo</th>
                                <td>
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                </td>
                            </tr>    
                            <tr>
                                <th scope="row">Photo size</th>
                                <td>
                                <input type="text" class="input form-control" id="userphotosize" name="userphotosize" spellcheck="no" translate="no" placeholder="Photo size" value="'.$user['userphotosize'].' MB" disabled>
                            </td>
                            </tr>
                            <tr> 
                                <td> 
                                    <input type="submit" value="Upload Photo & Save data" name="submit">
                                </td> 
                            </tr>
                            <tr>
                                <th scope="row">More information</th>
                                <td>
                                    <iframe src="ifexample.html" width="500" height="500"></iframe>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>        
            </body>
            </html>';
    }
?>