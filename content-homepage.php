<?php
/**
 * The template part for displaying homepage contents.
 * @package snapdragon
 */

defined('ABSPATH') or die('No script kiddies please!');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to snapdragon_homepage add_action
	 *
	 * @hooked snapdragon_page_header          - 10
	 * @hooked snapdragon_page_content         - 20
	 */
	do_action( 'snapdragon_homepage' );
	?>
</article>