<?php


/**
 * Description of RatingClass
 *
 * @author Gerald
 */
class Rating {
    //put your code here
    
    public function recordVote($imageId, $userId, $vote) {
        
        $dbQuery = new \DBQuery();
             
        $recordVote = $dbQuery->query("INSERT INTO votes (
                        `id` ,
                        `user_id` ,
                        `image_id` ,
                        `vote` ,
                        `votedate`
                        )
                        VALUES (
                        NULL , '".$userId."', '".$imageId."', '".$vote."', NOW( )");
        }
    
}
