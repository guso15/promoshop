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
class Tx_Promoshop_Domain_Model_Bookingitem extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Amount of items.
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $quantity;

	/**
	 * A product id
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $product;
	
	/**
	 * Starttime
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $starttime;
	
	/**
	 * Endtime
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $endtime;
	
	/**
	 * Constructs this Bookingitem
	 *
	 * @param integer $quantity The amount
	 * @param integer $product The product
	 * @return void
	 */
	public function __construct($quantity, $product, $starttime, $endtime) {
		$this->setQuantity($quantity);
		$this->setProduct($product);
		$this->setStarttime($starttime);
		$this->setEndtime($endtime);
	}

	/**
	 * Returns the quantity
	 *
	 * @return integer $quantity
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * Sets the quantity
	 *
	 * @param integer $quantity
	 * @return void
	 */
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
	}

	/**
	 * Returns the product
	 *
	 * @return Tx_Promoshop_Domain_Model_Product $product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * Sets the product
	 *
	 * @param integer $product
	 * @return void
	 */
	public function setProduct($product) {
		$this->product = $product;
	}
	
	/**
	 * Returns the starttime
	 *
	 * @return integer $starttime
	 */
	public function getStarttime() {
		return $this->starttime;
	}
	
	/**
	 * Returns the endtime
	 *
	 * @return integer $endtime
	 */
	public function getEndtime() {
		return $this->endtime;
	}
	
	/**
	 * Sets the starttime
	 *
	 * @param integer $starttime
	 * @return void
	 */
	public function setStarttime($starttime) {
		$this->starttime = $starttime;
	}
	
	/**
	 * Sets the endtime
	 *
	 * @param integer $endtime
	 * @return void
	 */
	public function setEndtime($endtime) {
		$this->endtime = $endtime;
	}

}
?>