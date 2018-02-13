<?php
/*
Plugin Name: ConservationFIT Child Pages
Plugin URI: http://www.conservationfit.org
Description: Show child pages via shortcode on parent page
Version: 1
Author: Ian Kleinfeld based on Sridhar Bodakunti
Author URI: http://conservationfit.org
Text Domain: List child pages
*/
/*
    BASED ON wp_list_child_pages plugin from
    Sridhar Bodakunti <touchwithsridhar@gmail.com>

    Copyright 2016
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require_once ('ViewChildPages.php');
function wp_list_pages_custom($args = '')
{
    $defaults = array(
        'depth' => 0, 'show_date' => '',
        'date_format' => get_option('date_format'),
        'child_of' => 0, 'exclude' => '',
        'title_li' => __('Pages'), 'echo' => 1,
        'authors' => '', 'sort_column' => 'menu_order, post_title',
        'link_before' => '', 'link_after' => '', 'walker' => '',
    );
    $r = wp_parse_args($args, $defaults);
    $output = '';
    $current_page = 0;
    // sanitize, mostly to keep spaces out
    $r['exclude'] = preg_replace('/[^0-9,]/', '', $r['exclude']);
    // Allow plugins to filter an array of excluded pages (but don't put a nullstring into the array)
    $exclude_array = ($r['exclude']) ? explode(',', $r['exclude']) : array();
    /**
     * Filter the array of pages to exclude from the pages list.
     *
     * @since 2.1.0
     *
     * @param array $exclude_array An array of page IDs to exclude.
     */
    $r['exclude'] = implode(',', apply_filters('wp_list_pages_excludes', $exclude_array));
    // Query pages.
    $r['hierarchical'] = 0;
    $pages = get_pages($r);
    if (!empty($pages)) {
        return $pages;
    } else {
        return array();
    }
}

function truncateToWord($content,$length=225){
    if(strlen($content)>=$length){
        $spaceAtPos = strpos($content, ' ', $length);
        $content = substr($content,0,$spaceAtPos );
    }
   return $content;
}

//Script for getting child pages as boxes
function cFIT_list_child_pages()
{
    $output = '';
    global $post;
    if (is_page() && $post->post_parent)
        $childpages = wp_list_pages_custom('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0');
    else
        $childpages = wp_list_pages_custom('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0');
    if (!empty($childpages)) {

        wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'css/style.css', false, '1.1', 'all');
        foreach ($childpages as $newpage) {
            $templatePath = dirname(__FILE__)."/staff.php";
            $output .= ViewChildPages::render($templatePath,$newpage);
        }
    }
    return $output;

}

// Adding shortcode feature to child pages
add_shortcode('cFIT_childpages', 'cFIT_list_child_pages');