<?php

/**
 * The Database class provides the methods for connecting to
 * and querying the database
 * @author Gerald
 */
class DBQuery {
  
  public function __construct () {
      
      
   
  }
  
  public function connect(){
      //The Daily Voice Coding test specified only MySQL
      switch (DATABASE_ENGINE) {
          case "MYSQL":
          
          try {
              $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
              if($mysqli)
              {
                  return $mysqli;
              } else {
                  throw new Exception('Unable to connect');
              }
          } catch (Exception $ex) {
              echo $ex->getMessage();
          }
          
          break;

          default:
              break;
      }
      
      
      }
      
      public function query($query,$mode){
          
          // let's make a connection to the DB
          $dbLink = $this->connect();
          // let's pass the query
          
          if($mode == "insert") {
              $result = $dbLink->prepare($query);
          } else {
              $result = $dbLink->query($query);
          }
          
          if(!$result){
                die('There was an error running the query [' . $dbLink->error . ']');
            }
                   
          // in production we should use an exception for db connection error
          
          // Let's close the connection
         $dbLink->close;
          
          // we need customize the returned value based on mysql output
          switch ($mode) {
              case "single": //a query expecting a single row of result
                  
                $array_result = array();
                //print_r($result);  
                while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $array_result[] = $row;
                }
                
                $queryresult =  $array_result;
                
                break;
                  
                case "count":
                
                $num_rows = $result->num_rows;
                
                //print_r($num_rows);

                 $queryresult = $num_rows;
                
                  break;
              
              case "insert":
                  
                  $queryresult  = $mysqli->insert_id; // the vote ID
                  

                  break;
              
              case "update":


                  break;
              
              case "multiple":  // a query expecting multiple rows of result
                
                
                  
                $array_result = array();
                while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $array_result[] = $row;
                }
                
                 $queryresult =  $array_result;
                 
                  break;

              default: 
                  
                 break;
          }
          
          return $queryresult;
     }
  }

