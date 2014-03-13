<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Let's use PHP5's autoloading of classes
function __autoload($class_name) {
      require_once './classes/'.$class_name . '.php';
  }
