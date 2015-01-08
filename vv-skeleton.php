<?php
/*
Plugin Name: Verdon's Skeleton
Plugin URI: http://verdon.ca/
Description: A proof of concept plugin with skeletons and bones
Version: 0.1
Author: Verdon Vaillancourt
Author URI: http://verdon.ca/
Plugin Type: Piklist
License: GPL2
*/

add_action('init', array('vv_skeleton', 'init'), -1);
// add_action('admin_init', array('vv_skeleton', 'admin_init'), -1);
class vv_Skeleton
{

    // initialize things and check for piklist
    public static function init()
    {
        if (is_admin())
        {
            include_once('includes/class-piklist-checker.php');

            if (!piklist_checker::check(__FILE__))
            {
                return;
            }

            add_filter('piklist_admin_pages', array('vv_skeleton', 'admin_pages'));
        }

        self::helpers();
    }

    // admin pages
    public static function admin_pages($pages) 
    {    
        $pages[] = array(
            'page_title' => 'VV Skeleton'
            ,'menu_title' =>  'Skeletons'
            ,'sub_menu' => 'tools.php'
            ,'capability' => 'manage_options'
            ,'menu_slug' => 'vv_skeleton'
            ,'setting' => 'vv_skeleton'
            ,'icon_url' => plugins_url('piklist/parts/img/piklist-icon.png') 
            ,'icon' => 'piklist-page'
            ,'single_line' => false
            ,'default_tab' => 'General'
        );

        return $pages;
    }

    public static function helpers() 
    {
    }



}


add_filter('piklist_admin_pages', 'vv_skeleton_setting_pages');
function vv_skeleton_setting_pages($pages)
{
    $pages[] = array(
        'page_title'  => 'VV Skeleton Settings'       // Title of page
        ,'menu_title' => 'Settings'       // Title of menu link
//        ,'sub_menu'   => 'themes.php'           // Show this page under the THEMES menu 
        ,'sub_menu'   => 'edit.php?post_type=vv_skeleton'           // Show this page under the THEMES menu 
        ,'capability' => 'manage_options'       // Minimum capability to see this page
        ,'menu_slug'  => 'vv_skeleton-fields' // Menu slug
        ,'setting'    => 'vv_skeleton'        // The settings name
        ,'icon'       => 'options-general'      // Menu/Page Icon
        ,'default_tab'=> 'Basic' // Set a default tab
        ,'save'       => true                   // true = show save button / false = hide save button
    );

    return $pages;
}


add_filter('piklist_post_types', 'vv_skeleton_post_type');
function vv_skeleton_post_type($post_types)
{
    $labels = array(
    'name' => 'Skeletons',
    'singular_name' => 'Skeleton',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Skeleton',
    'edit_item' => 'Edit Skeleton',
    'new_item' => 'New Skeleton',
    'all_items' => 'All Skeletons',
    'view_item' => 'View Skeleton',
    'search_items' => 'Search Skeletons',
    'not_found' =>  'No skeletons found',
    'not_found_in_trash' => 'No skeletons found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'VV Skeletons'
    );

    $post_types['vv_skeleton'] = array(
//        'labels' => piklist('post_type_labels', 'VV Skeleton')
        'labels' => $labels
        ,'description' => 'A custom post type for skeletons.'
        ,'public' => true
        ,'menu_position' => 20
        ,'menu_icon' => null
        ,'rewrite' => array(
            'slug' => 'skeleton'
        )
        ,'supports' => array(
            'title'
            ,'editor'
//            ,'author'
            ,'thumbnail'
//            ,'custom-fields'
            ,'comments'
            ,'revisions'
        )
    );
    return $post_types;
}


?>
