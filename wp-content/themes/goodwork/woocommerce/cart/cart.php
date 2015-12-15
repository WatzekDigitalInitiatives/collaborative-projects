<?php
/**
* Cart Page
*
* @author WooThemes
* @package WooCommerce/Templates
* @version 2.1.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'goodwork' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'goodwork' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'goodwork' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'goodwork' ); ?></th>
			<th class="product-remove">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			?>

					<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<!-- Product Name -->
						<td class="product-name">

							<?php

								$img_url = wp_get_attachment_image_src(get_post_thumbnail_id($_product->id), 'medium');

								$img_obj = aq_resize($img_url[0], '60', '60', true, false);

								$image = '<img src="' . $img_obj[0] . '" width="' . $img_obj[1] . '" height="' . $img_obj[2] . '" alt="" />';

								echo $image;

							?>

							<?php

							if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

                   			// Backorder notification
               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
               					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'goodwork' ) . '</p>';
							?>

						</td>

						<!-- Product price -->
						<td class="product-price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<!-- Quantity inputs -->
						<td class="product-quantity">
							<?php

							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );

							?>
						</td>

						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>


						<!-- Remove from cart link -->
						<td class="product-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'goodwork' ) ), $cart_item_key );
							?>
						</td>

					</tr>
					<?php
				}
			}

		do_action( 'woocommerce_cart_contents' );
			?>
			</tbody>
		</table>

		<div class="row-fluid">

			<div class="wpb_content_element span6 column_container" style="padding-right:30px">

			<?php if ( WC()->cart->coupons_enabled() ) { ?>

				<header class="sectionTitle clearfix no-con" style="margin-bottom:31px">
					<h3><?php _e('Apply Coupon', 'goodwork'); ?></h3>
				</header>
				<div class="coupon clearfix">

					<input name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'goodwork' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'goodwork' ); ?>" />

					<?php do_action('woocommerce_cart_coupon'); ?>

				</div>

			<?php } ?>

				<header class="sectionTitle clearfix no-con" style="margin:31px 0 31px">
					<h3><?php _e('Calculate Shipping', 'goodwork'); ?></h3>
				</header>
				<?php woocommerce_shipping_calculator(); ?>

			</div>

			<div class="wpb_content_element span6 column_container cart_total_rb" style="padding-left:30px">

				<header class="sectionTitle clearfix no-con" style="margin-bottom:31px">
					<h3><?php _e('Cart Total', 'goodwork'); ?></h3>
				</header>

				<?php woocommerce_cart_totals(); ?>

 				<input type="submit" class="checkout-button button alt" name="proceed" value="<?php _e( 'Proceed to Checkout &rarr;', 'goodwork' ); ?>" />
				<input type="submit" class="button" name="update_cart" value="<?php _e( 'Update Cart', 'goodwork' ); ?>" />

				<?php do_action('woocommerce_proceed_to_checkout'); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
				<?php do_action( 'woocommerce_after_cart_table' ); ?>

			</div>

		</div>

	</form>

<div class="cart-collaterals">

	<?php do_action('woocommerce_cart_collaterals'); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>