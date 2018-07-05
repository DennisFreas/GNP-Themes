<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

?>

<div class="user-image">
    <a href="<?php echo get_permalink( wc_get_page_id( 'myaccount' ) ) ?>">
        <?php
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;
        echo get_avatar( $user_id, 75 );
        ?>
    </a>
</div>
<div class="user-meta">
    <h4 class="username"><?php echo $current_user->display_name?></h4>
    <?php if ( isset( $current_user ) && $current_user->ID != 0 ) : ?>
    <a href="<?php echo wp_logout_url(); ?>" class="my-account-logout btn small btn-flat"><?php _e( 'logout', 'yit' ) ?></a>
    <?php endif; ?>
</div>