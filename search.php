<?php
/**
 * Template for search results integrated with WooCommerce Product Search.
 *
 * @link       https://www.itthinx.com
 * @package    Avada-child-wps
 * @subpackage Templates
 * @since      1.0.0
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
?>
<?php get_header(); ?>
<section id="content" <?php Avada()->layout->add_class( 'content_class' ); ?> <?php Avada()->layout->add_style( 'content_style' ); ?>>
	<?php if ( have_posts() && 0 != strlen( trim( get_search_query() ) ) ) : ?>

		<?php if ( 'bottom' == Avada()->settings->get( 'search_new_search_position' ) ) : ?>
			<?php get_template_part( 'templates/blog', 'layout' ); ?>
			<div class="fusion-clearfix"></div>
		<?php endif; ?>

		<?php if ( 'hidden' != Avada()->settings->get( 'search_new_search_position' ) ) : ?>
			<div class="search-page-search-form search-page-search-form-<?php echo esc_attr( Avada()->settings->get( 'search_new_search_position' ) ); ?>">
				<?php
				/**
				 * Render the post title
				 */
				$title_size = ( false === avada_is_page_title_bar_enabled( 0 ) ? '1' : '2' );
				echo avada_render_post_title( 0, false, esc_html__( 'Need a new search?', 'Avada' ), $title_size ); // WPCS: XSS ok.
				?>
				<p><?php esc_html_e( 'If you didn\'t find what you were looking for, try a new search!', 'Avada' ); ?></p>
				<?php
					if ( function_exists( 'woocommerce_product_search' ) && function_exists( 'avada_child_wps_search_form' ) ) {
						avada_child_wps_search_form();
					} else {
						$is_live_search = Avada()->settings->get( 'live_search' );
					?>
					<form role="search" class="searchform fusion-search-form fusion-live-search" method="get" action="<?php echo esc_url_raw( home_url( '/' ) ); ?>">
						<div class="fusion-search-form-content">
							<div class="fusion-search-field search-field">
								<label><span class="screen-reader-text"><?php esc_attr_e( 'Search for:', 'Avada' ); ?></span>
									<?php if ( $is_live_search ) : ?>
										<input type="search" class="s fusion-live-search-input" name="s" id="fusion-live-search-input" autocomplete="off" placeholder="<?php esc_html_e( 'Search ...', 'Avada' ); ?>" required aria-required="true" aria-label="<?php esc_html_e( 'Search ...', 'Avada' ); ?>"/>
									<?php else : ?>
										<input type="search" value="" name="s" class="s" placeholder="<?php esc_html_e( 'Search ...', 'Avada' ); ?>" required aria-required="true" aria-label="<?php esc_html_e( 'Search ...', 'Avada' ); ?>"/>
									<?php endif; ?>
								</label>
							</div>
							<div class="fusion-search-button search-button">
								<input type="submit" class="fusion-search-submit searchsubmit" value="&#xf002;" />
								<?php if ( $is_live_search ) : ?>
								<div class="fusion-slider-loading"></div>
								<?php endif; ?>
							</div>
						</div>
						<?php if ( $is_live_search ) : ?>
							<div class="fusion-search-results-wrapper"><div class="fusion-search-results"></div></div>
						<?php endif; ?>
					</form>
					<?php
				}
				?>
			</div>
		<?php endif; ?>

		<?php if ( 'top' == Avada()->settings->get( 'search_new_search_position' ) || 'hidden' == Avada()->settings->get( 'search_new_search_position' ) ) : ?>
			<?php get_template_part( 'templates/blog', 'layout' ); ?>
		<?php endif; ?>

	<?php else : ?>

		<div class="post-content">

			<?php Avada()->template->title_template( esc_html__( 'Couldn\'t find what you\'re looking for!', 'Avada' ) ); ?>
			<div class="error-page">
				<div class="fusion-columns fusion-columns-3">
					<div class="fusion-column col-lg-4 col-md-4 col-sm-4 fusion-error-page-oops">
						<h1 class="oops"><?php esc_html_e( 'Oops!', 'Avada' ); ?></h1>
					</div>
					<div class="fusion-column col-lg-4 col-md-4 col-sm-4 useful-links fusion-error-page-useful-links">
						<h3><?php esc_html_e( 'Helpful Links:', 'Avada' ); ?></h3>
						<?php
						// Get needed checklist default settings.
						$circle_class      = ( Avada()->settings->get( 'checklist_circle' ) ) ? 'circle-yes' : 'circle-no';
						$font_size         = Fusion_Sanitize::convert_font_size_to_px( Avada()->settings->get( 'checklist_item_size' ), Avada()->settings->get( 'body_typography', 'font-size' ) );
						$checklist_divider = ( 'yes' === Avada()->settings->get( 'checklist_divider' ) ) ? ' fusion-checklist-divider' : '';

						// Calculated derived values.
						$circle_yes_font_size    = $font_size * 0.88;
						$line_height             = $font_size * 1.7;
						$icon_margin             = $font_size * 0.7;
						$icon_margin_position    = ( is_rtl() ) ? 'left' : 'right';
						$content_margin          = $line_height + $icon_margin;
						$content_margin_position = ( is_rtl() ) ? 'right' : 'left';

						// Set markup depending on icon circle being used or not.
						if ( Avada()->settings->get( 'checklist_circle' ) ) {
							$before = '<span class="icon-wrapper circle-yes" style="background-color:var(--checklist_circle_color);font-size:' . $font_size . 'px;height:' . $line_height . 'px;width:' . $line_height . 'px;margin-' . $icon_margin_position . ':' . $icon_margin . 'px;" ><i class="fusion-li-icon fa fa-angle-right" style="color:var(--checklist_icons_color);"></i></span><div class="fusion-li-item-content" style="margin-' . $content_margin_position . ':' . $content_margin . 'px;">';
						} else {
							$before = '<span class="icon-wrapper circle-no" style="font-size:' . $font_size . 'px;height:' . $line_height . 'px;width:' . $line_height . 'px;margin-' . $icon_margin_position . ':' . $icon_margin . 'px;" ><i class="fusion-li-icon fa fa-angle-right" style="color:var(--checklist_icons_color);"></i></span><div class="fusion-li-item-content" style="margin-' . $content_margin_position . ':' . $content_margin . 'px;">';
						}

						$error_page_menu_args = [
							'theme_location' => '404_pages',
							'depth'          => 1,
							'container'      => false,
							'menu_id'        => 'fusion-checklist-1',
							'menu_class'     => 'fusion-checklist fusion-404-checklist error-menu' . $checklist_divider,
							'items_wrap'     => '<ul id="%1$s" class="%2$s" style="font-size:' . $font_size . 'px;line-height:' . $line_height . 'px;">%3$s</ul>',
							'before'         => $before,
							'after'          => '</div>',
							'echo'           => 0,
							'item_spacing'   => 'discard',
							'fallback_cb'    => 'fusion_error_page_menu_fallback',
						];

						// Get the menu markup with correct containers.
						$error_page_menu = wp_nav_menu( $error_page_menu_args );

						/**
						 * Fallback to main menu if no 404 menu is set.
						 *
						 * @since 5.5
						 * @param array $error_page_menu_args The menu arguments.
						 * @return string|false
						 */
						function fusion_error_page_menu_fallback( $error_page_menu_args ) {
							if ( has_nav_menu( 'main_navigation' ) ) {
								$error_page_menu_args['theme_location'] = 'main_navigation';
							}

							unset( $error_page_menu_args['fallback_cb'] );

							return wp_nav_menu( $error_page_menu_args );
						}

						// Make sure divider lines have correct color.
						if ( $checklist_divider ) {
							$error_page_menu = str_replace( 'class="menu-item ', 'style="border-bottom-color:var(--checklist_divider_color);" class="menu-item ', $error_page_menu );
						}

						echo $error_page_menu; // phpcs:ignore WordPress.Security.EscapeOutput
						?>
					</div>
					<div class="fusion-column col-lg-4 col-md-4 col-sm-4 fusion-error-page-search">
						<h3><?php esc_html_e( 'Try again', 'Avada' ); ?></h3>
						<p><?php esc_html_e( 'If you want to rephrase your query, here is your chance:', 'Avada' ); ?></p>
						<?php echo get_search_form( false ); ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>
<?php do_action( 'avada_after_content' ); ?>
<?php
get_footer();

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
