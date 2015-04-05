<?php
/**
 *  Copyright notice
 *
 * (c) 2012 Guenter Sommer <sommer@agentur-milchmaedchen.de>
 *
 */

/**
 * Mail view helper. Sends emails and attaches files to the email
 * coming from TypoScript, Flexform and the Plugin content element.
 */
class Tx_Promoshop_ViewHelpers_Render_MailViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

    /**
	 * Render the supplied contents as an html email
	 *
	 * @param array $params
	 * @return void
	 */
    public function render($params = array()) {
    	$mail = t3lib_div::makeInstance('t3lib_mail_Message');
    	
    	$customer =	$params['newBooking'];
    	$customerMail = $customer['email'];
    	
    	if ($mail && t3lib_div::validEmail($customerMail)) {
    		
    		// Get the parameters
    		$baseUrl =		$params['baseUrl'];
			$shopName =		$params['shopName'];
			$adminMail =	$params['adminMail'];
			$mailImage =	$params['mailHeaderImage'];
			$mailFile = 	$params['filePath'] . $params['fileName'];
			$customerName = $customer['firstName'] . ' ' . $customer['lastName'];
			$customerGender = $customer['gender'];
			
			if (!empty($customerGender) && !empty($customer['lastName'])) {
				$customerGender == '1' ? $gender = 'Herr' : $gender = 'Frau';
				$customerFullName = ' ' . $gender . ' ' . $customer['lastName'];
			} else {
				$customerFullName = '';
			}

    		$mailText = 'Guten Tag' . $customerFullName . ',<br /><br />im Anhang finden Sie Ihre Bestellbestätigung.<br /><br />';
    		$mailText .= 'Damit Ihre Reservierung verbindlich wird, müssen Sie dieses Dokument ausdrucken und innerhalb von 5 Werktagen unterschrieben an die Nummer 030 - 13 89 34 27 faxen. ';
			$mailText .= 'Bitte bringen Sie Ihre unterschriebene Bestellbestätigung auch bei einer Abholung vor Ort mit.<br /><br />';
    		$mailText .= 'Beste Grüße<br /><br />Ihr Team der Vodafone-Promotionplattform<br />der Niederlassung Nord-Ost';
			
			$mailFooter = 'Vodafone GmbH<br />Niederlassung Nord-Ost<br />Attilastraße 61-67, 12105 Berlin<br /><br />';
			$mailFooter .= '+++ Dies ist eine automatisch generierte E-Mail. Bitte antworten Sie nicht an diese E-Mail-Adresse. +++';

    		if (is_file($mailImage)) {
    			$mailImage = $mail->embed(Swift_Image::fromPath($baseUrl . $mailImage));
    			$mailImage = '<img src="' . $mailImage . '" alt="Vodafone Promotionshop" />';
    		} else {
    			$mailImage = '';
    		}
    		
    		$mail->setFrom(array('noreply@vodafone-promotionshop.de' => 'Vodafone ' . $shopName));
    		$mail->setTo(array($customerMail => $customerName));
    		
    		if (t3lib_div::validEmail($adminMail)) {
    			$mail->setBcc(array($adminMail => 'Vodafone ' . $shopName));
    		}
    		
			$mail->setReturnPath($adminMail);
			$mail->setSubject('Ihre Bestellung der Vodafone Promotion-Materialien');
			$mail->setBody(
				'<html><head></head><body style="background-color: #e8e8e8;">
				<table border="0" cellspacing="0" cellpadding="0" align="center" style="width: 700px; margin-top: 20px; background-color: #ffffff; font-size: 12px !important;">
				<tr><td style="padding: 0px 0px 20px; margin: 0px; border: 0;">
				' . $mailImage . '
				</td></tr><tr><td style="padding: 10px;">'
				. nl2br($mailText) .
				'</td></tr><tr><td style="padding: 20px 10px; background-color: #dadada; color: #4d4d4d !important; border: 0;">'
				. nl2br($mailFooter) .
				'</td></tr>
				</table></body></html>',
				'text/html'
			);
			
			if (is_file($mailFile)) {
				$mail->attach(Swift_Attachment::fromPath($mailFile)->setFilename($params['fileName']));
				//$mail->addPart($mailtext.$mailfooter, 'text/plain');
				$sendMail = $mail->send();
				
				if ($sendMail > 0) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
    	}
    }
}

?>