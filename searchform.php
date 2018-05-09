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
?>
<form role="search" class="searchform" method="get" action="<?php echo esc_url_raw( home_url( '/' ) ); ?>">
	<div class="search-table">
		<div class="search-field">
			<input type="text" value="" name="s" class="s" placeholder="<?php esc_html_e( 'Search ...', 'Avada' ); ?>" required aria-required="true" aria-label="<?php esc_html_e( 'Search ...', 'Avada' ); ?>"/>
		</div>
		<div class="search-button">
			<input type="submit" class="searchsubmit" value="&#xf002;" />
		</div>
	</div>
</form>
<?php
}
