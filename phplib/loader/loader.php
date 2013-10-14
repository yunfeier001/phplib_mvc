<?php
/**
 * phplib\loader\loader.php
 * php加载器
 *
 * @copyright	(c) 2013-2099 All Rights Reserved
 * @author		jellycheng <42282367@qq.com>
 * @created		2013-10-14
 * @version		$Id$
 */
namespace phplib\loader;

class loader{

		const NS_SEPARATOR = '\\';
		public static $namespaces = array();
	
		public static function register($autoload_function) {
			spl_autoload_register($autoload_function);
		}

		public static function autoload($classname) {
			$_name = explode(self::NS_SEPARATOR, $classname, 2);
			$_k = $_name[0] . self::NS_SEPARATOR;
			if(!empty(self::$namespaces[$_k]) && !empty($_name[1])) {
				$_path = self::$namespaces[$_k] . str_replace('\\', '/', $_name[1]) . '.php';
				//echo $_path;
				if(file_exists($_path)) {
					include $path;
				}
			}
			
			if(!class_exists($classname, false)) {
				if(function_exists('__autoload')) {
					__autoload($classname);
				} else if(function_exists('app_custom_autoload')) {
					\app_custom_autoload($classname);
				}
			}
		}

		public static function clear() {
			$funcs = spl_autoload_functions();
			if(!empty($funcs)) {
				foreach($funcs as $f) {
					spl_autoload_unregister($f);
				}
			}
		}
		
		/**
		 * 注册命名空间对应的目录
		 * <code>
		 * \phplib\loader\loader::registerNamespace('appcom', __DIR__);
		 * </code>
		 *
		 * @param  string $namespace
		 * @param  string $directory
		 */
		public static function registerNamespace($namespace, $directory) {
			$namespace = rtrim($namespace, self::NS_SEPARATOR) . self::NS_SEPARATOR;
			self::$namespaces[$namespace] = self::normalizeDirectory($directory);
		}

		/**
		 * 标准化目录
		 *
		 * @param  string $directory
		 * @return string
		 */
		public static function normalizeDirectory($directory) {
			$last = $directory[strlen($directory) - 1];
			if (in_array($last, array('/', '\\'))) {
				$directory[strlen($directory) - 1] = DIRECTORY_SEPARATOR;
				return $directory;
			}
			$directory .= DIRECTORY_SEPARATOR;
			return $directory;
		}

}

\phplib\loader\loader::register(__NAMESPACE__ . '\loader::autoload');
if(class_exists('\\phplib\\phplib', false)) {
	\phplib\loader\loader::registerNamespace('phplib', \phplib\phplib::getPhplibPath());
}
