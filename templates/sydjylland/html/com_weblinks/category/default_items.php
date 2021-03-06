<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_weblinks
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

JHtml::_('behavior.framework');

// Create a shortcut for params.
$params = &$this->item->params;
// Get the user object.
$user = JFactory::getUser();
// Check if user is allowed to add/edit based on weblinks permissinos.
$canEdit = $user->authorise('core.edit', 'com_weblinks.category.'.$this->category->id);
$canCreate = $user->authorise('core.create', 'com_weblinks');
$canEditState = $user->authorise('core.edit.state', 'com_weblinks');

$n = count($this->items);
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));


usort($this->items, function ($a, $b)
{
    return strcmp($a->title, $b->title);
});
?>
<div class="pad20">
<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_WEBLINKS_NO_WEBLINKS'); ?></p>
<?php else : ?>

	<?php if ($this->params->get('filter_field') != 'hide' || $this->params->get('show_pagination_limit')) :?>
	<?php endif; ?>

			<?php foreach ($this->items as $i => $item) : ?>
				<?php if (in_array($item->access, $this->user->getAuthorisedViewLevels())) : ?>
					<?php if ($this->items[$i]->state == 0) : ?>
						<div class="system-unpublished cat-list-row<?php echo $i % 2; ?>">
					<?php else: ?>
						<div class="cat-list-row<?php echo $i % 2; ?>" >
					<?php endif; ?>
					<?php if ($this->params->get('show_link_hits', 1)) : ?>
						<span class="list-hits badge badge-info pull-right">
							<?php echo JText::sprintf('JGLOBAL_HITS_COUNT', $item->hits); ?>
						</span>
					<?php endif; ?>

					<?php if ($canEdit) : ?>
						<span class="list-edit pull-left width-50">
							<?php echo JHtml::_('icon.edit', $item, $params); ?>
						</span>
					<?php endif; ?>

					<div class="list-title clearfix">
						<?php if ($this->params->get('icons', 1) == 0) : ?>
							<?php echo $this->escape($item->title); ?>
							<?php if ($item->description) : ?>
								<br /><div style="">
									<i><?php echo JHtml::_('content.prepare', $item->description, '', 'com_weblinks.categories'); ?></i>
								</div>
							<?php endif; ?>
						<?php elseif ($this->params->get('icons', 1) == 1) : ?>
							<?php if (!$this->params->get('link_icons')) : ?>
								<?php echo JHtml::_('image', 'system/weblink.png', JText::_('COM_WEBLINKS_LINK'), null, true); ?>
							<?php else: ?>
								<?php echo '<img src="'.$this->params->get('link_icons').'" alt="'.JText::_('COM_WEBLINKS_LINK').'" />'; ?>
							<?php endif; ?>
						<?php endif; ?>
						<?php
							// Compute the correct link
							$menuclass = 'category'.$this->pageclass_sfx;
							$link = $item->link;
							$width	= $item->params->get('width');
							$height	= $item->params->get('height');
							if ($width == null || $height == null)
							{
								$width	= 600;
								$height	= 500;
							}
							if ($this->items[$i]->state == 0) : ?>
								<span class="label label-warning">Unpublished</span>
							<?php endif; ?>

							<?php switch ($item->params->get('target', $this->params->get('target')))
							{
								case 1:
									// open in a new window
									echo '<a href="'. $link .'" target="_blank" class="'. $menuclass .'" rel="nofollow">'.
										$link .'</a>';
									break;

								case 2:
									// open in a popup window
									$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width='.$this->escape($width).',height='.$this->escape($height).'';
									echo "<a href=\"$link\" onclick=\"window.open(this.href, 'targetWindow', '".$attribs."'); return false;\">".
										$this->escape($item->title).'</a>';
									break;
								case 3:
									// open in a modal window
									JHtml::_('behavior.modal', 'a.modal');
									echo '<a class="modal" href="'.$link.'"  rel="{handler: \'iframe\', size: {x:'.$this->escape($width).', y:'.$this->escape($height).'}}">'.
										$this->escape($item->title). ' </a>';
									break;

								default:
									// open in parent window
									echo '<a href="'.  $link . '" class="'. $menuclass .'" rel="nofollow">'.
										$link . ' </a>';
									break;
							}
						?>
						</div>
						<?php $tagsData = $item->tags->getItemTags('com_weblinks.weblink', $item->id); ?>
						<?php if ($this->params->get('show_tags', 1)) : ?>
							<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
							<?php echo $this->item->tagLayout->render($tagsData); ?>
						<?php endif; ?>

						<?php if (($this->params->get('show_link_description')) and ($item->description != '')) : ?>
						<?php $images = json_decode($item->images); ?>
						<?php  if (isset($images->image_first) and !empty($images->image_first)) : ?>
						<?php $imgfloat = (empty($images->float_first)) ? $this->params->get('float_first') : $images->float_first; ?>
						<div class="img-intro-<?php echo htmlspecialchars($imgfloat); ?>"> <img
							<?php if ($images->image_first_caption):
								echo 'class="caption"'.' title="' .htmlspecialchars($images->image_first_caption) .'"';
							endif; ?>
							src="<?php echo htmlspecialchars($images->image_first); ?>" alt="<?php echo htmlspecialchars($images->image_first_alt); ?>"/> </div>
						<?php endif; ?>
						<?php  if (isset($images->image_second) and !empty($images->image_second)) : ?>
						<?php $imgfloat = (empty($images->float_second)) ? $this->params->get('float_second') : $images->float_second; ?>
						<div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image"> <img
						<?php if ($images->image_second_caption):
							echo 'class="caption"'.' title="' .htmlspecialchars($images->image_second_caption) .'"';
						endif; ?>
						src="<?php echo htmlspecialchars($images->image_second); ?>" alt="<?php echo htmlspecialchars($images->image_second_alt); ?>"/> </div>
						<?php endif; ?>

						<?php echo $item->description; ?>
						<?php endif; ?>

						</div>
				<?php endif;?>
			<?php endforeach; ?>

		<?php // Code to add a link to submit a weblink. ?>
		<?php /* if ($canCreate) : // TODO This is not working due to some problem in the router, I think. Ref issue #23685 ?>
			<?php echo JHtml::_('icon.create', $item, $item->params); ?>
		<?php  endif; */ ?>
		<?php if ($this->params->get('show_pagination')) : ?>
		 <div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="counter">
					<?php echo $this->pagination->getPagesCounter(); ?>
				</p>
			<?php endif; ?>
				<?php echo $this->pagination->getPagesLinks(); ?>
			</div>
		<?php endif; ?>
<?php endif; ?>
</div>