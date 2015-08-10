<?php

/**
 * Simplifies the built-in strpos function for improved redability inside actual production code
 * 
 * @param  string $needle    String to serach for
 * @param  string $haystack  String to be searched in
 * @return boolean           Returns true if the strpos function finds the needle in the haystack
 */
function contains($needle, $haystack) 
{
	return strpos($haystack, $needle) !== false;
}

/**
 * Filters an array and returns the values which match the requested value at runtime
 * Similar to built-in array_filter but for any array (any dimension)
 * 
 * @param  array $array Multidimensional 
 * @param  [type] $index Array dimension level
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
function filter_by_value($array, $index, $value)
{
	if (is_array($array) && count($array) > 0) {
		foreach (array_keys($array) as $key) {
			$temp[$key] = $array[$key][$index];

			if ($temp[$key] == $value) {
				return $resultingArray[$key] = $array[$key];
			}
		}
	}
	return false;
}

/**
 * Expands the built-in print_r function to better increase readiblity once rendered
 * 
 * @param variable $var 
 * @return void
 */
function print_var($var) 
{
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

/**
 * Runs the built-in htmlspecialchars function on arrays
 * Credit: http://jvk-codex.blogspot.ca/2009/05/php-htmlspecialchars-on-array.html
 * @param  [type] &$input [description]
 * @return [type]         [description]
 */
function array_htmlspecialchars(&$input) {
	if (is_array($input)) {
		foreach ($input as $key => $value) {
			if (is_array($value)) {
				$input[$key] = array_htmlspecialchars($value);
			} else {
				$input[$key] = htmlspecialchars($value);
			}
		}
		return $input;
	}
	return htmlspecialchars($input);
}










function echobr($string) {
	echo "<br>";
	echo $string;
}





?>