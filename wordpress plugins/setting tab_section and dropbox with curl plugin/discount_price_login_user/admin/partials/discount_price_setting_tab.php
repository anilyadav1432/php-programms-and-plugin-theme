<?php

if ( ! class_exists( 'Discount_Price_Setting_Tab' ) ) {

    /**
     * Settings class
     *
     * @since 1.0.0
     */
    class Discount_Price_Setting_Tab extends WC_Settings_Page {

        /**
         * Constructor
         * Define all hooks instead of inheriting from parent 
         * $this->id     string   this is  id of "discount_price_tab"
         * $this->label  string   this is title of "Discount Price Tab"
         * @since  1.0
         */
        public function __construct() {
                
            $this->id    = 'discount_price_tab';
            $this->label = __( 'Discount Price Tab', 'discount_price_login_user' );
               
            // show tab
            add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
            //show section
            add_action( 'woocommerce_sections_' . $this->id, array( $this, 'output_sections' ) );
            add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
            add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );
            
        }
        /**
         * Get sections of creating tab.
         *@since 1.0.0
         * @return array
         */
        public function get_sections() {
            $sections = array(
                '' => __( 'Discount Settings', 'discount_price_login_user' ),
                'discount' => __( 'Discount Price User Login', 'discount_price_login_user' ),
          
            );

            return apply_filters( 'woocommerce_get_sections_' . $this->id, $sections );
        }

        /**
         * Get settings array    it will define all fields in Setting section
         *@since 1.0.0
         * @return array
         */
        public function get_settings() {

            global $current_section;
            $prefix = 'cedcommerce_tab_';
            $settings = array();
            switch ($current_section) {
                case 'discount':
                    // $settings = array(                              
                    //         array()
                    // );
                    include_once dirname(__FILE__).'/discount_price_settings_main.php';
                    break;
                default:                                                
                    include_once dirname(__FILE__).'/discount_price_settings.php';
                
            }   

            return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings, $current_section );                   
        }
        /**
         * Save settings
         *
         * @since 1.0
         */
        public function save() {                    
            $settings = $this->get_settings();

            WC_Admin_Settings::save_fields( $settings );
        }


    }

}

return new Discount_Price_Setting_Tab();