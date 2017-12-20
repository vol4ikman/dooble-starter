<?php /* Template name: Modules */ ?>
<?php get_header();?>
<div class="modules-test">
    <div class="module-wrap">
        <h2>LOGIN MODULE</h2>
        <pre>

            $args = array(
            	'echo'           => true,
            	'remember'       => true,
            	'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
            	'form_id'        => 'loginform',
            	'id_username'    => 'user_login',
            	'id_password'    => 'user_pass',
            	'id_remember'    => 'rememberme',
            	'id_submit'      => 'wp-submit',
            	'label_username' => __( 'Username or Email Address' ),
            	'label_password' => __( 'Password' ),
            	'label_remember' => __( 'Remember Me' ),
            	'label_log_in'   => __( 'Log In' ),
            	'value_username' => '',
            	'value_remember' => false,
                'use_ajax'           => true
            );

            $view_args = array(
                'login_args' => $args
            );

            qs_get_module( 'login' , $view_args );

        </pre>
        <div class="module">
            <?php
                $args = array(
                	'redirect'       => home_url(),
                    'label_username' => __( 'Username' ),
                	'label_password' => __( 'Password' ),
                	'label_remember' => __( 'Remember Me' ),
                	'label_log_in'   => __( 'Log In' ),
                    'use_ajax'           => true,
                );

                $view_args = array(
                    'login_args' => $args
                );

                qs_get_module( 'login' , $view_args );
            ?>
        </div>
    </div>

</div>
<?php get_footer();?>
