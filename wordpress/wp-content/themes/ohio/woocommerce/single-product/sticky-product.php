<?php
    global $product;

    $available = OhioOptions::get( 'woocommerce_product_sticky', true );
?>
<?php if ($available): ?>
    <div class="sticky-product -fade-up">
        <?php if ( has_post_thumbnail() ) {
            $url = wp_get_attachment_image_url( $product->get_image_id(), 'thumbnail' ) ?>
            <div class="sticky-product-thumbnail" style="background-image: url(<?php echo esc_url($url) ?>)"></div>
        <?php } else { ?>
            <div class="sticky-product-thumbnail" style="background-image: url(<?php echo wc_placeholder_img_src() ?>)"></div>
        <?php } ?>
        <div class="sticky-product-details">
            <div class="headline">
                <h6 class="woo-product-name title">
                    <a href="<?php the_permalink() ?>"><?php the_title();?></a>
                </h6>
                <span class="tag <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></span>
            </div>
            <div class="woo-category category-holder">
                <?php
                $cats = get_the_terms( $post->ID, 'product_cat' );
                $cat_count = sizeof( $cats );
                if ($cat_count) {
                    $i = 0;
                    foreach ($cats as $cat) {
                        ?>
                        <a href="<?php echo get_term_link($cat->term_id) ?>" class="category"><?php echo esc_html($cat->name) ?></a>
                        <?php
                        $i++;
                    }
                }
                ?> 
            </div> 
            <?php if( $product->is_type( 'variable' ) ):?>
                <div class="variation-add-to-cart-wrap">
                    <div class="woocommerce-variation-add-to-cart variations_button woocommerce-add-to-cart">
                        <a type="submit" class="single_add_to_cart_button button -text alt sticky-product-cart " data-unavailable-message="<?php echo esc_attr( 'Sorry, this product is unavailable. Please choose a different combination.' ); ?>" data-button-loading="true">
                            <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
                        </a>

                        <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
                        <input type="hidden" name="variation_id" class="variation_id" value="0" />
                    </div>
                </div>
            <?php else: ?>
                <form class="cart woocommerce-add-to-cart" method="post" enctype='multipart/form-data'>
                    <?php if ( $product->is_in_stock() ) : ?>
                        <div class="simple-qty" style="display: none">
                            <?php if ( ! $product->is_sold_individually() ) {
                                woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) );
                            } ?>
                        </div>
                        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
                        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
                        <input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
                        <input type="hidden" name="variation_id" class="variation_id" value="0" />
                        <div class="variations_button sticky-product-btn">
                            <a class="single_add_to_cart_button button -text alt sticky-product-cart " data-button-loading="true">
                                <?php esc_html_e( 'Add to cart', 'ohio' ); ?>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="sticky-product-btn">
                            <a class="button -text alt sticky-product-out-of-stock">
                                <?php esc_html_e( 'Out of stock', 'ohio' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </form>
            <?php endif; ?>
        </div>
        <div class="close-bar">
			<button class="icon-button -small" aria-label="close">
                <i class="icon">
                    <svg class="default" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z"></path></svg>
                    <svg class="minimal" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7552 0.244806C16.0816 0.571215 16.0816 1.10043 15.7552 1.42684L1.42684 15.7552C1.10043 16.0816 0.571215 16.0816 0.244806 15.7552C-0.0816021 15.4288 -0.0816021 14.8996 0.244806 14.5732L14.5732 0.244806C14.8996 -0.0816019 15.4288 -0.0816019 15.7552 0.244806Z"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M15.7552 15.7552C15.4288 16.0816 14.8996 16.0816 14.5732 15.7552L0.244807 1.42684C-0.0816013 1.10043 -0.0816013 0.571215 0.244807 0.244806C0.571215 -0.0816021 1.10043 -0.0816021 1.42684 0.244806L15.7552 14.5732C16.0816 14.8996 16.0816 15.4288 15.7552 15.7552Z"></path></svg>
                </i>
            </button>
        </div>
    </div>
<?php endif; ?>
