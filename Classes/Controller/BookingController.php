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
class Tx_Promoshop_Controller_BookingController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * bookingRepository
	 *
	 * @var Tx_Promoshop_Domain_Repository_BookingRepository
	 */
	protected $bookingRepository;
	
	/**
	 * customerRepository
	 *
	 * @var Tx_Promoshop_Domain_Repository_CustomerRepository
	 */
	protected $customerRepository;
	
	/**
	 * The object repository
	 * @var Tx_Promoshop_Domain_Repository_SessionRepository
	 */
	protected $sessionRepository = NULL;


	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->accessControlService = t3lib_div::makeInstance('Tx_Promoshop_Service_AccessControlService');
		$this->dateService = t3lib_div::makeInstance('Tx_Promoshop_Service_DateTimeService');
		$this->settingsService = t3lib_div::makeInstance('Tx_Promoshop_Service_SettingsService');
		$this->persistence = $this->settingsService->getPersistanceSettings();
		$this->storagePid = $this->persistence['storagePid'];
		$this->customerRepository = t3lib_div::makeInstance('Tx_Promoshop_Domain_Repository_CustomerRepository');
		$this->categorieRepository = t3lib_div::makeInstance('Tx_Promoshop_Domain_Repository_ProductcategorieRepository');
		$this->sessionRepository = t3lib_div::makeInstance('Tx_Promoshop_Domain_Repository_SessionRepository');
		$this->feUser = $GLOBALS['TSFE']->fe_user->user['uid'];
		$this->baseUrl = $GLOBALS['TSFE']->config['config']['baseURL'];
		$this->customer = $this->customerRepository->findByUid($this->feUser);
		$this->args = $this->request->getArguments();
	}
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$bookings = $this->bookingRepository->findAll();
		$this->view->assign('bookings', $bookings);
	}

	/**
	 * action show
	 *
	 * @param $booking
	 * @return void
	 */
	public function showAction(Tx_Promoshop_Domain_Model_Booking $booking) {
		$this->view->assign('booking', $booking);
	}

	/**
	 * action new
	 *
	 * @param $newBooking
	 * @dontvalidate $newBooking
	 * @dontverifyrequesthash
	 * @return void
	 */
	public function newAction(Tx_Promoshop_Domain_Model_Booking $newBooking = NULL) {
		
		//debugster($this->args);
		//exit();
		
		if ($this->accessControlService->hasLoggedInFrontendUserOnStoragePid($this->storagePid)) {
			
			array_key_exists('args', $this->args) ? $argsInArray = TRUE : $argsInArray = FALSE;
			
			if ($argsInArray == TRUE) {
				$this->args['agb'] = $this->args['args']['agb'];
			}
			
			if (array_key_exists('backlink', $this->args)) {
				$this->redirect('index', 'Product', NULL, array('args' => $this->args));
			} elseif ($this->args['agb'] != 1) {
				$this->redirect('index', 'Product', NULL, array('starttime'=>$this->args['starttime'], 'endtime'=>$this->args['endtime'], 'selectedProducts'=>$this->args['selectedProducts']));
			} else {
				$this->view->assign('agb', $this->args['agb']);
			}
						
			if ($this->args['action'] == 'new') {
				if (array_key_exists('newCustomer', $this->args) && is_array($this->args['newCustomer'])) {
					$this->view->assign('customer', $this->args['newCustomer']);
				} elseif ($argsInArray == TRUE && array_key_exists('newBooking', $this->args['args']) && is_array($this->args['args']['newBooking'])) {
					$this->view->assign('customer', $this->args['args']['newBooking']);
				} else {
					$this->view->assign('customer', $this->customer);
				};
			}
			
			if ($argsInArray == TRUE && array_key_exists('newBooking', $this->args['args']) && is_array($this->args['args']['newBooking'])) {
				$this->view->assign('delivery', $this->args['args']['newBooking']['delivery']);
				$this->view->assign('starttime', $this->args['args']['newBooking']['starttime']);
				$this->view->assign('endtime', $this->args['args']['newBooking']['endtime']);
				$this->view->assign('selectedProducts', $this->args['args']['selectedProducts']);
			} 
			if ($argsInArray == FALSE) {
				$this->view->assign('delivery', $this->args['delivery']);
				$this->view->assign('starttime', $this->dateService->getTimestampFromDate($this->args['starttime']));
				$this->view->assign('endtime', $this->dateService->getTimestampFromDate($this->args['endtime']));
				$this->view->assign('selectedProducts', $this->args['selectedProducts']);
			}
			
			$this->view->assign('newBooking', $newBooking);
			
		} else {
			$this->flashMessages->add('Bitte loggen Sie sich ein.');
			$this->redirect('index', 'Product');
		}
	}

	/**
	 * Creates a new booking
	 *
	 * @param $newBooking A fresh Booking object which has not yet been added to the repository
	 * @param array $bookingitems An array of booked products.
	 * @return void
	 */
	public function createAction(Tx_Promoshop_Domain_Model_Booking $newBooking = NULL, array $bookingitems = array()) {
		
		//debugster($this->args);
		//exit();
		
		$isCreated = $this->sessionRepository->findBySession();

		if (!$isCreated) {
			$this->sessionRepository->writeToSession($token);
			$this->sessionRepository->cleanUpSession();
		}

		if (array_key_exists('backlink', $this->args)) {
			$this->redirect('new', 'Booking', NULL, array('args' => $this->args));
		}

		if ($this->accessControlService->hasLoggedInFrontendUserOnStoragePid($this->storagePid)) {
			if ($isCreated) {
				$this->view->assign('isCreated', $isCreated);
			} else {
				$starttime = $newBooking->getStarttime();
				$endtime = $newBooking->getEndtime();

				$newBooking = $this->createAndAddBookingitems($newBooking, $bookingitems, $starttime, $endtime);
				$this->bookingRepository->add($newBooking);
				$newBooking->setCustomer($this->customer);
				
				$token = md5($this->args['__hmac']);
				$this->sessionRepository->writeToSession($token);
				
				$this->settings['filePath'] == '' ? $filePath = 'uploads/tx_promoshop/bookings/' : $filePath = $this->settings['filePath'];
								
				// Construct a filename from the actual date and title of the productcategorie
				$dateString = time();
				$dateString = date("Y_m_d_H_s", $dateString);
				
				// Create filename from categorie title
				$shopName = $this->categorieRepository->findByUid($this->settings['allowedProductCategories']);
				$shopName = $shopName->getTitle();
				
				$replace = array( 'ä' => 'ae', 'ö' => 'oe', 'ü' => 'ue', 'ß' => 'ss', ' ' => '_', '\\' => '-', '/' => '-' );
				
				$fileName = strtr( strtolower($shopName), $replace );
				
				$fileName = $dateString . '_' . $fileName . '.pdf';
				
				$adminMail = $this->settings['adminMail'];
				$mailHeaderImage = 'uploads/tx_promoshop/' . $this->settings['mailHeaderImage'];
				
				$newBooking->setFile($fileName);
				
				$outputParams = array (
									'newBooking' => $this->args['newBooking'],
									'bookingItems' => $this->args['selectedProducts'],
									'filePath' => $filePath,
									'fileName' => $fileName,
									'shopName' => $shopName,
									'adminMail' => $adminMail,
									'mailHeaderImage' => $mailHeaderImage,
									'baseUrl' => $this->baseUrl
								);
				$this->view->assign('outputParams', $outputParams);
				
				$this->view->assign('filePath', $this->baseUrl . $filePath);
			}
		} else {
			$this->flashMessages->add('Bitte loggen Sie sich ein.');
			$this->redirect('index', 'Product');
		}
		
	}

	/**
	 * action edit
	 *
	 * @param $booking
	 * @return void
	 */
	public function editAction(Tx_Promoshop_Domain_Model_Booking $booking) {
		$this->view->assign('booking', $booking);
	}

	/**
	 * action update
	 *
	 * @param $booking
	 * @return void
	 */
	public function updateAction(Tx_Promoshop_Domain_Model_Booking $booking) {
		$this->bookingRepository->update($booking);
		$this->flashMessageContainer->add('Your Booking was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $booking
	 * @return void
	 */
	public function deleteAction(Tx_Promoshop_Domain_Model_Booking $booking) {
		$this->bookingRepository->remove($booking);
		$this->flashMessageContainer->add('Your Booking was removed.');
		$this->redirect('list');
	}
	
	/**
	 * action exit
	 *
	 * @param $newBooking
	 * @dontverifyrequesthash
	 * @return void
	 */
	public function exitAction(Tx_Promoshop_Domain_Model_Booking $newBooking = NULL) {
		//debugster($this->args);
		//exit();
		if (array_key_exists('backlink', $this->args)) {
			$this->redirect('index', 'Product', NULL, array('args' => $this->args));
		}
		
		if ($this->accessControlService->hasLoggedInFrontendUserOnStoragePid($this->storagePid)) {
			$this->view->assign('newBooking', $newBooking);
			$this->view->assign('customer', $this->args['newBooking']);
			$this->view->assign('bookingitems', $this->args['selectedProducts']);
		} else {
			$this->flashMessages->add('Bitte loggen Sie sich ein.');
			$this->redirect('index', 'Product');
		}
		
		$this->view->assign('agb', $this->args['agb']);
	}

	/**
	 * injectBookingRepository
	 *
	 * @param Tx_Promoshop_Domain_Repository_BookingRepository $bookingRepository
	 * @return void
	 */
	public function injectBookingRepository(Tx_Promoshop_Domain_Repository_BookingRepository $bookingRepository) {
		$this->bookingRepository = $bookingRepository;
	}
	
	/**
	 * Creates a BookingItem for every item in the bookingItems array and adds it to the booking.
	 *
	 * @param Tx_Promoshop_Domain_Model_Booking $booking The booking the booking items should be added to
	 * @param array $bookingitems An array of booking items
	 * @param integer $starttime A timestamp for starttime
	 * @param integer $endtime A timestamp for endtime
	 * @return Tx_Promoshop_Domain_Model_Booking The new booking 
	 */
	protected function createAndAddBookingitems(Tx_Promoshop_Domain_Model_Booking $booking, array $bookingitems = array(), $starttime = 0, $endtime = 0) {
		//debugster($bookingitems);
		//exit();
		foreach ($bookingitems['quantity'] as $key => $quantity) {
			if (!empty($quantity)) {
				$booking->addBookingitem(new Tx_Promoshop_Domain_Model_Bookingitem($quantity, $bookingitems['product'][$key], $starttime, $endtime));
			}
		}
		//exit();
		return $booking;
	}

}
?>