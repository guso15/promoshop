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
class Tx_Promoshop_Controller_ProductController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * productRepository
	 *
	 * @var Tx_Promoshop_Domain_Repository_ProductRepository
	 */
	protected $productRepository;
	
	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		/*$this->organizationRepository = t3lib_div::makeInstance('Tx_SjrOffers_Domain_Repository_OrganizationRepository');*/
		$this->args = $this->request->getArguments();
		$this->settingsService = t3lib_div::makeInstance('Tx_Promoshop_Service_SettingsService');
		$this->accessControlService = t3lib_div::makeInstance('Tx_Promoshop_Service_AccessControlService');
		$this->sessionRepository = t3lib_div::makeInstance('Tx_Promoshop_Domain_Repository_SessionRepository');
		$this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/Styles/jquery-ui-1.8.18.custom.css" />');
		$this->response->addAdditionalHeaderData('<link rel="stylesheet" type="text/css" href="' . t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) . 'Resources/Public/Styles/Fancybox/jquery.fancybox-1.3.4.css" />');
		$this->baseUrl = $GLOBALS['TSFE']->config['config']['baseURL'];
	}
	
	/**
	 * action index
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->persistence = $this->settingsService->getPersistanceSettings();
		
		$selectedProducts = '';
		
		if (array_key_exists('args', $this->args)) {
			if (array_key_exists('newBooking', $this->args['args'])) {
				$this->view->assign('newCustomer', $this->args['args']['newBooking']);

				$starttime = date("d.m.Y H:s", $this->args['args']['newBooking']['starttime']);
				$this->view->assign('starttime', $starttime);
				
				$endtime = date("d.m.Y H:s", $this->args['args']['newBooking']['endtime']);
				$this->view->assign('endtime', $endtime);
			}
			if (array_key_exists('selectedProducts', $this->args['args'])) {
				foreach($this->args['args']['selectedProducts'] AS $key => $val) {
					if ($val > 0) {
						$selectedProducts .= $key . '=' . $val . ',';
					}
				};
				$this->view->assign('selectedProducts', $selectedProducts);				
			}
			$this->view->assign('agb', $this->args['args']['agb']);
		} else {
			foreach($this->args['selectedProducts'] AS $key => $val) {
				if ($val > 0) {
					$selectedProducts .= $key . '=' . $val . ',';
				}
			};
			$this->view->assign('selectedProducts', $selectedProducts);
			$this->view->assign('starttime', $this->args['starttime']);
			$this->view->assign('endtime', $this->args['endtime']);
			$this->view->assign('agb', $this->args['agb']);
		}
		
		$this->settings['filePath'] == '' ? $filePath = 'uploads/tx_promoshop/bookings/' : $filePath = $this->settings['filePath'];
		$this->view->assign('filePath', $this->baseUrl . $filePath);
		$this->view->assign('baseUrl', $this->baseUrl);
		
		$storagePid = $this->persistence['storagePid'];
		
		if ($this->persistence['productStoragePid'] > 0) {
			$productStoragePid = $this->persistence['productStoragePid'];
		} else {
			$productStoragePid = $storagePid;
		}

		if ($this->accessControlService->hasLoggedInFrontendUserOnStoragePid($storagePid)) {
			$this->view->assign('products', $this->productRepository->findByCategorieAndPid(t3lib_div::intExplode(',', $this->settings['allowedProductCategories']), $productStoragePid));
		
			$productCategorie = $this->settings['allowedProductCategories'];
		
			$pluginSetup = array('storagePid' => $storagePid, 'productStoragePid' => $productStoragePid, 'productCategorie' => $productCategorie);
		
			$this->view->assign('pluginSetup', $pluginSetup);
		} else {
			$this->flashMessages->add('Bitte loggen Sie sich ein.');
			$this->sessionRepository->cleanUpSession();
		}
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$products = $this->productRepository->findAll();
		$this->view->assign('products', $products);
	}

	/**
	 * action show
	 *
	 * @param $product
	 * @dontvalidate $product
	 * @return void
	 */
	public function showAction(Tx_Promoshop_Domain_Model_Product $product) {
		$this->view->assign('product', $product);
	}

	/**
	 * action new
	 *
	 * @param $newProduct
	 * @dontvalidate $newProduct
	 * @return void
	 */
	public function newAction(Tx_Promoshop_Domain_Model_Product $newProduct = NULL) {
		$this->view->assign('newProduct', $newProduct);
	}

	/**
	 * action create
	 *
	 * @param $newProduct
	 * @return void
	 */
	public function createAction(Tx_Promoshop_Domain_Model_Product $newProduct) {
		$this->productRepository->add($newProduct);
		$this->flashMessageContainer->add('Your new Product was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $product
	 * @dontvalidate $product
	 * @return void
	 */
	public function editAction(Tx_Promoshop_Domain_Model_Product $product) {
		$this->view->assign('product', $product);
	}

	/**
	 * action update
	 *
	 * @param $product
	 * @return void
	 */
	public function updateAction(Tx_Promoshop_Domain_Model_Product $product) {
		$this->productRepository->update($product);
		$this->flashMessageContainer->add('Your Product was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $product
	 * @return void
	 */
	public function deleteAction(Tx_Promoshop_Domain_Model_Product $product) {
		$this->productRepository->remove($product);
		$this->flashMessageContainer->add('Your Product was removed.');
		$this->redirect('list');
	}

	/**
	 * injectProductRepository
	 *
	 * @param Tx_Promoshop_Domain_Repository_ProductRepository $productRepository
	 * @return void
	 */
	public function injectProductRepository(Tx_Promoshop_Domain_Repository_ProductRepository $productRepository) {
		$this->productRepository = $productRepository;
	}

}
?>