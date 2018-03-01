<?php

define("DIR", get_template_directory_uri());

function add_theme_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', TEMPLATE_DIRECTORY . '/assets/bootstrap/css/bootstrap.min.css');
	// wp_enqueue_style( 'slick', TEMPLATE_DIRECTORY . '/assets/slick/slick.css');
	// wp_enqueue_style( 'slick-theme', TEMPLATE_DIRECTORY . '/assets/slick/slick-theme.css');
	// wp_enqueue_style( 'font-awesome', TEMPLATE_DIRECTORY . '/assets/font-awesome/css/font-awesome.min.css');

	wp_enqueue_script( 'bootstrap-js', TEMPLATE_DIRECTORY . '/assets/bootstrap/js/bootstrap.min.js', array ( 'jquery' ));
	// wp_enqueue_script( 'slick-js', TEMPLATE_DIRECTORY . '/assets/slick/slick.min.js', array ( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_theme_support( 'post-thumbnails' );

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
        echo '<ul class="pagination">';
        foreach ( $paginate as $page ) {
            echo '<li class="page-item">' . $page . '</li>';
        }
        echo '</ul>';
        echo '</nav>';
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
