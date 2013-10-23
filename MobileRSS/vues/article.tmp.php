<?php include('includes/header.php'); 

$flux = $flux->query->results->item;
?>
<body>

<div data-role="page" id="article" data-dom-cache="true" data-add-back-btn="true">

   <header data-role="header" class="<?php echo $nomSite; ?>">
      <h1> <?php echo ucwords($nomSite); ?> </h1>
   </header><!-- /header -->

   <div data-role="content">	
        <h1> <?php echo $flux->title; ?> </h1>
        <h3>  <?php if(isset($flux->pubDate)) echo'Publié le'. $flux->pubDate; ?> <?php if(isset($flux->creator)) echo'par '. $flux->creator; ?> </h3>
        <h3> <?php if(isset($flux->category)) echo $flux->category; ?></h3>
        <div> <?php echo $flux->description; ?> </div>
   </div><!-- /content -->

   <footer data-role="footer" data-position="fixed" class="<?php echo $nomSite; ?>">
      <h4> <a href="<?php echo $shortLink?>" data-icon="forward" data-pretch="true"> Lire sur<?php echo''. ucwords($nomSite); ?></a></h4>
   </footer>
</div>
<!-- /page -->

</body>
</html>