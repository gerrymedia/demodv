<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserClass
 *
 * @author Gerald
 */
class User {
    //put your code here
      
   public static function showLogin() {
       include_once INCLUDES_DIR."/login_form.inc";
   }
   
   public function loginUser($userName, $password) {
      
       // first we will check if username exists in database
       //print "User->loginUser(username):". $userName;
       //print "User->loginUser(password):". $password;
       $dbQueryUsername = new DBQuery();
       $usernameQuery = "SELECT * FROM users WHERE username = '".$userName."'";
       $mode = "count";
       $getNumberOfRows = $dbQueryUsername->query($usernameQuery, $mode);
       //print "getNumberOfRows:".$getNumberOfRows;
       if($getNumberOfRows > 0){ // username was found, so now let's query the password
           //print "UserFound:".$getNumberOfRows;
           $dbQueryUserPassword = new DBQuery();
           $encryptedPassword = md5($password);
           //print "User->loginUser(encrypted):".$encryptedPassword;
           $userPasswordQuery = "SELECT * FROM users WHERE username = '".$userName."' AND password = '".$encryptedPassword."'";
           $getNumberOfRows_pw = $dbQueryUserPassword->query($userPasswordQuery, $mode);
            if($getNumberOfRows_pw > 0) { // password and username found
                //print "UserPWFound:".$getNumberOfRows_pw;
                // Let's create a session for this user 
                $_SESSION['auth'] = "yes";
                
                // Let's also set a userId session
                $userIdThisUser = $this->getUserId($userName);
                $_SESSION['userId'] =  $userIdThisUser;
                
                // Redirect to our login page to show welcome message
                header("Location: login.php");
            }
           }
           
           
       }
       
       private function getUserId($username) {
           
           $dbQuery = new DBQuery();
           $userIdQuery = "SELECT id FROM users WHERE username = '".$username."'";
           $userIdResult = $dbQuery->query($userIdQuery, "single");
           
           $userId = $userIdResult[0]['id'];
           
           return $userId;
          
           
       }
       
   }
