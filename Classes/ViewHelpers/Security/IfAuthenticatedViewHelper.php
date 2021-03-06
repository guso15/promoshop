<?php
namespace Guso\Promoshop\ViewHelpers\Security;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/***************************************************************
*  Copyright notice
*
*  (c) 2012 Guenter Sommer <sommer@agentur-milchmaedchen.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
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
 * View helper for checking access rights.
 */
class IfAuthenticatedViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\IfViewHelper {

	/**
	 * @var \Guso\Promoshop\Service\AccessControlService
	 *
	 * @inject
	 */
	protected $accessControlService;
	

	/**
	 * Checks, if a frontend user is logged in
	 *
	 * @return string The output
	 */
	public function render() {
		$storagePid = $GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_promoshop.']['persistence.']['storagePid'];

		if ($this->accessControlService->hasLoggedInFrontendUserOnStoragePid($storagePid)) {
			return $this->renderThenChild();
		} else {
			return $this->renderElseChild();
		}
	}
	
}


?>