<?php
session_start();
/* 
 * login.php
 *  
 */

/*
 * Let's load the bootstrap and configuration
 */

// Load boostrap in this demo application
require_once 'includes/bootstrap.inc';

// Let's load some configuration
require_once 'includes/config.inc';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>Demo - Code Test for D__lyV___ce</title>
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
<div class="container">
    <div class="login-container">
        <?php 
       if(@$_SESSION['auth'] != "yes") {
           
           switch ($_GET['do']) {
               case "login":
                    
               $user = new User();
               // for this demo we'll just accept raw input from the form; in production we need to sanitize user input
               $checkUser = $user->loginUser($_POST['username'], $_POST['password']);
               
               break;
           
               case "direct":
                   
                   include_once INCLUDES_DIR."/_direct_links.inc";
                   
                   break;
               
                case "developer":
                   // direct access for devs
                   $_SESSION['auth'] = "yes";
                   $_SESSION['userId'] = $_GET['u'];
                        
                   include_once INCLUDES_DIR."/member_welcome.inc";
                   
                   break;

               default:
                   
                   include_once INCLUDES_DIR."/login_form.inc";
                   
                   break;
           }
           
        } else {
            include_once INCLUDES_DIR."/member_welcome.inc";
        }
                
        ?>
    
     </div>
</div>
</body>
</html>
