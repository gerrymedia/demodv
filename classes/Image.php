<?php

/**
 *  
 * Other useful methods would be createImage(), deleteImage()
 * @author Gerald
 * $getIds - This method manipulates the multidimensional array from the database results and returns a one-dimensional array of image id's 
 * @getImage - A method for getting the next and previous images (id's)
 */
class Image {
  
    public static function getIds($images) {
        
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
        
        //debug: print_r($ids);
        return $ids;
    
   }
   
    public function getImage($currentImage,$imageList, $direction) {
        
        // let's set the current pointer in the $imageList array to the value of $currentImage
        while (current($imageList) !== $currentImage) next($imageList);
        
        //debug output: 
        //print "Current pointer:".current($imageList);
        
        switch ($direction) {
            case "next":
                // set the next image id to the next value in the array
                
                /* 
                 * But if the current image is the last in the imageList array, the next image should be the first image, so it cycles
                 * 
                 */
                
                // let's find the last image id
                $lastImageId = $this->getLastImage($imageList);
                // let's find the first image id
                 $firstImageId = $this->getFirstImage($imageList);
                
                if($currentImage == $lastImageId) { // check if our current image is the last image in the list
                    $imageId = $firstImageId; // if yes, the next image will be the first image in the list
                } else { // else, we normally point to the next element in the array
                    $imageId = next($imageList); 
                }
                        
                
            
                break;

            default: // direction is prev(ious)
                
                 // set the previous image id to the prev value in the array       
                 
                /*
                 * But if the current shown image is the first in the array (our first image which is imageId 1 ),
                 * the previous image would be the last item in our images array, to give a cycling
                 * effect to our image voting test app
                 */
                if($currentImage == 1) { // for now we'll test against the value of the currentImage id; in production, we should test for key[0] because we can't always assume that the first image will be have an id of 1 (depending on the database query)
                    
                    // if the current image is the first image in the database, id 1, we'll set the previous button to go to the last image in the array
                    $imageId = end($imageList);
                } else { // else, set the previous image to the previous element in the array
                    $imageId = prev($imageList); 
                }
                            
                break;
        }
        return $imageId;
       
    }
    
    private function getLastImage($imagesList){
        
        $lastImage = end($imagesList);
        
        return $lastImage;
    }
    
    private function getFirstImage($imagesList){
        
        $firstImage = reset($imagesList);
        
        return $firstImage;
        
    }
   
  
 
    
}
