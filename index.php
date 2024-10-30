<?php
/**
 * Plugin Name: coming-soon
 * Plugin URI: http://themegenic.com
 * Description: The #1 Coming Soon Page, Under Construction & Maintenance Mode plugin for WordPress.
 * Version: 1.0.0
 * Author: Themegenic
 * Author URI: http://themegenic.com
 * License: GPL2
 */
//echo get_option('cmsn_bgoption');

function cmsn_adminScripts() {
	
	wp_enqueue_script('thickbox');			
	wp_register_script('my-upload',  plugin_dir_url(__FILE__) . 'assets/js/custom_uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
	wp_enqueue_media();
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('jquery-style', plugin_dir_url(__FILE__) . 'assets/css/jquery-ui.css');
}

function cmsn_adminStyles() {
	wp_enqueue_style('thickbox');
	wp_register_style('stylesheet',  plugin_dir_url(__FILE__) . 'assets/css/style.css');
	wp_enqueue_style('stylesheet');
		
}


add_action('admin_print_scripts', 'cmsn_adminScripts');
add_action('admin_print_styles', 'cmsn_adminStyles');



function cmsn_colorPickerAssets($hook_suffix) {
    // $hook_suffix to apply a check for admin page.
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'cmsn_colorPickerAssets' );




include('admin_fields.php') ;
include('plug_functions.php') ;
 
 
function cmsn_settingsPage(){
	
	
	wp_register_script('bootstrap-new-js', plugins_url( 'assets/js/bootstrap.js', __FILE__ ));  
	wp_register_style('bootstrap-new-css', plugins_url( 'assets/css/bootstrap.css', __FILE__ ));
	wp_register_script('bootstrap-datepicker-js', plugins_url( 'assets/js/bootstrap-datepicker.js', __FILE__ ));
	wp_enqueue_script('bootstrap-new-js'); 
	wp_enqueue_style('bootstrap-new-css'); 
	wp_enqueue_script('bootstrap-datepicker-js');
	
	?>

<div class="container-fluid">
   
  <h1 class="title"><?php printf( __('Comming Soon Settings Panel','cmsn')); ?></h1>
  
  <ul class="nav nav-tabs custom-tab">
    <li class="active"><a data-toggle="tab" href="#home"><?php printf( __('Page content','cmsn')); ?></a></li>
    <li><a data-toggle="tab" href="#menu1"><?php printf( __('Page Desgin','cmsn')); ?></a></li>
    <li><a data-toggle="tab" href="#menu2"><?php printf( __('Contact/Social Icons','cmsn')); ?></a></li>    
    <li><a data-toggle="tab" href="#menu3"><?php printf( __('Add Extra css','cmsn')); ?></a></li>    
  </ul>

 
  
  <div class="tab-content">
  
    <div id="home" class="tab-pane fade in active">

        <div class="field_wrapper">	      
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("cmsn_section");
	            do_settings_sections("cmsn_group");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
		
		
    </div>
		
    <div id="menu1" class="tab-pane fade">     
 
	  <div class="for_bg_option">
	  <h4><?php printf( __('You can select any one as an background option','cmsn')); ?> </h4></br>
	  
	  <?php $bgres = sanitize_text_field(esc_js(get_option('cmsn_bgoption')));  ?>
		<form id="bgoption" method="post" action="" >
			
			<label class="radio-inline">
			<input type="radio" val="avideo" name="bgopt" <?php if($bgres=='avideo'){echo 'checked="checked"';} ?> ><?php printf( __('Activate background video','cmsn')); ?>
			</label>
			
			<label class="radio-inline">
			<input type="radio" val="acolour" name="bgopt" <?php if($bgres=='acolour'){echo 'checked="checked"';} ?> ><?php printf( __('Activate background Colour','cmsn')); ?>
			</label>
			</br></br>
			<div id="bgres" style="display:none" class="alert-success alert"></div>
<img style="display:none;" src="<?php echo plugins_url( 'assets/css/jquery.countdown.css', __FILE__ ); ?>" id="bgloading" />
			
		</form>
		
		
	  </div> 
	  
	  <?php 
	  $bgeres = sanitize_text_field(esc_js(get_option('cmsn_bgoption')));	 
	  if($bgeres == 'acolour'){	
		$bgc = 'block' ;
		$vdc = 'none' ;
		$sld = 'none' ;
	  } 
	  else if($bgeres == 'aslider'){
		$bgc = 'none' ;
		$vdc = 'none' ;
		$sld = 'block' ; 
	  }
	  else if($bgeres == 'avideo'){
		$bgc = 'none' ;
		$vdc = 'block' ;
		$sld = 'none' ; 
	  }
	  ?>
	  
	<?php $res = sanitize_text_field(esc_js(get_option('cmsn_slider')));  
			
		?>	 
	
	  <div class="for_slider" style="display:<?php echo $sld ; ?>;">
	  <h4><?php printf( __('Background Slider','cmsn')); ?></h4>
	     
		<form method="post" action="" id="imgslider">
			<div class="field_wrapper_add_more field_wrapper">	
			
			<div id="res"></div>
			<img style="display:none;" src="<?php echo plugins_url( 'assets/css/jquery.countdown.css', __FILE__ ); ?>" id="loading" />
			
			<div class="custom-row"><button type="submit" class="btn btn-primary"><?php printf( __('save images','cmsn')); ?></button></div>
			
			<?php 
			if($res != ''){
				$count = 1;
				foreach ($res AS $currentVal) {
					if($count==1){ $add_img = "add-icon.png"; } else { $add_img = "remove-icon.png"; }
			?>
				<div class="block">
				<input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
				<input type="text" id="image_<?php echo rand(1,1000000) ; ?>" name="field_name[]" value="<?php echo sanitize_text_field(esc_js($currentVal)) ; ?>"/>
				<a href="javascript:void(0);" class="<?php if($count==1){echo "add_button" ;}else{echo "remove_button";} ?>" title="Add field"><img src="<?php echo plugins_url( 'assets/images/'.$add_img, __FILE__ ); ?>"/></a>
				</div>	
				
			<?php
			$count = $count + 1 ;
				}
			}else{
			?>
		
			<div class="block"> 
			<input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
			<input type="text" id="image_1" name="field_name[]" value=""/>
			<a href="javascript:void(0);" class="add_button" title="Add field"><img src="<?php echo plugins_url( 'assets/images/add-icon.png', __FILE__ ); ?>"/></a>
			</div>	
			<?php } ?>
			
			</div>			
		</form>
	 </div>
	 

	 
	 
	 <div class="for_video_url" style="display:<?php echo $vdc ; ?>;">
	 <?php $vdres = sanitize_text_field(esc_js(get_option('cmsn_videoUrl')));  ?>	
		<h4> <?php printf( __('Video URL','cmsn')); ?></h4>
		<form method="post" action="" id="videourl">			
			<input type="text" id="video_url" name="video_url" value="<?php echo $vdres ; ?>"/>
			<div class="custom-row"><button type="submit" class="btn btn-primary"> <?php printf( __('save','cmsn')); ?> </button></div>
			
			<div id="vdres">
				<img style="display:none;" src="<?php echo plugins_url( 'assets/css/jquery.countdown.css', __FILE__ ); ?>" id="vdloading" />
			</div>
			
		</form>
	 </div>
	 

	  
	  <div class="for_bg_colour" style="display:<?php echo $bgc ; ?>;">
	 <?php $bgcol = sanitize_text_field(esc_js(get_option('cmsn_bgColour')));  ?>	
		<h4><?php printf( __('Background Colour ','cmsn')); ?></h4>
		<form method="post" action="" id="bgcolour">			
			<input type="text" class="my-input-class" id="bg_colour" name="bg_colour"  value="<?php echo $bgcol ; ?>">
		<div class="custom-row">	<button type="submit" class="btn btn-primary"> <?php printf( __('save','cmsn')); ?> </button></div>
			
			<div id="bgcolres">
				<img style="display:none;" src="<?php echo plugins_url( 'assets/css/jquery.countdown.css', __FILE__ ); ?>" id="bgcolloading" />
			</div>
			
		</form>
	 </div>
	 
	
	 
		  
    </div>
	
	<div id="menu2" class="tab-pane fade"> 
	
		<form method="post" action="" id="contact_social">
		 
			<div class="for_social_contact">
			 		
			
			<?php 
			
			$cn = sanitize_text_field(esc_js(get_option('cmsn_conenable')));
			if($cn != 'null'){
				echo '<div class="custom-check"><input type="checkbox" name="cmsn_social[]" value="cmsn_conenable" checked/>Enable Contact Us button</div> ';
			}else{
				echo '<input type="checkbox" name="cmsn_social[]" value="cmsn_conenable" />Enable Contact Us button<br> ';
			}
			
			$sp = sanitize_text_field(esc_js(get_option('cmsn_soicenable')));
			if($sp != 'null'){
				echo '<div class="custom-check"><input type="checkbox" name="cmsn_social[]" value="cmsn_soicenable" checked/>Enable Social Icons </div>';
			}else{
				echo '<div class="custom-check"><input type="checkbox" name="cmsn_social[]" value="cmsn_soicenable" />Enable Social Icons </div>';
			}
			
			
			$sb = sanitize_text_field(esc_js(get_option('cmsn_subscribeenable')));
			if($sb != 'null'){
				echo '<div class="custom-check"><input type="checkbox" name="cmsn_social[]" value="cmsn_subscribeenable" checked/>Enable Subscriber Form </div>';
			}else{
				echo '<div class="custom-check"><input type="checkbox" name="cmsn_social[]" value="cmsn_subscribeenable" />Enable Subscriber Form</div>';
			}
			
			?>
			
					
		
		
			<div class="custom-row">		
			<label> <?php printf( __('Contact form will submit to :','cmsn')); ?></label>
			<input type="email" name="cmsn_authorEmail" placeholder="admin@test.com" id="author_email" value="<?php echo sanitize_email(get_option('cmsn_authorEmail')) ; ?>" />
			</div>
								
	<div class="custom-row">		
			<label><?php printf( __('Social Icons:','cmsn')); ?></label>
				<div class="socials">
			<input type="text" name="cmsn_facebooklink" placeholder="facebook link"  value="<?php echo sanitize_text_field(esc_js(get_option('cmsn_facebooklink'))) ; ?>" />
			<input type="text" name="cmsn_twitterlink" placeholder="twitter link"  value="<?php echo sanitize_text_field(esc_js(get_option('cmsn_twitterlink'))) ; ?>" />
			<input type="text" name="cmsn_linkedinlink" placeholder="linkedin link" value="<?php echo sanitize_text_field(esc_js(get_option('cmsn_linkedinlink'))) ; ?>" />
			<input type="text" name="cmsn_pintersetlink" placeholder="pinterset link"  value="<?php echo sanitize_text_field(esc_js(get_option('cmsn_pintersetlink'))) ; ?>" />
			<input type="text" name="cmsn_gpluslink" placeholder="google plus link"  value="<?php echo sanitize_text_field(esc_js(get_option('cmsn_gpluslink'))) ; ?>" />
			</div>
			</div>
			<div class="custom-row">
			<label><?php printf( __('Subscriber form script:','cmsn')); ?></label>
			
			<textarea name="cmsn_subscriberform"  rows="5" cols="60"><?php echo sanitize_text_field(esc_js(get_option('cmsn_subscriberform'))); ?></textarea>
			</div>
			<div class="custom-row">
			<button type="submit" class="btn btn-primary"><?php printf( __('save','cmsn')); ?></button>
			
			</div>
			<div id="contact_social_res"></div>
			<img style="display:none;" src="<?php echo plugins_url( 'assets/css/jquery.countdown.css', __FILE__ ); ?>" id="contact_socialloading" />
			
			</div>
			
		</form>	
		
    </div>
		
    <div id="menu3" class="tab-pane fade"> 
	<form method="post" action="" id="extracss">
		<textarea name="extracss_textarea" id="extracss_textarea"  placeholder="Use your own custom css" rows="10" cols="100"><?php echo sanitize_text_field(esc_js(get_option('cmsn_extracssTextarea'))) ; ?></textarea>	
		<div id="extres">
		<img style="display:none;" src="<?php echo plugins_url( 'assets/css/jquery.countdown.css', __FILE__ ); ?>" id="extloading" />
		</div>
		<button type="submit" class="btn btn-primary"><?php printf( __('save','cmsn')); ?></button></br>
		
	</form>
		
    </div>
    
  </div>
</div>


	
		
		
		
		
		<script>
	
	
	
		/*------------------------- date picker start-------------------------*/
		jQuery(document).ready(function() {
			jQuery('#launch_date').datepicker({
				dateFormat : 'mm/dd/yy'				
			});
		});
		/*------------------------- date picker end-------------------------*/
		
		
		/*------------------------- wordpress colour picker start-------------------------*/
			(function ($) {
			$(function () {
			$('.my-input-class').wpColorPicker();
			});
			}(jQuery));
		/*------------------------- wordpress colour picker end-------------------------*/
		
		
		
			
		/*---------------------Add more images Start------------------------*/
			jQuery(document).ready(function(){
				
				function ran(){					
					return Math.floor((Math.random() * 100) + 1) ;					
				}
				
				var maxField = 100; 
				var addButton = jQuery('.add_button'); 
				var wrapper = jQuery('.field_wrapper_add_more'); 
				
				var x = 1; 
				jQuery(addButton).click(function(){ 
					if(x < maxField){ 
						x++; 
						jQuery(wrapper).append('<div class="block"><input id="_btn" class="upload_image_button" type="button" value="Upload Image" /><input type="text" id="image_'+ran()+'" name="field_name[]" value="--"/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="<?php echo plugins_url( 'assets/images/remove-icon.png', __FILE__ ); ?>"/></a></div>'); 
					}
				});
				jQuery(wrapper).on('click', '.remove_button', function(e){ 
					e.preventDefault();
					jQuery(this).parent('div').remove(); 
					x--;
				});
			});
			/*---------------------Add more images end------------------------*/
			
			
			/*---------------------save images start------------------------*/
			
			jQuery(document).ready(function (e) {
				jQuery("#imgslider").on('submit',(function(e) {
					e.preventDefault();
					var formdata = new FormData(this);				
					formdata.append('action', 'savebgsliderimg');
					jQuery.ajax({
						url: "<?php echo admin_url( 'admin-ajax.php' ) ; ?>",
						type: "POST",
						data:  formdata,
						contentType: false,
						cache: false,
						processData:false,
						beforeSend:function(){	
							jQuery('#res').html('') ;
							jQuery('#loading').css('display','block');
						},
						success: function(data)
						{
							if(data!=''){
								jQuery('#res').html(data) ;
							}
							jQuery('#loading').css('display','none');
							
						},
						error : function(xhr, textStatus, errorThrown){							
									alert('something going wrong please try again.');								
								}    
				   });
				}));
			});
			
			/*---------------------save images end------------------------*/
			
			
			
			
		   /*---------------------save background option start------------------------*/

		
		
				jQuery(document).ready(function () {
			
				jQuery("#bgoption input[name='bgopt']").click(function(){
					var chkda = jQuery('#bgoption input:radio[name=bgopt]:checked').attr('val') ;
									
					jQuery.ajax({
						url: "<?php echo admin_url( 'admin-ajax.php' ) ; ?>",
						type: "POST",
						data:  {
							action: 'activatebgoption',
							chkd: chkda
						},						
						beforeSend:function(){
					
						},
						success: function(data)
						{
							if(data!=''){
								
							}
							var val__ = '<?php echo get_option('cmsn_bgoption'); ?>';
							jQuery('#bgloading').css('display','none');
							
							if(chkda == 'aslider'){								
								jQuery('.for_slider').css('display','block');
								jQuery('.for_video_url').css('display','none');
								jQuery('.for_bg_colour').css('display','none');
							}
							else if(chkda == 'avideo'){								
								jQuery('.for_slider').css('display','none');
								jQuery('.for_video_url').css('display','block');
								jQuery('.for_bg_colour').css('display','none');
							}
							else if(chkda == 'acolour'){								
								jQuery('.for_slider').css('display','none');
								jQuery('.for_video_url').css('display','none');
								jQuery('.for_bg_colour').css('display','block');
							}
							
							
						},
						error : function(xhr, textStatus, errorThrown){							
									alert('something going wrong please try again.');								
								}    
				   });
				});				
			});
				
				
			/*---------------------save background option end------------------------*/
			
			
			
		/*---------------------save video url start------------------------*/
			
			jQuery(document).ready(function () {
				jQuery("#videourl").on('submit',(function(e) {
					e.preventDefault();
					
					jQuery.ajax({
						url: "<?php echo admin_url('admin-ajax.php' ) ; ?>",
						type: "POST",
						data:  {
							action: 'savebgvideourl',
							url: jQuery("#videourl").find('input[name="video_url"]').val()
						},						
						beforeSend:function(){			    
			
						},
						success: function(data)
						{
							alert(data);
							if(data!=''){
								
							}
							
						},
						error : function(xhr, textStatus, errorThrown){							
									alert('something going wrong please try again.');								
								}    
				   });
				}));
			});
			
			/*---------------------save video url end------------------------*/
		
		
			/*---------------------save video url start------------------------*/
			
			jQuery(document).ready(function () {
				jQuery("#bgcolour").on('submit',(function(e) {
					e.preventDefault();
					
					jQuery.ajax({
						url: "<?php echo admin_url( 'admin-ajax.php' ) ; ?>",
						type: "POST",
						data:  {
							action: 'savebgcolour',
							bg_colour: jQuery("#bgcolour").find('input[name="bg_colour"]').val()
						},						
						beforeSend:function(){			    
						},
						success: function(data)
						{
							alert(data);
							if(data!=''){
							}
							
						},
						error : function(xhr, textStatus, errorThrown){							
									alert('something going wrong please try again.');								
								}    
				   });
				}));
			});
			
		/*---------------------save video url end------------------------*/
		
			/*---------------------save extra css start------------------------*/
			
			jQuery(document).ready(function () {
				jQuery("#extracss").on('submit',(function(e) {
					e.preventDefault();
					
					jQuery.ajax({
						url: "<?php echo admin_url( 'admin-ajax.php' ) ; ?>",
						type: "POST",
						data:  {
							action: 'saveextracsstextarea',
							extr: jQuery("#extracss_textarea").val()
						},						
						beforeSend:function(){			    
							
						},
						success: function(data)
						{
							alert(data);
							if(data!=''){
								
							}
							
						},
						error : function(xhr, textStatus, errorThrown){							
									alert('something going wrong please try again.');								
								}    
				   });
				}));
			});
			
		/*---------------------save extra css end------------------------*/
		
		
		
		
		
		/*---------------------save contact email start------------------------*/
			
			jQuery(document).ready(function () {
				jQuery("#contact_social").on('submit',(function(e) {
					e.preventDefault();
					var formdata = new FormData(this);	
					
					formdata.append('action', 'savecontactsocialopt');
					jQuery.ajax({
						url: "<?php echo admin_url( 'admin-ajax.php' ) ; ?>",
						type: "POST",
						data:  formdata,
						contentType: false,
						cache: false,
						processData:false,												
						beforeSend:function(){	
							jQuery('#contact_social_res').html('') ;
							
						},
						success: function(data)
						{
							alert(data);
							if(data!=''){
								
							}
							
							
						},
						error : function(xhr, textStatus, errorThrown){							
									alert('something going wrong please try again.');								
								}    
				   });
				}));
			});
			
		/*---------------------save contact email end------------------------*/
		

		</script>	
	
	 
	
<?php
	
}


//-----------admin page---------------------------------------------------

function cmsn_AddMenuItem()
{
	add_menu_page("Comming Soon", "Comming Soon", "manage_options", "comming-soon", "cmsn_settingsPage", null, 99);
}

add_action("admin_menu", "cmsn_AddMenuItem");




/*======================Front END =============================*/

function cmsn_redirect()
{	

		$sp = get_option('cusoon_pstatus');
	 
			if ( !is_user_logged_in()  )
			{
				if($sp=='pdisable'){					
									
				}elseif($sp=='enablecusoon'){  
					wp_register_script('bootstrap-js', plugins_url( 'assets/js/bootstrap.js', __FILE__ ));  
					wp_register_script('jquery-countdown-js', plugins_url( 'assets/js/jquery.countdown.js', __FILE__ ));   
					wp_register_style('bootstrap-css', plugins_url( 'assets/css/bootstrap.css', __FILE__ ));
					wp_register_style('style-css', plugins_url( 'assets/css/style.css', __FILE__ ));
					wp_register_style('media-css', plugins_url( 'assets/css/media.css', __FILE__ ));
					wp_register_style('jquery.countdown-css', plugins_url( 'assets/css/jquery.countdown.css', __FILE__ ));
					wp_register_style('font-style', 'https://fonts.googleapis.com/css?family=Roboto:100,400,500,900'); 
					$file =plugin_dir_path( __FILE__ ).'/csoon.php';
					include($file);
					exit();	
				}elseif($sp=='enablemaintenc'){ 
					wp_register_script('bootstrap-js', plugins_url( 'assets/js/bootstrap.js', __FILE__ ));  
					wp_register_script('jquery-countdown-js', plugins_url( 'assets/js/jquery.countdown.js', __FILE__ ));    
					wp_register_style('bootstrap-css', plugins_url( 'assets/css/bootstrap.css', __FILE__ ));
					wp_register_style('style-css', plugins_url( 'assets/css/style.css', __FILE__ ));
					wp_register_style('media-css', plugins_url( 'assets/css/media.css', __FILE__ ));
					wp_register_style('jquery.countdown-css', plugins_url( 'assets/css/jquery.countdown.css', __FILE__ ));
					wp_register_style('font-style', 'https://fonts.googleapis.com/css?family=Roboto:100,400,500,900'); 
					$file =plugin_dir_path( __FILE__ ).'/maintenace.php';
					include($file);
					exit();	
				}
				
			}
	
}



/*
* add action to call function wbr_coming_soon_pro_template_redirect
*/
add_action( 'template_redirect', 'cmsn_redirect' );