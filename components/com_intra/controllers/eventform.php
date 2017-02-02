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

/**
 * Event controller class.
 *
 * @since  1.6
 */
class IntraControllerEventForm extends JControllerForm
{
	/**
	 * Method to check out an item for editing and redirect to the edit form.
	 *
	 * @return void
	 *
	 * @since    1.6
	 */
	public function edit($key = NULL, $urlVar = NULL)
	{
		$app = JFactory::getApplication();

		// Get the previous edit id (if any) and the current edit id.
		$previousId = (int) $app->getUserState('com_intra.edit.event.id');
		$editId     = $app->input->getInt('id', 0);

		// Set the user id for the user to edit in the session.
		$app->setUserState('com_intra.edit.event.id', $editId);

		// Get the model.
		$model = $this->getModel('EventForm', 'IntraModel');

		// Check out the item
		if ($editId)
		{
			$model->checkout($editId);
		}

		// Check in the previous user.
		if ($previousId)
		{
			$model->checkin($previousId);
		}

		// Redirect to the edit screen.
		$this->setRedirect(JRoute::_('index.php?option=com_intra&view=eventform&layout=edit', false));
	}

	/**
	 * Method to save a user's profile data.
	 *
	 * @return void
	 *
	 * @throws Exception
	 * @since  1.6
	 */
	public function save($key = NULL, $urlVar = NULL)
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app   = JFactory::getApplication();
		$model = $this->getModel('EventForm', 'IntraModel');

		// Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');

		//dato
		if( strpos($data['date'],'-')==2 ) {
			$date = substr($data['date'],-4).'-'.substr($data['date'],3,2).'-'.substr($data['date'],0,2);
			$data['date'] = $date;
		}
		$data['participants'] = implode(',',$data['participants']);

		// filer
		$files = JFactory::getApplication()->input->files->get('jform');
		//echo '<pre>';
		//var_dump( $files );
		if( strlen($files['file'][0]['name']) > 3 AND strlen($files['file'][0]['type'])>2 )
		{
			$path = JPATH_ROOT . '/files';
			$files['file'][0]['name'] = str_replace(' ','',JFile::makeSafe($files['file'][0]['name']));
			$filename = time().'_'.$files['file'][0]['name'];
			$filepath = JPath::clean($path . '/' .$filename);
			JFile::upload($files['file'][0]['tmp_name'], $filepath);
			chmod($filepath, 0775);
			$data['file'] = $filename;
			//echo $filename;
		}
		//var_dump( $data );
		//exit;
		// Validate the posted data.
		$form = $model->getForm();

		if (!$form)
		{
			throw new Exception($model->getError(), 500);
		}

		// Validate the posted data.
		$data = $model->validate($form, $data);

		// Check for errors.
		if ($data === false)
		{
			// Get the validation messages.
			$errors = $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
			{
				if ($errors[$i] instanceof Exception)
				{
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				}
				else
				{
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			$input = $app->input;
			$jform = $input->get('jform', array(), 'ARRAY');

			// Save the data in the session.
			$app->setUserState('com_intra.edit.event.data', $jform);

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_intra.edit.event.id');
			$this->setRedirect(JRoute::_('index.php?option=com_intra&view=eventform&layout=edit&id=' . $id, false));
		}

		// Attempt to save the data.
		$return = $model->save($data);

		// Check for errors.
		if ($return === false)
		{
			// Save the data in the session.
			$app->setUserState('com_intra.edit.event.data', $data);

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_intra.edit.event.id');
			$this->setMessage(JText::sprintf('Save failed', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_intra&view=eventform&layout=edit&id=' . $id, false));
		}

		// Check in the profile.
		if ($return)
		{
			$model->checkin($return);
		}

		// Clear the profile id from the session.
		$app->setUserState('com_intra.edit.event.id', null);

		// Redirect to the list screen.
		$this->setMessage(JText::_('COM_INTRA_ITEM_SAVED_SUCCESSFULLY'));
		$menu = JFactory::getApplication()->getMenu();
		$item = $menu->getActive();
		$url  = (empty($item->link) ? 'index.php?option=com_intra&view=events' : $item->link);
		$this->setRedirect(JRoute::_($url, false));

		// Flush the data from the session.
		$app->setUserState('com_intra.edit.event.data', null);
	}

	/**
	 * Method to abort current operation
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function cancel($key = NULL)
	{
		$app = JFactory::getApplication();

		// Get the current edit id.
		$editId = (int) $app->getUserState('com_intra.edit.event.id');

		// Get the model.
		$model = $this->getModel('EventForm', 'IntraModel');

		// Check in the item
		if ($editId)
		{
			$model->checkin($editId);
		}

		$menu = JFactory::getApplication()->getMenu();
		$item = $menu->getActive();
		$url  = (empty($item->link) ? 'index.php?option=com_intra&view=events' : $item->link);
		$this->setRedirect(JRoute::_($url, false));
	}

	/**
	 * Method to remove data
	 *
	 * @return void
	 *
	 * @throws Exception
     *
     * @since 1.6
	 */
	public function remove()
    {
        $app   = JFactory::getApplication();
        $model = $this->getModel('EventForm', 'IntraModel');
        $pk    = $app->input->getInt('id');

        // Attempt to save the data
        try
        {
            $return = $model->delete($pk);

            // Check in the profile
            $model->checkin($return);

            // Clear the profile id from the session.
            $app->setUserState('com_intra.edit.event.id', null);

            $menu = $app->getMenu();
            $item = $menu->getActive();
            $url = (empty($item->link) ? 'index.php?option=com_intra&view=events' : $item->link);

            // Redirect to the list screen
            $this->setMessage(JText::_('COM_EXAMPLE_ITEM_DELETED_SUCCESSFULLY'));
            $this->setRedirect(JRoute::_($url, false));

            // Flush the data from the session.
            $app->setUserState('com_intra.edit.event.data', null);
        }
        catch (Exception $e)
        {
            $errorType = ($e->getCode() == '404') ? 'error' : 'warning';
            $this->setMessage($e->getMessage(), $errorType);
            $this->setRedirect('index.php?option=com_intra&view=events');
        }
    }
}
