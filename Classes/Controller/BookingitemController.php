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
class BookingitemController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

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
	 * @param \Guso\Promoshop\Domain\Model\Bookingitem $bookingitem
	 *
	 * @return void
	 */
	public function showAction(Bookingitem $bookingitem) {
		$this->view->assign('bookingitem', $bookingitem);
	}

	/**
	 * action new
	 *
	 * @param \Guso\Promoshop\Domain\Model\Bookingitem $bookingitem
	 * @dontvalidate $newBookingitem
	 *
	 * @return void
	 */
	public function newAction(Bookingitem $bookingitem = NULL) {
		$this->view->assign('newBookingitem', $bookingitem);
	}

	/**
	 * action create
	 *
	 * @param \Guso\Promoshop\Domain\Model\Bookingitem $bookingitem
	 *
	 * @return void
	 */
	public function createAction(Bookingitem $bookingitem) {
		$this->bookingitemRepository->add($bookingitem);
		$this->addFlashMessage('Ihre neue Buchung wurde angelegt.', 'Ihre Buchung', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
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
	 * @param \Guso\Promoshop\Domain\Model\Bookingitem $bookingitem
	 *
	 * @return void
	 */
	public function updateAction(Bookingitem $bookingitem) {
		$this->bookingitemRepository->update($bookingitem);
		$this->addFlashMessage('Ihre bestehende Buchung wurde geändert.', 'Ihre Buchung', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \Guso\Promoshop\Domain\Model\Bookingitem $bookingitem
	 *
	 * @return void
	 */
	public function deleteAction(Bookingitem $bookingitem) {
		$this->bookingitemRepository->remove($bookingitem);
		$this->addFlashMessage('Ihre bestehende Buchung wurde entfernt.', 'Ihre Buchung', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK, TRUE);
		$this->redirect('list');
	}

}
?>