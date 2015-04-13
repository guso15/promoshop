<?php
namespace Guso\Promoshop\Domain\Session;

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
 * Session handler
 *
 * @package promoshop
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 **/
class SessionHandler implements \TYPO3\CMS\Core\SingletonInterface {
 
	/**
	 * Returns the object stored in the users PHP session
	 * @return Object the stored object
	 */
	public function restoreFromSession() {
		$sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses', 'tx_promoshop_pi1');
		return unserialize($sessionData);
	}
 
	/**
	 * Writes an object into the PHP session
	 * @param	$object	any serializable object to store into the session
	 * @return	Guso\Promoshop\Domain\Session\SessionHandler this
	 */
	public function writeToSession($object) {
		$sessionData = serialize($object);
		$GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_promoshop_pi1', $sessionData);
		$GLOBALS['TSFE']->fe_user->storeSessionData();
		return $this;
	}
 
	/**
	 * Cleans up the session: removes the stored object from the PHP session
	 * @return	Guso\Promoshop\Domain\Session\SessionHandler this
	 */
	public function cleanUpSession() {
		$GLOBALS['TSFE']->fe_user->setKey('ses', 'tx_promoshop_pi1', NULL);
		$GLOBALS['TSFE']->fe_user->storeSessionData();
		return $this;
	}
}

?>