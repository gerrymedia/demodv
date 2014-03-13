<?php

/* 
 * bootstrap.inc
 */
// Let's use PHP5's autoloading of classes
function __autoload($class_name) {
      require_once './classes/'.$class_name . '.php';
  }
