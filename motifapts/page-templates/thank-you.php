<?php
/*
* Template Name: Thank You
*
*/
get_header(); ?>
    <div class="thank-you container" role="main">
        <div class="content">
            <h1 class="page-title"><?php wp_title(""); ?></h1>
            <div class="copy">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content();?>
                    <?php endwhile;?>
                <?php endif;?>
            </div>
            <div class="images">
                <?php
                if(get_field('images')):
                    echo "<ul class='image-list'>";
                    while(has_sub_field('images')):
                        $image = get_sub_field('image');
                        $imageUrl = $image["url"];
                        $imageAltText = $image["alt"];
                        echo "<li><img src='$imageUrl' alt='$imageAltText'/></li>";
                    endwhile;
                    echo "</ul>";
                endif; ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>