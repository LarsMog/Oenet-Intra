<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.framework');

?>
<?php if (empty($this->items)) : ?>
	<p> <?php echo JText::_('COM_CONTACT_NO_ARTICLES'); ?>	 </p>
<?php else : ?>

		<div class="category list-striped">

			<?php foreach ($this->items as $i => $item) : ?>

				<?php if (in_array($item->access, $this->user->getAuthorisedViewLevels())) : ?>
                                <div class="row person">
					<div class="col-md-6">
							<div class="clearfix">
                                                            <b><?php echo $item->country; ?></b><br />
                                                           <?php if ($this->params->get('show_position_headings')) : ?><?php echo $item->con_position; ?><br />
							<?php endif; ?>
                                                         <?php echo $item->name; ?>
							</div>
							
						<?php if ($item->email_to == TRUE) : ?>
							<div class="clearfix">
								<a class="mailto" href="mailto:<?php echo $item->email_to; ?>"><?php echo $item->email_to; ?></a>
							</div>
                                                    <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php if ($this->params->get('show_mobile_headings') AND !empty ($item->mobile)) : ?>
								<div class="clearfix">
									<?php echo JTEXT::sprintf('COM_CONTACT_MOBILE_NUMBER', $item->mobile); ?>
								</div>
							<?php endif; ?>
                                                        <?php echo nl2br($item->address); ?>
							<?php if ($this->params->get('show_telephone_headings') AND !empty($item->telephone)) : ?>
								<div class="clearfix">
									Tlf. <?php echo $item->telephone; ?>
								</div>
							<?php endif; ?>
				<?php endif; ?>
				</div>                                        </div>
			<?php endforeach; ?>


<?php endif; ?>
