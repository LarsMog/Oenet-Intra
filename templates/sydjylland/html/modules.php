<?php
/*------------------------------------------------------------------------
# author    Webitall ApS
# copyright Copyright © 2013 webitall. All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.webitall.dk
-------------------------------------------------------------------------*/

defined('_JEXEC') or die;

?>

<?php function modChrome_raw($module, &$params, &$attribs) { ?>

	<?php echo $module->content; ?>

<?php } ?>

<?php function modChrome_extended($module, &$params, &$attribs) { ?>

	<?php $moduleTag = $params->get('module_tag', 'div'); ?>
	<?php $headerClass = $params->get('header_class'); ?>
	<?php $headerTag = htmlspecialchars($params->get('header_tag', 'h3')); ?>
	<?php $bootstrapSize = (int)$params->get('bootstrap_size', 0); ?>
	<?php $moduleClass = $bootstrapSize != 0 ? ' col-md-' . $bootstrapSize : ''; ?>

	<<?php echo $moduleTag; ?> class="module<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?><?php echo $moduleClass; ?>">

		<?php if($module->showtitle) : ?>
			<<?php echo $headerTag; ?> <?php if($headerClass): ?>class="<?php echo $headerClass; ?>" <?php endif;?> >
				<?php echo $module->title; ?>
			</<?php echo $headerTag; ?>>
		<?php endif; ?>

		<?php echo $module->content; ?>

	</<?php echo $moduleTag; ?>>

<?php } ?>

<?php function modChrome_doafront($module, &$params, &$attribs) { ?>

	<?php $moduleTag = $params->get('module_tag', 'div'); ?>
	<?php $headerClass = $params->get('header_class'); ?>
	<?php $headerTag = htmlspecialchars($params->get('header_tag', 'h3')); ?>
	<?php $bootstrapSize = (int)$params->get('bootstrap_size', 0); ?>
	<?php $moduleClass = $bootstrapSize != 0 ? ' col-md-' . $bootstrapSize : ''; ?>

	<<?php echo $moduleTag; ?> class="front<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?><?php echo $moduleClass; ?>">

		<?php if($module->showtitle) : ?>
			<<?php echo $headerTag; ?> <?php if($headerClass): ?>class="<?php echo $headerClass; ?>" <?php endif;?> >
				<?php echo $module->title; ?>
			</<?php echo $headerTag; ?>>
		<?php endif; ?>

		<?php echo $module->content; ?>

	</<?php echo $moduleTag; ?>>

<?php } ?>