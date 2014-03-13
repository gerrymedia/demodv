<?php
/* 
 * Frontpage template
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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
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
                    <?php print '<img src="'.ASSETS_DIR.'/img/btn_left_previous.jpg" width="50" height="50" alt="Previous">'; ?>
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
                                $totalVotes = $singleImage[0]['thumbs_up'] + $singleImage[0]['thumbs_down'];
                                $votesUp = $singleImage[0]['thumbs_up']/$totalVotes;
                                $votesUpPercentage = round($votesUp * 100);
                                print $votesUpPercentage."%";
                            ?>
                        </div>
                        <div class="thumbs-up-button">
                          <?php print '<img src="'.ASSETS_DIR.'/img/btn_thumbs_up.png" alt="Thumbs Up">'; ?>
                        </div>
                        <div class="thumbs-down-button">
                           <?php print '<img src="'.ASSETS_DIR.'/img/btn_thumbs_down.png" alt="Thumbs Down">'; ?>
                        </div>
                        <div class="thumbs-down-votes">
                            <?php
                                $votesDownPercentage = 100 - $votesUpPercentage; 
                                print $votesDownPercentage."%";
                            ?>
                        </div>
                    </div>
                </div>
                
            </div><!-- /image-container -->

            <div class="nav" id="next">
                <?php print '<img src="'.ASSETS_DIR.'/img/btn_right_next.jpg" width="50" height="50" alt="Next">'; ?>
            </div>
            <br class="clear" />
        </div><!-- /#photo-display .container -->
<?php

$json= json_encode($singleImage);
print "<pre>";
print_r($json);
print "</pre>";
echo "hello";
?>
    </div><!-- /photo-display -->
</div><!-- /container -->
</body>
</html>

