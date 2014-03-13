<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$_SESSION['userId'] = 1;
        
if(@$_SESSION['auth']!= "yes") {
    header("Location: login.php");
}

$_SESSION['currentShownImage'];
/*
 * This is a coding test for DailyVoice
 * completed by Gerry Lacuarta gerrymedia@gmail.com
 * index.php 
 */

use \Controller as Controller;
use \Image as Image;
use \Rating as Rating;

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
$allImages = Controller::getImages();

// Let's get an array of all second level keys in $images

$images = new Image();
$ids = $images->getIds($allImages);
//print_r($ids);
// Count the total members in the array, our images
$imageCount = count($allImages);
$maxArrayKey = $imageCount - 1;
// Pick a random array element, so we need to generate a random number from zero to the key of last item in the array
$randomKey = rand(0,$maxArrayKey);
while($randomKey == $_SESSION['currentShownImage']) { $randomKey = rand(0,$maxArrayKey); }
//debug: print $randomKey;
// Get the ID of the image associated with our randomKey
$randomImageId = $allImages[$randomKey]['id'];


// debug: print $randomImageId;

// Let's save this image ID in the current session so the user does not see it on the next display (navigation or thumbs vote)
$_SESSION['currentShownImage'] = $randomImageId;

// the following acts as a pseudo router when buttons are clicked

if($_GET['v']) {

    switch ($_GET['v']) {
        case "0":
            
            $vote = "down";
            //We'll show another random image
    Controller::showSingleImage($randomImageId);
                
            break;
        
        case "1":
            
            $vote = "up";
            //We'll show another random image
    Controller::showSingleImage($randomImageId);

            break;
        
        case "no":
            
             Controller::showSingleImage($_SESSION['currentShownImage']);

            break;

        default:
            break;
    }

    $rating = new Rating();
    // in production we need to filter GET values
    $idImageRated =  $_GET['id'];
    $previousImage = $idImageRated;
    $recordVote = $rating->recordVote($idImageRated, $_SESSION['userId'], $vote);
    
    
            
} else {
    
    // we'll show the first random image
    Controller::showSingleImage($randomImageId);
}
