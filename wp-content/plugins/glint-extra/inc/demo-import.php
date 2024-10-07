<?php 
/*
* @packge Glint Extra
* @since 1.0.0
 */
function glint_import() { 
  return array(
    array(
      'import_file_name'             => __('Demo','glint-extra'),
      'page_title'                   => __('Import Demo Data','glint-extra'),
      'local_import_file'            => GLINT_EXTRA_ROOT_PATH.'/demo/demo-data.xml',
      'local_import_widget_file'     => GLINT_EXTRA_ROOT_PATH.'/demo/widget.wie',
      'import_notice'                => __( 'This import maybe finish on 2-5 minutes', 'glint-extra' ),

  ),
   
);
}
add_filter( 'pt-ocdi/import_files', 'glint_import' );

add_action( 'pt-ocdi/after_import',  'glint_after_import' );
if(!function_exists( 'glint_after_import')):
function glint_after_import($selected_import){
if ( 'Demo' === $selected_import['import_file_name'] ) {

  $main_menu = get_term_by('slug', 'Main Nav', 'nav_menu');

      set_theme_mod( 'nav_menu_locations', array(
        'main-menu' => $main_menu->term_id,
      ));

    //Set Front page
       $page = get_page_by_title( 'Home Page 2');
       if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
        update_option( 'show_on_front', 'page' );
       }

       $blog = get_page_by_title( 'Blog');
       if ( isset( $page->ID ) ) {
        update_option( 'page_for_posts', $blog->ID );
        update_option( 'show_on_front', 'page' );
       }

}}
endif;
