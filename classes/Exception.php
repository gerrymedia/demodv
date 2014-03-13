<?php

/**
 * Description of ExceptionsClass
 * @author Gerald
 */

namespace Exception;

class Exception {
    //put your code here
    
    public function DislayErrorMessage($errorMessage) {
        switch ($errorMessage) {
            case "Database Connection Error":
                $message = array("message" => "Database Connection Error");
                $view = new \Views;
                $render = $view->renderPageContent("error", $message);
                break;

            default:
                break;
        }
    }
}
