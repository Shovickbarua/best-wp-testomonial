<?
/**
 * Adds a submenu page under a custom post type parent.
 */
function register_bwpt_settings_page()
{
    add_submenu_page(
        'edit.php?post_type=testimonial',
        __('Settings', 'bwpt'),
        __('Settings', 'bwpt'),
        'manage_options',
        'bwpt-settings-page',
        'bwpt_settings_pages'
    );
}
add_action('admin_menu', 'register_bwpt_settings_page');
/**
 * Display callback for the submenu page.
 */
function elements_bwpt_settings_pages()
{
    ?>
    <div class="wrap">
        <h1>
            <?php _e('Testomonial Settings', 'bwpt'); ?>
        </h1>
        <p>
            <?php _e('Testomonial Settings', 'bwpt'); ?>
        </p>
    </div>
    <?php
}

?>