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

require_once(t3lib_extMgm::extPath('promoshop').'/Resources/Public/Scripts/Fpdf/fpdf.php');
require_once(t3lib_extMgm::extPath('promoshop').'/Resources/Public/Scripts/Fpdi/fpdi.php');

 /**
 * Class for implementing and extending the fpdf functionality via the fpdi helper class.
 */

class createPdf extends FPDI {
	
	// Page header
	/*public function Header()
	{
    	// Logo
	    $this->Image(t3lib_extMgm::extPath('promoshop').'/Resources/Public/Files/logo.gif',10,6,30);
    	// Arial bold 15
   	 	$this->SetFont('Arial','B',15);
    	// Move to the right
    	$this->Cell(80);
    	// Title
    	$this->Cell(30,10,'Title',1,0,'C');
    	// Line break
    	$this->Ln(20);
	}


	// Page footer
	public function footer() {
	    // Position at 1.5 cm from bottom
    	$this->SetY(-15);
	    // Arial italic 8
    	$this->SetFont('Arial','',8);
    	// Page number
    	$this->Cell(0,10,'Seite '.$this->PageNo().'/{nb}',0,0,'C');    	
    }*/
}

?>