<!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        
        <?php wp_head(); ?>
    </head>

    <body <?php body_class('site'); ?>>

        <header class="site__header main-header">

            <?php   $image_id = 559;
	            $image_url = wp_get_attachment_image_src($image_id, 'full');
	            $image_url = $image_url[0]; ?>
	            <a href="/"><img class="logo" src="<?php echo $image_url; ?>"></a>
        </header>
            <?php wp_nav_menu( 
                    array( 
                        'theme_location' => 'main', 
                        'container' => 'ul', // éviter d'avoir une div autour 
                        'menu_class' => 'site__header__menu', // classe personnalisée 
                    ) 
                ); 
            ?>

            <!-- Barre de recherche -->
            <?php get_search_form(); ?>

        <!-- Vérifier si un utilisateur est connecté -->
        <?php 
        if ( is_user_logged_in() ):
            $current_user = wp_get_current_user(); 
        ?>
            <p>
                <?php echo $current_user->user_firstname; ?>
                <a href="<?php echo wp_logout_url(); ?>"> Déconnexion </a>
            </p>
        <?php else: ?>
            <p>
                <a href="<?php echo wp_login_url(); ?>"> Connexion </a>
            </p>
        <?php endif; ?>


        

    <?php wp_body_open(); ?>