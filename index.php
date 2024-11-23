<!DOCTYPE html>
<html>
<head>
    <title>CyberSecurity Sandpit</title>
    <!-- UPGRADED TO BOOSTRAP 5 FROM BOOSTRAP 4 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSP HEADER TO PREVENT CROSS SITE SCRIPTING -->
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; style-src https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css; script-src https://code.jquery.com/jquery-3.6.0.min.js; form-action 'self';">
</head>
<!-- ************************************************************************************* BODY -->
<body>
    <div id="login">

        <form name="loginform" action="appaction_login.php" method="post" class="form-horizontal">
            <div class="form-group">
        		<?php if(isset($_GET['msg']) && $_GET['msg'] <> NULL) echo '<table class="table table-condensed"><tr><th scope="row">'.htmlspecialchars($_GET['msg']).'</th></tr></table>'; ?>
                CyberSecurity Sandpit - Red team
                <br><br>
            </div>

            <div class="input-group align-middle">
                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>&nbsp;</span>
                <input type="text" class="input form-control" id="userlogin" name="userlogin" spellcheck="no" translate="no" placeholder="Login ID" maxlength="30" required>
                <br><br>
            </div>

            <div class="input-group align-middle">
                <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i>&nbsp;</span>
                <input type="password" class="input form-control" id="userpassword" name="userpassword" spellcheck="no" translate="no" placeholder="Password" maxlength="30" required> 
                <br><br>
            </div>

            <br>
            <div class="form-group">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary" id="login" name="login" value="login"> LOGIN </button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>