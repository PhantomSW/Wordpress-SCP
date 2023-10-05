<!-- <footer class="site__footer">
	
</footer> -->
<div class="separation"></div>
                <?php wp_nav_menu( 
                        array( 
                            'theme_location' => 'footer', 
                            'container' => 'ul', // éviter d'avoir une div autour 
                            'menu_class' => 'site__header__menu', // classe personnalisée 
                        ) 
                    ); 
                ?>
<footer class="main-footer">
    <div class="inside">
        
    
        <div class="logo">
            <?php   $image_id = 559;
                    $image_url = wp_get_attachment_image_src($image_id, 'full');
                    $image_url = $image_url[0]; ?>
            <img src="<?php echo $image_url; ?>" alt="L'Oréal - Safe@Work - Safe@Home">
        </div>
    </div>
</footer>

<!-- Back to top -->
<a href="#" class="top"><i class="fa-solid fa-arrow-up-long"></i></a>
	<?php wp_footer(); ?>
</body>
</html>