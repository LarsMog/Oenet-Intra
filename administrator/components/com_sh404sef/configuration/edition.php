<?php
/**
 * sh404SEF - SEO extension for Joomla!
 *
 * @author      Yannick Gaultier
 * @copyright   (c) Yannick Gaultier - Weeblr llc - 2016
 * @package     sh404SEF
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     4.8.0.3423
 * @date		2016-08-25
 */
class Sh404sefConfigurationEdition
{
	public static $id = 'full';
	public static $name = '';

	public static function is($edition)
	{
		return $edition == self::id;
	}
}
