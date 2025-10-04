<?php
/**
 * Online Electro Store functions and definitions
 *
 * @package online_electro_store
 * @since 1.0
 */

if ( ! function_exists( 'online_electro_store_support' ) ) :
	function online_electro_store_support() {

		load_theme_textdomain( 'online-electro-store', get_template_directory() . '/languages' );

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		add_theme_support('woocommerce');

		// Enqueue editor styles.
		add_editor_style(get_stylesheet_directory_uri() . '/assets/css/editor-style.css');

		/* Theme Credit link */
		define('ONLINE_ELECTRO_STORE_BUY_NOW',__('https://www.cretathemes.com/products/electro-wordpress-theme','online-electro-store'));
		define('ONLINE_ELECTRO_STORE_PRO_DEMO',__('https://pattern.cretathemes.com/online-electro-store/','online-electro-store'));
		define('ONLINE_ELECTRO_STORE_THEME_DOC',__('https://pattern.cretathemes.com/free-guide/online-electro-store/','online-electro-store'));
		define('ONLINE_ELECTRO_STORE_PRO_THEME_DOC',__('https://pattern.cretathemes.com/pro-guide/online-electro-store/','online-electro-store'));
		define('ONLINE_ELECTRO_STORE_SUPPORT',__('https://wordpress.org/support/theme/online-electro-store','online-electro-store'));
		define('ONLINE_ELECTRO_STORE_REVIEW',__('https://wordpress.org/support/theme/online-electro-store/reviews/#new-post','online-electro-store'));
		define('ONLINE_ELECTRO_STORE_PRO_THEME_BUNDLE',__('https://www.cretathemes.com/products/wordpress-theme-bundle','online-electro-store'));
		define('ONLINE_ELECTRO_STORE_PRO_ALL_THEMES',__('https://www.cretathemes.com/collections/wordpress-block-themes','online-electro-store'));

	}
endif;

add_action( 'after_setup_theme', 'online_electro_store_support' );

if ( ! function_exists( 'online_electro_store_styles' ) ) :
	function online_electro_store_styles() {
		// Register theme stylesheet.
		$online_electro_store_theme_version = wp_get_theme()->get( 'Version' );

		$online_electro_store_version_string = is_string( $online_electro_store_theme_version ) ? $online_electro_store_theme_version : false;
		wp_enqueue_style(
			'online-electro-store-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$online_electro_store_version_string
		);

		wp_enqueue_style( 'dashicons' );

		wp_enqueue_style( 'animate-css', esc_url(get_template_directory_uri()).'/assets/css/animate.css' );

		wp_enqueue_script( 'jquery-wow', esc_url(get_template_directory_uri()) . '/assets/js/wow.js', array('jquery') );

		//font-awesome
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/inc/fontawesome/css/all.css'
			, array(), '6.7.0' );

		// Enqueue Swiper CSS
		wp_enqueue_style(
		    'online-electro-store-swiper-bundle-style',
		    get_template_directory_uri() . '/assets/css/swiper-bundle.css',
		    array(),
		    $online_electro_store_version_string
		);

		// Enqueue Swiper JS
		wp_enqueue_script(
		    'online-electro-store-swiper-bundle-scripts',
		    get_template_directory_uri() . '/assets/js/swiper-bundle.js',
		    array('jquery'),
		    $online_electro_store_version_string,
		    true
		);

		// Enqueue Custom Script (depends on Swiper too)
		wp_enqueue_script(
		    'online-electro-store-custom-script',
		    get_template_directory_uri() . '/assets/js/custom-script.js',
		    array('jquery', 'online-electro-store-swiper-bundle-scripts'),
		    $online_electro_store_version_string,
		    true
		);

	}
endif;

add_action( 'wp_enqueue_scripts', 'online_electro_store_styles' );

/* Enqueue admin-notice-script js */
add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'appearance_page_online-electro-store') return;

    wp_enqueue_script('admin-notice-script', get_template_directory_uri() . '/get-started/js/admin-notice-script.js', ['jquery'], null, true);
    wp_localize_script('admin-notice-script', 'pluginInstallerData', [
        'ajaxurl'     => admin_url('admin-ajax.php'),
        'nonce'       => wp_create_nonce('install_cretatestimonial_nonce'), // Match this with PHP nonce check
        'redirectUrl' => admin_url('themes.php?page=online-electro-store-guide-page'),
    ]);
});

add_action('wp_ajax_check_creta_testimonial_activation', function () {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
    $online_electro_store_plugin_file = 'creta-testimonial-showcase/creta-testimonial-showcase.php';

    if (is_plugin_active($online_electro_store_plugin_file)) {
        wp_send_json_success(['active' => true]);
    } else {
        wp_send_json_success(['active' => false]);
    }
});


// Add block patterns
require get_template_directory() . '/inc/block-patterns.php';

// Add block styles
require get_template_directory() . '/inc/block-styles.php';

// Block Filters
require get_template_directory() . '/inc/block-filters.php';

// Svg icons
require get_template_directory() . '/inc/icon-function.php';

// TGM Plugin
require get_template_directory() . '/inc/tgm/tgm.php';

// Customizer
require get_template_directory() . '/inc/customizer.php';

// Get Started.
require get_template_directory() . '/inc/get-started/get-started.php';

// Add Getstart admin notice
function online_electro_store_admin_notice() { 
    global $pagenow;
    $theme_args      = wp_get_theme();
    $meta            = get_option( 'online_electro_store_admin_notice' );
    $name            = $theme_args->__get( 'Name' );
    $current_screen  = get_current_screen();

    if( !$meta ){
	    if( is_network_admin() ){
	        return;
	    }

	    if( ! current_user_can( 'manage_options' ) ){
	        return;
	    } if($current_screen->base != 'appearance_page_online-electro-store-guide-page' && $current_screen->base != 'toplevel_page_cretats-theme-showcase' ) { ?>

	    <div class="notice notice-success dash-notice">
	        <h1><?php esc_html_e('Hey, Thank you for installing Online Electro Store Theme!', 'online-electro-store'); ?></h1>
	        <p><a href="javascript:void(0);" id="install-activate-button" class="button admin-button info-button get-start-btn">
				   <?php echo __('Nevigate Getstart', 'online-electro-store'); ?>
				</a>

				<script type="text/javascript">
				document.getElementById('install-activate-button').addEventListener('click', function () {
				    const online_electro_store_button = this;
				    const online_electro_store_redirectUrl = '<?php echo esc_url(admin_url("themes.php?page=online-electro-store-guide-page")); ?>';
				    // First, check if plugin is already active
				    jQuery.post(ajaxurl, { action: 'check_creta_testimonial_activation' }, function (response) {
				        if (response.success && response.data.active) {
				            // Plugin already active — just redirect
				            window.location.href = online_electro_store_redirectUrl;
				        } else {
				            // Show Installing & Activating only if not already active
				            online_electro_store_button.textContent = 'Nevigate Getstart';

				            jQuery.post(ajaxurl, {
				                action: 'install_and_activate_creta_testimonial_plugin',
				                nonce: '<?php echo wp_create_nonce("install_activate_nonce"); ?>'
				            }, function (response) {
				                if (response.success) {
				                    window.location.href = online_electro_store_redirectUrl;
				                } else {
				                    alert('Failed to activate the plugin.');
				                    online_electro_store_button.textContent = 'Try Again';
				                }
				            });
				        }
				    });
				});
				</script>
				
	        	<a class="button button-primary site-edit" href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>"><?php esc_html_e('Site Editor', 'online-electro-store'); ?></a> 
				<a class="button button-primary buy-now-btn" href="<?php echo esc_url( ONLINE_ELECTRO_STORE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'online-electro-store'); ?></a>
				<a class="button button-primary bundle-btn" href="<?php echo esc_url( ONLINE_ELECTRO_STORE_PRO_THEME_BUNDLE ); ?>" target="_blank"><?php esc_html_e('Get Bundle', 'online-electro-store'); ?></a>
	        </p>
	        <p class="dismiss-link"><strong><a href="?online_electro_store_admin_notice=1"><?php esc_html_e( 'Dismiss', 'online-electro-store' ); ?></a></strong></p>
	    </div>
	    <?php }?>
	    <?php
	}
}

add_action( 'admin_notices', 'online_electro_store_admin_notice' );

if( ! function_exists( 'online_electro_store_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function online_electro_store_update_admin_notice(){
    if ( isset( $_GET['online_electro_store_admin_notice'] ) && $_GET['online_electro_store_admin_notice'] = '1' ) {
        update_option( 'online_electro_store_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'online_electro_store_update_admin_notice' );

//After Switch theme function
add_action('after_switch_theme', 'online_electro_store_getstart_setup_options');
function online_electro_store_getstart_setup_options () {
    update_option('online_electro_store_admin_notice', FALSE );
}

function online_electro_store_google_fonts() {
 
	wp_enqueue_style( 'montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap', false ); 
}
 
add_action( 'wp_enqueue_scripts', 'online_electro_store_google_fonts' );

