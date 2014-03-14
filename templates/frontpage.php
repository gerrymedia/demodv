<?php
session_start();
/* 
 * Frontpage template, used by the View class
 *
 * 
 *  */

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>Demo - Code Test for D__lyV___ce</title>
	<link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/ajax.js"></script>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
<div class="container">
    
    <?php
    
    /*
     * Let's pick a random image to display, from the array of all images
     */
    
    
    
    ?>
    <div class="row" id="photo-display">
        
        <h1>Don't You Love This Photo?</h1>
        
        <div class="display-container">
            <div class="nav" id="prev">
                <div class="btn-nav-container">
                     <div class="btn-nav">
                         <a href="/?v=no&img=<?php print $previousImageId; ?>" id="btn-prev"></a>
                      </div>
                </div>
            </div>

            <div class="image-container">

                <div class="image" id="image-id">
                <span class="helper"></span>
                  
                <?php print '<img src="/data/images/'.$singleImage[0]['image'].'" />'; ?>    
                </div>
                <div class="voting-widget-container">
                    <div class="voting-widget">
                        <div class="thumbs-up-votes">
                            <?php
                                print $votesUpPercentage."%";
                            ?>
                        </div>
                        <div class="thumbs-up-button">
                         <a href="/?v=up&img=<?php print $singleImage[0]['id']; ?>" id="btn-thumbup"></a>
                        </div>
                        <div class="thumbs-down-button">
                            <a href="/?v=down&img=<?php print $singleImage[0]['id']; ?>" id="btn-thumbdown"></a>
                        </div>
                        <div class="thumbs-down-votes">
                            <?php
                                print $votesDownPercentage."%";
                            ?>
                        </div>
                    </div>
                </div>
                
            </div><!-- /image-container -->

            <div class="nav" id="next">
                 <div class="btn-nav-container">
                     <div class="btn-nav">
                        <a href="/?v=no&img=<?php print $nextImageId; ?>" id="btn-next"></a>
                     </div>
                 </div>    
            </div>
            <br class="clear" />
        </div><!-- /#photo-display .container -->
<?php

// json in case I decide to use Angular (single page application)
// $json= json_encode($singleImage);

?>
    </div><!-- /photo-display -->
</div><!-- /container -->
<div id="developer-box">
<?php if($_SESSION['auth'] == "yes") {
    print "Developer/Tester Box: You are logged in as User ID: ".$_SESSION['userId'].". You may logout and destroy your session by clicking <a href='logout.php'>here</a>.";
}
?>
</div>
</body>
</html>

