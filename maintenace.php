<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
    <title><?php echo get_option('cmsn_title') ; ?></title>
   <?php wp_enqueue_script('jquery');
	 wp_enqueue_script('bootstrap-js'); 
	 wp_enqueue_script('jquery-countdown-js'); 
	 wp_enqueue_style('bootstrap-css'); 
	 wp_enqueue_style('style-css'); 
	 wp_enqueue_style('media-css'); 
	 wp_enqueue_style('jquery.countdown-css'); 
	 wp_enqueue_style('font-style'); 
	 
	 ?>
   <style>
	
	<?php 
	if(get_option('cmsn_extracssTextarea')){
	echo sanitize_text_field(esc_js(get_option('cmsn_extracssTextarea'))) ;
	}
	?>
   
   </style>
   <?php  wp_head(); ?>
  </head>
  <body>
      <div class="banner" >
	 
	  <!------ background-color section start-------->
      
	  <?php 
	  $bgeres = sanitize_text_field(esc_js(get_option('cmsn_bgoption')));
	  $bgcolres = sanitize_text_field(esc_js(get_option('cmsn_bgColour')));
	  if($bgeres == 'acolour'){
		if($bgcolres != ''){
	  ?>
	  <div class="color" style="background-color:<?php echo $bgcolres ; ?> ;"></div>
	  
	  <?php 
		} 
	  } 
	  ?>
	  
	  <!------ background-color section end-------->
	  
	  
	  <!------ video section start-------->
	  <?php 
	   
	  $vdres = sanitize_text_field(esc_url(get_option('cmsn_videoUrl')));	
	  if($bgeres == 'avideo'){
		  
		if($vdres != ''){
	  ?>	  
		<div class="embed-responsive embed-responsive-16by9 fillWidth">
		<iframe  src="<?php echo $vdres ; ?>" autoplay="autopaly" frameborder="0" volume="0" allowfullscreen ></iframe>
		</div>
		
		<?php }else{ ?>
		  
		 <div class="embed-responsive embed-responsive-16by9 fillWidth">

		</div>
		  
	  <?php } } ?>
		
		  <!------ video section end -------->
	
	
	  <!--- -----hide overlay in bg color option /start--->  
	  <?php  if($bgeres != 'acolour'){	  ?>
          <div class="overlay"></div>      
	  <?php } ?>  
		  
	  <!--- -----hide overlay in bg color option /end--->
		  
		  <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                      <div class="logo"><a href="javascript:void(0)" class="logo-img">
					  <img src="<?php echo sanitize_text_field(esc_url(get_option('cmsn_logo'))) ; ?>"/></a></div>
                    </div>
                </div>
            </div>
          </header>
          <section>
              <div class="container">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="content">
                              
							  <h3><?php echo sanitize_text_field(esc_js(get_option('cmsn_mainheading'))) ; ?></h3>
                              <h1><?php echo sanitize_text_field(esc_js(get_option('cmsn_subheading'))) ; ?></h1>
							  <p><?php echo sanitize_text_field(esc_js(get_option('cmsn_maintextarea'))) ; ?></p>
								
							
                          </div>
                      </div>
                  </div>
				 
               </div>
          </section>
         
      </div>

	<script type="text/javascript">
	  <?php 
	  $bgeres = sanitize_text_field(esc_js(get_option('cmsn_bgoption'))); 
	  $res = sanitize_text_field(esc_js(get_option('cmsn_slider'))); 
	  if($bgeres == 'aslider'){
	  ?>
	       
		  
		  jQuery(document).ready(function() {
                jQuery(".banner").backgroundCycle({
                    imageUrls: [
					<?php foreach ($res AS $currentVal) { ?>
                        '<?php echo $currentVal ; ?>',
                        
					<?php } ?>
                    ],
                    fadeSpeed: 2500,
                    duration: 5000,
                    backgroundSize: SCALING_MODE_COVER
                });
            });
	 
	 <?php } ?>	
	
	
	

	</script>
	

  </body>
  
</html>