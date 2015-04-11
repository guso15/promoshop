<?php
namespace Guso\Promoshop\Controller;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

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
class BookingController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * bookingRepository
	 *
	 * @var \Guso\Promoshop\Domain\Repository\BookingRepository
	 *
	 * @inject
	 */
	protected $bookingRepository;
	
	/**
	 * customerRepository
	 *
	 * @var \Guso\Promoshop\Domain\Repository\CustomerRepository
	 *
	 * @inject
	 */
	protected $customerRepository;
	
	/**
	 * categorieRepository
	 *
	 * @var \Guso\Promoshop\Domain\Repository\ProductcategorieRepository
	 *
	 * @inject
	 */
	protected $categorieRepository;
	
	/**
	 * sessionRepository
	 *
	 * @var \Guso\Promoshop\Domain\Repository\SessionRepository
	 *
	 * @inject
	 */
	protected $sessionRepository = NULL;
	
	/**
	 * @var \Guso\Promoshop\Service\AccessControlService
	 *
	 * @inject
	 */
	protected $accessControlService;
	
	/**
	 * @var \Guso\Promoshop\Service\DateTimeService
	 * @inject
	 */
	protected $dateService;
	
	/**
	 * @var \Guso\Promoshop\Service\SettingsService
	 *
	 * @inject
	 */
	protected $settingsService;


	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	public function initializeAction() {
		$this->persistence = $this->settingsService->getPersistanceSettings();
		$this->storagePid = $this->persistence['storagePid'];
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
	 * @param \Guso\Promoshop\Domain\Model\Booking $booking
	 *
	 * @return void
	 */
	public function showAction(Booking $booking = NULL) {
		$this->view->assign('booking', $booking);
	}

	/**
	 * action new
	 *
	 * @param \Guso\Promoshop\Domain\Model\Booking $booking
	 *
	 * @dontvalidate $booking
	 * @dontverifyrequesthash
	 *
	 * @return void
	 */
	public function newAction(Booking $booking = NULL) {
		
		if ($this->accessControlService->hasLoggedInFrontendUserOnStoragePid($this->storagePid)) {

			array_key_exists('args', $this->args) ? $argsInArray = TRUE : $argsInArray = FALSE;
			
			if ($argsInArray == TRUE) {
				$this->args['agb'] = $this->args['args']['agb'];
				
				if (array_key_exists('errormail', $this->args['args'])) {
					$this->view->assign('errormail', $this->args['args']['errormail']);
				}
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
			
			$this->view->assign('newBooking', $booking);
			
		} else {
			$this->addFlashMessage('Bitte loggen Sie sich ein.', 'Log-in Fehler', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
			$this->redirect('index', 'Product');
		}
	}

	/**
	 * Creates a new booking
	 *
	 * @param $newBooking A fresh Booking object which has not yet been added to the repository
	 * A fresh Booking object which has not yet been added to the repository
	 *
	 * @param array $bookingitems An array of booked products.
	 *
	 * @return void
	 */
	public function createAction(\Guso\Promoshop\Domain\Model\Booking $newBooking = NULL, $bookingitems = array()) {
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
				
			//\TYPO3\CMS\Core\Utility\DebugUtility::debug($booking, 'Remove Escort');
			
			/*
				$starttime = $newBooking->getStarttime();
				$endtime = $newBooking->getEndtime();

				$booking = $this->createAndAddBookingitems($newBooking, $bookingitems, $starttime, $endtime);
		
				$this->bookingRepository->add($booking);
				$booking->setCustomer($this->customer);
				
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
				
				//$booking->setFile($fileName);
				//exit();
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
				
				$this->view->assign('filePath', $this->baseUrl . $filePath);*/
			}
		} else {
			$this->addFlashMessage('Bitte loggen Sie sich ein.', 'Log-in Fehler', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
			$this->redirect('index', 'Product');
		}
		
	}

	/**
	 * action edit
	 *
	 * @param \Guso\Promoshop\Domain\Model\Booking $booking
	 *
	 * @return void
	 */
	public function editAction(Booking $booking = NULL) {
		$this->view->assign('booking', $booking);
	}

	/**
	 * action update
	 *
	 * @param \Guso\Promoshop\Domain\Model\Booking $booking
	 *
	 * @return void
	 */
	public function updateAction(Booking $booking = NULL) {
		$this->bookingRepository->update($booking);
		$this->addFlashMessage('Ihre Buchung wurde geändert.', 'Ihre Buchung', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Guso\Promoshop\Domain\Model\Booking $booking
	 *
	 * @return void
	 */
	public function deleteAction(Booking $booking = NULL) {
		$this->bookingRepository->remove($booking);
		$this->addFlashMessage('Ihre Buchung wurde entfernt.', 'Ihre Buchung', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
		$this->redirect('list');
	}
	
	/**
	 * action exit
	 *
	 * @param \Guso\Promoshop\Domain\Model\Booking $booking
	 * 
	 * @dontverifyrequesthash
	 *
	 * @return void
	 */
	public function exitAction(Booking $booking = NULL) {
		
		if (array_key_exists('backlink', $this->args)) {
			$this->redirect('index', 'Product', NULL, array('args' => $this->args));
		}
		
		if (!filter_var($this->args['newBooking']['email'], FILTER_VALIDATE_EMAIL)) {
			$this->args['errormail'] = 1;
			$this->redirect('new', 'Booking', NULL, array('args' => $this->args));
		}
		
		if ($this->accessControlService->hasLoggedInFrontendUserOnStoragePid($this->storagePid)) {
			$this->view->assign('newBooking', $booking);
			$this->view->assign('customer', $this->args['newBooking']);
			$this->view->assign('bookingitems', $this->args['selectedProducts']);
		} else {
			$this->addFlashMessage('Bitte loggen Sie sich ein.', 'Log-in Fehler', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
			$this->redirect('index', 'Product');
		}
		
		$this->view->assign('agb', $this->args['agb']);
	}

	
	/**
	 * Creates a BookingItem for every item in the bookingItems array and adds it to the booking.
	 *
	 * @param Guso\Promoshop\Domain\Model\Booking $booking The booking the booking items should be added to
	 * @param array $bookingitems An array of booking items
	 * @param integer $starttime A timestamp for starttime
	 * @param integer $endtime A timestamp for endtime
	 *
	 * @return Guso\Promoshop\Domain\Model\Booking The new booking 
	 */
	protected function createAndAddBookingitems(\Guso\Promoshop\Domain\Model\Booking $booking, $bookingitems = array(), $starttime = 0, $endtime = 0) {

		foreach ($bookingitems['quantity'] as $key => $quantity) {
			if (!empty($quantity)) {
				$booking->addBookingitem(new \Guso\Promoshop\Domain\Model\Bookingitem($quantity, $bookingitems['product'][$key], $starttime, $endtime));
			}
		}

		return $booking;
	}

}
?>