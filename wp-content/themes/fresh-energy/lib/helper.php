<?php

// for PHP 5.2 servers
function get_date_diff($now, $then) { 
    
    $now = date_format($now, 'U');
    $then = date_format($then, 'U');

    $spread = $now - $then;

    $diff = array(
    	'y' => floor($spread / (60 * 60 * 24 * 365)),
    	'm' => floor($spread / (60 * 60 * 24 * 365 / 12)), // average-ish
    	'd' => floor($spread / (60 * 60 * 24)),
    	'h' => floor($spread / (60 * 60)),
    	'i' => floor($spread / 60),
    	's' => $spread
  	);

    return $diff;

} 

// Create human readable time a la Twitter
function relative_time($time){	

	$now = gmdate("D F d H:i:s O Y");

	$now = new DateTime($now);
	$then = new DateTime($time);

	$diff = get_date_diff($now, $then);
	
	// easier to work with
	$years = $diff['y'];
	$months = $diff['m'];
	$days = $diff['d'];
	$hours = $diff['h'];
	$minutes = $diff['i'];
	$seconds = $diff['s'];


	if( $years > 0 || $months > 0 || $days > 0 ){
		return date("M j", strtotime($time));
	}
	
	if( $hours > 0){
		return $hours . "h";
	}

	if( $minutes > 0){
		return $minutes . "m";
	}

	return $seconds . "s";

}
// Make URls, hashtags, and @mentions clickable in raw tweet text
function add_links($tweet) {

	$text = $tweet->text;

	// easier to work with
	$entities = $tweet->entities;
	$hastags = $entities->hashtags;
	$urls = $entities->urls;
	$mentions = $entities->user_mentions;
	$symbols = $entities->symbols;

	// plain text? bail early
	if( !$hastags && !$symbols && !$urls && !$mentions ){
		return $text;
	}
	
	if( $hastags ){
		foreach ($hastags as $hashtag) {
			$text = str_replace('#'.$hashtag->text, '<a href="https://twitter.com/search?q=%23'.$hashtag->text.'" target="_blank">#'.$hashtag->text.'</a>', $text);
		}
	}

	if( $urls ){
		foreach ($urls as $url) {
			$text = str_replace($url->url, '<a href="'.$url->url.'" target="_blank">'.$url->url.'</a>', $text);
		}
	}

	if( $mentions ){
		foreach ($mentions as $mention) {
			$text = str_replace('@'.$mention->screen_name, '<a href="https://twitter.com/'.$mention->screen_name.'" target="_blank">@'.$mention->screen_name.'</a>', $text);
		}
	}

	return $text;

}
