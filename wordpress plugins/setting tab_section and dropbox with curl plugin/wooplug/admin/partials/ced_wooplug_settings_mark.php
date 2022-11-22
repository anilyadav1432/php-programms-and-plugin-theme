<?php
$user_types = array(
    'mark'   => __( '', 'wooplug' ),
    'fixed'   => __( 'fixed', 'wooplug' ),
    'percentage'   => __( 'percentage', 'wooplug' ),
);

$settings = array(
        array(
            'name' => __( 'Mark Value Form', 'wooplug' ),
            'type' => 'title',
            'id'   => $prefix . 'Mark Value Form'
        ),
        array(
            'id'        => $prefix . 'setting_mark_type',
            'name'      => __( 'Mark Type', 'wooplug' ), 
            'type'      => 'select',
            'class'     => 'wc-enhanced-select',
            'options'   => $user_types,
            'desc_tip'  => __( ' The primary mark type ', 'wooplug')
        ),
        array(
            'id'        => $prefix . 'setting_value_type',
            'name'      => __( 'Value', 'wooplug' ), 
            'type'      => 'number',
            'desc_tip'  => __( ' The numeric designation of this value.', 'wooplug')
        ),
        array(
            'id'        => $prefix . 'mark_in_service',
            'name'      => __( 'show/hide by mark & value', 'wooplug' ),
            'type'      => 'checkbox',
            'desc'  => __( 'check this box if You want to apply.', 'wooplug' ),
            'default'   => 'yes'
        ),   
        array(
            '' => __( 'Mark Value Form', 'wooplug' ),
            'type' => 'title',
            'id'   => $prefix . 'mark_config_settings'
        ),          
                               
    );
?>