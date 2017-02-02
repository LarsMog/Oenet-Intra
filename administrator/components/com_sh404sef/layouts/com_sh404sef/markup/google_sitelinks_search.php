<?php
/**
 * sh404SEF - SEO extension for Joomla!
 *
 * @author      Yannick Gaultier
 * @copyright   (c) Yannick Gaultier - Weeblr llc - 2016
 * @package     sh404SEF
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     4.8.0.3423
 * @date        2016-08-25
 */

/**
 * Input:
 *
 * $displayData['url']
 * $displayData['target']
 */
// Security check to ensure this file is being included by a parent file.
if (!defined('_JEXEC')) die('Direct Access to this location is not allowed.');
?>
<!-- Google sitelinks search markup-->
<script type="application/ld+json">
<?php echo json_encode($displayData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>

</script>
<!-- End of Google sitelinks search markup-->
