<?php
namespace Guso\Promoshop\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Günter Sommer <sommer@agentur-milchmaedchen.de>
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
class ProductcategorieController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$productcategories = $this->productcategorieRepository->findAll();
		$this->view->assign('productcategories', $productcategories);
	}

	/**
	 * action show
	 *
	 * @param \Guso\Promoshop\Domain\Model\Productcategorie $productcategorie
	 *
	 * @return void
	 */
	public function showAction(Productcategorie $productcategorie) {
		$this->view->assign('productcategorie', $productcategorie);
	}

	/**
	 * action new
	 *
	 * @param \Guso\Promoshop\Domain\Model\Productcategorie $productcategorie
	 * @dontvalidate $newProductcategorie
	 *
	 * @return void
	 */
	public function newAction(Productcategorie $productcategorie) {
		$this->view->assign('newProductcategorie', $productcategorie);
	}

	/**
	 * action create
	 *
	 * @param \Guso\Promoshop\Domain\Model\Productcategorie $productcategorie
	 *
	 * @return void
	 */
	public function createAction(Productcategorie $productcategorie) {
		$this->productcategorieRepository->add($productcategorie);
		$this->addFlashMessage('Ihre neue Produktkategorie wurde angelegt.', 'Ihre Produktkategorie', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \Guso\Promoshop\Domain\Model\Productcategorie $productcategorie
	 *
	 * @return void
	 */
	public function editAction(Productcategorie $productcategorie) {
		$this->view->assign('productcategorie', $productcategorie);
	}

	/**
	 * action update
	 *
	 * @param \Guso\Promoshop\Domain\Model\Productcategorie $productcategorie
	 *
	 * @return void
	 */
	public function updateAction(Productcategorie $productcategorie) {
		$this->productcategorieRepository->update($productcategorie);
		$this->addFlashMessage('Ihre bestehende Produktkategorie wurde angelegt.', 'Ihre Produktkategorie', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Guso\Promoshop\Domain\Model\Productcategorie $productcategorie
	 *
	 * @return void
	 */
	public function deleteAction(Productcategorie $productcategorie) {
		$this->productcategorieRepository->remove($productcategorie);
		$this->addFlashMessage('Ihre bestehende Produktkategorie wurde entfernt.', 'Ihre Produktkategorie', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
		$this->redirect('list');
	}

}
?>