<?php
/**
 *  Copyright notice
 *
 * (c) 2012 Guenter Sommer <sommer@agentur-milchmaedchen.de>
 *
 */

/**
 * Datetime service. Provides helper functions to convert date strings and timestamps.
 */
class Tx_Promoshop_Service_DateTimeService implements t3lib_Singleton {

   	/**
     * Returns a timestamp out from a given date string.
     *
     * @param string $date The date 
     * @return integer
     */
    public function getTimestampFromDate($date = NULL) {
    	if ($date !== NULL) {
	    	// Converting the datetimestrings into timestamps	    	
			$date = str_replace(array(" ", ":"), '.', $date);
			$date = t3lib_div::trimExplode('.', $date);

			$date[3] == '00' ? $date3 = '0' : $date3 = $date[3];
			$date[4] == '00' ? $date4 = '0' : $date4 = $date[4];
			
			strpos($date['0'], '0') == 0 ? $date0 = str_replace('0', '', $date[0]) : $date0 = $date[0];
			strpos($date['1'], '0') == 0 ? $date1 = str_replace('0', '', $date[1]) : $date1 = $date[1];
		
			$date = mktime(intval($date3),date('i',$date4),0,intval($date1),intval($date0),intval($date[2]));

			return $date;
		} else {
			return NULL;
		}
    }
    
    /**
     * Returns a date out from a given timestamp string.
     *
     * @param integer $timestamp The timestamp 
     * @return string The formatted date string
     */
    public function getDateFromTimestamp($timestamp = NULL) {
    	if ($timestamp !== NULL) {
	    	// Converting the datetimestrings into timestamps
			$date = date("d.m.Y H:s", $timestamp);

			return $date;
		} else {
			return NULL;
		}
    }

}

?>