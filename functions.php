<?php

define( "DIR", get_template_directory_uri() );

function add_theme_scripts() {
	wp_enqueue_style( 'slick', DIR . '/assets/slick/slick.css' );
	wp_enqueue_style( 'slick-theme', DIR . '/assets/slick/slick-theme.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_script( 'slick-js', DIR . '/assets/slick/slick.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'theme-js', DIR . '/assets/js/theme.js', array( 'jquery' ) );
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_theme_support( 'post-thumbnails' );
add_post_type_support( 'page', 'excerpt' );

require_once( 'helpers/wp_bootstrap_navwalker.php' );
require_once( 'helpers/max_charlength.php' );
require_once( 'helpers/custom_post_types.php' );

function get_post_id( $post = null ) {
	if ( is_null( $post ) ) {
		return get_the_ID();
	}

	return $post->ID;
}

function create_page( $page_name ) {
	$check_page_exist = get_page_by_title( $page_name, 'OBJECT' );

	if ( empty( $check_page_exist ) ) {
		return wp_insert_post(
			array(
				'comment_status' => 'close',
				'ping_status'    => 'close',
				'post_author'    => 1,
				'post_title'     => $page_name,
				'post_name'      => sanitize_title( $page_name ),
				'post_status'    => 'publish',
				'post_content'   => '',
				'post_type'      => 'page',
			)
		);
	}

	return 0;
}

function get_breadcrumb( string $separator = "&nbsp;>&nbsp;" ) {
	echo '<a href="' . home_url() . '" rel="nofollow">Home</a>';
	if ( is_category() || is_single() ) {
		echo $separator;
		the_category( $separator );
		if ( is_single() ) {
			echo $separator;
			the_title();
		}
	} elseif ( is_page() ) {
		echo $separator;
		echo the_title();
	} elseif ( is_search() ) {
		echo "{$separator}Busca por... ";
		echo '"<em>' . the_search_query() . '</em>"';
	}
}

function get_gallery( $post, $full_attachment = true ) {
	if ( ! $full_attachment ) {
		return get_post_gallery_images( $post );
	}

	$gallery = get_post_gallery( $post, false );

	if ( ! $gallery ) {
		return [];
	}

	$gids = explode( ",", $gallery['ids'] );

	$images = [];

	foreach ( $gids as $id ) {
		$attachment = get_post( $id );

		$images[] = [
			'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption'     => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href'        => get_permalink( $attachment->ID ),
			'src'         => $attachment->guid,
			'srcset'      => wp_get_attachment_image_srcset( $attachment->ID ),
			'title'       => $attachment->post_title
		];
	}

	return $images;
}

function wp_pagination( WP_Query $query = null ) {
	global $wp_query;

	$query         = $query ?: $wp_query;
	$big           = 999999999;
	$max_num_pages = $query->max_num_pages;

	$paginate = paginate_links(
		array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'type'      => 'array',
			'total'     => $max_num_pages,
			'format'    => '?paged=%#%',
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'prev_text' => '',
			'next_text' => '',
		)
	);

	if ( $max_num_pages > 1 && $paginate ) {
		echo '<nav>';
		echo '<ul class="pagination justify-content-center">';
		foreach ( $paginate as $page ) {
			$active = strpos( $page, 'current' ) !== false ? 'active' : '';
			$page   = str_replace( 'span', 'a', $page );
			//$page = str_replace('page-numbers', 'page-link', $page);
			$page = str_replace( 'current', '', $page );

			echo '<li class="pagination-item ' . $active . '">' . $page . '</li>';
		}
		echo '</ul>';
		echo '</nav>';
	}
}