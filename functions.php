<?php

define("DIR", get_template_directory_uri());

function add_theme_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', DIR . '/assets/bootstrap/css/bootstrap.min.css');
	// wp_enqueue_style( 'slick', DIR . '/assets/slick/slick.css');
	// wp_enqueue_style( 'slick-theme', DIR . '/assets/slick/slick-theme.css');
	// wp_enqueue_style( 'font-awesome4', DIR . '/assets/font-awesome/css/font-awesome.min.css');
	// wp_enqueue_script( 'font-awesome5', 'https://use.fontawesome.com/releases/v5.0.8/js/all.js');

	wp_enqueue_script( 'bootstrap-js', DIR . '/assets/bootstrap/js/bootstrap.min.js', array ( 'jquery' ));
	// wp_enqueue_script( 'slick-js', DIR . '/assets/slick/slick.min.js', array ( 'jquery' ));
	wp_enqueue_script( 'theme-js', DIR . '/assets/js/theme.js', array ( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_theme_support( 'post-thumbnails' );

require_once('wp_bootstrap_navwalker.php');

/**
 *
 * Paginação utilizando a função paginate_links
 * @param  WP_Query $query Contém uma $query customizada
 *
 */
function wp_pagination( $query=null, $wpcpn_posts=null )
{
    global $wp_query;
    $query = $query ? $query : $wp_query;
    $big = 999999999;
    $max_num_pages = $query->max_num_pages;

    $paginate = paginate_links(
        array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'type'      => 'array',
            'total'     => $max_num_pages,
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var('paged') ),
            'prev_text' => __('&laquo;'),
            'next_text' => __('&raquo;'),
        )
    );
    if ( $max_num_pages > 1 && $paginate ) {
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination justify-content-center">';
        foreach ( $paginate as $page ) {
		$active = strpos($page, 'current') !== false ? 'active' : '';
		$page = str_replace('span', 'a', $page);
		$page = str_replace('page-numbers', 'page-link', $page);
		$page = str_replace('current', '', $page);

		echo '<li class="page-item '. $active .'">' . $page . '</li>';
        }
        echo '</ul>';
        echo '</nav>';
    }
}

function the_title_max_charlength($charlength, $end_str = '[...]') {
	$title = get_the_title();
	$charlength++;

	if ( mb_strlen( $title ) > $charlength ) {
		$subex = mb_substr( $title, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo $end_str;
	} else {
		echo $title;
	}
}

function the_excerpt_max_charlength($charlength, $end_str = '[...]') {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo $end_str;
	} else {
		echo $excerpt;
	}
}

function limit_words($string, $word_limit) {
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}

?>
