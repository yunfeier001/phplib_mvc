<?php
/**
 * phplib\util\util.php
 * 
 *
 * @copyright	(c) 2013-2099 All Rights Reserved
 * @author		jellycheng <42282367@qq.com>
 * @created		2013-10-14
 * @version		$Id$
 */
namespace phplib\util;

function getgpc($k, $t='R') {
	switch($t) {
		case 'P': $var = &$_POST; break;
		case 'G': $var = &$_GET; break;
		case 'C': $var = &$_COOKIE; break;
		case 'R': $var = &$_REQUEST; break;
	}
	return isset($var[$k]) ? (is_array($var[$k]) ? $var[$k] : trim($var[$k])) : '';
}

