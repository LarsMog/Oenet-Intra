<?php
/**
 * sh404SEF - SEO extension for Joomla!
 *
 * @author       Yannick Gaultier
 * @copyright    (c) Yannick Gaultier - Weeblr llc - 2016
 * @package      sh404SEF
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version      4.8.0.3423
 * @date        2016-08-25
 */

/**
 * Input:
 *
 * $displayData['languageTag']
 *
 */
// Security check to ensure this file is being included by a parent file.
if (!defined('_JEXEC'))
{
	die('Direct Access to this location is not allowed.');
}
?>
<!-- Facebook SDK -->
<div id='fb-root'></div>
<script>(function (d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s);
		js.id = id;
		js.src = "//connect.facebook.net/<?php echo $displayData['languageTag']; ?>/sdk.js#xfbml=1&version=v2.7&appId=<?php echo $displayData['appId']; ?>";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
<!-- End of Facebook SDK -->
