<?php

/**
 * Handles admin panel notifications
 */
class QS_theme_admin_notices{
    static public function admin_notices() {
        $notices = array();
        $errors  = array();
        $infos   = array();

        if ( defined( 'ENV' ) && ENV == 'dev' ) {
            $notices[ __( 'DEV enviorment is activated', 'wipi' ) ] = __( 'Please finalize all files and change to LIVE mode', 'qstheme' );
        }

        if ( count( $notices ) ) {
            echo '<div class="notice notice-warning" style="background: #fcf8e3;">';
            foreach ( $notices as $title => $notice ) {
                echo '<p><strong>' . $title . '</strong> ' . $notice . '</p>';
            }
            echo '</div>';
        }

        if ( count( $infos ) ) {
            echo '<div class="notice notice-info" style="background: #DDF4FF;">';
            foreach ( $infos as $title => $notice ) {
                echo '<p><strong>' . $title . '</strong> ' . $notice . '</p>';
            }
            echo '</div>';
        }

        if ( count( $errors ) ) {
            echo '<div class="notice notice-error" style="background: #f2dede;">';
            foreach ( $errors as $title => $notice ) {
                echo '<p><strong>' . $title . '</strong> ' . $notice . '</p>';
            }
            echo '</div>';
        }
    }
}
