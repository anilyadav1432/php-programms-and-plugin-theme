<?php

if ( ! class_exists( 'Ced_Wooplug_Shipping_Method' ) ) {
    class Ced_Wooplug_Shipping_Method extends WC_Shipping_Method {
       
        /**
         * Constructor. TO initialize all things of shipping methpod
         *  
         * @since             1.0.0
         * @param int $instance_id Instance ID.
	    */
        public function __construct( $instance_id = 0 ) {
            $this->id                 = 'ced_shipp_method'; 
            $this->instance_id        = absint( $instance_id );
            $this->method_title       = __( 'Ced Shipping', 'wooplug' );  
            $this->method_description = __( 'Ced Shipping Method', 'wooplug' );
            $this->supports              = array(
                'shipping-zones',
                'instance-settings',
            );
            $this->instance_form_fields = array(     
                'enabled' => array(
                    'title' => __( 'Enable', 'wooplug' ),
                    'type' => 'checkbox',
                    'description' => __( 'Enable this shipping.', 'wooplug' ),
                    'default' => 'yes'
                    ),

                'title' => array(
                  'title' => __( 'Title', 'wooplug' ),
                  'type' => 'text',
                  'description' => __( 'Title to be display on site', 'wooplug' ),
                  'default' => __( 'Ced_Shipping', 'wooplug' )
                  ),
                'weight' => array(
                  'title' => __( 'Weight (kg)', 'wooplug' ),
                  'type' => 'number',
                  'description' => __( 'Maximum allowed weight', 'wooplug' ),
                  'default' => 100
                  ),
            );
            
            $this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
            $this->title = isset( $this->settings['title'] ) ? $this->settings['title'] : __( 'Ced Shipping', 'wooplug' );
    
            
            add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
    
          
        }
        
         /*  
        *shipping Calculation declaration in this function 
        *  @param array $package (default: array())
        * @since             1.0.0
        */
       
        public function calculate_shipping( $package = array() ) {
            $this->add_rate( array(
                'id'    => $this->id . $this->instance_id,
                'label' => $this->title,
                'cost'  => 100,
            ) );
        }


    }
}