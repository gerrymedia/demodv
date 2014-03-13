<?php
/**
 *  This is the app's single controller.
 *
 * @author Gerald
 * @getImages() - return all images
 *  * 
 */

use \View as View;

class Controller {
   
    
        // this method will display all images; it instantiates the DBQuery class
        public static function getImages() {
            $getAllImages = new DBQuery();
            // we'll pass SQL query parameters to the class' query() method
            $images_collection = $getAllImages->query("SELECT * FROM images LIMIT 0, 30", "multiple");
            // finally let's return the $rows array

            return $images_collection;
        }
        
        // this method will pick a random image
        public static function showSingleImage($id) {
            $dbQuery = new DBQuery();
            // we'll pass SQL query parameters to the DBQuery class' query() method
            $singleImage = $dbQuery->query("SELECT * FROM images WHERE id = ".$id, "single");
            // create a new View object, passing our template file
            $view = new View('frontpage');
            // pass our data to the View template in $images variable
            $view->displayAssign('singleImage', $singleImage);
        }
        
        
   
}
