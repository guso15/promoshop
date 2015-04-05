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
class Tx_Promoshop_Domain_Model_Customer extends Tx_Extbase_Domain_Model_FrontendUser {

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;
    
    /**
     * @var string
     */
    protected $gender;
    
    /**
     * @var string
     */
    protected $mobile;

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
     * @return integer
     */
    public function getGender() {
        return $this->gender;
    }
    
    /**
     * Sets the mobile value
     *
     * @param string $mobile
     * @return void
     * @api
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

}
?>