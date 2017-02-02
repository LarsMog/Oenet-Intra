<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>
<div class="row">
	<h1 style="text-align: center">Log på</h1>
</div>

<div class="row">
	<div class="col-md-7">
		<div class="panel panel-default">
			<div class="panel-heading"><h3 style="text-align: center">Indtast brugernavn og adgangskode</h3></div>
			<div class="panel-body">
				<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" class="form-validate form-horizontal">
						<br>

						<?php foreach ($this->form->getFieldset('credentials') as $field) : ?>
							<?php if (!$field->hidden) : ?>
								<div class="form-group">
									<div class="col-sm-3 control-label"><?php echo $field->label; ?></div>
									<div class="col-sm-9">
										<?php $field->__set('class', $field->getAttribute('class').' form-control'); ?>
										<?php echo $field->input; ?>
									</div>
								</div>

							<?php endif; ?>
						<?php endforeach; ?>

						<?php if ($this->tfa): ?>
							<div class="control-group">
								<div class="control-label">
									<?php echo $this->form->getField('secretkey')->label; ?>
								</div>
								<div class="controls">
									<?php echo $this->form->getField('secretkey')->input; ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
							<div class="form-group">
								<div class="col-sm-3 control-label"><label><?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME') ?></label></div>
								<div class="col-sm-9"><input id="remember" type="checkbox" name="remember" class="orm-control" value="yes" style="-ms-transform: scale(2); -moz-transform: scale(2); -webkit-transform: scale(2);-o-transform: scale(2); margin-top: 10px; margin-left:5px"/></div>
							</div>
						<?php endif; ?>

						<div class="form-group">
							<div class="col-sm-3 control-label"> </div>
							<div class="col-sm-9">
								<button type="submit" class="btn btn-primary btn-block">
									<?php echo JText::_('JLOGIN'); ?>
								</button>
							</div>
						</div>

						<?php if ($this->params->get('login_redirect_url')) : ?>
							<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return'))); ?>" />
						<?php else : ?>
							<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_menuitem', $this->form->getValue('return'))); ?>" />
						<?php endif; ?>
						<?php echo JHtml::_('form.token'); ?>
					</fieldset>
				</form>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading"><h3 style="text-align: center">Muligheder</h3></div>
			<div class="panel-body">
				<ul class="nav nav-tabs nav-stacked">
					<li>
						<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
							<?php echo JText::_('COM_USERS_LOGIN_RESET'); ?></a>
					</li>
					<li>
						<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
							<?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?></a>
					</li>
					<?php
					$usersConfig = JComponentHelper::getParams('com_users');
					if ($usersConfig->get('allowUserRegistration')) : ?>
						<li>
							<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
								<?php echo JText::_('COM_USERS_LOGIN_REGISTER'); ?></a>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>

	</div>

	<div class="col-md-7">
		<div class="panel panel-default"  style="margin-right:12px;">
		<div class="panel-heading"><h3 style="text-align: center">Information</h3></div>
			<div class="panel-body">
			</div>
		</div>
	</div>

</div>

<div class="login<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	</div>
	<?php endif; ?>

	<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
	<div class="login-description">
	<?php endif; ?>

		<?php if ($this->params->get('logindescription_show') == 1) : ?>
			<?php echo $this->params->get('login_description'); ?>
		<?php endif; ?>

		<?php if (($this->params->get('login_image') != '')) :?>
			<img src="<?php echo $this->escape($this->params->get('login_image')); ?>" class="login-image" alt="<?php echo JText::_('COM_USERS_LOGIN_IMAGE_ALT')?>"/>
		<?php endif; ?>

	<?php if (($this->params->get('logindescription_show') == 1 && str_replace(' ', '', $this->params->get('login_description')) != '') || $this->params->get('login_image') != '') : ?>
	</div>
	<?php endif; ?>


</div>
<div>

</div>
