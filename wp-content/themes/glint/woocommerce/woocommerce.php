<?php
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    // add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    //Интеграция WooCommerce Шаблона
    add_filter( 'woocommerce_add_to_cart_fragments', 'wc_mini_cart_refresh_number');
    function wc_mini_cart_refresh_number($fragments){
        ob_start();
        ?>
        <a href="#" class="cart_btn">
            <span class="wc-block-mini-cart__amount"><?php echo WC()->cart->total . ' ' . get_woocommerce_currency_symbol(); ?></span>
            <span class="wc-block-mini-cart__quantity-badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none" width="20" height="20" class="wc-block-mini-cart__icon" aria-hidden="true" focusable="false"><circle cx="12.6667" cy="24.6667" r="2" fill="currentColor"></circle><circle cx="23.3333" cy="24.6667" r="2" fill="currentColor"></circle><path fill-rule="evenodd" clip-rule="evenodd" d="M9.28491 10.0356C9.47481 9.80216 9.75971 9.66667 10.0606 9.66667H25.3333C25.6232 9.66667 25.8989 9.79247 26.0888 10.0115C26.2787 10.2305 26.3643 10.5211 26.3233 10.8081L24.99 20.1414C24.9196 20.6341 24.4977 21 24 21H12C11.5261 21 11.1173 20.6674 11.0209 20.2034L9.08153 10.8701C9.02031 10.5755 9.09501 10.269 9.28491 10.0356ZM11.2898 11.6667L12.8136 19H23.1327L24.1803 11.6667H11.2898Z" fill="currentColor"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M5.66669 6.66667C5.66669 6.11438 6.1144 5.66667 6.66669 5.66667H9.33335C9.81664 5.66667 10.2308 6.01229 10.3172 6.48778L11.0445 10.4878C11.1433 11.0312 10.7829 11.5517 10.2395 11.6505C9.69614 11.7493 9.17555 11.3889 9.07676 10.8456L8.49878 7.66667H6.66669C6.1144 7.66667 5.66669 7.21895 5.66669 6.66667Z" fill="currentColor"></path>
                </svg>
                <span class="wc-block-mini-cart__badge"><?php echo WC()->cart->get_cart_contents_count() ?></span>
            </span>
            <script>
                updateCart();

                window.addEventListener('added_to_cart wc_cart_button_updated cart_totals_refreshed updated_cart_totals', function(){
                    // console.log('updated_cart_totals')
                    updateCart();
                });

                function updateCart() {
                    document.querySelector('.cart_btn').addEventListener('click', (e) => {
                        e.preventDefault();
                        document.querySelector('.wc-block-mini-cart__button').click()
                    });
                }
            </script>
        </a>
        <?php
        $fragments['.cart_btn'] = ob_get_clean();
        return $fragments;
    }

    add_action('wp_enqueue_scripts', 'woocommerce_scripts', 99);

    function woocommerce_scripts(){
        if(is_checkout()){
            // wp_enqueue_style('checkout', get_template_directory_uri() . '/woocommerce/css/checkout.css');
            wp_enqueue_style('checkout', get_template_directory_uri() . '/woocommerce/css/checkout.css');
            
            // wp_dequeue_script( 'select' );
            // wp_dequeue_script( 'nice_select' );
            wp_enqueue_script('nice_select', get_template_directory_uri() . '/assets/js/jquery.nice-select.min.js', array('jquery'), null, true);
            // wp_enqueue_script('checkout', get_template_directory_uri() . '/woocommerce/js/checkout.js', array(), null, true);
        }

        if(is_product()){
            wp_enqueue_style('product', get_template_directory_uri() . '/woocommerce/css/single-product.css');
        }

        if(is_account_page()){
            wp_enqueue_style('account', get_template_directory_uri() . '/woocommerce/css/account.css');
            
            wp_enqueue_script('account', get_template_directory_uri() . '/woocommerce/js/account.js', array('jquery'), null, true);
        }

        if(is_cart()){
            wp_enqueue_style('cart', get_template_directory_uri() . '/woocommerce/css/cart.css');
        }
    }


    // Здесь писать свои функции вывода вёрстки для WooCommerce хуков
    function get_filtered_price()
    {
        global $wpdb;

        $args       = wc()->query->get_main_query();

        $tax_query  = isset($args->tax_query->queries) ? $args->tax_query->queries : array();
        $meta_query = isset($args->query_vars['meta_query']) ? $args->query_vars['meta_query'] : array();

        foreach ($meta_query + $tax_query as $key => $query) {
            if (!empty($query['price_filter']) || !empty($query['rating_filter'])) {
                unset($meta_query[$key]);
            }
        }

        $meta_query = new \WP_Meta_Query($meta_query);
        $tax_query  = new \WP_Tax_Query($tax_query);

        $meta_query_sql = $meta_query->get_sql('post', $wpdb->posts, 'ID');
        $tax_query_sql  = $tax_query->get_sql($wpdb->posts, 'ID');

        $sql  = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
        $sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
        $sql .= " 	WHERE {$wpdb->posts}.post_type IN ('product')
                AND {$wpdb->posts}.post_status = 'publish'
                AND price_meta.meta_key IN ('_price')
                AND price_meta.meta_value > '' ";
        $sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

        $search = \WC_Query::get_main_search_query_sql();
        if ($search) {
            $sql .= ' AND ' . $search;
        }

        $prices = $wpdb->get_row($sql); // WPCS: unprepared SQL ok.

        return [
            'min' => floor($prices->min_price),
            'max' => ceil($prices->max_price)
        ];
    }

    function display_shop_filters()
    {
        ob_start(); ?>

        <aside class="catalog__aside">
            <div class="catalog__filters" data-spollers="992,max" data-one-spoller="">
                <div class="catalog__filters-trigger" tabindex="-1" type="button" data-spoller="">
                    <svg width="30" height="30">
                        <use href='<?php echo get_template_directory_uri(); ?>/assets/build/img/sprite/sprite.svg#filter'>
                    </svg>
                    Products Filter
                </div>

                <ul class="catalog__filters-content filters">
                    <li class="filters__item">
                        <span class="filters__head">Price</span>

                        <div class="filters__range range">
                            <div class="range__inputs">
                                <label class="range__label">
                                    <input class="range__input" type="number" min="<?php echo get_filtered_price()['min']; ?>" max="<?php echo get_filtered_price()['max']; ?>" value="<?php echo get_filtered_price()['min']; ?>" id="range-min">
                                </label>

                                <div class="range__separator">-</div>

                                <label class="range__label">
                                    <input class="range__input" type="number" min="<?php echo get_filtered_price()['min']; ?>" max="<?php echo get_filtered_price()['max']; ?>" value="<?php echo get_filtered_price()['max']; ?>" id="range-max">
                                </label>
                            </div>

                            <div class="range__slider" id="range-slider"></div>
                        </div>
                    </li>

                    <?php
                    $taxonomies = get_taxonomies(['object_type' => ['product']]);

                    foreach ($taxonomies as $attr) {
                        if ($attr == 'product_type' || $attr == 'product_cat' || $attr == 'product_tag') continue;

                        $attrs = get_terms(array(
                            'taxonomy' => $attr,
                            'hide_empty' => false,
                        ));

                        if ($attrs) { ?>
                            <li class="filters__item">
                                <span class="filters__head"><?php print_r(get_taxonomy($attr)->labels->name_admin_bar); ?></span>
                                <ul class="filters__list <?php echo $attr; ?>">
                                    <?php foreach ($attrs as $attribute) { ?>
                                        <li class="filters__list-item">
                                            <label>
                                                <input class="filters__input" data-id="<?php echo $attribute->term_id; ?>" type="checkbox" name="pa_lamp-intensity[]">
                                                <span class="filters__checkbox"><?php echo $attribute->name . '(' . $attribute->count . ')'; ?></span>
                                            </label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                    <?php }
                    } ?>
                </ul>
            </div>
        </aside>

    <?php
        echo ob_get_clean();
    }

    function get_product_title()
    {
        ob_start(); ?>
        <div class="card__title"><?php echo get_the_title(); ?></div>
    <?php
        echo ob_get_clean();
    }

    // вывести звёздный рейтинг 
    function get_star_rating()
    {
        global $post, $product;
        $rating_count = $product->get_rating_count(); // кол-во комментов
        $review_count = $product->get_review_count(); // 
        $average      = $product->get_average_rating();

        if ($rating_count > 0) {
            $title = sprintf(__('Оценка %s из 5', 'woocommerce'), $average);
        } else {
            $title = 'No reviews';
            $rating = 0;
        }

        echo '<div class="star-rating">';
        echo '<span style="width:' . (($rating_count / 5) * 100) . '%"><strong class="rating">' . $average . '</strong> ' . __('из 5', 'woocommerce') . '</span>';
        echo '</div>';
        echo '<div class="rate" style="background: url(http://wayup/wp-content/uploads/2022/06/star-fill.svg) left center; width:' . (($average / 5) * 95) . 'px !important; max-width: 95px !important;"></div>';
    }

    // вывести % скидки товара
    // function show_discount()
    // {
    //     if (!defined('ABSPATH')) {
    //         exit; // Exit if accessed directly
    //     }

    //     global $post, $product;

    //     if ($product->is_on_sale()) :
    //         $price = get_post_meta(get_the_ID(), '_regular_price', true);
    //         $sale = get_post_meta(get_the_ID(), '_price', true);
    //         $discount = floor(100 - (($sale / $price) * 100)) . '%';

    //         echo '<span class="discount">' . $discount . '</span>';
    //     endif;
    // }
    function display_price()
    {
        ob_start();
        global $product;
        //if ($product->is_on_sale()) :
            // $price = get_post_meta(get_the_ID(), '_regular_price', true);
            // $sale = get_post_meta(get_the_ID(), '_price', true);
            // $discount = floor(100 - (($sale / $price) * 100)) . '%';


            if ($product->get_regular_price()) {
                if ($product->get_sale_price()) { ?>
                    <div class="card__pricing">
                        <span class="card__pricing-before"><?php echo get_woocommerce_currency_symbol() . $product->get_regular_price(); ?></span>
                        <span class="card__pricing-current"><?php echo get_woocommerce_currency_symbol() . $product->get_sale_price(); ?></span>
                    </div>
                <?php } else { ?>
                    <div class="card__pricing">
                        <span class="card__pricing-current"><?php echo get_woocommerce_currency_symbol() . $product->get_regular_price(); ?></span>
                    </div>
                <?php } ?>
            <?php }
            // echo '<div class="card__pricing">';
            // echo '<span class="card__pricing-before">' . get_woocommerce_currency_symbol() . $price . '</span>';
            // echo '<span class="card__pricing-current">' . get_woocommerce_currency_symbol() . $sale . '</span>';
            // echo '</div>';
        //endif;

        return ob_get_contents();
    }

    function display_rating()
    {
        global $product;
        // $rating_count = $product->get_rating_count(); // кол-во комментов
        $review_count = $product->get_review_count(); // 
        $average      = ceil($product->get_average_rating()); // кол-во звёзд
    ?>
        <div class="card__rating">
            <?php for ($i = 0; $i < $average; $i++) { ?>
                <svg width="14" height="14" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 0L13.4697 7.60081H21.4616L14.996 12.2984L17.4656 19.8992L11 15.2016L4.53436 19.8992L7.00402 12.2984L0.538379 7.60081H8.53035L11 0Z" fill="#FFA200"></path>
                </svg>
            <?php } ?>

            <?php for ($i = 0; $i < 5 - $average; $i++) { ?>
                <svg width="14" height="14" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 0L13.4697 7.60081H21.4616L14.996 12.2984L17.4656 19.8992L11 15.2016L4.53436 19.8992L7.00402 12.2984L0.538379 7.60081H8.53035L11 0Z" fill="#000"></path>
                </svg>
            <?php } ?>
        </div>

        <div class="card__reviews">(<?php echo $review_count; ?>) reviews</div>
    <?php 
    }

    function my_custom_img_function($attachment_id, $main_image = false)
    {
        $flexslider        = (bool) apply_filters('woocommerce_single_product_flexslider_enabled', get_theme_support('wc-product-gallery-slider'));
        $gallery_thumbnail = wc_get_image_size('gallery_thumbnail');
        $thumbnail_size    = apply_filters('woocommerce_gallery_thumbnail_size', array($gallery_thumbnail['width'], $gallery_thumbnail['height']));
        $image_size        = apply_filters('woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size);
        $full_size         = apply_filters('woocommerce_gallery_full_size', apply_filters('woocommerce_product_thumbnails_large_size', 'full'));
        $thumbnail_src     = wp_get_attachment_image_src($attachment_id, $thumbnail_size);
        $full_src          = wp_get_attachment_image_src($attachment_id, $full_size);
        $alt_text          = trim(wp_strip_all_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)));
        $image             = wp_get_attachment_image(
            $attachment_id,
            $image_size,
            false,
            apply_filters(
                'woocommerce_gallery_image_html_attachment_image_params',
                array(
                    'title'                   => _wp_specialchars(get_post_field('post_title', $attachment_id), ENT_QUOTES, 'UTF-8', true),
                    'data-caption'            => _wp_specialchars(get_post_field('post_excerpt', $attachment_id), ENT_QUOTES, 'UTF-8', true),
                    'data-src'                => esc_url($full_src[0]),
                    'data-large_image'        => esc_url($full_src[0]),
                    'data-large_image_width'  => esc_attr($full_src[1]),
                    'data-large_image_height' => esc_attr($full_src[2]),
                    'class'                   => esc_attr($main_image ? 'wp-post-image' : ''),
                ),
                $attachment_id,
                $image_size,
                $main_image
            )
        );

        return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image"><a data-lightbox="Gallery" href="' . esc_url($full_src[0]) . '">' . $image . '</a></div>';
    }



    // // Удаление/Подключение/Переподключение хуков
    // // archive-product.php
    // remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    // add_action('woocommerce_before_main_content', 'get_breadcrumbs', 20);

    // remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    // remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);



    // remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

    // remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    // add_action('woocommerce_sidebar', 'display_shop_filters', 10);

    // // content-product.php
    // remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

    // remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    // add_action('woocommerce_shop_loop_item_title', 'get_product_title', 10);

    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

    // remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    // remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    // add_action('woocommerce_after_shop_loop_item_title', 'display_price', 10);
    // add_action('woocommerce_after_shop_loop_item_title', 'display_rating', 15);

    // remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);


    // single-product.php
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    // add_action('woocommerce_before_main_content', 'get_breadcrumbs', 20);



    // remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);



    // content-single-product.php
    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);



    // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
    // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
    // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
    // remove_action('woocommerce_single_product_summary', 'generate_product_data', 60);
    // // add_action( 'woocommerce_single_product_summary', 'get_star_rating', 10);


    // remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    // remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
    // remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);



    // add_action('woocommerce_before_checkout_form', 'open_checkout_div', 1);
    // add_action('woocommerce_after_checkout_form', 'close_checkout_div', 1);
    
    // remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 ); 
    // remove_action( 'woocommerce_product_after_tabs', 'woocommerce_checkout_coupon_form', 10 ); 
    

    function open_checkout_div() {
        echo '<div class="open_checkout">';
    }
    function close_checkout_div() {
        echo '</div>';
    }

    
}