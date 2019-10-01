<?php echo $before_widget;?>
<?php echo $before_title;?>

<?php $objCart = WC()->cart; ?>

<?php do_action( 'tdm_wmc_before' ); ?>

<?php if ( ! $objCart->is_empty() ) { ?>

      <?php do_action( 'tdm_wmc_before_not_empty' ); ?>

      <?php
        $get_cart = $objCart->get_cart();
        $cart_totals = $objCart->get_totals( );
        $cart_total_value = wc_price( $cart_totals['subtotal'] + $cart_totals['subtotal_tax'] );
      ?>
      <ul class="tdm-wmc tdm-wmc-list tdm-wmc-product_list_widget <?php echo esc_attr( $custom_main_class ); ?>">

        <?php
    		  do_action( 'tdm_wmc_before_contents' );
        ?>

        <li>
          <?php
      		  do_action( 'tdm_wmc_before_li_contents' );
          ?>
            <div class="tdm_wmc_before_container">
              <span class="tdm_wmc_count">
                <?php echo sprintf( _n( '%d item', '%d items', $objCart->get_cart_contents_count() ), $objCart->get_cart_contents_count() ); ?>
              </span>

              <span class="tdm_wmc_total">
            		<?php
            		echo $cart_total_value;
            		?>
            	</span>
            </div>
          <?php
      		  do_action( 'tdm_wmc_after_li_contents' );
          ?>
          <ul class="tdm_wmc_content_container">
          <?php foreach ( $objCart->get_cart() as $cart_item_key => $cart_item ) {
            $_product   = apply_filters( 'tdm_wmc_item_product', $cart_item['data'], $cart_item, $cart_item_key );
      			$product_id = apply_filters( 'tdm_wmc_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

        			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'tdm_wmc_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
        				$product_name      = apply_filters( 'tdm_wmc_item_name', $_product->get_name(), $cart_item, $cart_item_key );
        				$thumbnail         = apply_filters( 'tdm_wmc_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
        				$product_price     = apply_filters( 'tdm_wmc_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
        				$product_permalink = apply_filters( 'tdm_wmc_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
              }

              ?>
              <li class="tdm_wmc-item <?php echo esc_attr( apply_filters( 'tdm_wmc_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>" id="tdm_wmc_item-<?php echo $product_id;?>">
                <?php
      					echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
      						'tdm_wmc_item_remove_link',
      						sprintf(
      							'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
      							esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
      							esc_html__( 'Remove this item', 'woocommerce' ),
      							esc_attr( $product_id ),
      							esc_attr( $cart_item_key ),
      							esc_attr( $_product->get_sku() )
      						),
      						$cart_item_key
      					);
      					?>
                <?php if ( empty( $product_permalink ) ) : ?>
      						<?php echo $thumbnail . $product_name;  ?>
      					<?php else : ?>
      						<a href="<?php echo esc_url( $product_permalink ); ?>" class="tdm_wmc_thumb">
      							<?php echo $thumbnail . $product_name;  ?>
      						</a>
      					<?php endif; ?>
      					<?php echo wc_get_formatted_cart_item_data( $cart_item );  ?>
      					<?php echo apply_filters( 'tdm_wmc_widget_cart_item_quantity', '<span class="quantity tdm_wmc_quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
              </li>
            <?php }//foreach ?>

            <li>
              <div class="tdm_wmc_after_container">
                <p class="woocommerce-mini-cart__total total">
              		<?php
              		/**
              		 * Woocommerce_widget_shopping_cart_total hook.
              		 *
              		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
              		 */
              		do_action( 'woocommerce_widget_shopping_cart_total' );
              		?>
              	</p>
              </div>
            </li>

          </ul>
        </li>

      </ul>

      <?php do_action( 'tdm_wmc_after_not_empty' ); ?>

<?php }//if cart is not empty ?>

<?php do_action( 'tdm_wmc_after' ); ?>

<?php echo $after_widget;?>
