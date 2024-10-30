<?php

function cmsn_logoDisplay()
{
echo ' <input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
	   <input id="logo" type="text" placeholder="Please enter the url" value="'.sanitize_text_field(esc_js(get_option('cmsn_logo'))).'" name="cmsn_logo" /> 
     ' ;
}


function cmsn_displayPageTitle()
{
echo '<input type="text" name="cmsn_title" id="cmsn_title" value="'.sanitize_text_field(esc_js(get_option('cmsn_title'))).'" />' ;
}


function cmsn_displayMainHeading()
{	
 echo '<input type="text" name="cmsn_mainheading" id="main_heading" value="'.sanitize_text_field(esc_js(get_option('cmsn_mainheading'))).'" />' ;
}


function cmsn_displaySubHeading()
{	
 echo '<input type="text" name="cmsn_subheading" id="sub_heading" value="'.sanitize_text_field(esc_js(get_option('cmsn_subheading'))).'" />' ;
}

function cmsn_displayMainTextarea()
{

$settings = array( 'textarea_name' => 'cmsn_maintextarea','textarea_rows'=>'5' );
wp_editor( sanitize_text_field(esc_js(get_option('cmsn_maintextarea'))) , 'pmaintextarea', $settings );

}

function cmsn_launchDate()
{	
 echo '<input type="text" name="cmsn_launchdate" id="launch_date" value="'.sanitize_text_field(esc_js(get_option('cmsn_launchdate'))).'" />' ;
}


function cmsn_PanelFields()
{
add_settings_section("cmsn_section", "", null, "cmsn_group");	
add_settings_field("cmsn_pstatus", "Plugin activation status", "cmsn_radioDisplay", "cmsn_group", "cmsn_section"); 
add_settings_field("cmsn_title", "page title", "cmsn_displayPageTitle", "cmsn_group", "cmsn_section"); 	
add_settings_field("cmsn_logo", "Logo", "cmsn_logoDisplay", "cmsn_group", "cmsn_section"); 
add_settings_field("cmsn_mainheading","Main Heading", "cmsn_displayMainHeading","cmsn_group", "cmsn_section"); 
add_settings_field("cmsn_subheading","Sub Heading", "cmsn_displaySubHeading","cmsn_group", "cmsn_section"); 
add_settings_field("cmsn_maintextarea","Main Textarea", "cmsn_displayMainTextarea","cmsn_group", "cmsn_section"); 
add_settings_field("cmsn_launchdate","Launch date", "cmsn_launchDate","cmsn_group", "cmsn_section"); 


register_setting("cmsn_section", "cmsn_logo");
register_setting("cmsn_section", "cmsn_title");    
register_setting("cmsn_section", "cmsn_mainheading");  
register_setting("cmsn_section", "cmsn_subheading");  
register_setting("cmsn_section", "cmsn_maintextarea");  
register_setting("cmsn_section", "cmsn_launchdate"); 
register_setting("cmsn_section", "cmsn_pstatus");    
  
}

function cmsn_radioDisplay()
{
   ?>
       <label class="radio-inline">
			<input type="radio" value="pdisable"  name="cmsn_pstatus" <?php checked('pdisable', get_option('cmsn_pstatus'), true); ?>> <?php printf( __('Disabled','cmsn')); ?>
			</label>
			
			<label class="radio-inline">
			<input type="radio" value="enablecusoon" name="cmsn_pstatus" <?php checked('enablecusoon', get_option('cmsn_pstatus'), true); ?>>  <?php printf( __('Enable Coming Soon Mode','cmsn')); ?>
			</label>
			
			<label class="radio-inline">
			<input type="radio" value="enablemaintenc" name="cmsn_pstatus" <?php checked('enablemaintenc', get_option('cmsn_pstatus'), true); ?>><?php printf( __('Enable Maintenance Mode','cmsn')); ?>
			</label>
   <?php
}
add_action("admin_init", "cmsn_PanelFields");

?>