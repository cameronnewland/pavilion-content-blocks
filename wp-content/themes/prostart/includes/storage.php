<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage PROSTART
 * @since PROSTART 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('prostart_storage_get')) {
	function prostart_storage_get($var_name, $default='') {
		global $PROSTART_STORAGE;
		return isset($PROSTART_STORAGE[$var_name]) ? $PROSTART_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('prostart_storage_set')) {
	function prostart_storage_set($var_name, $value) {
		global $PROSTART_STORAGE;
		$PROSTART_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('prostart_storage_empty')) {
	function prostart_storage_empty($var_name, $key='', $key2='') {
		global $PROSTART_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($PROSTART_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($PROSTART_STORAGE[$var_name][$key]);
		else
			return empty($PROSTART_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('prostart_storage_isset')) {
	function prostart_storage_isset($var_name, $key='', $key2='') {
		global $PROSTART_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($PROSTART_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($PROSTART_STORAGE[$var_name][$key]);
		else
			return isset($PROSTART_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('prostart_storage_inc')) {
	function prostart_storage_inc($var_name, $value=1) {
		global $PROSTART_STORAGE;
		if (empty($PROSTART_STORAGE[$var_name])) $PROSTART_STORAGE[$var_name] = 0;
		$PROSTART_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('prostart_storage_concat')) {
	function prostart_storage_concat($var_name, $value) {
		global $PROSTART_STORAGE;
		if (empty($PROSTART_STORAGE[$var_name])) $PROSTART_STORAGE[$var_name] = '';
		$PROSTART_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('prostart_storage_get_array')) {
	function prostart_storage_get_array($var_name, $key, $key2='', $default='') {
		global $PROSTART_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($PROSTART_STORAGE[$var_name][$key]) ? $PROSTART_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($PROSTART_STORAGE[$var_name][$key][$key2]) ? $PROSTART_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('prostart_storage_set_array')) {
	function prostart_storage_set_array($var_name, $key, $value) {
		global $PROSTART_STORAGE;
		if (!isset($PROSTART_STORAGE[$var_name])) $PROSTART_STORAGE[$var_name] = array();
		if ($key==='')
			$PROSTART_STORAGE[$var_name][] = $value;
		else
			$PROSTART_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('prostart_storage_set_array2')) {
	function prostart_storage_set_array2($var_name, $key, $key2, $value) {
		global $PROSTART_STORAGE;
		if (!isset($PROSTART_STORAGE[$var_name])) $PROSTART_STORAGE[$var_name] = array();
		if (!isset($PROSTART_STORAGE[$var_name][$key])) $PROSTART_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$PROSTART_STORAGE[$var_name][$key][] = $value;
		else
			$PROSTART_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('prostart_storage_merge_array')) {
	function prostart_storage_merge_array($var_name, $key, $value) {
		global $PROSTART_STORAGE;
		if (!isset($PROSTART_STORAGE[$var_name])) $PROSTART_STORAGE[$var_name] = array();
		if ($key==='')
			$PROSTART_STORAGE[$var_name] = array_merge($PROSTART_STORAGE[$var_name], $value);
		else
			$PROSTART_STORAGE[$var_name][$key] = array_merge($PROSTART_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('prostart_storage_set_array_after')) {
	function prostart_storage_set_array_after($var_name, $after, $key, $value='') {
		global $PROSTART_STORAGE;
		if (!isset($PROSTART_STORAGE[$var_name])) $PROSTART_STORAGE[$var_name] = array();
		if (is_array($key))
			prostart_array_insert_after($PROSTART_STORAGE[$var_name], $after, $key);
		else
			prostart_array_insert_after($PROSTART_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('prostart_storage_set_array_before')) {
	function prostart_storage_set_array_before($var_name, $before, $key, $value='') {
		global $PROSTART_STORAGE;
		if (!isset($PROSTART_STORAGE[$var_name])) $PROSTART_STORAGE[$var_name] = array();
		if (is_array($key))
			prostart_array_insert_before($PROSTART_STORAGE[$var_name], $before, $key);
		else
			prostart_array_insert_before($PROSTART_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('prostart_storage_push_array')) {
	function prostart_storage_push_array($var_name, $key, $value) {
		global $PROSTART_STORAGE;
		if (!isset($PROSTART_STORAGE[$var_name])) $PROSTART_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($PROSTART_STORAGE[$var_name], $value);
		else {
			if (!isset($PROSTART_STORAGE[$var_name][$key])) $PROSTART_STORAGE[$var_name][$key] = array();
			array_push($PROSTART_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('prostart_storage_pop_array')) {
	function prostart_storage_pop_array($var_name, $key='', $defa='') {
		global $PROSTART_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($PROSTART_STORAGE[$var_name]) && is_array($PROSTART_STORAGE[$var_name]) && count($PROSTART_STORAGE[$var_name]) > 0) 
				$rez = array_pop($PROSTART_STORAGE[$var_name]);
		} else {
			if (isset($PROSTART_STORAGE[$var_name][$key]) && is_array($PROSTART_STORAGE[$var_name][$key]) && count($PROSTART_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($PROSTART_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('prostart_storage_inc_array')) {
	function prostart_storage_inc_array($var_name, $key, $value=1) {
		global $PROSTART_STORAGE;
		if (!isset($PROSTART_STORAGE[$var_name])) $PROSTART_STORAGE[$var_name] = array();
		if (empty($PROSTART_STORAGE[$var_name][$key])) $PROSTART_STORAGE[$var_name][$key] = 0;
		$PROSTART_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('prostart_storage_concat_array')) {
	function prostart_storage_concat_array($var_name, $key, $value) {
		global $PROSTART_STORAGE;
		if (!isset($PROSTART_STORAGE[$var_name])) $PROSTART_STORAGE[$var_name] = array();
		if (empty($PROSTART_STORAGE[$var_name][$key])) $PROSTART_STORAGE[$var_name][$key] = '';
		$PROSTART_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('prostart_storage_call_obj_method')) {
	function prostart_storage_call_obj_method($var_name, $method, $param=null) {
		global $PROSTART_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($PROSTART_STORAGE[$var_name]) ? $PROSTART_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($PROSTART_STORAGE[$var_name]) ? $PROSTART_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('prostart_storage_get_obj_property')) {
	function prostart_storage_get_obj_property($var_name, $prop, $default='') {
		global $PROSTART_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($PROSTART_STORAGE[$var_name]->$prop) ? $PROSTART_STORAGE[$var_name]->$prop : $default;
	}
}
?>