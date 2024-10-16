<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Glint
 * @since 1.0.0
 */

$show_brands    = cs_get_option('show_brands', false);
$brands_gallery = cs_get_option('brands_gallery');
$brand_thumb    = cs_get_option('brand_thumb');
$copyright_text = cs_get_option('copyright_text');

$copyright_text_allowed_tags = array(
    'a' => array(
        'href'  => array(),
        'title' => array()
    ),
    'img' => array(
        'alt' => array(),
        'title' => array(),
        'loading' => array(),
        'src' => array()
    ),
    'br'     => array(),
    'em'     => array(),
    'span'   => array(),
    'strong' => array(),
);

?>

</div><!-- #content -->


<!--:::::FOOTER AREA START :::::::-->
<div class="footer-area footer-bg">

    <?php if ($show_brands == true): ?>
        <!--:::::LOGO AREA START :::::::-->
        <div class="logo-carousel section-padding">
            <div class="container">
                <div class="row">
                    <div class="logos owl-carousel">
                        <?php
                        if (!empty($brands_gallery)):
                            foreach ($brands_gallery as $item):
                                foreach ($item as $image): ?>
                                    <div class="single-logo-table">
                                        <div class="single-logo-table-cell">
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['title']); ?>">
                                        </div>
                                    </div>
                        <?php
                                endforeach;
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--:::::LOGO AREA END :::::::-->
    <?php endif; ?>
    <div class="footer-menu-and-copyright">
        <div class="container">
            <div class="row">
                <div class="footer-top col-lg-12 text-center d-flex justify-content-between align-items-center">
                    <div class="col-lg-6 p-0">
                        <?php echo do_shortcode('[mc4wp_form id=114]'); ?>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center gap-2 justify-content-between p-0">
                        <?php if (has_nav_menu('footermenu')) : ?>
                            <?php
                            wp_nav_menu(
                                array(
                                    'menu'            => 'footer-menu',
                                    'theme_location'  => 'footermenu',
                                    'container'       => 'div',
                                    'container_class' => 'footer-menu',
                                    'menu_class'      => 'footer-navv',
                                    'depth'           => 1
                                )
                            );
                            ?>
                        <?php endif; ?>
                        <div class="switcher d-flex">
                            <?php
                            pll_the_languages(array(
                                'display_names_as' => 'slug',
                            ));
                            ?>
                        </div>
                    </div>
                </div>


                <div class="footer-copyright text-center">
                    <?php
                    if (!empty($copyright_text)) {
                        echo wp_kses($copyright_text, $copyright_text_allowed_tags);
                    } else {
                        esc_html_e('Copyright &copy; QuomodoTheme 2020 All Right Reserved.', 'glint');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php if ($show_brands == true): ?>
        <div class="space-60"></div>
    <?php endif; ?>

</div>
<!--:::::FOOTER AREA END :::::::-->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>