<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Larsmog_events
 * @author     Webitall Aps <home@webitall.dk>
 * @copyright  2016 Webitall Aps
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_intra', JPATH_SITE);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/media/com_intra/js/form.js');

$user    = JFactory::getUser();
$canEdit = IntraFrontemdHelpersIntra::canUserEdit($this->item, $user);

JFactory::getDocument()->addScript('/templates/sydjylland/js/bootstrap-datepicker.js');
JFactory::getDocument()->addScript('/templates/sydjylland/js/bootstrap-datepicker.da.min.js');
JFactory::getDocument()->addStyleSheet('/templates/sydjylland/css/bootstrap-datepicker3.css');


?>

<div class="row event-edit front-end-edit">
	<?php if (!$canEdit) : ?>
		<h3>
			Du har ikke tilladelse til at redigere.
		</h3>
	<?php else : ?>
		<?php if (!empty($this->item->id)): ?>
			<h1>Edit <?php echo $this->item->id; ?></h1>
		<?php else: ?>
			<h1 style="text-align: center">Tilføj ny begivenhed</h1>
		<?php endif; ?>

		<form id="form-event"
		      action="<?php echo JRoute::_('index.php?option=com_intra&task=event.save'); ?>"
		      method="post" class="form-validate form-horizontal" enctype="multipart/form-data">

			<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>"/>
			<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>"/>
			<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>"/>
			<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>"/>
			<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>"/>

			<?php echo $this->form->getInput('created_by'); ?>
			<?php echo $this->form->getInput('modified_by'); ?>

			<div class="form-group">
				<div class="col-sm-4 control-label"><?php echo $this->form->getLabel('name'); ?></div>
				<div class="col-sm-9">
					<?php echo $this->form->getInput('name'); ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-4 control-label"><?php echo $this->form->getLabel('date'); ?></div>
				<div class="col-sm-9">
					<div class="input-group date" data-provide="datepicker" data-date-format="dd-mm-yyyy"
					     data-date-week-start="1" data-date-language="da">

						<div class="input-group-addon">
							<span class="glyphicon glyphicon-calendar"></span>
						</div>
						<input id="date" type="text" class="form-control" name="jform[date]" value="<?php echo date('d-m-Y', strtotime($this->item->date)); ?>">
						<div class="input-group-addon">
							<span class="glyphicon glyphicon-th"></span>
						</div>
						<!--<input type="hidden" id="start_date" name="jform[new_date]" value="<?php echo date('d-m-Y', strtotime($match->match_date)); ?>"/>-->
					</div>
				</div>
			</div>


			<!--<div class="form-group">
				<div class="col-sm-4 control-label"><?php echo $this->form->getLabel('date'); ?></div>
				<div class="col-sm-9">
					<?php echo $this->form->getInput('date'); ?>
				</div>
			</div>-->

			<div class="form-group">
				<div class="col-sm-4 control-label">Tidspunkt</div>
				<div class="col-sm-9">
					<?php echo $this->form->getInput('time_start'); ?> - <?php echo $this->form->getInput('time_end'); ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-4 control-label"><?php echo $this->form->getLabel('place'); ?></div>
				<div class="col-sm-9">
					<?php echo $this->form->getInput('place'); ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-4 control-label"><?php echo $this->form->getLabel('description'); ?></div>
				<div class="col-sm-9">
					<?php echo $this->form->getInput('description'); ?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-4 control-label"><?php echo $this->form->getLabel('file'); ?></div>
				<div class="col-sm-9">
					<?php echo $this->form->getInput('file'); ?>
				</div>
			</div>


			<?php if (!empty($this->item->file)) :
				foreach ((array) $this->item->file as $singleFile) :
					if (!is_array($singleFile)) :
						echo '<a href="' . JRoute::_(JUri::root() . '/' . DIRECTORY_SEPARATOR . $singleFile, false) . '">' . $singleFile . '</a> ';
					endif;
				endforeach;
			endif; ?>
			<input type="hidden" name="jform[file_hidden]" id="jform_file_hidden" value="<?php echo str_replace('Array,', '', implode(',', (array) $this->item->file)); ?>"/>


			<div class="form-group">
				<div class="col-sm-4 control-label"><?php echo $this->form->getLabel('participants'); ?></div>
				<div class="col-sm-9">
					<?php echo $this->form->getInput('participants'); ?>
				</div>
			</div>


			<div class="form-group">
				<div class="col-sm-4 control-label">
					<a class="btn" href="<?php echo JRoute::_('index.php?option=com_intra&task=eventform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>">
						<?php echo JText::_('JCANCEL'); ?>
					</a>
				</div>
				<div class="col-sm-9">

					<?php if ($this->canSave): ?>
						<button type="submit" class="validate btn btn-primary btn-lg btn-block">
							Gem begivenhed
						</button>
					<?php endif; ?>

				</div>
			</div>

			<input type="hidden" name="option" value="com_intra"/>
			<input type="hidden" name="task" value="eventform.save"/>
			<?php echo JHtml::_('form.token'); ?>
		</form>
	<?php endif; ?>
</div>
