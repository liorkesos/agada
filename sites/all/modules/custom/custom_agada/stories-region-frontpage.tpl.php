<?php
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 *
**/
//dpm($simple_stories);
?>

	<!-- styles -->
	<link rel="stylesheet" href="../sites/all/themes/agada/css/jsquares.css" type="text/css" media="all" />	
	<!-- js -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
   <script src="../sites/all/themes/agada/js/jquery.hoverintent.min.js" type="text/javascript"></script>
	<script src="../sites/all/themes/agada/js/jquery.jsquares.js" type="text/javascript"></script>
    
	<script type="text/javascript">
		$(document).ready(function(){
			$('#js-container').jsquares();
		});
	</script>

    
    <div id="js-container">
	
			<div class="js-image size-1" style="top:5px;left:5px;">
            	<?php if (isset($extended_stories[0])) print $extended_stories[0]; ?>
			</div>
		
			<div class="js-image size-2" style="top:5px;left:222px;">	
			<?php if (isset($simple_stories[0])) print $simple_stories[0]; ?>
			</div>
            
         <div class="js-image size-3" style="top:5px;left:394px;">	 
			  <?php  if (isset($extended_stories[1])) print $extended_stories[1]; ?>
			</div>
            
            <div class="js-image size-4" style="top:265px;left:223px;">	
					<?php  if (isset($simple_stories[1])) print $simple_stories[1]; ?>
			</div>
            
            <div class="js-image size-5" style="top:375px;left:5px;">	   
				 <?php  if (isset($extended_stories[2])) print $extended_stories[2]; ?>

			</div>
            
            <div class="js-image size-6" style="top:375px;left:394px;">
					<?php  if (isset($extended_stories[3])) print $extended_stories[3]; ?>
			</div>
		
        	<div class="clear"></div>  
         <div class="clear"></div>
				
	</div>