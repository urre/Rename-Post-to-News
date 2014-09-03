<?php
/*
Plugin Name: Rename Post to News
Plugin URI: labs.urre.me/renameposttonews
Description: Rename built in Post type (Post) to "News". Renames menu items and labels and replaces admin menu icon with a pencil icon instead of the standard pin.
Version: 0.1
Author: Urban Sanden
Author URI: http://urre.me
Author Email: hej@urre.me
License: GPL2
*/


class RenamePostToNews {

    function __construct() {

        # Load plugin text domain
        add_action( 'init', array( $this, 'plugin_textdomain' ) );

        # Register admin styles and scripts
        add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );

        # Change labels
        add_action( 'init', array( $this, 'change_post_object_label' ) );
        add_action( 'admin_menu', array( $this, 'change_post_menu_label' ) );

    }

    public function plugin_textdomain() {
        $domain = 'renameposttonews';
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
        load_textdomain( $domain, WP_LANG_DIR.'/'.$domain.'/'.$domain.'-'.$locale.'.mo' );
        load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

    }

    # Rename menu labels
    public function change_post_menu_label() {

          global $menu;
          global $submenu;
          $menu[5][0] = __('News', 'renameposttonews');
          $submenu['edit.php'][5][0] = __('News', 'renameposttonews');
          $submenu['edit.php'][10][0] = __('Add new post', 'renameposttonews');
          $submenu['edit.php'][16][0] = __('Tags', 'renameposttonews');
          echo '';

    }

    # Rename post object labels
    public function change_post_object_label() {

      global $wp_post_types;
      $labels = &$wp_post_types['post']->labels;
      $labels->name = __('News', 'renameposttonews');
      $labels->singular_name = __('News', 'renameposttonews');
      $labels->add_new = __('Add new post', 'renameposttonews');
      $labels->add_new_item = __('Add new post', 'renameposttonews');
      $labels->edit_item = __('Edit new post', 'renameposttonews');
      $labels->new_item = __('New post', 'renameposttonews');
      $labels->view_item = __('Show item', 'renameposttonews');
      $labels->search_items = __('Search post', 'renameposttonews');
      $labels->not_found = __('No posts found', 'renameposttonews');
      $labels->not_found_in_trash = __('New posts found in trash', 'renameposttonews');

    }

    # Change pin icon to pencil icon
    public function register_admin_styles() {
        if (is_admin()) {
            wp_enqueue_style( 'renameposttonews-plugin-styles', plugins_url( 'rename-post-to-news/css/rename-post-to-news.admin.css' ) );
        }
    }


}

$rptn = new RenamePostToNews();