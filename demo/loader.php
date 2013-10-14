<?php
/**
 * demo\loader.php
 * 
 *
 * @copyright	(c) 2013-2099 All Rights Reserved
 * @author		jellycheng <42282367@qq.com>
 * @created		2013-10-14
 * @version		$Id$
 */
require '../phplib/_init.php';
require_once '../phplib/loader/loader.php';

/**
#自定义加载器
function app_custom_autoload($cls) {
	echo $cls . __FILE__;
}
*/

new \phplib\a\ab();