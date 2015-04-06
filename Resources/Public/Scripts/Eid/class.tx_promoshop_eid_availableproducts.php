<?php
if (!defined ('PATH_typo3conf')) die ('Could not access this script directly!');

#
/***************************************************************
#
*  Copyright notice
#
*
#
*  (c) 2012 Guenter Sommer <sommer@agentur-milchmaedchen.de>
#
*
#
*  All rights reserved
#
*
#
*  This copyright notice MUST APPEAR in all copies of the script!
#
***************************************************************/
#
 
#
/**
#
 * This class could called with AJAX via eID
#
 *
#
 * @author      Guenter Sommer <sommer@agentur-milchmaedchen.de>
#
 * @package     TYPO3
#
 * @subpackage  tx_promoshop
#
 */

require_once(PATH_tslib.'class.tslib_pibase.php');
tslib_eidtools::connectDB(); //Connect to database

class tx_promoshop_eid_availableproducts extends tslib_pibase {
 
     function main() {
 		
		//$this->feUserObject = tslib_eidtools::initFeUser();
		//$this->TSFEObject = tslib_eidtools::getTSFE();
		
 		$output = NULL;
 		
 		$storagePid = t3lib_div::_GP('storagePid');
 		$productStoragePid = t3lib_div::_GP('productStoragePid');
		$productCategorie = t3lib_div::_GP('productCategorie');
		
		// Converting the datetimestrings into timestamps
		$starttime = t3lib_div::_GP('starttime');
		$endtime = t3lib_div::_GP('endtime');
		
		$start = $starttime;
		$end = $endtime;

		$starttime = str_replace(array(" ", ":"), '.', $starttime);
		$starttime = t3lib_div::trimExplode('.', $starttime);
		$starttime[3] == '00' ? $starttime3 = '0' : $starttime3 = $starttime[3];
		$starttime[4] == '00' ? $starttime4 = '0' : $starttime4 = $starttime[4];
		$starttime0 = str_replace('0', '', $starttime[0]);
		$starttime1 = str_replace('0', '', $starttime[1]);
		
		$endtime = str_replace(array(" ", ":"), '.', $endtime);
		$endtime = t3lib_div::trimExplode('.', $endtime);
		$endtime[3] == '00' ? $endtime3 = '0' : $endtime3 = $endtime[3];
		$endtime[4] == '00' ? $endtime4 = '0' : $endtime4 = $endtime[4];
		$endtime0 = str_replace('0', '', $endtime[0]);
		$endtime1 = str_replace('0', '', $endtime[1]);
		
		$starttime = mktime(intval($starttime3),intval($starttime4),0,intval($starttime1),intval($starttime0),intval($starttime[2]));
		$endtime = mktime(intval($endtime3),intval($endtime4),0,intval($endtime1),intval($endtime0),intval($endtime[2])); 

		// Looking for products that are booked in the given timespan
		$productarr = array();
		//$products = $GLOBALS['TYPO3_DB']->exec_SELECTquery('product', 'tx_promoshop_domain_model_bookingitem');
		$products = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid, quantity', 'tx_promoshop_domain_model_product', 'deleted = 0 AND hidden = 0 AND pid = ' . $productStoragePid . ' AND categorie = ' . $productCategorie);
		$num = $GLOBALS['TYPO3_DB']->sql_num_rows($products);
		if ($num >= 1) {
			while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_row($products)) {
				$product = $row[0];
				$quantity = $row[1];
				/*$quantity = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('quantity', 'tx_promoshop_domain_model_product','uid = ' . $product);
				foreach ($quantity as $record) {
					$quantity = $record['quantity'];
				}*/
				$bookings = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('SUM(quantity) as total', 'tx_promoshop_domain_model_bookingitem','deleted = 0 AND hidden = 0 AND pid = ' . $storagePid . ' AND starttime <= ' . $endtime . ' AND endtime >= ' . $starttime . ' AND product = ' . $product);
				foreach ($bookings as $record) {
					$quantity = intval($quantity) - intval($record['total']);
				}
				$productarr["$product"] = $quantity;
			}
		}
		
		$respond2 = '';
		if (empty($start)) {
			$respond1 = '<span style="color: red;">Bitte Startdatum wählen.</span>';
		} elseif (empty($end)) {
			$respond1 = '<span style="color: red;">Bitte Enddatum wählen.</span>';
		} else {
			$respond1 = 'Gewählter Zeitraum: ' . t3lib_div::_GP('starttime');
			$respond1 .= ' Uhr bis ' . t3lib_div::_GP('endtime') . ' Uhr.';
			$respond2 = $productarr;
		}
		
		
  		$output = array($respond1,$respond2);
  		
  		echo json_encode($output);
	}
}
 
$availableProducts = GeneralUtility::makeInstance('tx_promoshop_eid_availableproducts');
$availableProducts->main();
?>