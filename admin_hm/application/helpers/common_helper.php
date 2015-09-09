<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CCH
 */

/**
* Returns variable or default value
* @access	public
* @param	mixed
* @return	mixed
*/
if(!function_exists('my_echo'))
{
	function my_echo(&$variable, $default_echo = '')
	{
		if(isset($variable) and $variable != '') return $variable;
		else return $default_echo;
	}
}