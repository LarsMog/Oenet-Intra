<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$images = json_decode($item->images);
$item_heading = $params->get('item_heading', 'h4');
?>
<?php if ($params->get('item_title')) : ?>

	<<?php echo $item_heading; ?> class="newsflash-title<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php if ($params->get('link_titles') && $item->link != '') : ?>
		<a href="<?php echo $item->link;?>">
			<?php echo $item->title;?></a>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>
	</<?php echo $item_heading; ?>>

<?php endif; ?>
<a href="<?php echo $item->link;?>"><img src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/></a>
<?php if (!$params->get('intro_only')) :
	echo $item->afterDisplayTitle;
endif; ?>

<?php echo $item->beforeDisplayContent; ?>
<div class="pad20">
	<?php
	$cut = false;
	$parts = preg_split('/([\s\n\r]+)/', $item->introtext, null, PREG_SPLIT_DELIM_CAPTURE);
	$parts_count = count($parts);
	$length = 0;
	$last_part = 0;
	for (; $last_part < $parts_count; ++$last_part) {
		$length += strlen($parts[$last_part]);
		if ($length > 200) {
			$cut = true;
			break;
		}
	}
	echo implode(array_slice($parts, 0, $last_part));
	if( $cut ) {
		echo '...';
		echo '<a class="readmore pull-right" href="'.$item->link.'">'.JText::_('COM_CONTENT_FEED_READMORE').'</a>';
	}
	?>


</div>
<div style="clear:both;"></div>