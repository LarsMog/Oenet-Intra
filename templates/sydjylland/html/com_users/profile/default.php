<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="profile <?php echo $this->pageclass_sfx?>">

<div class="page-header">
	<h1>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h1>
</div>

<?php if (JFactory::getUser()->id == $this->data->id) : ?>
<ul class="btn-toolbar pull-right">
	<li class="btn-group">
		<a class="btn btn-primary" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id='.(int) $this->data->id);?>">
			<span class="icon-user"></span> <?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?></a>
	</li>
</ul>
<?php endif; ?>

<?php echo $this->loadTemplate('core'); ?>

<?php echo $this->loadTemplate('params'); ?>

<?php echo $this->loadTemplate('custom'); ?>

    <fieldset id="users-profile-core">
        <legend>
            <?php echo JText::_('Medlemsdata'); ?>
        </legend>

        <?php
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from('#__webitall_memberdues_members')
            ->where('user_id='.(int)JFactory::getUser()->id);
        $db->setQuery($query);
        $member = $db->loadObject();
        ?>

        <dl class="dl-horizontal">
            <dt>Navn</dt>
            <dd><?php echo $member->name; ?></dd>

            <dt>Titel</dt>
            <dd><?php echo $member->title; ?></dd>

            <dt>Afdeling</dt>
            <dd><?php echo $member->department; ?></dd>

            <dt>Adresse</dt>
            <dd><?php echo $member->address_l1; ?></dd>

            <dt> </dt>
            <dd><?php echo $member->address; ?></dd>

            <dt>Postnr.</dt>
            <dd><?php echo $member->zip; ?></dd>

            <dt>By</dt>
            <dd><?php echo $member->city; ?></dd>

            <dt>Telefon</dt>
            <dd><?php echo $member->phone; ?></dd>

            <dt>Mobil</dt>
            <dd><?php echo $member->mobile; ?></dd>

            <dt>Faktura-email</dt>
            <dd><?php echo $member->email; ?></dd>
        </dl>
    </fieldset>
</div>
