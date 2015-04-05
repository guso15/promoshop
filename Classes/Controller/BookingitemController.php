<?php

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
class Tx_Promoshop_Controller_BookingitemController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$bookingitems = $this->bookingitemRepository->findAll();
		$this->view->assign('bookingitems', $bookingitems);
	}

	/**
	 * action show
	 *
	 * @param $bookingitem
	 * @return void
	 */
	public function showAction(Tx_Promoshop_Domain_Model_Bookingitem $bookingitem) {
		$this->view->assign('bookingitem', $bookingitem);
	}

	/**
	 * action new
	 *
	 * @param $newBookingitem
	 * @dontvalidate $newBookingitem
	 * @return void
	 */
	public function newAction(Tx_Promoshop_Domain_Model_Bookingitem $newBookingitem = NULL) {
		$this->view->assign('newBookingitem', $newBookingitem);
	}

	/**
	 * action create
	 *
	 * @param $newBookingitem
	 * @return void
	 */
	public function createAction(Tx_Promoshop_Domain_Model_Bookingitem $newBookingitem) {
		$this->bookingitemRepository->add($newBookingitem);
		$this->flashMessageContainer->add('Your new Bookingitem was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param $bookingitem
	 * @return void
	 */
	public function editAction(Tx_Promoshop_Domain_Model_Bookingitem $bookingitem) {
		$this->view->assign('bookingitem', $bookingitem);
	}

	/**
	 * action update
	 *
	 * @param $bookingitem
	 * @return void
	 */
	public function updateAction(Tx_Promoshop_Domain_Model_Bookingitem $bookingitem) {
		$this->bookingitemRepository->update($bookingitem);
		$this->flashMessageContainer->add('Your Bookingitem was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param $bookingitem
	 * @return void
	 */
	public function deleteAction(Tx_Promoshop_Domain_Model_Bookingitem $bookingitem) {
		$this->bookingitemRepository->remove($bookingitem);
		$this->flashMessageContainer->add('Your Bookingitem was removed.');
		$this->redirect('list');
	}

}
?>