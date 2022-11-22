<?php

$page_arr=array();
foreach(get_pages() as $key=>$val){
    $page_arr[$val->ID]=$val->post_title;
}

$users_arr=array();
global $wp_roles;
$users = $wp_roles->get_names();

foreach($users as $user){

    $users_arr[$user]=$user;
}



$user_types = array(
    'user'   => __( '', 'wooplug' ),
    'administrator'   => __( 'administrator', 'wooplug' ),
    'editor'   => __( 'editor', 'wooplug' ),
);

$settings = array(
        array(
            'name' => __( 'Price Configuration', 'wooplug' ),
            'type' => 'title',
            'id'   => $prefix . 'price_config_settings'
        ),
      
        array(
            'id'        => $prefix . 'setting_user_type',
            'name'      => __( 'User Type', 'wooplug' ), 
            'type'      => 'multiselect',
            'class'     => 'wc-enhanced-select',
            'options'   => $users_arr,
            'desc_tip'  => __( ' The primary user type ', 'wooplug')
        ),


        array(
            'id'        => $prefix . 'setting_page_type',
            'name'      => __( 'page Type', 'wooplug' ), 
            'type'      => 'multiselect',
            'class'     => 'wc-enhanced-select',
            'options'   =>$page_arr,
            'desc_tip'  => __( ' The primary page type', 'wooplug')
        ),
        array(
            'id'        => $prefix . 'ship_in_service',
            'name'      => __( 'Show/Hide(by user & page)', 'wooplug' ),
            'type'      => 'checkbox',
            'desc'  => __( 'check this box if You want to apply.', 'wooplug' ),
            'default'   => 'yes'
        ),   
        array(
            '' => __( 'Price Configuration', 'wooplug' ),
            'type' => 'title',
            'id'   => $prefix . 'price_config_settings'
        ),          
                            
    );
?>