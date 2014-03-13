<?php

/*
 * Views class
 * Implementation of the MVC methodology in this code test
 * 
 */

/**
 * Description of ViewsClass
 *
 * @author Gerald
 */
class View {
    
  private $render = FALSE;
    
  public function __construct($template) {
      
    // load the template file  
    try {
        $template = TEMPLATE_DIR."/".$template.TEMPLATE_EXT;

        if (file_exists($template)) {
            $this->render = $template;
        } else {
            throw new customException('Template file ' . $template . ' not found!');
        }
    }
    catch (customException $e) {
        echo $e->errorMessage();
    }
}

    // catch the assignment of the variable to the variable name; called from our controller
    public function displayAssign($variable, $value) {
        $this->data[$variable] = $value;
    }

    public function __destruct() {
        extract($this->data);
        include($this->render);

    }


}
