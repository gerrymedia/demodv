<?php
/*
 * This is a coding test for DailyVoice
 * completed by Gerry Lacuarta gerrymedia@gmail.com
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

// we'll get the next item in the array after the current pointer in the $imageIdsArray
$nextImageToShow_id = next($imageIdsArray);

// the previous button will show the last image in the array    
end($imageIdsArray); // move the internal pointer to the end of the array
$lastKey = key($imageIdsArray); // fetches the key of the element pointed to by the internal
$previousImageToShow_id = $imageIdsArray[$lastKey]; 
 
/*
 * The following conditional block acts as a pseudo router when buttons are clicked
 */

if($_GET['v']) {

    switch ($_GET['v']) {
                
        case "no":  // there's no vote, just a click on the navigation buttons
            
            // We also receive an img query string in the URL
            $imageToShow_id = $_GET['img'];
            
            // We need to generate the imageIds for the next and previous button
            // We'll pass these id's to our view via the Controller object
            // We'll do this by walking through the array, until we find the pointer of the current image
            // *while (current($imageIdsArray) !== $imageToShow_id) next($imageIdsArray);
            // Then we can get the next image (id)
             // * $nextImageToShow_id = next($imageIdsArray);
             // *print $nextImageToShow_id;
             // We'll walk again through the array
              //* while (current($imageIdsArray) !== $imageToShow_id) next($imageIdsArray);
            // Then we can get the previous image (id)
             //* $previousImageToShow_id = prev($imageIdsArray);
             //* print $previousImageToShow_id;
             
             $nextImageToShow_id = 1;
             $previousImageToShow_id = 2;
            
            Controller::showSingleImage($imageToShow_id,$nextImageToShow_id,$previousImageToShow_id);

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
                print "You cannot vote on this image";
            } else { // no duplicate found..
                //let's record the vote, passing imageId, userId and the vote
                
                $vote = $_GET['v'];
                              
                $rating = new Rating();
                $voting = $rating->recordVote($_GET['img'], $_SESSION['userId'], $vote);
                if($voting > 0) {
                    // vote was successfully recorded; we can the next image
                    Controller::showSingleImage($nextImageToShow_id);
                }
            }
            
            break;
    }
    
    
           
} else { 
    // If there are no query strings, we'll show the default frontpage
    // we'll show the first image from the DB, on first page load
    Controller::showSingleImage($firstImagefromDB,$nextImageToShow_id,$previousImageToShow_id);
}

/*
 * Debugging Information
 */

print "<p>User ID: ".$_SESSION['userId'];

print "<pre>";
print_r($imageIds);
print "</pre>";
print "Key:". key($imageIds);

print "Next Image to Show:".$nextImageToShow_id;
print "Previous Image to Show:".$previousImageToShow_id;