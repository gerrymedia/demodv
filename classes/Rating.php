<?php
/**
 * Handles rating and voting functions
 *
 * @author Gerald
 */

use DBQuery;

class Rating {
    //put your code here
    
  public function recordVote($imageId, $userId, $vote) {
        
        $now = date("Y-m-d H:i:s");
        
        $dbQuery = new DBQuery();
        
        $insertQuery = "INSERT INTO `votes` (`id`, `user_id`, `image_id`, `vote`, `votedate`) VALUES (NULL , '".$userId."', '".$imageId."', '".$vote."', '".$now."'";
        
       $recordVote = $dbQuery->query($insertQuery, "insert");
        print $insertQuery;
        return $recordVote; // contains a new vote id
        }
        
      public static function countVotes($id,$vote){
       
       // We need to make a database query
       $dbQuery = new DBQuery();
      
       $countVoteQuery = "SELECT * FROM votes WHERE image_id = ".$id." AND vote ='".$vote."'";
       //print $countVoteQuery;
       $voteCount = $dbQuery->query($countVoteQuery, "count");
       
      
       return $voteCount;
   }
   
   public static function checkDuplicate($userId,$imageId){
       
       $dbQuery = new DBQuery();
       $checkDuplicateVoteQuery = "SELECT * FROM votes WHERE user_id = ".$userId." AND image_id = ".$imageId;
       
       $duplicateCheckResult = $dbQuery->query($checkDuplicateVoteQuery,"count");
       
       if($duplicateCheckResult > 0) { // a voting record was found for this user and image
           $alreadyVoted = true;
       } else {
           $alreadyVoted = false;
       }
       
       return $alreadyVoted;
       
   }
   
}
