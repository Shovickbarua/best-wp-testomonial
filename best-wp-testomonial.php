<?php
/*
 * Plugin Name:       Best WP Testomonial
 * Plugin URI:        https://wordpress.org/plugins/best-wp-testomonial/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Requires at least: 6.0
 * Requires PHP:      8.0
 * Author:            Shovick Barua
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       bwpt
 */

/**
 * Proper way to enqueue styles
 */
function bwpt_enqueue_style()
{
	wp_enqueue_style('owl-carousel', "https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css");
	wp_enqueue_style('owl-theme', "https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css");
	wp_enqueue_style('fontawesome-all', "https://e6t7a8v2.stackpathcdn.com/tutorial/css/fontawesome-all.min.css");
	wp_enqueue_style('bwpt-style', plugins_url('css/bwpt-style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'bwpt_enqueue_style');
/**
 * Proper way to enqueue styles
 */
function bwpt_enqueue_scripts()
{
	wp_enqueue_script('jquery-min', 'https://code.jquery.com/jquery-1.12.0.min.js', array(), '1.0.0', true);
	wp_enqueue_script('owl-carousel-min', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js', array(), '1.0.0', true);
	wp_enqueue_script('bwpt-js', plugins_url('js/bwpt-js.js', __FILE__), array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'bwpt_enqueue_scripts');

if (!function_exists('bwpt_custom_post_type')) {

	// Register Custom Post Type
	function bwpt_custom_post_type()
	{

		$labels = array(
			'name' => _x('Testomonials', 'Post Type General Name', 'bwpt'),
			'singular_name' => _x('Testomonial Type', 'Post Type Singular Name', 'bwpt'),
			'menu_name' => __('Testomonials', 'bwpt'),
			'name_admin_bar' => __('Post Type', 'bwpt'),
			'archives' => __('Item Archives', 'bwpt'),
			'attributes' => __('Item Attributes', 'bwpt'),
			'parent_item_colon' => __('Parent Item:', 'bwpt'),
			'all_items' => __('All Items', 'bwpt'),
			'add_new_item' => __('Add New Item', 'bwpt'),
			'add_new' => __('Add New', 'bwpt'),
			'new_item' => __('New Item', 'bwpt'),
			'edit_item' => __('Edit Item', 'bwpt'),
			'update_item' => __('Update Item', 'bwpt'),
			'view_item' => __('View Item', 'bwpt'),
			'view_items' => __('View Items', 'bwpt'),
			'search_items' => __('Search Item', 'bwpt'),
			'not_found' => __('Not found', 'bwpt'),
			'not_found_in_trash' => __('Not found in Trash', 'bwpt'),
			'featured_image' => __('Featured Image', 'bwpt'),
			'set_featured_image' => __('Set featured image', 'bwpt'),
			'remove_featured_image' => __('Remove featured image', 'bwpt'),
			'use_featured_image' => __('Use as featured image', 'bwpt'),
			'insert_into_item' => __('Insert into item', 'bwpt'),
			'uploaded_to_this_item' => __('Uploaded to this item', 'bwpt'),
			'items_list' => __('Items list', 'bwpt'),
			'items_list_navigation' => __('Items list navigation', 'bwpt'),
			'filter_items_list' => __('Filter items list', 'bwpt'),
		);
		$args = array(
			'label' => __('Testomonial Type', 'bwpt'),
			'description' => __('Testomonial Description', 'bwpt'),
			'labels' => $labels,
			'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
			'hierarchical' => false,
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'show_in_nav_menus' => true,
			'can_export' => true,
			'has_archive' => true,
			'exclude_from_search' => false,
			'publicly_queryable' => true,
			'capability_type' => 'page',
		);
		register_post_type('testimonial', $args);

	}
	add_action('init', 'bwpt_custom_post_type', 0);

}

// bwpt post loop
function bwpt_testimonial_loop()
{
	?>
	<div id="testimonial-slider" class="owl-carousel">
		<?php
		// WP_Query arguments
		$args = array(
			'post_type' => array('testimonial'),
			'post_status' => array('publish'),
			'post_per_page' => 10
		);

		// The Query
		$bwpt_query = new WP_Query($args);

		// The Loop
		if ($bwpt_query->have_posts()) {
			while ($bwpt_query->have_posts()) {
				$bwpt_query->the_post();
				// do something
				?>
				<div class="testimonial">
					<div class="pic">
						<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>">
					</div>
					<h3 class="title">
						<?php the_title(); ?>
					</h3>
					<p class="description">
						<?php the_excerpt(); ?>
					</p>
					<div class="testimonial-content">
						<div class="testimonial-profile">
							<h3 class="name">
								<?php get_post_meta(get_the_ID(), 'testi_name', true); ?>
							</h3>
							<span class="post">
								<?php get_post_meta(get_the_ID(), 'testi_desig', true); ?>
							</span>
						</div>
						<ul class="rating">
							<?php $bwqt_client_review = get_post_meta(get_the_ID(), 'testi_rating', true);
							if ($bwqt_client_review == 1) {
								echo "<li class='fa fa-star'><li class='fa fa-star'></li>";
							} else if ($bwqt_client_review == 2) {
								echo "<li class='fa fa-star'></li> <li class='fa fa-star'></li>";
							} else if ($bwqt_client_review == 3) {
								echo "<li class='fa fa-star'></li> <li class='fa fa-star'></li><li class='fa fa-star'></li>";
							} else if ($bwqt_client_review == 4) {
								echo "<li class='fa fa-star'></li> <li class='fa fa-star'></li><li class='fa fa-star'></li> <li class='fa fa-star'></li>";
							} else if ($bwqt_client_review == 5) {
								echo "<li class='fa fa-star'></li> <li class='fa fa-star'></li><li class='fa fa-star'></li> <li class='fa fa-star'></li><li class='fa fa-star'></li>";
							} else if ($bwqt_client_review == 1.5) {
								echo "<li class='fa fa-star'></li> <li class='fa fa fa-star-half'></li>";
							} else if ($bwqt_client_review == 2.5) {
								echo "<li class='fa fa-star'><li class='fa fa-star'></li> <li class='fa fa fa-star-half'></li>";
							} else if ($bwqt_client_review == 3.5) {
								echo "<li class='fa fa-star'><li class='fa fa-star'><li class='fa fa-star'></li> <li class='fa fa fa-star-half'></li>";
							} else if ($bwqt_client_review == 4.5) {
								echo "<li class='fa fa-star'><li class='fa fa-star'><li class='fa fa-star'><li class='fa fa-star'></li> <li class='fa fa fa-star-half'></li>";
							} else {
								echo 'rating not found';
							}
							?>

						</ul>
					</div>
				</div>
				<?php
			}
		} else {
			// no posts found
		}

		// Restore original Post Data
		wp_reset_postdata();
		?>
	</div>
	<?php
}

// shortcode

function bwpt_testomonial_shortcode()
{
	add_shortcode('BESTWPTESTIMONIAL', 'bwpt_testimonial_loop');
}
add_action('init', 'bwpt_testomonial_shortcode');

// redirect
register_activation_hook(__FILE__, 'bwpt_plugin_activate');
add_action('admin_init', 'bwpt_plugin_redirect');

function bwpt_plugin_activate()
{
	add_option('bwpt_plugin_do_activation_redirect', true);
}

function bwpt_plugin_redirect()
{
	if (get_option('bwpt_plugin_do_activation_redirect', false)) {
		delete_option('bwpt_plugin_do_activation_redirect');
		if (!isset($_GET['activate-multi'])) {
			wp_redirect('edit.php?post_type=testimonial?page=bwpt-settings-page');
		}
	}
}
// 	add_action( 'activate_' . $file, $callback );

/**
 * Adds a submenu page under a custom post type parent.
 */
foreach (glob(plugin_dir_path(__FILE__) . "inc/*.php") as $php_file)
	include_once $php_file;
?>



<!-- xdkjcjkx -->

<!-- 
if(function_exists('bwpt_testomonial_shortcode')){ bwpt_testimonial_loop() ; }  -->