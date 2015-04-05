<?php
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
class Tx_Promoshop_Service_SettingsService implements t3lib_Singleton {

   	/**
	 * Initializes the configuration manager interface
	 *
	 * @return void
	 */
    public function init() {
        $objectManager = t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');
		$configurationManager = $objectManager->get('Tx_Extbase_Configuration_ConfigurationManagerInterface');
		
		$this->frameworkConfiguration = $configurationManager->getConfiguration(
			Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
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