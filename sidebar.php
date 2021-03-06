<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage distinctionpp
 * @since distinctionpp 1.0
 */
?>

		<div id="primary" class="widget-area" role="complementary"><aside>
			<button type="button" id="widget-area-toggle-btn" class="btn btn-default">
				<span class="glyphicon glyphicon-th-list"></span>
			</button><div class="clearfix"></div>
			<ul class="xoxo">

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) { ?>
			<li id="archives" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Archives', 'wp_distinctionpp' ); ?></h3>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li>

			<li id="meta" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Meta', 'wp_distinctionpp' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>

		<?php } // end primary widget area ?>
			</ul>
		</aside></div><!-- #primary .widget-area -->

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) { ?>

		<div id="secondary" class="widget-area" role="complementary"><aside>
			<ul class="xoxo">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</aside></div><!-- #secondary .widget-area -->

<?php } ?>
