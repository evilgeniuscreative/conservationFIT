<?php
/**
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package Cryout Creations
 * @subpackage Nirvana
 */

if (have_posts()) while (have_posts()) : the_post(); ?>

    <!-- CONTENT-SINGLEOBS.php -->
    <div id = "post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <h1 class = "entry-title">Observation Detail</h1>
        <div class = "entry-content">
            <?php the_content(); ?>
            <div style = "clear:both;"></div>
            <?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:', 'nirvana'), 'after' => '</div>')); ?>
            <?php edit_post_link(__('Edit', 'nirvana'), '<span class="edit-link"><i class="icon-edit"></i> ', '</span>'); ?>
        </div><!-- .entry-content -->
    </div><!-- #post-## -->

    <?php comments_template('', true);
endwhile; ?>
