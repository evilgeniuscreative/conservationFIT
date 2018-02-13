<?php
/**
 * Created by IntelliJ IDEA.
 * User: iaaron
 * Date: 3/24/17
 * Time: 4:28 PM
 */

$content = preg_replace("/<img[^>]+\>/i", "", $viewData->post_content);
$title = truncateToWord($viewData->post_title);
$content = truncateToWord( $content);

$thumb = get_the_post_thumbnail_url($viewData->ID,array(150,150),array(center,center));
if (!empty($thumb)) {
    $imagePath = $thumb;
} else {
    $imagePath = '';
}
?>
<article class="child-page-item">
      <figure><a class="child-page-thumb" href="<?php echo get_permalink($viewData->ID) ?>"><img src="<?php echo $imagePath ?>" title="<?php echo $title ?>" /></a></figure>
    <header>
        <h2><a href="<?php echo get_permalink($viewData->ID) ?>"><?php echo $title ?></a></h2>
    </header>
    <main>

        <div class="child-page-content"><?php echo $content ?>  ... <a class="more-link" href="<?php echo get_permalink($viewData->ID) ?>">[full bio]</a></div>

    </main>
</article>
