<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Intra
 * @author     Webitall Aps <home@webitall.dk>
 * @copyright  2017 Webitall Aps
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Departments controller class.
 *
 * @since  1.6
 */
class IntraControllerDepartments extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'departmentss';
		parent::__construct();
	}
}
