<?php

if ( ! class_exists( 'Ced_Wooplug_Setting_Tab' ) ) {

    /**
     * Settings class
     *
     * @since 1.0.0
     */
    class Ced_Wooplug_Setting_Tab extends WC_Settings_Page {

        /**
         * Constructor
         * Define all hooks instead of inheriting from parent 
         * $this->id     string   this is  id of "Cedcommece Tab "
         * $this->label  string   this is title of "ced_commerce_tab" tab
         * @since  1.0
         */
        public function __construct() {
                
            $this->id    = 'ced_commerce_tab';
            $this->label = __( 'Cedcommece Tab', 'wooplug' );
                   
            add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
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
                '' => __( 'Settings', 'wooplug' ),
                'mark' => __( 'Mark', 'wooplug' ),
                // 'results' => __( 'Sale Results', 'wooplug' )
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
            $prefix = 'ced_commerce_tab_';
            $settings = array();
            switch ($current_section) {
                case 'mark':
                    // $settings = array(                              
                    //         array()
                    // );
                    include_once dirname(__FILE__).'/ced_wooplug_settings_mark.php';
                    break;
                default:                                                
                include_once dirname(__FILE__).'/ced_wooplug_settings_main.php';    
            }   

            return apply_filters( 'woocommerce_get_settings_' . $this->id, $settings, $current_section );                   
        }

        /**
         * Output    we can provide output after same form data
         * @since 1.0.0
         */
        public function output() {                  
            global $current_section;

            switch ($current_section) {
                case 'results':
                    include_once dirname(__FILE__).'/ced_wooplug_settings_results.php';
                    break;
                default:
                    $settings = $this->get_settings();
                    WC_Admin_Settings::output_fields( $settings );
            }
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


return new Ced_Wooplug_Setting_Tab();