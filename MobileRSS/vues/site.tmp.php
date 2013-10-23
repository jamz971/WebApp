<?php include('includes/header.php'); ?>

<body>

<div data-role="page" id="site" data-theme="e" data-add-back-btn="true" data-dom-cache="true">

	<header data-role="header">
    
    		<h1><?php echo ucwords($nomSite);?></h1>
               
    </header>
        
        <div data-role="content" data-theme="e">
        
        	<ul data-role="listview" data-filter="true" data-filter-placeholder="Chercher un flux">
            	
                <?php 
				
                /*foreach($flux->query->results->item as $item) { 
					if ( isset($item->comments) && !empty($item->comments) )$comments = '<span class="ui-li-count">'.$item->comments[1].'</span>';
					else $comments = "";*/
					
					foreach($flux->query->results->item as $item) { 
					if ( isset($item->comments) )$comments = '<span class="ui-li-count">'.$item->comments[1].'</span>';
					elseif(isset($item->comments->content)) $comments = '<span class="ui-li-count">'.$item->comments->content.'</span>';
					else( $comments = "");
				?> 
                
                <li>
                	<h2><a href="article.php?nomSite=<?php echo $nomSite;?>&shortLink=<?php if(!isset($item->guid->content))echo urlencode($item->origLink);else echo urlencode($item->guid->content);?>" data-prefetch="true">
					<?php echo $item->title; ?>                  
                    </a></h2>
                    <?php echo $comments;?>
                </li>
                
                <?php  } ?>
                
            </ul>

    </div> <!-- end contain -->
    
</div> <!-- end  accueil -->
    
</body>

</html>