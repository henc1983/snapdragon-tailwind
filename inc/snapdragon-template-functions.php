<?php
/**
 * Template Functions.
 *
 * @package snapdragon
 */

defined('ABSPATH') or die('No script kiddies please!');



if ( ! function_exists( 'snapdragon_main_header_button_group_translates' ) ) {
	function snapdragon_main_header_button_group_translates() {
		global $snapdragon;

		if( ! is_object($snapdragon) 
			|| ! property_exists( $snapdragon , 'defaults' )
			|| ! property_exists( $snapdragon , 'cookies' )
			|| ! property_exists( $snapdragon , 'translates' )
			|| ! is_a( $snapdragon->defaults , 'SnapdragonDefaults' )
			|| ! is_a( $snapdragon->cookies , 'SnapdragonCookies')
			|| ! is_a( $snapdragon->translates , 'SnapdragonTranslates')
		) { return; }

		$enableds = $snapdragon->translates->get_enabled();

		if( count( $enableds ) < 2 ) {
			return;
		}

		$selected = $snapdragon->cookies->get_cookie( $snapdragon->defaults::TRANSLATE_COOKIE_NAME );

		if ( ! $snapdragon->translates->get_url( $selected ) ) {
			return;
		}


		$id = 'translate-main-nav';
		?>
		<div class="dropdown group" id="dropdown-<?php esc_attr_e( $id ) ?>">
			<button class="toggle button text-sm text-black/80 px-1">
				<img class="flag pointer-events-none" src="<?php esc_attr_e( $snapdragon->translates->get_url( $selected ) ) ?>" alt="<?php esc_attr_e( 'Selected language' , 'snapdragon' )?>">
				<span class="pointer-events-none"><?php esc_html_e( $snapdragon->translates->get_title( $selected ) ) ?></span>
				<svg class="icon pointer-events-none"><use xlink:href="#arrow-svg-icon" /></svg>
			</button>
			<div class="content rounded-md" id="dropdown-content-<?php // esc_attr_e( $id ) ?>" aria-labelledby="#dropdown-<?php esc_attr_e( $id ) ?>">

			<form method="post">
				
				<?php 

					foreach( $snapdragon->translates->get_enabled() as $lang ) :
						?>
						<button type="submit">
							<img class="pointer-events-none" src="<?php esc_attr_e( $snapdragon->translates->get_url( $lang ) ) ?>" alt="<?php esc_attr_e( 'Selected language' , 'snapdragon' )?>">
							<span><?php esc_html_e( $snapdragon->translates->get_title( $lang ) ) ?></span>
							<span>( <?php esc_html_e( $snapdragon->translates->get_code( $lang ) ) ?> )</span>
						</button>

						<?php
					endforeach;

				?>

			</form>

			</div>
		</div>
		<?php
	}
}



if ( ! function_exists( 'snapdragon_main_header_button_group_profile' ) ) {
	function snapdragon_main_header_button_group_profile() {
		$title = __( 'Login' , 'snapdragon' );
		
		if ( is_user_logged_in() ) {
			global $current_user;
			$title = $current_user->display_name;
		}

		$item = (object) [
			'ID' => 'profile',
			'title' => $title,
			'icon' => 'user',
			'btn_class' => 'gap-0.5 pr-1.5 pl-3 text-white/70 bg-primary'
		];
		echo '<p class="ml-auto">';
		

		ob_start();
		?>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, vel, ratione aut consequuntur fugiat cum repudiandae et voluptas sed rem at placeat labore quasi sequi ducimus illo soluta hic! Est?</p>

		<?php 
		$content = ob_get_contents();
		ob_end_clean();
		get_template_part( 'template-parts/components/dropdown' , 'button' , [ 'item'=>$item , 'content'=>$content ] );
		echo '</p>';
	}
}



if ( ! function_exists( 'snapdragon_main_header_button_group_wishlist' ) ) {
	function snapdragon_main_header_button_group_wishlist() {
		$item = (object) [
			'ID' => 'wishlist',
			'title' => __( 'Wishlist' , 'snapdragon' ),
			'icon' => 'wishlist',
			'btn_class' => 'gap-0.5 pr-1.5 pl-3 text-black/70 text-sm'
		];
		
		ob_start();
		?>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, at atque. Temporibus optio tempore officia magni odio nemo vero aperiam.</p>

		<?php

		$content = ob_get_contents();
		ob_end_clean();
		get_template_part( 'template-parts/components/dropdown' , 'button' , [ 'item'=>$item , 'content'=>$content ] );
	}
}



if ( ! function_exists( 'snapdragon_main_header_button_group_cart' ) ) {
	function snapdragon_main_header_button_group_cart() {
		$item = (object) [
			'ID' => 'cart',
			'title' => __( 'Cart' , 'snapdragon' ),
			'icon' => 'cart',
			'btn_class' => 'gap-0.5 pr-1.5 pl-3 text-sm bg-primary rounded-md text-white/70'
		];
		
		ob_start();
		?>

		<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos, at atque.</p>

		<?php

		$content = ob_get_contents();
		ob_end_clean();
		get_template_part( 'template-parts/components/dropdown' , 'button' , [ 'item'=>$item , 'content'=>$content ] );
	}
}



if ( ! function_exists( 'snapdragon_main_header_navmenu_toggle' ) ) {
	function snapdragon_main_header_navmenu_toggle() {
		?>
		
		<button class="group menu-toggle" id="snapdragon-navmenu-toggle">
			<span class="menu-bars">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</span>
			
			<span>
				<?php esc_html_e( 'Menu' , 'snapdragon' ) ?>	
			</span>
		</button>

		<?php
	}
}



if ( ! function_exists( 'snapdragon_main_header_navmenu_menuitems' ) ) {
	function snapdragon_main_header_navmenu_menuitems() {
		?>
		
		<nav id="main-menu">
			<ul class="nav-list">

				<?php 
					if ( !is_front_page() ) {
						get_template_part( 'template-parts/components/nav' , 'link' , [ 'item'=>(object)[
							'ID' => 'homeurl',
							'url' => home_url(),
							'title' => __( 'Kezdőlap' , 'snapdragon' ),
						] ] );
					}
				?>

				<?php 
					if( has_nav_menu('menu-1') ) :
						$menu_id = snapdragon_nav_menu_id( 'menu-1' );
						$header_menus = wp_get_nav_menu_items( $menu_id );

						if( ! empty(  $header_menus ) && is_array( $header_menus ) ) :
							foreach( $header_menus as $item ) :
								if( ! $item->menu_item_parent ) :

									$child_items = snapdragon_child_menu_items( $header_menus , $item->ID );
									$has_children = !empty(  $child_items ) && is_array( $child_items );

									if( ! $has_children ) :

										get_template_part( 'template-parts/components/nav' , 'link' , [ 'item'=>$item ] );
										
									else :
											
										get_template_part( 'template-parts/components/nav' , 'dropdown' , [ 'item'=>$item , 'children'=>$child_items ] );

									endif;    // if( ! $has_children )
								endif;    // if( ! $item->menu_item_parent )
							endforeach;   // foreach( $header_menus as $item )
						endif;   // if( ! empty(  $header_menus ) && is_array( $header_menus ) )
					endif;    // if( has_nav_menu('menu-1') )
				
				?>
			</ul>
		</nav>

		<?php
	}
}



if ( ! function_exists( 'snapdragon_main_header_before' ) ) {
	function snapdragon_main_header_before() {
		?>
		<header id="snapdragon-main-header" class="w-screen overflow-x-hidden">
			<div id="header-sections" class="w-full flex-center flex-col">
		<?php
	}
}



if ( ! function_exists( 'snapdragon_spinner_js_template' ) ) {
	function snapdragon_spinner_js_template() {
		?>
		<template id="loader-animation-template">
			<div class="spinner-animation"></div>
		</template>
		<?php
	}
}



if ( ! function_exists( 'snapdragon_main_header_after' ) ) {
	function snapdragon_main_header_after() {
		?>
				</div>
			</header>
		<?php
	}
}



if ( ! function_exists( 'snapdragon_main_header_section_brand' ) ) {
	function snapdragon_main_header_section_brand() {		
		?>
		<main class="py-6 header-section">
			<div class="section-side brand">
				
				<?php
					if ( function_exists( 'snapdragon_get_custom_logo' ) ) {
						snapdragon_get_custom_logo();
					}
				?>
				
				<h3 class="header-news-text mx-auto">
					Kérdésed van?
					<a class="font-bold text-sm cursor-pointer flex flex-nowrap items-center gap-1 transition-colors duration-200 text-white/80 no-underline" href="tel:+36 30 123 4567">	
						<svg><use xlink:href="#phone-svg-icon"/></svg>+36 30 123 4567
					</a>
				</h3>
			
			</div>
				
			<div class="section-side search justify-center">
				<?php get_search_form(); ?>
			</div>
			
			<div class="section-side buttongroup justify-end">
				<?php do_action( 'snapdragon_main_header_button_group' ); ?>
			</div>

			
		</main>

		<?php
	}
}



if ( ! function_exists( 'snapdragon_main_header_section_navigation' ) ) {
	function snapdragon_main_header_section_navigation() {
		?>

		<footer class="nav-footer">
			<div class="header-section nav">

				<?php do_action( 'snapdragon_main_header_navmenu' ) ?>

			</div>
		</footer>

		<?php
	}
}



if ( ! function_exists( 'snapdragon_custom_brand_logo' ) ) {
	function snapdragon_custom_brand_logo() {
		if( has_custom_logo() ) :
			
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

			?>
				<a class="snapdragon-site-logo" href="<?php esc_attr_e( esc_url( home_url() ) ) ?>">
					<img class="h-full" src="<?php esc_attr_e( esc_url( $image[0] ) ) ?>" alt="<?php esc_attr_e( 'Site Logo' , 'snapdragon' )?>">
				</a>
			<?php

		else :
			?>
				<h2 class="page-title">
					<?php esc_html_e( bloginfo( 'name' ) ); ?>
				</h2>
			<?php
		endif;	
	}
}



if ( ! function_exists( 'snapdragon_google_site_verification' ) ) {
	/**
	 * Inject google datas to <head> meta
	 * @since 1.0
	 */
	function snapdragon_google_site_verification() {
		
		$verification = get_option( 'snapdragon_google_verification' , [ 'meta' => 'D2qQKJUQ9kPwNYZI5PFhqoXEXd1hap1WrBz_Vv51tjk' , 'script' => 'ca-pub-4690077027254207'] );

		?>
			<meta name="google-site-verification" content="<?php esc_attr_e( $verification[ 'meta' ] )?>" />
			<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=<?php esc_attr_e( $verification[ 'script' ] )?>"
			crossorigin="anonymous"></script>
		<?php
	}
}



if ( ! function_exists( 'snapdragon_barion_code_inject' ) ) {
	/**
	 * Inject barion code to <head>
	 * @since 1.0
	 */
	function snapdragon_barion_code_inject() {

				
		if ( is_home() || is_front_page() ) {
			return;
		}

		?>
		<script>
			// Create BP element on the window
			window["bp"] = window["bp"] || function () {
				(window["bp"].q = window["bp"].q || []).push(arguments);
			};
			window["bp"].l = 1 * new Date();

			// Insert a script tag on the top of the head to load bp.js
			scriptElement = document.createElement("script");
			firstScript = document.getElementsByTagName("script")[0];
			scriptElement.async = true;
			scriptElement.src = 'https://pixel.barion.com/bp.js';
			firstScript.parentNode.insertBefore(scriptElement, firstScript);
			window['barion_pixel_id'] = '<?php esc_attr_e(get_option( 'snapdragon_barion_pixel_id' , '' ))?>';            

			// Send init event
			bp('init', 'addBarionPixelId', window['barion_pixel_id']);
		</script>

		<noscript>
			<img height="1" width="1" style="display:none" alt="Barion Pixel" src="https://pixel.barion.com/a.gif?ba_pixel_id='<?php esc_attr_e(get_option( 'snapdragon_barion_pixel_id' , '' ))?>'&ev=contentView&noscript=1">
		</noscript>
		<?php
	}
}



if ( ! function_exists( 'snapdragon_page_header' ) ) {
	/**
	 * Display the page header
	 * @since 1.0
	 */
	function snapdragon_page_header() {
		if ( is_front_page() ) {
			return;
		}

		?>
		<header class="entry-header">
			<?php

			if ( ! is_page_template( 'template-homepage.php' ) ) {
				snapdragon_post_thumbnail( 'full' );
			}

			the_title( '<h1 class="entry-title">', '</h1>' );
			?>
		</header>
		<?php
	}
}



if ( ! function_exists( 'snapdragon_page_content' ) ) {
	/**
	 * Display the post content
	 * @since 1.0
	 */
	function snapdragon_page_content() {
		?>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'snapdragon' ),
						'after'  => '</div>',
					)
				);
			?>
		</div>
		<?php
	}
}



if ( ! function_exists( 'snapdragon_display_comments' ) ) {
	/**
	 * Snapdragon display comments
	 * @since  1.0
	 */
	function snapdragon_display_comments() {
		if ( comments_open() || 0 !== intval( get_comments_number() ) ) :
			comments_template();
		endif;
	}
}



if ( ! function_exists( 'snapdragon_post_header' ) ) {
	/**
	 * Display the post header with a link to the single post
	 * @since 1.0
	 */
	function snapdragon_post_header() {
		?>
		<header class="entry-header">
		<?php

		/**
		 * Functions hooked in to snapdragon_post_header_before action.
		 *
		 * @hooked snapdragon_post_meta - 10
		 */
		do_action( 'snapdragon_post_header_before' );

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		}

		do_action( 'snapdragon_post_header_after' );
		?>
		</header>
		<?php
	}
}



if ( ! function_exists( 'snapdragon_post_meta' ) ) {
	/**
	 * Display the post meta
	 * @since 1.0
	 */
	function snapdragon_post_meta() {
		if ( 'post' !== get_post_type() ) {
			return;
		}

		// Posted on.
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$output_time_string = sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>', esc_url( get_permalink() ), $time_string );

		$posted_on = '
			<span class="posted-on">' .
			/* translators: %s: post date */
			sprintf( __( 'Posted on %s', 'snapdragon' ), $output_time_string ) .
			'</span>';

		// Author.
		$author = sprintf(
			'<span class="post-author">%1$s <a href="%2$s" class="url fn" rel="author">%3$s</a></span>',
			__( 'by', 'snapdragon' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);

		// Comments.
		$comments = '';

		if ( ! post_password_required() && ( comments_open() || 0 !== intval( get_comments_number() ) ) ) {
			$comments_number = get_comments_number_text( __( 'Leave a comment', 'snapdragon' ), __( '1 Comment', 'snapdragon' ), __( '% Comments', 'snapdragon' ) );

			$comments = sprintf(
				'<span class="post-comments">&mdash; <a href="%1$s">%2$s</a></span>',
				esc_url( get_comments_link() ),
				$comments_number
			);
		}

		echo wp_kses(
			sprintf( '%1$s %2$s %3$s', $posted_on, $author, $comments ),
			array(
				'span' => array(
					'class' => array(),
				),
				'a'    => array(
					'href'  => array(),
					'title' => array(),
					'rel'   => array(),
				),
				'time' => array(
					'datetime' => array(),
					'class'    => array(),
				),
			)
		);
	}
}



if ( ! function_exists( 'snapdragon_post_content' ) ) {
	/**
	 * Display the post content with a link to the single post
	 * @since 1.0
	 */
	function snapdragon_post_content() {
		?>
		<div class="entry-content">
		<?php

		/**
		 * Functions hooked in to snapdragon_post_content_before action.
		 *
		 * @hooked snapdragon_post_thumbnail - 10
		 */
		do_action( 'snapdragon_post_content_before' );

		the_content(
			sprintf(
				/* translators: %s: post title */
				__( 'Continue reading %s', 'snapdragon' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);

		do_action( 'snapdragon_post_content_after' );

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'snapdragon' ),
				'after'  => '</div>',
			)
		);
		?>
		</div>
		<?php
	}
}



if ( ! function_exists( 'snapdragon_post_thumbnail' ) ) {
	/**
	 * Display post thumbnail
	 *
	 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
	 * @uses has_post_thumbnail()
	 * @uses the_post_thumbnail
	 * @param string $size the post thumbnail size.
	 * @since 1.0
	 */
	function snapdragon_post_thumbnail( $size = 'full' ) {
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( $size );
		}
	}
}



if ( ! function_exists( 'snapdragon_edit_post_link' ) ) {
	/**
	 * Display the edit link
	 * @since 1.0
	 */
	function snapdragon_edit_post_link() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'snapdragon' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<div class="edit-link">',
			'</div>'
		);
	}
}



if ( ! function_exists( 'snapdragon_post_taxonomy' ) ) {
	/**
	 * Display the post taxonomies
	 * @since 1.0
	 */
	function snapdragon_post_taxonomy() {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'snapdragon' ) );

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'snapdragon' ) );
		?>

		<aside class="entry-taxonomy">
			<?php if ( $categories_list ) : ?>
			<div class="cat-links">
				<?php echo esc_html( _n( 'Category:', 'Categories:', count( get_the_category() ), 'snapdragon' ) ); ?> <?php echo wp_kses_post( $categories_list ); ?>
			</div>
			<?php endif; ?>

			<?php if ( $tags_list ) : ?>
			<div class="tags-links">
				<?php echo esc_html( _n( 'Tag:', 'Tags:', count( get_the_tags() ), 'snapdragon' ) ); ?> <?php echo wp_kses_post( $tags_list ); ?>
			</div>
			<?php endif; ?>
		</aside>

		<?php
	}
}



if ( ! function_exists( 'snapdragon_post_nav' ) ) {
	// Display navigation to next/previous post when applicable.
	function snapdragon_post_nav() {
		$args = array(
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'snapdragon' ) . ' </span>%title',
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'snapdragon' ) . ' </span>%title',
		);
		the_post_navigation( $args );
	}
}



if ( ! function_exists( 'snapdragon_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 */
	function snapdragon_paging_nav() {
		global $wp_query;

		$args = array(
			'type'      => 'list',
			'next_text' => _x( 'Next', 'Next post', 'snapdragon' ),
			'prev_text' => _x( 'Previous', 'Previous post', 'snapdragon' ),
		);

		the_posts_pagination( $args );
	}
}



if ( ! function_exists( 'snapdragon_comment' ) ) {
	/**
	 * Snapdragon comment template
	 * @param array $comment the comment array.
	 * @param array $args the comment args.
	 * @param int   $depth the comment depth.
	 * @since 1.0
	 */
	function snapdragon_comment( $comment, $args, $depth ) {
		if ( 'div' === $args['style'] ) {
			$tag       = 'div';
			$add_below = 'comment';
		} else {
			$tag       = 'li';
			$add_below = 'div-comment';
		}
		?>
		<<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-body">
		<div class="comment-meta commentmetadata">
			<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 128 ); ?>
			<?php printf( wp_kses_post( '<cite class="fn">%s</cite>', 'snapdragon' ), get_comment_author_link() ); ?>
			</div>
			<?php if ( '0' === $comment->comment_approved ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'snapdragon' ); ?></em>
				<br />
			<?php endif; ?>

			<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="comment-date">
				<?php echo '<time datetime="' . esc_attr( get_comment_date( 'c' ) ) . '">' . esc_html( get_comment_date() ) . '</time>'; ?>
			</a>
		</div>
		<?php if ( 'div' !== $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-content">
		<?php endif; ?>
		<div class="comment-text">
		<?php comment_text(); ?>
		</div>
		<div class="reply">
		<?php
		comment_reply_link(
			array_merge(
				$args,
				array(
					'add_below' => $add_below,
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
				)
			)
		);
		?>
		<?php edit_comment_link( __( 'Edit', 'snapdragon' ), '  ', '' ); ?>
		</div>
		</div>
		<?php if ( 'div' !== $args['style'] ) : ?>
		</div>
		<?php endif; ?>
		<?php
	}
}



if ( ! function_exists( 'snapdragon_preloader_animation' ) ) {
    function snapdragon_preloader_animation() { 
        ?>
        <div id="snapdragon-site-preloader" class="preloader">
            <svg class="text-primary" height="100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                <radialGradient id="a12" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)">
                    <stop offset="0" stop-color="currentColor"></stop>
                    <stop offset=".3" stop-color="currentColor" stop-opacity=".9"></stop>
                    <stop offset=".6" stop-color="currentColor" stop-opacity=".6"></stop>
                    <stop offset=".8" stop-color="currentColor" stop-opacity=".3"></stop>
                    <stop offset="1" stop-color="currentColor" stop-opacity="0"></stop>
                </radialGradient>
                <circle transform-origin="center" fill="none" stroke="url(#a12)" stroke-width="20" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70">
                    <animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="1" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform>
                </circle>
                <circle transform-origin="center" fill="none" opacity=".2" stroke="currentColor" stroke-width="20" stroke-linecap="round" cx="100" cy="100" r="70"></circle>
            </svg>
        </div> 
        <?php
    }
}



if ( ! function_exists( 'snapdragon_svg_icons' ) ) {
    function snapdragon_svg_icons() {     
        ?>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="search-svg-icon" viewBox="0 0 512 512">
                <path fill="currentColor" d="M368 208A160 160 0 1 0 48 208a160 160 0 1 0 320 0zM337.1 371.1C301.7 399.2 256.8 416 208 416C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208c0 48.8-16.8 93.7-44.9 129.1L505 471c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L337.1 371.1z"></path>
            </symbol>
            <symbol id="close-svg-icon" viewBox="0 0 448 512">
                <path fill="currentColor" d="M41 39C31.6 29.7 16.4 29.7 7 39S-2.3 63.6 7 73l183 183L7 439c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l183-183L407 473c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-183-183L441 73c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-183 183L41 39z"></path>
            </symbol>
            <symbol id="user-svg-icon" viewBox="0 0 448 512">
                <path fill="currentColor" d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"></path>
            </symbol>
            <symbol id="wishlist-svg-icon" viewBox="0 0 512 512">
                <path fill="currentColor" d="M225.8 468.2l-2.5-2.3L48.1 303.2C17.4 274.7 0 234.7 0 192.8v-3.3c0-70.4 50-130.8 119.2-144C158.6 37.9 198.9 47 231 69.6c9 6.4 17.4 13.8 25 22.3c4.2-4.8 8.7-9.2 13.5-13.3c3.7-3.2 7.5-6.2 11.5-9c0 0 0 0 0 0C313.1 47 353.4 37.9 392.8 45.4C462 58.6 512 119.1 512 189.5v3.3c0 41.9-17.4 81.9-48.1 110.4L288.7 465.9l-2.5 2.3c-8.2 7.6-19 11.9-30.2 11.9s-22-4.2-30.2-11.9zM239.1 145c-.4-.3-.7-.7-1-1.1l-17.8-20c0 0-.1-.1-.1-.1c0 0 0 0 0 0c-23.1-25.9-58-37.7-92-31.2C81.6 101.5 48 142.1 48 189.5v3.3c0 28.5 11.9 55.8 32.8 75.2L256 430.7 431.2 268c20.9-19.4 32.8-46.7 32.8-75.2v-3.3c0-47.3-33.6-88-80.1-96.9c-34-6.5-69 5.4-92 31.2c0 0 0 0-.1 .1s0 0-.1 .1l-17.8 20c-.3 .4-.7 .7-1 1.1c-4.5 4.5-10.6 7-16.9 7s-12.4-2.5-16.9-7z"></path>
            </symbol>
            <symbol id="cart-svg-icon" viewBox="0 0 576 512">
                <path fill="currentColor" d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48H69.5c3.8 0 7.1 2.7 7.9 6.5l51.6 271c6.5 34 36.2 58.5 70.7 58.5H488c13.3 0 24-10.7 24-24s-10.7-24-24-24H199.7c-11.5 0-21.4-8.2-23.6-19.5L170.7 288H459.2c32.6 0 61.1-21.8 69.5-53.3l41-152.3C576.6 57 557.4 32 531.1 32h-411C111 12.8 91.6 0 69.5 0H24zM131.1 80H520.7L482.4 222.2c-2.8 10.5-12.3 17.8-23.2 17.8H161.6L131.1 80zM176 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm336-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"></path>
            </symbol>
            <symbol id="mail-svg-icon" viewBox="0 0 512 512">
                <path fill="currentColor" d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"></path>
            </symbol>
            <symbol id="phone-svg-icon" viewBox="0 0 512 512">
                <path fill="currentColor" d="M280 0C408.1 0 512 103.9 512 232c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-101.6-82.4-184-184-184c-13.3 0-24-10.7-24-24s10.7-24 24-24zm8 192a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm-32-72c0-13.3 10.7-24 24-24c75.1 0 136 60.9 136 136c0 13.3-10.7 24-24 24s-24-10.7-24-24c0-48.6-39.4-88-88-88c-13.3 0-24-10.7-24-24zm73 166.7c11.3-13.8 30.3-18.5 46.7-11.4l112 48c17.6 7.5 27.4 26.5 23.4 45.1l-24 112c-4 18.4-20.3 31.6-39.1 31.6l0 0c-6.1 0-12.2-.1-18.2-.4l-.1 0 0 0c-10-.4-19.8-1.1-29.6-2.2C175.2 485.6 0 295.2 0 64v0C0 45.1 13.2 28.8 31.6 24.9l112-24c18.7-4 37.6 5.8 45.1 23.4l48 112c7 16.4 2.4 35.4-11.4 46.7l-40.6 33.2c26.7 46 65.1 84.4 111.1 111.1L329 286.7zm133.8 78.1l-100.4-43L333 357.6c-14.9 18.2-40.8 22.9-61.2 11.1c-53.3-30.9-97.7-75.3-128.6-128.6c-11.8-20.4-7.1-46.3 11.1-61.2l35.9-29.4-43-100.4L48.1 70.5C51.5 286.2 225.8 460.5 441.5 464l21.3-99.2z"></path>
            </symbol>
            <symbol id="gps-svg-icon" viewBox="0 0 384 512">
                <path fill="currentColor" d="M336 192c0-79.5-64.5-144-144-144S48 112.5 48 192c0 12.4 4.5 31.6 15.3 57.2c10.5 24.8 25.4 52.2 42.5 79.9c28.5 46.2 61.5 90.8 86.2 122.6c24.8-31.8 57.8-76.4 86.2-122.6c17.1-27.7 32-55.1 42.5-79.9C331.5 223.6 336 204.4 336 192zm48 0c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192zm-160 0a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm-112 0a80 80 0 1 1 160 0 80 80 0 1 1 -160 0z"></path>
            </symbol>
            <symbol id="home-svg-icon" viewBox="0 0 576 512">
                <path fill="currentColor" d="M570.24 247.41L512 199.52V104a8 8 0 0 0-8-8h-32a8 8 0 0 0-7.95 7.88v56.22L323.87 45a56.06 56.06 0 0 0-71.74 0L5.76 247.41a16 16 0 0 0-2 22.54L14 282.25a16 16 0 0 0 22.53 2L64 261.69V448a32.09 32.09 0 0 0 32 32h128a32.09 32.09 0 0 0 32-32V344h64v104a32.09 32.09 0 0 0 32 32h128a32.07 32.07 0 0 0 32-31.76V261.67l27.53 22.62a16 16 0 0 0 22.53-2L572.29 270a16 16 0 0 0-2.05-22.59zM463.85 432H368V328a32.09 32.09 0 0 0-32-32h-96a32.09 32.09 0 0 0-32 32v104h-96V222.27L288 77.65l176 144.56z"></path>
            </symbol>  
            <symbol id="arrow-svg-icon" viewBox="0 0 20 20">
                <path fill="currentColor" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
            </symbol> 
        </svg>
        <?php
    }
}