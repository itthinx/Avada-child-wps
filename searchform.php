<?php
/**
 * The search-form template integrated with WooCommerce Product Search.
 *
 * @link       https://www.itthinx.com
 * @package    Avada-child-wps
 * @subpackage Templates
 * @since      1.0.0
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

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
