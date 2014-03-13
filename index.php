<?php

/*
 * This is a coding test for DailyVoice
 * completed by Gerry Lacuarta gerrymedia@gmail.com
 * index.php 
 */

use \Controller as Controller;


/*
 * Let's load the bootstrap and configuration
 */

// Load boostrap in this demo application
require_once 'includes/bootstrap.inc';

// Let's load some configuration
require_once 'includes/config.inc';

/*
 * Let's assemble the frontpage
 */
// on the frontpage, we'll show a random image from the database
// instead of making an expensive RAND() call in MYSQL, we'll generate a random number in PHP 

// We'll call a static function from our custom Controller class and we'll receive an array of images
$images = Controller::getImages();
//debug: print_r($images);
// Count the total members in the array, our images
$imageCount = count($images);
$maxArrayKey = $imageCount - 1;
// Pick a random array element, so we need to generate a random number from zero to the key of last item in the array
$randomKey = rand(0,$maxArrayKey);
//debug: print $randomKey;
// Get the ID of the image associated with our randomKey
$randomImageId = $images[$randomKey]['id'];
// debug: print $randomImageId;

// Let's save this image ID in the current session so the user does not see it on the next display (navigation or thumbs vote)
//$_SESSION("currentShownImage") = randomImageId;

// Finally, we'll show the random image
Controller::showSingleImage($randomImageId);
