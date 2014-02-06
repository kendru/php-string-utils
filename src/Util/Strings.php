<?php
namespace Kendru\Util;

class Strings
{
	/**
	 * Increment a string, assuming a standard alphabetical collation
	 *
	 * @param string $str
	 * @return string
	 */
	public static function increment($str)
	{
		return self::incrementRecursive($str, $str);
	}

	/**
	 * We need to keep track of the original string in the case that
	 * the input string is empty or made up entirely of "z" and/or " "
	 *
	 * @param string $str      String to increment
	 * @param string $original Original input string
	 */
	private static function incrementRecursive($str, $original)
	{
		if (empty($str)) {
			return $original . 'a';
		}

		$lastChar = $str[strlen($str) - 1];

		if ($lastChar === 'z' || $lastChar === ' ') {
			return self::incrementRecursive(substr($str, 0, strlen($str) - 1), $original);
		}

		return substr($str, 0, strlen($str) - 1) . ++$lastChar;
	}	
}
