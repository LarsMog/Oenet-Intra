<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//load user_profile plugin language
$lang = JFactory::getLanguage();
$lang->load('plg_user_profile', JPATH_ADMINISTRATOR);
?>
<div class="profile-edit<?php echo $this->pageclass_sfx?>">
<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	</div>
<?php endif; ?>

<script type="text/javascript">
	Joomla.twoFactorMethodChange = function(e)
	{
		var selectedPane = 'com_users_twofactor_' + jQuery('#jform_twofactor_method').val();

		jQuery.each(jQuery('#com_users_twofactor_forms_container>div'), function(i, el) {
			if (el.id != selectedPane)
			{
				jQuery('#' + el.id).hide(0);
			}
			else
			{
				jQuery('#' + el.id).show(0);
			}
		});
	}
</script>

<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
<?php foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
	<?php $fields = $this->form->getFieldset($group);?>
	<?php if (count($fields)):?>
	<fieldset>
		<?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
		<legend><?php echo JText::_($fieldset->label); ?></legend>
		<?php endif;?>
		<?php foreach ($fields as $field):// Iterate through the fields in the set and display them.?>
			<?php if ($field->hidden):// If the field is hidden, just display the input.?>
                <div class="form-group">
					<div class="controls">
						<?php echo $field->input;?>
					</div>
				</div>
			<?php else:?>
                <div class="form-group">

                        <label class="col-sm-4 control-label"><?php echo $field->label; ?>

                            <?php if (!$field->required && $field->type != 'Spacer') : ?>
                            <span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
                            <?php endif; ?>
                        </label>


                    <div class="col-sm-7">
                        <?php $field->__set('class', $field->getAttribute('class').' form-control'); ?>
						<?php echo $field->input; ?>
					</div>
				</div>
			<?php endif;?>
		<?php endforeach;?>
	</fieldset>
	<?php endif;?>
<?php endforeach;?>

<?php if (count($this->twofactormethods) > 1): ?>
	<fieldset>
		<legend><?php echo JText::_('COM_USERS_PROFILE_TWO_FACTOR_AUTH') ?></legend>

		<div class="control-group">
			<div class="control-label">
				<label id="jform_twofactor_method-lbl" for="jform_twofactor_method" class="hasTooltip"
					   title="<strong><?php echo JText::_('COM_USERS_PROFILE_TWOFACTOR_LABEL') ?></strong><br/><?php echo JText::_('COM_USERS_PROFILE_TWOFACTOR_DESC') ?>">
					<?php echo JText::_('COM_USERS_PROFILE_TWOFACTOR_LABEL'); ?>
				</label>
			</div>
			<div class="controls">
				<?php echo JHtml::_('select.genericlist', $this->twofactormethods, 'jform[twofactor][method]', array('onchange' => 'Joomla.twoFactorMethodChange()'), 'value', 'text', $this->otpConfig->method, 'jform_twofactor_method', false) ?>
			</div>
		</div>
		<div id="com_users_twofactor_forms_container">
			<?php foreach($this->twofactorform as $form): ?>
			<?php $style = $form['method'] == $this->otpConfig->method ? 'display: block' : 'display: none'; ?>
			<div id="com_users_twofactor_<?php echo $form['method'] ?>" style="<?php echo $style; ?>">
				<?php echo $form['form'] ?>
			</div>
			<?php endforeach; ?>
		</div>
	</fieldset>

	<fieldset>
		<legend>
			<?php echo JText::_('COM_USERS_PROFILE_OTEPS') ?>
		</legend>
		<div class="alert alert-info">
			<?php echo JText::_('COM_USERS_PROFILE_OTEPS_DESC') ?>
		</div>
		<?php if (empty($this->otpConfig->otep)): ?>
		<div class="alert alert-warning">
			<?php echo JText::_('COM_USERS_PROFILE_OTEPS_WAIT_DESC') ?>
		</div>
		<?php else: ?>
		<?php foreach ($this->otpConfig->otep as $otep): ?>
		<span class="span3">
			<?php echo substr($otep, 0, 4) ?>-<?php echo substr($otep, 4, 4) ?>-<?php echo substr($otep, 8, 4) ?>-<?php echo substr($otep, 12, 4) ?>
		</span>
		<?php endforeach; ?>
		<div class="clearfix"></div>
		<?php endif; ?>
	</fieldset>
<?php endif; ?>

    <div class="form-group">

        <label class="col-sm-4 control-label">  </label>


        <div class="col-sm-7">
			<button type="submit" class="btn btn-primary validate"><span><?php echo JText::_('Gem stamdata'); ?></span></button>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="profile.save" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
    </div>
	</form>
</div>



<legend>Redigér medlemsdata</legend>
<?php
    $db = JFactory::getDbo();
    $query = $db->getQuery(true)
        ->select('*')
        ->from('#__webitall_memberdues_members')
        ->where('user_id='.(int)JFactory::getUser()->id);
    $db->setQuery($query);
    $member = $db->loadObject();
?>

<form action="<?php echo JRoute::_('index.php?option=com_webitall_memberdues&task=member.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-4 control-label">Navn</label>
        <div class="col-sm-7">
            <input id="jform_name" class="form-control" type="text" size="30" value="<?php echo $member->name; ?>" name="jform[name]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Titel</label>
        <div class="col-sm-7">
            <input id="jform_title" class="form-control" type="text" size="30" value="<?php echo $member->title; ?>" name="jform[title]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Afdeling</label>
        <div class="col-sm-7">
            <input id="jform_department" class="form-control" type="text" size="30" value="<?php echo $member->department; ?>" name="jform[department]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Adresse</label>
        <div class="col-sm-7">
            <input id="jform_address_l1" class="form-control" type="text" size="30" value="<?php echo $member->address_l1; ?>" name="jform[address_l1]"><br/>
            <input id="jform_address" class="form-control" type="text" size="30" value="<?php echo $member->address; ?>" name="jform[address]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Postnr</label>
        <div class="col-sm-7">
            <input id="jform_zip" class="form-control" type="text" size="30" value="<?php echo $member->zip; ?>" name="jform[zip]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">By</label>
        <div class="col-sm-7">
            <input id="jform_city" class="form-control" type="text" size="30" value="<?php echo $member->city; ?>" name="jform[city]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Telefon</label>
        <div class="col-sm-7">
            <input id="jform_phone" class="form-control" type="text" size="30" value="<?php echo $member->phone; ?>" name="jform[phone]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Mobil</label>
        <div class="col-sm-7">
            <input id="jform_mobile" class="form-control" type="text" size="30" value="<?php echo $member->mobile; ?>" name="jform[mobile]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">Faktura-email</label>
        <div class="col-sm-7">
            <input id="jform_email" class="form-control" type="text" size="30" value="<?php echo $member->email; ?>" name="jform[email]">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">  </label>
        <div class="col-sm-7">
            <input type="hidden" name="jform[id]" value="<?php echo $member->id; ?>">
            <button type="submit" class="btn btn-primary validate"><span><?php echo JText::_('Gem medlemsdata'); ?></span></button>
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
</form>