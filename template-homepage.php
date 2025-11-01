<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package snapdragon
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
                while ( have_posts() ) :

                    the_post();

                    do_action( 'snapdragon_homepage_before' );

                    get_template_part( 'content', 'homepage' );

                    /**
                     * Functions hooked in to snapdragon_page_after action
                     * @hooked snapdragon_display_comments - 10
                     */
                    do_action( 'snapdragon_homepage_after' );
                    
                endwhile;
			?>

		</main>
	</div>
<?php

do_action( 'snapdragon_sidebar' );

get_footer();