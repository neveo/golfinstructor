<?php
/**
* This class provides a namespace for the static functions which are used by the VMS view pages.
*
* PHP version 5
*
* @package    VMS
* @subpackage ViewUtil
* @author     Neveo Harrison <code@neveoo.com>
*/
class ViewUtilities {
	
	/**
	* The private constructor to ensure that this class is only used statically.
	*/	
	private function __construct() {}
	
	/**
	* Convert BLOB data for display.  We have to call this from a separate file to deal with headers.
	* 
	* @param mixed $blob The blob which to display.
	* @static 
	* @return void
	*/
	public static function displayPhoto($photo) 
	{
		header('Content-Type: ' . $photo->type);
		switch (DB_DC_TYPE) {
			case DB_DC_TYPE_IBM_DB2: 			echo pack('H*', bin2hex($photo->data));  break;
			case DB_DC_TYPE_DB2_UNIFIED_ODBC: 	echo pack('H*', bin2hex($photo->data));  break;
		}		
	}
	
	/**
	* Convert value to localized display.
	* 
	* @param mixed $value The currency value which to display.
	* @static 
	* @return void
	*/
	public static function displayCurrency($value) 
	{
		echo '$' . number_format($value);
	}	
	
	/**
	* Display current date.
	* 
	* @param string $format An optional format.
	* @static 
	* @return void
	*/
	public static function displayCurrentDate($format = '%m/%d/%Y') 
	{
		echo ViewUtilities::displayFormattedDate('now', $format);
	}	
	
	/**
	* Display date plus two weeks.
	* 
	* @param string $format An optional format.
	* @static 
	* @return void
	*/
	public static function displayFutureDate($format = '%m/%d/%Y') 
	{
		echo ViewUtilities::displayFormattedDate('+2 weeks', $format);
	}	
	
	/**
	* Display the given date in the format specified.
	* 
	* @param string $date The date that should be formatted.
	* @param string $format An optional format.
	* @static 
	* @return void
	*/
	public static function displayFormattedDate($date, $format = '%m/%d/%Y') 
	{
		echo strftime($format, strtotime($date));
	}	
	
	/**
	* Display the age for the given date.
	* 
	* @param string $date The date that should be formatted.
	* @param string $format An optional format, otherwise this echos 12/15/2006.
	* @static 
	* @return void
	*/
	public static function displayFormattedAge($date) 
	{
		$birthday = strftime('%Y%d%m', strtotime($date));
		$today = strftime('%Y%d%m', time());
      	echo (int)(($today - $birthday) / 10000);
	}	
	
	/**
	* Display the float value with the appropriate decimals.
	* 
	* @param string $handicap The date that should be formatted.
	* @static 
	* @return void
	*/
	public static function displayFormattedHandicap($handicap) 
	{
		if (is_float($handicap)) {
			echo number_format($handicap, 1);
		} else {
			echo number_format($handicap, 1);
		}
	}	
	
	/**
	* Display years in a dropdown.
	* 
	* @param int $selectedYear The year to start counting back down from until VEHICLE_YEARS_LIMIT.
	* @static 
	* @return void
	*/
	public static function displayYearsMenu($selectedYear) 
	{
		$startYear = date('Y');
		$endYear = date('Y') - VEHICLE_YEARS_LIMIT;
		
		echo '<option value="">--Select an option--</option>';
		for ($startYear; $startYear > $endYear; $startYear--) {
			if ($selectedYear == $startYear) {
				printf('<option value="%d" selected="selected">%d</option>', $startYear, $startYear);
			} else {
				printf('<option value="%d">%d</option>', $startYear, $startYear);
			}
		}
	}		
	
	/**
	* Display vehicle types in a dropdown.
	* 
	* @param string $selectedType The vehicle type to marked selected if it is in the list.
	* @static 
	* @return void
	*/
	public static function displayTypesMenu($selectedType) 
	{
		global $vehicleTypes;
		
		echo '<option value="">--Select an option--</option>';
		foreach ($vehicleTypes as $type) {
			if ($type == $selectedType) {
				printf('<option value="%s" selected="selected">%s</option>', $type, $type);
			} else {
				printf('<option value="%s">%s</option>', $type, $type);
			}
			
		}
	}	
	
	/**
	* Display vehicle colors in a dropdown.
	* 
	* @param string $selectedColor The color to marked selected if it is in the list.
	* @static 
	* @return void
	*/
	public static function displayColorsMenu($selectedColor) 
	{
		global $vehicleColors;
		
		echo '<option value="">--Select an option--</option>';
		foreach ($vehicleColors as $color) {
			if ($color == $selectedColor) {
				printf('<option value="%s" selected="selected">%s</option>', $color, $color);
			} else {
				printf('<option value="%s">%s</option>', $color, $color);
			}
			
		}
	}	

	/**
	* Display yes or no options in a dropdown.
	* 
	* @param string $selectedOption The option to marked selected if it is in the list.
	* @static 
	* @return void
	*/
	public static function displayYesNoMenu($selectedOption) 
	{
		$options = array('Y', 'N');
		
		echo '<option value="">--Select an option--</option>';
		foreach ($options as $option) {
			if ($option == $selectedOption) {
				printf('<option value="%s" selected="selected">%s</option>', $option, $option);
			} else {
				printf('<option value="%s">%s</option>', $option, $option);
			}
			
		}
	}	
	
	/**
	* Display vehicle doors in a dropdown.
	*
	* @param int $selectedDoors The number to marked selected if it is in the list.
	* @static 
	* @return void
	*/
	public static function displayDoorsMenu($selectedDoors) 
	{
		global $vehicleDoors;
		
		echo '<option value="">--Select an option--</option>';
		foreach ($vehicleDoors as $doors) {
			if ($doors == $selectedDoors) {
				printf('<option value="%s" selected="selected">%s</option>', $doors, $doors);
			} else {
				printf('<option value="%s">%s</option>', $doors, $doors);
			}
			
		}
	}	
	
}	