<?php
/*
 * Check if WooCommerce is active
 */

        if ( ! class_exists( 'My_Shipping_Method' ) ) {
            class My_Shipping_Method extends WC_Shipping_Method {
               
                public function __construct($instance_id = 0) {
                    $this->id                    = 'custom_method';
                    $this->instance_id           = absint( $instance_id );
                    $this->method_title          = __( 'custom Shipping Method' );
                    $this->method_description    = __( 'custom Shipping method for demonstration purposes.' );
                    $this->supports              = array(
                        'shipping-zones',
                        'instance-settings',
                    );
                    $this->instance_form_fields = $this->form_fields = array(
 
                        'enabled' => array(
                             'title' => __( 'Enable', 'my' ),
                             'type' => 'checkbox',
                             'description' => __( 'Enable this shipping.', 'my' ),
                             'default' => 'yes'
                             ),
    
                        'title' => array(
                           'title' => __( 'Title', 'my' ),
                             'type' => 'text',
                             'description' => __( 'Title to be display on site', 'my' ),
                             'default' => __( 'MyShipping', 'my' )
                             ),
    
                        'weight' => array(
                           'title' => __( 'Weight (kg)', 'my' ),
                             'type' => 'number',
                             'description' => __( 'Maximum allowed weight', 'my' ),
                             'default' => 100
                             ),
    
                        
                    );
                    $this->enabled              = $this->get_option( 'enabled' );
                    $this->title                = $this->get_option( 'title' );
                    $this->weight               = $this->get_option('weight');

                    add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
                }
 
           
             
 
            
                
                public function calculate_shipping( $package = array() )
				{

					// print_r($package);die();
                   $alla_items = $package['contents'];
                   $total_weight = 0;
                    foreach ($alla_items as $orderline) {
                        $product_weight = $orderline['data']->weight;
                
                        $total_weight += $product_weight;
                    };

                    if($total_weight < 1) {
                        $cost = '30';
                    } elseif($total_weight > 1 && $total_weight < 5) {
                        $cost = '60';
                    } elseif($total_weight > 5 && $total_weight < 10) {
                        $cost = '100'; 
                    } elseif($total_weight > 10 && $total_weight < 20) {
                        $cost = '200'; 
                    } elseif($total_weight > 20) {
                        $cost = ($total_weight * 10);
                    } else {
                        echo 'sorry';
                    }

                    echo $total_weight;

                    $rate = array( 
                        'id' => $this->id,
                        'label' => $this->title,
                        'cost' => $cost,
                        'calc_tax' => 'per_item'
                    );

                    // Register the rate
                    $this->add_rate( $rate );
                }
            }
        }

 
   
 
         
    
 
    
    
