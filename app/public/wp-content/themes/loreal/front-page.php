<?php get_header(); ?>
<main>
<div class="col2">
	<div class="main-content">
        
	    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	        <?php the_content(); ?>
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




</main>

<?php get_footer(); ?>