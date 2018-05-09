<?php
/**
 * Product Search Form integrated with WooCommerce Product Search.
 *
 * @link       https://www.itthinx.com
 * @package    Avada-child-wps
 * @subpackage Templates
 * @since      1.0.0
 */

if ( function_exists( 'woocommerce_product_search' ) && function_exists( 'avada_child_wps_search_form' ) ) {
	avada_child_wps_search_form();
} else {
?>
<form role="search" method="get" class="searchform" action="<?php echo esc_url_raw( home_url( '/' ) ); ?>">
	<div>
		<input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" class="s" placeholder="<?php esc_attr_e( 'Search...', 'Avada' ); ?>" />
		<input type="hidden" name="post_type" value="product" />
	</div>
</form>
<?php
}
