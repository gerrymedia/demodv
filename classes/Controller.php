<?php
/**
 *  This is the app's single controller.
 *
 * @author Gerald
 * @getImages() - return all images
 * @showSingleImage() - return a single image and output to View
 *  * 
 */

use \View as View;
use \Rating as Rating;
use Image;

class Controller {
   
    
        // this method will display all images; it instantiates the DBQuery class
        public static function getImages() {
            $getAllImages = new DBQuery();
            // we'll pass SQL query parameters to the class' query() method
            $images_collection = $getAllImages->query("SELECT id FROM images", "multiple");
            // finally let's return the $rows array

            return $images_collection;
        }
        
        // this method will pick a random image
        public static function showSingleImage($id,$imageIdsList) {
            $dbQuery = new DBQuery();
            $singleImageQuery = "SELECT * FROM images WHERE id = ".$id." LIMIT 1"; 
            // we'll pass SQL query parameters to the DBQuery class' query() method
            $singleImage = $dbQuery->query($singleImageQuery,"single");
            
            // we'll get the next item in the array after the current pointer in the $imageIdsArray
            $nextImageToShow = new Image();
            $nextImageId = $nextImageToShow->getImage($id,$imageIdsList,"next");
            
            $previousImageToShow = new Image();
            $previousImageId = $previousImageToShow->getImage($id,$imageIdsList,"prev");
            
            // the previous button will show the last image in the array    
            end($imageIdsArray); // move the internal pointer to the end of the array
            $lastKey = key($imageIdsArray); // fetches the key of the element pointed to by the internal
            $previousImageToShow_id = $imageIdsArray[$lastKey]; 

            /*
             * Count votes: We'll call a method in the Rating class
             */
            $thumbsUpCount = Rating::countVotes($id, "up");
            //print $id;
            $thumbsDownCount = Rating::countVotes($id, "down");
            
            $totalVotes = $thumbsUpCount + $thumbsDownCount;
            
            $votesUp = $thumbsUpCount/$totalVotes;
            $votesUpPercentage = round($votesUp * 100);
            
            $votesDown = $thumbsDownCount/$totalVotes;
            $votesDownPercentage = round($votesDown * 100);
                               
                                
            
            // create a new View object, passing our template file
            $view = new View('frontpage');
            // pass our data to the View template, asssigning to variables
            $view->displayAssign('singleImage', $singleImage);
            $view->displayAssign('previousImageId', $previousImageId);
            $view->displayAssign('nextImageId', $nextImageId);
            $view->displayAssign('votesUpPercentage', $votesUpPercentage);
            $view->displayAssign('votesDownPercentage', $votesDownPercentage);
        }
        
        public static function showError($message) {
            
             $view = new View('error');
             $view->displayAssign('errorMessage', $message);
        }
        
   
}
