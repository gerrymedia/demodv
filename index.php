<?php
/*
 * 
 * index.php 
 */

error_reporting(E_ERROR | E_PARSE);
session_start();
        
if(@$_SESSION['auth']!= "yes") {
    header("Location: login.php");
}

$_SESSION['currentShownImage'];

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
// on the frontpage, we'll display  the first image from the the database

// We'll call a static function in our custom Controller class and we'll receive an array of images
$allImages = Controller::getImages(); // this methods makes a DB query

// Let's get an array of only image id's
$imageIds = Image::getIds($allImages); // this method does array manipulations

/*
 * We are going to reference $imageIds multiple times so let's assign its values 
 * to another variable so we don't invoke the method Image::getIds unnecessarily
 *  */
$imageIdsArray = $imageIds;

// assign the first element of the array to a semantic variable name
$firstImagefromDB = $imageIdsArray[0];

/*
 * The following conditional block acts as a pseudo router when buttons are clicked
 */

if($_GET['v']) {

    switch ($_GET['v']) {
                
        case "no":  // there's no vote, just a click on the navigation buttons
            
            // We also receive an img query string in the URL
            $imageToShow_id = $_GET['img'];
                                 
            Controller::showSingleImage($imageToShow_id,$imageIdsArray );

            break;

        default:
            
            if(!isset($_GET['img'])) { 
                // we expect an img id in the URL, if missing, show an error page
                Controller::showError("Image not found!");                
            }
            
            // Check if user has already voted; if true, then show a message    
            $duplicate = Rating::checkDuplicate($_SESSION['userId'], $_GET['img']);
            
            if($duplicate === true ) {
                 // User has already voted on this image, let's show a message
                Controller::showError("You have already voted on this image. You cannot vote on this image.");
               } else { // no duplicate found..
                
                // Let's record the vote, passing imageId, userId and the vote
                
                // Sanitize the URL parameters
                $vote = htmlspecialchars($_GET['v'], ENT_QUOTES, 'utf-8');
                $image = htmlspecialchars($_GET['img'], ENT_QUOTES, 'utf-8');
                
                // let's record the vote              
                $rating = new Rating();
                $voting = $rating->recordVote($image, $_SESSION['userId'], $vote);
                if($voting > 0) {
                    // vote was successfully recorded; we can the next image
                    
                    $nextImageToShow = new Image();
                    $nextImageToShow_id = $nextImageToShow->getImage($firstImagefromDB,$imageIdsArray,"next");
            
                    Controller::showSingleImage($nextImageToShow_id,$imageIdsArray);
                }
            }
            
            break;
    }
    
    
           
} else { 
    // If there are no query strings, we'll show the default frontpage
    // we'll show the first image from the DB, on first page load
    Controller::showSingleImage($firstImagefromDB,$imageIdsArray);
}

/*
 * Debugging Information
 */

