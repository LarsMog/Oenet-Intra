<?php
/**
 * @version    CVS: 1.0.0
 * @package    COM_INTRA
 * @author     Webitall Aps <home@webitall.dk>
 * @copyright  2016 Webitall Aps
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_intra');

if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_intra'))
{
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>


<div class="row">

    <h1 style="text-align: center"><?php echo $this->item->name; ?></h1>

	<div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">Information</div>

            <table class="table">
                <tbody><tr>
                    <td style="text-align: center;" <b=""><i class="fa fa-calendar"></i> </td>
                    <td><b><?php echo JHTML::Date($this->item->date, 'l \d\e\n j\. F Y', true); ?></b></td>
                </tr>
                <tr>
                    <td style="text-align: center;" <b=""><i class="fa fa-clock-o"></i> </td>
                    <td><b><?php echo $this->item->time_start;?>
                            <?php if( strlen( $this->item->time_end ) > 0 ) : ?>
                        - <?php echo  $this->item->time_end; ?>
	                    <?php endif; ?></b>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center;"><b><i class="fa fa-map-marker"></i> </b></td>
                    <td></td>
                </tr>
                </tbody></table>
        </div>

    </div>

    <div class="col-md-7 col-md-offset-1 well">

    </div>

    <table class="table">
		

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_MODIFIED_BY'); ?></th>
			<td><?php echo $this->item->modified_by_name; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_NAME'); ?></th>
			<td><?php echo $this->item->name; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_DATE'); ?></th>
			<td><?php echo $this->item->date; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_TIME_START'); ?></th>
			<td><?php echo $this->item->time_start; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_TIME_END'); ?></th>
			<td><?php echo $this->item->time_end; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_PLACE'); ?></th>
			<td><?php echo $this->item->place; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_DESCRIPTION'); ?></th>
			<td><?php echo $this->item->description; ?></td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_FILE'); ?></th>
			<td>
			<?php if( $this->item->file ) : ?>
                <a href="/files/<?php echo $this->item->file;?>" target="_blank"><?php echo substr($this->item->file,strpos($this->item->file,'_')+1);?></a>
			<?php endif; ?>

		</td>
		</tr>

		<tr>
			<th><?php echo JText::_('COM_INTRA_FORM_LBL_EVENT_PARTICIPANTS'); ?></th>
			<td><?php echo $this->item->participants; ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_intra&task=event.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_INTRA_EDIT_ITEM"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_intra.event.'.$this->item->id)) : ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_intra&task=event.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_INTRA_DELETE_ITEM"); ?></a>

<?php endif; ?>