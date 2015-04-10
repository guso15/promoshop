<?php
namespace Guso\Promoshop\ViewHelpers\Helpers;

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
 * View helper to display the booked product.
 */
class GetBookedProductViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\IfViewHelper {
	
	/**
	 * productRepository
	 *
	 * @var \Guso\Promoshop\Domain\Repository\ProductRepository
	 *
	 * @inject
	 */
	protected $productRepository;
	
	
	/**
	 * Displays a booked product
	 *
	 * @param integer $product Id number of the booked product
	 * @return string Product title
	 */
	public function render($product) {
		$product = $this->productRepository->findByUid($product);
		$product = $product->getTitle();
				
		return $product;
	}
	
}

?>