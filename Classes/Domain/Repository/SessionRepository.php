<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Guenter Sommer <sommer@agentur-milchmaedchen.de>
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package promoshop
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Promoshop_Domain_Repository_SessionRepository extends Tx_Extbase_Persistence_Repository {
 
	/**
	 * The session handler
	 * @var Tx_Promoshop_Domain_Session_SessionHandler
	 */
	protected $sessionHandler = NULL;
 
	public function __construct() {
		\TYPO3\CMS\Core\Utility\DebugUtility::debug($sessionHandler, 'Remove Escort Object');
		//parent::__construct();
		// get an instance of the session handler
		//$this->sessionHandler = t3lib_div::makeInstance('Tx_Promoshop_Domain_Session_SessionHandler');
	}
 
	/**
	 * Returns the token stored in the users PHP session
	 * @return string The token
	 */
	public function findBySession() {
		return $this->sessionHandler->restoreFromSession();
	}
 
	/**
	 * Writes the token into the PHP session
	 * @return string 
	 */
	public function writeToSession($token) {
		$this->sessionHandler->writeToSession($token);
		return $this;
	}
 
	/**
	 * Cleans up the session: removes the stored object from the PHP session
	 * @return	string
	 */
	public function cleanUpSession() {
		$this->sessionHandler->cleanUpSession();
		return $this;
	}
}

?>