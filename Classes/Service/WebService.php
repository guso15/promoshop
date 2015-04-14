<?php
namespace Guso\Promoshop\Service;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

class WebService implements \TYPO3\CMS\Core\SingletonInterface {
 
     function handle() {
 		$output = NULL;
 		
 		$storagePid = GeneralUtility::_GP('storagePid');
 		$productStoragePid = GeneralUtility::_GP('productStoragePid');
		$productCategorie = GeneralUtility::_GP('productCategorie');
		
		// Converting the datetimestrings into timestamps
		$starttime = GeneralUtility::_GP('starttime');
		$endtime = GeneralUtility::_GP('endtime');
		
		$start = $starttime;
		$end = $endtime;

		$starttime = str_replace(array(" ", ":"), '.', $starttime);
		$starttime = GeneralUtility::trimExplode('.', $starttime);
		$starttime[3] == '00' ? $starttime3 = '0' : $starttime3 = $starttime[3];
		$starttime[4] == '00' ? $starttime4 = '0' : $starttime4 = $starttime[4];
		$starttime0 = str_replace('0', '', $starttime[0]);
		$starttime1 = str_replace('0', '', $starttime[1]);
		
		$endtime = str_replace(array(" ", ":"), '.', $endtime);
		$endtime = GeneralUtility::trimExplode('.', $endtime);
		$endtime[3] == '00' ? $endtime3 = '0' : $endtime3 = $endtime[3];
		$endtime[4] == '00' ? $endtime4 = '0' : $endtime4 = $endtime[4];
		$endtime0 = str_replace('0', '', $endtime[0]);
		$endtime1 = str_replace('0', '', $endtime[1]);
		
		$starttime = mktime(intval($starttime3),intval($starttime4),0,intval($starttime1),intval($starttime0),intval($starttime[2]));
		$endtime = mktime(intval($endtime3),intval($endtime4),0,intval($endtime1),intval($endtime0),intval($endtime[2])); 

		// Looking for products that are booked in the given timespan
		$productarr = array();
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
			$respond1 = '<span style="color: red;">Bitte Startdatum wählen.</span>' . $start;
		} elseif (empty($end)) {
			$respond1 = '<span style="color: red;">Bitte Enddatum wählen.</span>';
		} else {
			$respond1 = 'Gewählter Zeitraum: ' . GeneralUtility::_GP('starttime');
			$respond1 .= ' Uhr bis ' . GeneralUtility::_GP('endtime') . ' Uhr.';
			$respond2 = $productarr;
		}
		
  		$output = array($respond1,$respond2);

  		echo json_encode($output);
	}
}

?>