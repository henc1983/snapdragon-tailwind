<?php
/**
 * Single Post content template.
 * @package snapdragon
 */

defined('ABSPATH') or die('No script kiddies please!');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	do_action( 'snapdragon_single_post_top' );

	/**
	 * Functions hooked into snapdragon_single_post add_action
	 * @hooked snapdragon_post_header          - 10
	 * @hooked snapdragon_post_content         - 30
	 */
	do_action( 'snapdragon_single_post' );

	/**
	 * Functions hooked in to snapdragon_single_post_bottom action
	 * @hooked snapdragon_post_nav         - 10
	 * @hooked snapdragon_display_comments - 20
	 */
	do_action( 'snapdragon_single_post_bottom' );
	?>
</article>