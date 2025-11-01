<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: https://codex.wordpress.org/The_Loop
 *
 * @package snapdragon
 */

defined('ABSPATH') or die('No script kiddies please!');



while ( have_posts() ) :
	the_post();

	/**
	 * Include the Post-Format-specific template for the content.
	 * If you want to override this in a child theme, then include a file
	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
	 */
	get_template_part( 'content', get_post_format() );

endwhile;

/**
 * Functions hooked in to snapdragon_paging_nav action
 * @hooked snapdragon_paging_nav - 10
 */
do_action( 'snapdragon_loop_after' );