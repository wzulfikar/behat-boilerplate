<?php

/**
 * get title and desc from given string
 * 
 * - what in title is only receipt and index of item, no total item
 * - separate multiple item with .
 *
 * @param  string $string 
 * @return array          ['title'=>'bdr1231', 'desc'=>'majalengka']
 */
function parseTitleDesc($string){
	// replace whitespace + . with . only
	// eg. from "bdr23 .3 .3" to "bdr23.3.3"
	$string = preg_replace('/\s+\./', '.', $string);

	// extract match of title & desc from string
	preg_match("/(?'title'\D{1,}(\d|\.){1,})\s?(?'desc'\D+)?/", $string, $title_desc);
	
	// if no match found, die.
	if(!$title_desc) 
		die('No title match from ' . $string);
	
	$title = trim($title_desc['title']);
	$desc  = isset($title_desc['desc']) ? trim($title_desc['desc']) : '';

	// if title contains only 1 item, return 
	// else, continue to extract items from title
	if(count(explode('.', $title)) < 2)
		return [compact('title', 'desc')];

	$explode_title = explode('.', $title);
	$title = array_shift($explode_title);
	$items = $explode_title;
	
	// purge $receipts
	$receipts = [];
	foreach($items as $item){
		$receipts[] = ['title'=>$title . '.' . $item, 'desc'=>$desc];
	}

	return $receipts;
}