<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User;

/**
 * Description of UserClass
 *
 * @author Gerald
 */
class User {
    //put your code here
   public function __construct() {
      
   }
   
   public static function showLogin() {
       include_once INCLUDES_DIR."/login_form.inc";
   }
}
