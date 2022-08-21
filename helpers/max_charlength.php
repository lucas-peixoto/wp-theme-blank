<?php

function the_title_max_charlength( int $charlength, $end_str = '[...]' ) {
	$title = get_the_title();
	max_charlenghth( $charlength, $title, $end_str );
}

function the_excerpt_max_charlength( int $charlength, $end_str = '[...]' ) {
	$excerpt = get_the_excerpt();
	max_charlenghth( $charlength, $excerpt, $end_str );
}

/**
 * @param int $charlength
 * @param string $text
 * @param string $end_str
 *
 * @return void
 */
function max_charlenghth( int $charlength, string $text, string $end_str ) {
	$charlength ++;

	if ( mb_strlen( $text ) > $charlength ) {
		$subex   = mb_substr( $text, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut   = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo $end_str;
	} else {
		echo $text;
	}
}

function limit_words( $string, $word_limit ): string {
	$words = explode( " ", $string );

	return implode( " ", array_splice( $words, 0, $word_limit ) );
}