<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

<div class="container">

	<h1>Videos</h1>
    
    <div class="row">
    
    <?php 
		include_once "Zend/Loader.php";
		Zend_Loader::loadClass('Zend_Gdata_Youtube');
		
		$youtube = new Zend_Gdata_Youtube();
		
		$videoFeed = $youtube->getvideoFeed('http://gdata.youtube.com/feeds/users/jamsfx/uploads');
		
		foreach ($videoFeed as $video): $thumbs = $video->getVideoThumbnails();
	?>
    <div class="span4" style="height:600px;">
    	<div class="thumbnail" >
            <h2><?php echo $video->getVideoTitle() ; ?></h2>
            <img src="<?php echo $thumbs[0]['url']; ?> " />        
            <p><?php echo $video->getVideoDescription() ; ?></p>
            <p><?php echo round($video->getVideoDuration()/60) ; ?></p>
            <p><a  href="<?php echo $video->getVideoWatchPageUrl() ; ?>" class="btn-primary">Voir videos</a></p>
        </div>    
    </div>
	
	<?php endforeach; ?>
    
    </div>  <!-- end row -->

</div> <!-- end container principal -->

</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
</html>