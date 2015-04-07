<?php
namespace Guso\Promoshop\ViewHelpers\Render;

use \TYPO3\CMS\Core\Utility\GeneralUtility,
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

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

//require_once(PATH_t3lib.'class.t3lib_befunc.php');
require_once(ExtensionManagementUtility::extPath('promoshop').'/Resources/Public/Scripts/Pdf/class.createPdf.php');
//require_once(PATH_t3lib.'class.t3lib_cs.php');

 /**
 * View helper for rendering pdf output.
 */

class PdfViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
		
	 /**
	 * Render the supplied contents as a pdf
	 *
	 * @param array $params
	 * @return void
	 */
    public function render($params = array()) {
    
    	$productRepository = GeneralUtility::makeInstance('Tx_Promoshop_Domain_Repository_ProductRepository');
    	$dateService = GeneralUtility::makeInstance('Tx_Promoshop_Service_DateTimeService');
    	
    	// Get the parameters
		$customer =			$params['newBooking'];
		$booking =			$params['booking'];
		$products =			$params['bookingItems'];
		$fileName =			$params['fileName'];
		$filePath =			$params['filePath'];
		$shopName =			$params['shopName'];
		$structure =		$params['structure'];
		$orientation =		$params['formatOptions']['orientation'] ? $params['formatOptions']['orientation'] : 'portrait';
		$unit =				$params['formatOptions']['unit'] ? $params['formatOptions']['unit'] : 'mm';
		$format =			$params['formatOptions']['format'] ? $params['formatOptions']['format'] : 'A4';
		$marginLeft =		$params['formatOptions']['margin_left'] ? $params['formatOptions']['margin_left'] : '10';
		$marginTop =		$params['formatOptions']['margin_top'] ? $params['formatOptions']['margin_top'] : '35';
		$marginRight =		$params['formatOptions']['margin_right'] ? $params['formatOptions']['margin_right'] : '10';
		$font =				$params['formatOptions']['font'] ? $params['formatOptions']['font'] : 'Arial';
		$fontSize =			$params['formatOptions']['font_size'] ? $params['formatOptions']['font_size'] : '9';
		$fillColor =		$params['formatOptions']['fill_color'] ? $params['formatOptions']['fill_color'] : '255,255,255';
		$picturePosition =	$params['formatOptions']['picture_position'] ? $params['formatOptions']['picture_position'] : 'top_right';
		$pictureWidth =		$params['formatOptions']['picture_width'] ? $params['formatOptions']['picture_width'] : '25';
		$pictureMarginTop =	$params['formatOptions']['picture_margin_top'] ? $params['formatOptions']['picture_margin_top'] : '15';
		$template =			$params['formatOptions']['template'] ? $params['formatOptions']['template'] : '';
		
		//$str = iconv('UTF-8', 'windows-1252', $customer['address']);
		
		// The data must be in iso-8859-1: Determine the charset from the database
		$fromCharset = $GLOBALS['TYPO3_CONF_VARS']['BE']['forceCharset'] ? $GLOBALS['TYPO3_CONF_VARS']['BE']['forceCharset'] : 'iso-8859-1';
		
		// Convert to iso-8859-1
		$cs = GeneralUtility::makeInstance('t3lib_cs');
		$cs->convArray(&$customer, $fromCharset, 'iso-8859-1');
		
		define('EUR',chr(128));
		
		switch ($customer['delivery']) {
			case 1:
				$delivery = 'Selbstabholung';
				break;
			case 2:
				$delivery = 'Lieferung';
				break;
		}
		
		$starttime = $dateService->getDateFromTimestamp($customer['starttime']);
		$endtime = $dateService->getDateFromTimestamp($customer['endtime']);
		
		
    	$pdf = new createPdf();
    	
    	$pagecount = $pdf->setSourceFile(ExtensionManagementUtility::extPath('promoshop').'/Resources/Public/Files/Promoshop.pdf'); 
    	
		$tplidx = $pdf->importPage(1, '/MediaBox');
		
		// Determine the widths and height of cells
		$cellHeight = ($fontSize+3)/$pdf->k;
    	$cellWidth = array(13*$fontSize/$pdf->k, $pageWidth*0.75);
   		$cellWidth[] = $pdf->fw - $marginLeft - $marginRight - $cellWidth['0'];
    	
    	$pdf->SetFont($font,'',intval($fontSize));
		$pdf->SetFillColor(intval($fillColor));
		
		// Set the page margins and start a new page
		$pdf->SetMargins(intval($marginLeft), intval($marginTop), intval($marginRight));
    			
		$pdf->addPage(); 
		$pdf->useTemplate($tplidx, 1, 1);
		
		$pdf->SetY(80);
		$pdf->Cell(3);
		$pdf->SetFont($font,'B',intval($fontSize));
		$pdf->Cell(150,$cellHeight,$shopName,0,1,'L',1);
				
		$pdf->SetY(43);
		$pdf->SetX(105);
		$pdf->SetFont($font,'B',intval($fontSize));
		$pdf->Cell(150,$cellHeight,'Besteller',0,1,'L',1);
						
		$pdf->SetFont($font,'',intval($fontSize));
			
		$pdf->SetX(105);
		$pdf->Cell(150,$cellHeight,$customer['company'],0,1,'L',1);
		$pdf->SetX(105);
		$pdf->Cell(150,$cellHeight,$customer['firstName'] . ' ' . $customer['lastName'],0,1,'L',1);
		$pdf->SetX(105);
		$pdf->Cell(150,$cellHeight,$customer['address'],0,1,'L',1);
		$pdf->SetX(105);
		$pdf->Cell(150,$cellHeight,$customer['zip'] . ' ' . $customer['city'],0,1,'L',1);
						
		$pdf->SetX(105);
		$pdf->Cell('',$cellHeight, '', '', 1);
						
		$pdf->SetX(105);
		$pdf->Cell(150,$cellHeight,'Telefon: ' . $customer['telephone'],0,1,'L',1);
		$pdf->SetX(105);
		$pdf->Cell(150,$cellHeight,'Mobil: ' . $customer['mobile'],0,1,'L',1);
						
		if ($customer['fax']) {
			$pdf->SetX(105);
			$pdf->Cell(150,$cellHeight,'Fax: ' . $customer['fax'],0,1,'L',1);
		}
						
		$pdf->SetX(105);
		$pdf->Cell(150,$cellHeight,'E-Mail: ' . $customer['email'],0,1,'L',1);
				
		$pdf->SetX(105);
		$pdf->Cell('',$cellHeight, '', '', 1);
				
		$pdf->SetX(105);
		$pdf->Cell(150,$cellHeight,utf8_decode('Zuständiger Vodafone VB: ') . $customer['vbname'],0,1,'L',1);
						
		if ($customer['vbphone']) {
			$pdf->SetX(105);
			$pdf->Cell(150,$cellHeight,'(Telefon: ' . $customer['vbphone'] . ')',0,1,'L',1);
		}
		
		$pdf->Cell('',$cellHeight, '', '', 1);
		
		$pdf->Cell(3);
		$pdf->Cell(150,$cellHeight,'Bestellart: ' . $delivery,0,1,'L',1);
		
		$pdf->Cell('',$cellHeight, '', '', 1);
		
		$pdf->Cell(3);
		$pdf->SetFont($font,'B',intval($fontSize));
		$pdf->Cell(150,$cellHeight,'Mietzeitraum ' . $starttime . ' Uhr bis ' . $endtime . ' Uhr',0,1,'L',1);
		
		$pdf->Cell('',$cellHeight, '', '', 1);
		$pdf->SetFont($font,'',intval($fontSize));
		
		$countProducts = 0;
		foreach ($products as $id => $amount)	{
			if ($amount > 0) {
				$product = $productRepository->findByUid($id);
				$title = $product->getTitle();
				
				$title = iconv('UTF-8', 'windows-1252', $title);
				
				$price = $product->getPrice();
				$pdf->Cell(3);
				$pdf->Cell(150,$cellHeight,$amount . ' x ' . $title . ' (' . $price . ' ' . EUR . ' )',0,1,'L',1);
				$countProducts += 1;
			}
		}
		
		// Set a partial template
		// Get the actual vertical position
		$boxY = $pdf->getY();
		$pagecount = $pdf->setSourceFile(ExtensionManagementUtility::extPath('promoshop').'/Resources/Public/Files/PromoshopEof.pdf'); 
		$tplidx = $pdf->importPage(1, '/MediaBox');
		$pdf->useTemplate($tplidx, 1, $boxY+8);
		
		// Set a new page template
		$shop2 = strpos($shopname, 'ollenberg');
		if ($shop2 === false) {
			$pagecount = $pdf->setSourceFile(ExtensionManagementUtility::extPath('promoshop').'/Resources/Public/Files/PromoshopAbg.pdf');
		} else {
			$pagecount = $pdf->setSourceFile(ExtensionManagementUtility::extPath('promoshop').'/Resources/Public/Files/PromoshopBAbg.pdf');
		}
		$tplidx = $pdf->importPage(1, '/MediaBox');
		$pdf->addPage(); 
		$pdf->useTemplate($tplidx, 1, 1);
						
		$pdf->Output($filePath . $fileName, 'F');
		
		return $fileName;
    }
}

?>