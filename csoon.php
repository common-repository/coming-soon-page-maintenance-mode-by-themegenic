<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
    <title><?php echo get_option('cmsn_title') ; ?></title>
	 <?php 
	 wp_enqueue_script('jquery');
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
	  $vdres = sanitize_text_field(esc_js(get_option('cmsn_videoUrl')));	
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
					  <img src="<?php echo esc_url(get_option('cmsn_logo')); ?>"/></a></div>
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
								
								
								<ul id="example"> 
								<li><span class="days"> <?php _e('00','cmsn'); ?></span><p class="days_text"><?php _e('Days','cmsn'); ?></p></li>
								<li class="seperator">:</li>
								<li><span class="hours"> <?php _e('00','cmsn'); ?></span><p class="hours_text"><?php _e('Hours','cmsn'); ?></p></li>
								<li class="seperator">:</li> 
								<li><span class="minutes"> <?php _e('00','cmsn'); ?></span><p class="minutes_text"><?php _e('Minutes','cmsn'); ?></p></li>
								<li class="seperator">:</li> 
								<li><span class="seconds"> <?php _e('00','cmsn'); ?></span><p class="seconds_text"><?php _e('Seconds','cmsn'); ?></p></li>
								</ul>


							
                          </div>
                      </div>
                  </div>
				  <div class="row">
					
					<div class="col-md-12">
					<div class="new-block">
						
						<?php 
						
							$cn = sanitize_text_field(esc_js(get_option('cmsn_conenable')));
							if($cn != 'null'){		
							echo '
							
								<div class="contact">
								<p>
								<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
								Click here to explore
								</a>						
								</p>
								</div>
							
							
							' ;
							}
						
						?>
						
						
						<?php 						
						$sp = sanitize_text_field(esc_js(get_option('cmsn_subscribeenable')));
						if($sp != 'null'){	
						$sb = sanitize_text_field(get_option('cmsn_subscriberform'));
						if($sb != ''){	
						?>
						<div class="newsletter">
							<?= html_entity_decode($sb);?>
						</div>
						<?php } } ?> 
						



						
						
						<?php 
							$sp = sanitize_text_field(esc_js(get_option('cmsn_soicenable')));
							if($sp != 'null'){	
						?>
						
						 <ul class="socail">
						 <?php 
							$f = sanitize_text_field(esc_js(get_option('cmsn_facebooklink')));
							if($f != ''){		
							echo '<li><a href="'.$f.'"><i class="fa fa-facebook"></i>Facebook</a></li>' ;
							}
							
							$t = sanitize_text_field(esc_js(get_option('cmsn_twitterlink')));
							if($t != ''){		
							echo '<li><a href="'.$t.'"><i class="fa fa-twitter"></i>Twitter</a></li>' ;
							}
							
							$l = sanitize_text_field(esc_js(get_option('cmsn_linkedinlink')));
							if($l != ''){		
							echo '<li><a href="'.$l.'"><i class="fa fa-linkedin"></i>Linkedin</a></li>' ;
							}
							
							$p = sanitize_text_field(esc_js(get_option('cmsn_pintersetlink')));
							if($p != ''){		
							echo '<li><a href="'.$p.'"><i class="fa fa-pinterest"></i>Pinterset</a></li>' ;
							}
							
							$g = sanitize_text_field(esc_js(get_option('cmsn_gpluslink')));
							if($g != ''){		
							echo '<li><a href="'.$g.'"><i class="fa fa-google-plus"></i>Gplus</a></li>' ;
							}

						 ?>
                             
							  
                          </ul>
						  
						<?php } ?> 
						
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
	
	
		jQuery('#example').countdown({
			date: '<?php echo get_option('cmsn_launchdate') ; ?> 23:59:59',
			offset: -8,
			day: 'Day',
			days: 'Days'
		}, function () {
		});
	

	</script>
	
	<div class="modal fade my-model" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
	  <div class="logo"><a href="javascript:void(0)" class="logo-img"><img src="<?php echo esc_url(get_option('cmsn_logo')) ; ?>" /></a></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php _e('Contact','cmsn'); ?> <span> <?php _e('us','cmsn'); ?></span></h4>
		<span class="line"></span> 
      </div>
      <div class="modal-body">
       <form method="post" action="" id="c_form">
		<fieldset>
			
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6 ful-width">
					<div class="form-group">
					<label><?php _e('First Name','cmsn'); ?> <span><?php _e('*','cmsn'); ?></span></label>
						<input name="f_name" type="text" class="form-control txtfield" placeholder="First Name" required/>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6 ful-width">
					<div class="form-group">
						<label> <?php _e('Last Name','cmsn'); ?> <span><?php _e('*','cmsn'); ?></span></label>
						<input name="l_name" type="text" class="form-control txtfield" placeholder="First Name" required/>
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					<label><?php _e('Email Address','cmsn'); ?> <span><?php _e('*','cmsn'); ?></span></label>
						<input type="email" name="email" class="form-control txtfield" placeholder="Email Address" required/>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
					<label><?php _e('Message','cmsn'); ?><span><?php _e('*','cmsn'); ?></span></label>
						<textarea required name="message" class="form-control txtfield" placeholder="Enter your message here.."></textarea>
					</div>
				</div>
				
			</div>
				  
		</fieldset>
	  
      </div>
      <div class="modal-footer">

        <button id="as" type="submit" class="btn btn-primary btn-block"><?php _e('Submit','cmsn'); ?></button>
		<div id="email_res"></div>
		<img  style="display:none;" src="<?php echo plugins_url( 'assets/images/loading.gif', __FILE__ ); ?>" id="loader_modal" alt="loading...." />
      </div>
	  
	   </form>
    </div>
  </div>
</div>

	<script>
		jQuery('#c_form').on('submit',function(event){			
			event.preventDefault()
			
				var formdata = new FormData(this);		
				formdata.append('action', 'userinfofromsubittedform');
				jQuery.ajax({
					url: "<?php echo admin_url( 'admin-ajax.php' ) ; ?>",
					type: "POST",
					data:  formdata,
					contentType: false,
					cache: false,
					processData:false,
					beforeSend:function(){	
						jQuery('#email_res').html('') ;
						jQuery('#loader_modal').css('display','block');
					},
					success: function(data)
					{
						if(data!=''){
							jQuery('#email_res').html(data) ;
						}
						jQuery('#loader_modal').css('display','none');
						
					},
					error : function(xhr, textStatus, errorThrown){	
					
								alert('something going wrong please try again.');
							}    
			   });
			
		});
	</script>


  </body>
  
</html>