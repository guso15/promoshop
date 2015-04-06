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
class Booking extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
	
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
	 * Art der Lieferung.
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $delivery;

	/**
	 * Booked item.
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_Promoshop_Domain_Model_Bookingitem>
	 */
	protected $bookingitems;

	/**
	 * The customer who books the products.
	 *
	 * @var Tx_Extbase_Domain_Model_FrontendUser
	 */
	protected $customer;
	
	/**
	 * Company
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $company;
	
	/**
	 * Gender
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $gender;
	
	/**
	 * First name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $firstName;
	
	/**
	 * Last name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $lastName;
	
	/**
	 * Address
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $address;
	
	/**
	 * Zip
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $zip;
	
	/**
	 * City
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $city;
	
	/**
	 * Telephone
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $telephone;
	
	/**
	 * Fax
	 *
	 * @var string
	 */
	protected $fax;
	
	/**
	 * Mobile
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $mobile;
	
	/**
	 * Email
	 *
	 * @var string
	 * @validate emailAddress
	 */
	protected $email;
	
	/**
	 * VB Name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $vbname;
	
	/**
	 * VB Phone
	 *
	 * @var string
	 */
	protected $vbphone;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->bookingitems = new Tx_Extbase_Persistence_ObjectStorage();
	}
	
	/**
     * Returns the id number
     *
     * @return integer
     */
    public function getId() {
        return $this->uid;
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
	
	/**
	 * Returns the delivery
	 *
	 * @return integer $delivery
	 */
	public function getDelivery() {
		return $this->delivery;
	}

	/**
	 * Sets the delivery
	 *
	 * @param integer $delivery
	 * @return void
	 */
	public function setDelivery($delivery) {
		$this->delivery = $delivery;
	}

	/**
	 * Returns the customer
	 *
	 * @return Tx_Extbase_Domain_Model_FrontendUser customer
	 */
	public function getCustomer() {
		return $this->customer;
	}

	/**
	 * Sets the customer
	 *
	 * @param Tx_Extbase_Domain_Model_FrontendUser $customer
	 * @return Tx_Extbase_Domain_Model_FrontendUser customer
	 */
	public function setCustomer(Tx_Extbase_Domain_Model_FrontendUser $customer) {
		$this->customer = $customer;
	}
	
	/**
     * Sets the company value
     *
     * @param string $company
     * @return void
     */
    public function setCompany($company) {
        $this->company = $company;
    }

    /**
     * Returns the company value
     *
     * @return string
     */
    public function getCompany() {
        return $this->company;
    }
    
    /**
     * Sets the gender value
     *
     * @param integer $gender
     * @return void
     * @api
     */
    public function setGender($gender) {
        $this->gender = $gender;
    }

    /**
     * Returns the gender value
     *
     * @return string
     */
    public function getGender() {
        return $this->gender;
    }
	
	 /**
     * Sets the firstName value
     *
     * @param string $firstName
     * @return void
     * @api
     */
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    /**
     * Returns the firstName value
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Sets the lastName value
     *
     * @param string $lastName
     * @return void
     * @api
     */
    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    /**
     * Returns the lastName value
     *
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }
        
    /**
     * Sets the address value
     *
     * @param string $address
     * @return void
     */
    public function setAddress($address) {
        $this->address = $address;
    }

    /**
     * Returns the address value
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }
    
    /**
     * Sets the zip value
     *
     * @param string $zip
     * @return void
     */
    public function setZip($zip) {
        $this->zip = $zip;
    }

    /**
     * Returns the zip value
     *
     * @return string
     */
    public function getZip() {
        return $this->zip;
    }
    
    /**
     * Sets the city value
     *
     * @param string $city
     * @return void
     */
    public function setCity($city) {
        $this->city = $city;
    }

    /**
     * Returns the city value
     *
     * @return string
     */
    public function getCity() {
        return $this->city;
    }
    
    /**
     * Sets the telephone value
     *
     * @param string $telephone
     * @return void
     */
    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    /**
     * Returns the telephone value
     *
     * @return string
     */
    public function getTelephone() {
        return $this->telephone;
    }
    
    /**
     * Sets the fax value
     *
     * @param string $fax
     * @return void
     */
    public function setFax($fax) {
        $this->fax = $fax;
    }

    /**
     * Returns the fax value
     *
     * @return string
     */
    public function getFax() {
        return $this->fax;
    }
    
    /**
     * Sets the mobile value
     *
     * @param string $mobile
     * @return void
     */
    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

    /**
     * Returns the mobile value
     *
     * @return string
     */
    public function getMobile() {
        return $this->mobile;
    }
    
    /**
     * Sets the email value
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Returns the email value
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }
    
    /**
     * Sets the vbname value
     *
     * @param string $vbname
     * @return void
     */
    public function setVbname($vbname) {
        $this->vbname = $vbname;
    }

    /**
     * Returns the vbname value
     *
     * @return string
     */
    public function getVbname() {
        return $this->vbname;
    }
    
    /**
     * Sets the vbphone value
     *
     * @param string $vbphone
     * @return void
     */
    public function setVbphone($vbphone) {
        $this->vbphone = $vbphone;
    }

    /**
     * Returns the vbphone value
     *
     * @return string
     */
    public function getVbphone() {
        return $this->vbphone;
    }
    
    /**
     * Sets the file name
     *
     * @param string $file
     * @return void
     */
    public function setFile($file) {
        $this->file = $file;
    }

    /**
     * Returns the file name
     *
     * @return string
     */
    public function getFile() {
        return $this->file;
    }

	/**
	 * Adds a Bookingitem
	 *
	 * @param Tx_Promoshop_Domain_Model_Bookingitem $bookingitem
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Promoshop_Domain_Model_Bookingitem> bookingitems
	 */
	public function addBookingitem(Tx_Promoshop_Domain_Model_Bookingitem $bookingitem) {
		$this->bookingitems->attach($bookingitem);
	}

	/**
	 * Removes a Bookingitem
	 *
	 * @param Tx_Promoshop_Domain_Model_Bookingitem $bookingitemToRemove The Bookingitem to be removed
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Promoshop_Domain_Model_Bookingitem> bookingitems
	 */
	public function removeBookingitem(Tx_Promoshop_Domain_Model_Bookingitem $bookingitemToRemove) {
		$this->bookingitems->detach($bookingitemToRemove);
	}

	/**
	 * Returns the Bookingitems
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Promoshop_Domain_Model_Bookingitem> bookingitems
	 */
	public function getBookingitems() {
		return $this->bookingitems;
	}

	/**
	 * Sets the Bookingitems
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_Promoshop_Domain_Model_Bookingitem> $bookingitems
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_Promoshop_Domain_Model_Bookingitem> bookingitems
	 */
	public function setBookingitems(Tx_Extbase_Persistence_ObjectStorage $bookingitems) {
		$this->bookingitems = $bookingitems;
	}

}
?>