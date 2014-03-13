<?php

/* 
 * config.inc
 * Constants and Configuration
 * 
 */

// Set some directories
define("ASSETS_DIR", "assets");
define("INCLUDES_DIR", "includes");

//Set the environment
define("ENV", "prod");

//Set the database credentials
define("DB_HOST", "mysql.phpprince.com");
define("DB_USERNAME", "dvtest01");
define("DB_PASSWORD","Dvtestpw1#");
define("DB_DATABASE","dvtest01");

//Number of votes allowed per user per image
define("VOTE_LIMIT", 1);

/*
 * Mode of restriction
 * Modes: account, IP address
 */
define("RESTRICT_BY", "account");

/*
 * Let's define the database engine
 */
define("DATABASE_ENGINE","MYSQL");

/*
 * Template extension
 */
define("TEMPLATE_EXT",".php");
define("TEMPLATE_DIR","templates");


