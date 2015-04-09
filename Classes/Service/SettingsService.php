<?php
namespace Guso\Promoshop\Service;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 *  Copyright notice
 *
 * (c) 2012 Guenter Sommer <sommer@agentur-milchmaedchen.de>
 *
 */

/**
 * Settings service. Provides access to the plugin settings
 * coming from TypoScript, Flexform and the Plugin content element.
 */
class SettingsService implements \TYPO3\CMS\Core\SingletonInterface {

   	/**
	 * Initializes the configuration manager interface
	 *
	 * @return void
	 */
    public function init() {
        $objectManager = GeneralUtility::makeInstance('\TYPO3\CMS\Extbase\Object\ObjectManager');
		$configurationManager = $objectManager->get('\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface');
		
		$this->frameworkConfiguration = $configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
		);
    }

    /**
     * Returns all persistance settings.
     *
     * @return array
     */
    public function getPersistanceSettings() {
    	$this->init();
        $this->persistence = $this->frameworkConfiguration['persistence'];

        return $this->persistence;
    }

}

?>