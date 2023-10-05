<?php get_header(); ?>
<?php 
    if ( is_category() ) {
        $title = single_tag_title( '', false );
    }
    elseif ( is_tag() ) {
        $title = "Étiquette : " . single_tag_title( '', false );
    }
    elseif ( is_search() ) {
        $title = "Vous avez recherché : " . get_search_query();
    }
    else {
        $title = 'Le Blog';
    }
?>

    <main class="site__content container">
        <div class="col2">
            <div class="main-content"   >
            
                <h1><?php echo $title?></h1 >
                <p><?php the_content(); ?></p>
                
                <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

                    <a href="<?php the_permalink(); ?>">
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_excerpt(); ?></p>
                        <img style="max-height:400px;" src="<?php the_post_thumbnail_url(); ?>">
                    </a>
                    <p>------------------------------------------------------------------------------------------------------------------------------------------------------</p>
                <?php endwhile; endif; ?>
            </div>

            <div class="scp_sidebar">
                <aside class="site__sidebar">
                    <ul>
                        <?php dynamic_sidebar( 'sidebar-1' ); ?>
                    </ul>
                </aside>
            </div>
        </div>

        <?php the_posts_pagination(); ?>
    </main>

<?php get_footer(); ?>