<?php

add_action( 'wp_ajax_savebgsliderimg', 'cmsn_savebgsliderimg');
add_action( 'wp_ajax_nopriv_saveBgSliderImg', 'cmsn_savebgsliderimg');
function cmsn_savebgsliderimg(){
	
	$arr = sanitize_text_field($_POST['field_name']);
			
	update_option('cmsn_slider', $arr);
	
	$result = get_option('cmsn_slider');
	
	if($result != ''){
		echo "Images saved successfully" ;
	}else{
		echo "something going wrong please try again" ;
	}
	
	die() ;
	
}

add_action( 'wp_ajax_activatebgoption', 'cmsn_activatebgoption' );
add_action( 'wp_ajax_nopriv_activatebgoption', 'cmsn_activatebgoption' );
function cmsn_activatebgoption(){

	$arr = sanitize_text_field(esc_js($_POST['chkd']));

	update_option('cmsn_bgoption', $arr);
	
	$result = get_option('cmsn_bgoption');
	
	if($result != ''){

		echo "your option saved successfully" ;
	}else{
		echo "something going wrong please try again" ;
	}	
	die() ;
	
}

add_action( 'wp_ajax_savebgvideourl', 'cmsn_savebgvideourl' );
add_action( 'wp_ajax_nopriv_savebgvideourl', 'cmsn_savebgvideourl' );
function cmsn_savebgvideourl(){
	
	$arr = esc_url($_POST['url']) ;
		
	update_option('cmsn_videoUrl', $arr);
	
	$result = get_option('cmsn_videoUrl');
	
	if($result != ''){
		echo "your option saved successfully" ;
	}else{
		echo "something going wrong please try again" ;
	}
	
	die() ;
	
}

add_action( 'wp_ajax_savebgcolour', 'cmsn_savebgcolour' );
add_action( 'wp_ajax_nopriv_savebgcolour', 'cmsn_savebgcolour' );
function cmsn_savebgcolour(){
	
	$arr = sanitize_text_field(esc_js($_POST['bg_colour'])) ;	
	
	update_option('cmsn_bgColour', $arr);
	
	$result = get_option('cmsn_bgColour');

	if($result != ''){
		echo "your option saved successfully" ;
	}else{
		echo "something going wrong please try again" ;
	}
	
	die() ;
	
}

add_action( 'wp_ajax_saveextracsstextarea', 'cmsn_saveextracsstextarea' );
add_action( 'wp_ajax_nopriv_saveextracsstextarea', 'cmsn_saveextracsstextarea' );
function cmsn_saveextracsstextarea(){
	
	$arr = sanitize_text_field(esc_js($_POST['extr'])) ;	
	
	update_option('cmsn_extracssTextarea', $arr);
	
	$result = get_option('cmsn_extracssTextarea');
	
	if($result != ''){
		echo "your option saved successfully" ;
	}else{
		echo "something going wrong please try again" ;
	}
	
	die() ;
	
}



add_action( 'wp_ajax_savecontactsocialopt', 'cmsn_savecontactsocialopt' );
add_action( 'wp_ajax_nopriv_savecontactsocialopt', 'cmsn_savecontactsocialopt' );
function cmsn_savecontactsocialopt(){

	if(esc_js($_POST['cmsn_social'][0]!="")) {	
		update_option('cmsn_conenable', 'cmsn_conenable');
	}else{
	update_option('cmsn_conenable', 'null');
	}
	
	if(esc_js($_POST['cmsn_social'][1]!="")) {	
	update_option('cmsn_soicenable', 'cmsn_soicenable');
	}else{
	update_option('cmsn_soicenable', 'null');
	}
	if (esc_js($_POST['cmsn_social'][2]!="")) {	
	update_option('cmsn_subscribeenable', 'cmsn_subscribeenable');
	}else{
	update_option('cmsn_subscribeenable', 'null');
	}
		
	update_option('cmsn_authorEmail', sanitize_email($_POST['cmsn_authorEmail']));
	update_option('cmsn_facebooklink', esc_url_raw($_POST['cmsn_facebooklink']));
	update_option('cmsn_twitterlink', esc_url_raw($_POST['cmsn_twitterlink']));
	update_option('cmsn_linkedinlink', esc_url_raw($_POST['cmsn_linkedinlink']));
	update_option('cmsn_pintersetlink', esc_url_raw($_POST['cmsn_pintersetlink']));
	update_option('cmsn_gpluslink', esc_url_raw($_POST['cmsn_gpluslink']));
	update_option('cmsn_subscriberform', stripslashes(sanitize_text_field(esc_js($_POST['cmsn_subscriberform']))));
	
	echo "your option saved successfully" ;
	
	die() ;
	
}

add_action( 'wp_ajax_userinfofromsubittedform', 'cmsn_userInfoFromSubittedForm' );
add_action( 'wp_ajax_nopriv_userinfofromsubittedform', 'cmsn_userInfoFromSubittedForm' );

function cmsn_userInfoFromSubittedForm(){
			
	$to = get_option('cmsn_authorEmail') ;
	
	$subject = "Message from ".sanitize_email($_POST['email'])."";

	$message = "<b>Hello admin,</b>";
	$message .= "<h1>Message from ".sanitize_text_field(esc_js($_POST['f_name']))." ".sanitize_text_field(esc_js($_POST['l_name']))."</h1></br><p>".sanitize_text_field(esc_js($_POST['message']))."</p>";

	$header = "From:".sanitize_email($_POST['email'])." \r\n";	
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-type: text/html\r\n";

	$retval = mail ($to,$subject,$message,$header);

	if( $retval == true ) {
	echo "Message sent successfully...";
	}else {
	echo "Message could not be sent...";
	}	
	die() ;		
}
?>