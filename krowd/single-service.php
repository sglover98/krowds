<?php
/**
 * $Desc
 *
 * @author     Gaviasthemes Team     
 * @copyright  Copyright (C) 2020 gaviasthemes. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * 
 */
    get_header(); 

    $page_id = krowd_id();

    $default_sidebar_config = krowd_get_option('single_service_sidebar', ''); 
    $default_left_sidebar = krowd_get_option('single_service_left_sidebar', '');
    $default_right_sidebar = krowd_get_option('single_service_right_sidebar', '');

    $sidebar_layout_config = get_post_meta($page_id, 'krowd_sidebar_config', true);
    $left_sidebar = get_post_meta($page_id, 'krowd_left_sidebar', true);
    $right_sidebar = get_post_meta($page_id, 'krowd_right_sidebar', true);

    if ($sidebar_layout_config == "") {
      $sidebar_layout_config = $default_sidebar_config;
    }
    if ($left_sidebar == "") {
      $left_sidebar = $default_left_sidebar;
    }
    if ($right_sidebar == "") {
      $right_sidebar = $default_right_sidebar;
    }

   $left_sidebar_config  = array('active' => false);
   $right_sidebar_config = array('active' => false);
   $main_content_config  = array('class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12');

    $sidebar_config = krowd_sidebar_global($sidebar_layout_config, $left_sidebar, $right_sidebar);
   
    extract($sidebar_config);
    
 ?>

<section id="wp-main-content" class="clearfix main-page">
    <?php do_action( 'krowd_before_page_content' ); ?>
    <div class="container">  
      <div class="main-page-content row">
        <div class="content-page <?php echo esc_attr($main_content_config['class']); ?>">      
          <div id="wp-content" class="wp-content clearfix">
            <?php while ( have_posts() ) : the_post(); 
              get_template_part( 'templates/content/single', 'service' ); 
            endwhile; ?>  

            <?php 
              if( comments_open() || get_comments_number() ) {
                comments_template();
              }
            ?>
            <?php krowd_post_nav(); ?>
          </div>    
        </div>      

         <!-- Left sidebar -->
         <?php if($left_sidebar_config['active']): ?>
         <div class="sidebar wp-sidebar sidebar-left <?php echo esc_attr($left_sidebar_config['class']); ?>">
            <?php do_action( 'krowd_before_sidebar' ); ?>
            <div class="sidebar-inner">
               <?php dynamic_sidebar($left_sidebar_config['name'] ); ?>
            </div>
            <?php do_action( 'krowd_after_sidebar' ); ?>
         </div>
         <?php endif ?>

         <!-- Right Sidebar -->
         <?php if($right_sidebar_config['active']): ?>
         <div class="sidebar wp-sidebar sidebar-right <?php echo esc_attr($right_sidebar_config['class']); ?>">
            <?php do_action( 'krowd_before_sidebar' ); ?>
               <div class="sidebar-inner">
                  <?php dynamic_sidebar($right_sidebar_config['name'] ); ?>
               </div>
            <?php do_action( 'krowd_after_sidebar' ); ?>
         </div>
         <?php endif ?>
      </div>   
    </div>
    <?php do_action( 'krowd_after_page_content' ); ?>
</section>

<?php get_footer(); ?>
