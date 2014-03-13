<?php

/**
 *  
 * Other useful methods would be createImage(), deleteImage()
 * @author Gerald
 */
class Image {
  
    public function getIds($images) {
        
         $idsArray = array();
        
        foreach ($images as $key => $value) {
            $idsArray[] = $value;
            
            if (is_array($images[$value])) {
              
                     $idsArray = array_merge($idsArray,$this->getIds($images[$value]));
                
            }
        
        }
        return $idsArray;
    
   }
 
    
}
