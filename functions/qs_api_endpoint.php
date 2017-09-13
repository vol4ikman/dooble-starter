<?php
if( ! class_exists( 'API_Endpoint' ) ):

    class API_Endpoint {

        // WordPress hooks

        public function init() {
            add_filter('query_vars', array($this, 'add_query_vars'), 0);
            add_action('parse_request', array($this, 'sniff_requests'), 0);
            add_action('init', array($this, 'add_endpoint'), 0);
        }

        // Add public query vars
        public function add_query_vars($vars) {
            $vars[] = '__properties';
            $vars[] = 'token';
            return $vars;
        }

        // Add API Endpoint
        public function add_endpoint() {
            add_rewrite_rule('^api/?', 'index.php?__properties=1', 'top');
            flush_rewrite_rules(false); //// <---------- REMOVE THIS WHEN DONE
        }

        // Sniff Requests
        public function sniff_requests($wp_query) {
            global $wp;

            if(
                ( isset( $wp->query_vars[ '__properties' ] ) && !empty( $wp->query_vars[ '__properties' ] ) ) &&
                ( isset( $wp->query_vars[ 'token' ] ) && !empty( $wp->query_vars[ 'token' ] ) )
            ) {

                $response = array(
                    'users' => array(
                        array(
                            'id'         => 1,
                            'first_name' => 'Alex',
                            'last_name'  => 'Volkov',
                            'age'        => 32
                        ),
                        array(
                            'id'         => 2,
                            'first_name' => 'Michael',
                            'last_name'  => 'Bann',
                            'age'        => 22
                        ),
                        array(
                            'id'         => 3,
                            'first_name' => 'Boris',
                            'last_name'  => 'Wahn',
                            'age'        => 52
                        )
                    ),
                    'images' => array(
                        'http://lorempixel.com/400/200/sports/',
                        'http://lorempixel.com/400/200/city/',
                        'http://lorempixel.com/400/200/food/'
                    )
                );

            } else {
                $response = array(
                    'message' => 'Error. Invalid or missing token'
                );
            }

            wp_send_json( $response );

        }

    }

    $propEPT = new API_Endpoint();
    $propEPT->init();

endif; // PropertiesEndpoint
