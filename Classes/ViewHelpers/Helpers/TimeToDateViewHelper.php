<?php
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
 * View helper for converting timestamps into date strings.
 */
class Tx_Promoshop_ViewHelpers_Helpers_TimeToDateViewHelper extends Tx_Fluid_ViewHelpers_IfViewHelper {

	/**
	 * Converts a given timestamp into a date string
	 *
	 * @param integer $timestamp Timestamp
	 * @return string Date string
	 */
	public function render($timestamp) {
		$date = date("j.m.Y H:s", $timestamp);

		return $date;
	}
	
}

?>