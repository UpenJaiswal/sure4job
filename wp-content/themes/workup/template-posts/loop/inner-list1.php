<?php 
global $post;
$thumbsize = !isset($thumbsize) ? workup_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
$thumb = workup_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout post-list-item1'); ?>>
    <div class="list-inner clearfix">
        <?php
            if ( !empty($thumb) ) {
                ?>
                <div class="top-image">
                    <?php
                        echo trim($thumb);
                    ?>
                 </div>
                <?php
            }
        ?>
        <div class="<?php echo (!empty($thumb))?'col-content':'col-content-full'; ?>">
            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php } ?>
            <div class="description"><?php echo workup_substring( get_the_excerpt(),20, '...' ); ?></div>
            <div class="top-info flex-middle">
                <div class="date">
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?>
                </div>
                <div class="category">
                    <i class="fa fa-folder-o" aria-hidden="true"></i><?php workup_post_categories_first($post); ?>
                </div>
            </div>
        </div>
    </div>
</article>