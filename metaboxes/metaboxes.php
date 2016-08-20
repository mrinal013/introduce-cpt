<?php

add_action("init","codestar_init",999);
function codestar_init(){
    $options = array();
    CSFramework_Metabox::instance($options);
}


require_once plugin_dir_path( __FILE__ ) . '/class/class.sectiontypes.php';

require_once plugin_dir_path( __FILE__ ) . '/class/class.general.php';

// call require class from metaboxes.php
new SectionTypes();
new General();

//this section is used to establish a relationship between section type and metaboxes
add_action ("init","section_mb_filter");
function section_mb_filter(){
    $post_id = isset($_REQUEST['post'])?$_REQUEST['post']:false;
    if(!$post_id){
        $post_id = isset($_REQUEST['post_ID'])?$_REQUEST['post_ID']:false;
    }
    if($post_id && "section" == get_post_type($post_id)){
        $section_type_info = get_post_meta($post_id,'section_types',true);
        if( isset($section_type_info) ) {
            $section_type = $section_type_info['section_type'];
        }
        $section_type = $section_type_info['section_type'];
        if("banner"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.banner.php';
			new Banner();
        } else if("feature"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.feature.php';
			new Feature();
        } else if("portfolio"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.portfolio.php';
			new Portfolio();
        } else if("purchage"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.purchage.php';
			new Purchage();
        } else if("summary"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.summary.php';
			new Summary();
        } else if("partner"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.partner.php';
			new Partner();
        } else if("skil"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.skil.php';
			new Skil();
        } else if("review"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.review.php';
			new Review();
        } else if("team"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.team.php';
			new Team();
        } else if("service"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.service.php';
			new Service();
        } else if("blog"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.blog.php';
			new Blog();
        } else if("slider"==$section_type){
			require_once plugin_dir_path( __FILE__ ) . '/class/class.blog.php';
			new Blog();
        }
    }
}
