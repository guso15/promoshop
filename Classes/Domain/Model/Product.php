<?php
namespace Guso\Promoshop\Domain\Model;

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
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * The name of the product
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * A short description of the product.
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $shortDescription;

	/**
	 * A detailed description.
	 *
	 * @var string
	 */
	protected $longDescription;

	/**
	 * Product price.
	 *
	 * @var float
	 */
	protected $price;

	/**
	 * Product quantity.
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $quantity;

	/**
	 * Related Categorie.
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $categorie;

	/**
	 * Product image.
	 *
	 * @var string
	 */
	protected $image;
	
	/**
	 * Product image title.
	 *
	 * @var string
	 */
	protected $imageTitle;
	
	/**
	 * Image zoom.
	 *
	 * @var integer
	 */
	protected $imageZoom;

	/**
	 * Product related file.
	 *
	 * @var string
	 */
	protected $file;
	
	/**
	 * Product file title.
	 *
	 * @var string
	 */
	protected $fileTitle;

	/**
	 * Returns the shortDescription
	 *
	 * @return string $shortDescription
	 */
	public function getShortDescription() {
		return $this->shortDescription;
	}

	/**
	 * Sets the shortDescription
	 *
	 * @param string $shortDescription
	 * @return void
	 */
	public function setShortDescription($shortDescription) {
		$this->shortDescription = $shortDescription;
	}

	/**
	 * Returns the longDescription
	 *
	 * @return string $longDescription
	 */
	public function getLongDescription() {
		return $this->longDescription;
	}

	/**
	 * Sets the longDescription
	 *
	 * @param string $longDescription
	 * @return void
	 */
	public function setLongDescription($longDescription) {
		$this->longDescription = $longDescription;
	}

	/**
	 * Returns the price
	 *
	 * @return float $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param float $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
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
	 * Returns the title
	 *
	 * @return string title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return string title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the categorie
	 *
	 * @return integer categorie
	 */
	public function getCategorie() {
		return $this->categorie;
	}

	/**
	 * Sets the categorie
	 *
	 * @param integer $categorie
	 * @return integer categorie
	 */
	public function setCategorie($categorie) {
		$this->categorie = $categorie;
	}

	/**
	 * Returns the image
	 *
	 * @return string $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param string $image
	 * @return void
	 */
	public function setImage($image) {
		$this->image = $image;
	}
	
	/**
	 * Returns the imageTitle
	 *
	 * @return string $imageTitle
	 */
	public function getImageTitle() {
		return $this->imageTitle;
	}

	/**
	 * Sets the imageTitle
	 *
	 * @param string $imageTitle
	 * @return void
	 */
	public function setImageTitle($imageTitle) {
		$this->imageTitle = $imageTitle;
	}
	
	/**
	 * Returns integer image zoom
	 *
	 * @return integer imageZoom
	 */
	public function getImageZoom() {
		return $this->imageZoom;
	}
	
	/**
	 * Sets the image zoom
	 *
	 * @param integer $imageZoom
	 * @return integer imageZoom
	 */
	public function setImageZoom($imageZoom) {
		$this->imageZoom = $imageZoom;
	}

	/**
	 * Returns the file
	 *
	 * @return string $file
	 */
	public function getFile() {
		return $this->file;
	}

	/**
	 * Sets the file
	 *
	 * @param string $file
	 * @return void
	 */
	public function setFile($file) {
		$this->file = $file;
	}
	
	/**
	 * Returns the fileTitle
	 *
	 * @return string $fileTitle
	 */
	public function getFileTitle() {
		return $this->fileTitle;
	}

	/**
	 * Sets the imageTitle
	 *
	 * @param string $fileTitle
	 * @return void
	 */
	public function setFileTitle($fileTitle) {
		$this->fileTitle = $fileTitle;
	}

}
?>