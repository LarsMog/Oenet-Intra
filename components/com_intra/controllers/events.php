<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Larsmog_events
 * @author     Webitall Aps <home@webitall.dk>
 * @copyright  2016 Webitall Aps
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Events list controller class.
 *
 * @since  1.6
 */
class IntraControllerEvents extends Larsmog_eventsController
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional
	 * @param   array   $config  Configuration array for model. Optional
	 *
	 * @return object	The model
	 *
	 * @since	1.6
	 */
	public function &getModel($name = 'Events', $prefix = 'IntraModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}
}
