<?php

use DBQuery;

/**
 *  
 * Other useful methods would be createImage(), deleteImage()
 * @author Gerald
 */
class Image {
  
    public static function getIds($images) {
        
        // This method manipulates the multidimensional array from the database results
        // and returns a one-dimensional array of image id's 
        
        $idsArray = array();
        
        foreach ($images as $key => $value) {
            $idsArray[] = $value;
            
            if (is_array($images[$value])) {
              
                     $idsArray = array_merge($idsArray,$this->getIds($images[$value]));
                
            }
        
        }
        
        $ids = array();
        foreach ($idsArray as $key3 => $value3){
            $ids[]= $value3['id'];
        }
        
        //print_r($ids);
        return $ids;
    
   }
   
}
