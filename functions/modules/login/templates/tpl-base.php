<div class="login-module">
    <?php $args = wp_parse_args( $this->get_login_args() ); ?>

    <form name="<?php echo $args['form_id'];?>" id="<?php echo $args['form_id'];?>" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) );?>" method="post">
        <p class="login-username">
            <label for="<?php echo esc_attr( $args['id_username'] );?>">
                <?php echo esc_html( $args['label_username'] );?>
            </label>
            <input type="text" name="log" class="input" value="" size="20" autocomplete="off" >
        </p>
        <p class="login-password">
            <label for="<?php echo esc_attr( $args['id_password'] );?>">
                <?php echo esc_attr( $args['id_password'] );?>
            </label>
            <input type="password" name="pwd" class="input" value="" size="20" autocomplete="off" />
        </p>

        <p class="login-remember">
            <label>
                <input name="rememberme" type="checkbox" id="<?php echo esc_attr( $args['id_remember'] );?>" value="forever" <?php echo ( $args['value_remember'] ? ' checked="checked"' : '' );?>>
                    <?php echo esc_html( $args['label_remember'] );?>
            </label>
        </p>
        <p class="login-submit">
            <input type="submit" name="wp-submit" id="<?php echo esc_attr( $args['id_submit'] );?>" class="button button-primary" value="<?php echo esc_attr( $args['label_log_in'] );?>">
            <input type="hidden" name="redirect_to" value="<?php echo esc_url( $args['redirect'] );?>">
        </p>
        <?php if( $args['use_ajax'] ):?>
            <?php wp_nonce_field( 'login', 'login-module', '', true ) ?>
        <?php endif;?>
    </form>
</div>
