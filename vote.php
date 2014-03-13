<?php
session_start();
/* 
 * vote.php
 *  
 */

/*
 * Let's load the bootstrap and configuration
 */

// Load boostrap in this demo application
require_once 'includes/bootstrap.inc';

// Let's load some configuration
require_once 'includes/config.inc';

$rating = new Rating();
$sendVote = $rating->recordVote($imageId, $userId, $vote);

?>
