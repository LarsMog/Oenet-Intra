<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Intra
 * @author     Webitall Aps <home@webitall.dk>
 * @copyright  2017 Webitall Aps
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Intra', JPATH_COMPONENT);
JLoader::register('IntraController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Intra');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
