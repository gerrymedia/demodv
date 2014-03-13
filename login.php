<?php

/* 
 * login.php
 *  
 */

/*
 * Let's load the bootstrap and configuration
 */

use \User as User;

// Load boostrap in this demo application
require_once 'includes/bootstrap.inc';

// Let's load some configuration
require_once 'includes/config.inc';

if($_SESSION['auth']== "yes") {
    header("Location: index.php");
} else {
    $showLogin = User::showLogin();
}
