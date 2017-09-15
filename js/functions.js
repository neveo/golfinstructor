// Default instructive message used in the form validation functions.
var DEFAULT_MSG = 'Please enter a value in this form field';

/** 
 * Display Biography, Career Highlights and Teaching Philosophy for Teaching
 * in the Teaching Pro Profile page, right now the content is hard coded but will
 * eventually be pulled from the database.  
 */
function switchMenu(obj) {
	var el = document.getElementById(obj);
	if ( el.style.display != "none" ) {
		el.style.display = 'none';
	}
	else {
		el.style.display = '';
	}
}

// Validation types.
var TEXT = 1;		// checks for empty string.
var NUMBER = 2; 	// checks for numeric entry.
var MONTH = 3; 		// checks that a number is in the range 0-11.
var DAY = 4;		// checks that a number is in the range 1-31.
var YEAR = 5;		// checks that a number is greater than 2000.
var CHECKED = 8;	// checks that a given checkbox is checked.
var SELECTED = 9;	// checks that a given menu has one or more items selected.

// Global variables for the edit page to maintain state.
var registeredFields = new Array();

/**
 * Register this form element for validation by the generic form validator.
 */
function registerField (displayName, fieldName, fieldType) {
	var validationObj = new Object();
	validationObj.displayName = displayName;
	validationObj.fieldName = fieldName;
	validationObj.fieldType = fieldType;
	registeredFields[registeredFields.length] = validationObj;
}

/** 
 * Validates any given form, checking for whether a form field exists before validating it.  
 */
function validateRegisteredFields (objForm) {  
	var arrEls = objForm.elements;
	var isValid = true;
	errorActionReset();
	for (var i = 0; i < registeredFields.length; i++) {
		var fieldEl = arrEls[registeredFields[i].fieldName];
		var fieldName = registeredFields[i].fieldName;
		var fieldValue = fieldEl.value;
		var displName = registeredFields[i].displayName;
		// alert("displName is: " + displName);
		switch (registeredFields[i].fieldType) {
			case SELECTED:
				isValid = false;
				for (var j = 0; j < fieldEl.options.length; j++) {
					if (fieldEl.options[j].selected) {
						isValid = true;
					}
				}
				if (!isValid) errorAction(fieldName, displName, 'Please select at least one option');
			break;	
					
			case TEXT:
				if (fieldEl != null && fieldValue == '') {
					errorAction(fieldName, displName);
					isValid = false;
				}	
			break;
			
			case NUMBER:
				if (fieldEl != null && isNaN(fieldValue)) {
					errorAction(fieldName, displName, 'This value is not numeric');
					isValid = false;
				}			
			break;			
			
			case MONTH:
				if (fieldEl != null && (parseInt(fieldValue) > 11 || parseInt(fieldValue) < 0) || isNaN(fieldValue)) {
					errorAction(fieldName, displName, 'This is not a valid month');
					isValid = false;
				}	
			break;
			
			case DAY:
				if (fieldEl != null && (parseInt(fieldValue) > 31 || parseInt(fieldValue) < 1) || isNaN(fieldValue)) {
					errorAction(fieldName, displName, 'This is not a valid day');
					isValid = false;
				}	
			break;
			
			case YEAR:
				if (fieldEl != null && (parseInt(fieldValue) < 2000 || isNaN(fieldValue))) {
					errorAction(fieldName, displName, 'This is not a valid year');
					isValid = false;
				}	
			break;
			
			case CHECKED:
				if (fieldEl != null && !fieldEl.checked) {
					errorAction(fieldName, displName, 'Please check the box');
					isValid = false;
				}	
			break;
						
		}
	}

	return isValid;
}


/**
 * Highlights the given span with bold red text.
 */
function errorAction (item, msg) {
	if (msg == null || msg == '') msg = DEFAULT_MSG;
	var spanEl = document.getElementById('label_' + item);
	spanEl.style.color = 'red';
	spanEl.title = msg;
}

/**
 * Resets all the spans to black and regular weight text.
 */
function errorActionReset () {
	for (var i = 0; i < document.getElementsByTagName('label').length; i++) {
		var spanEl = document.getElementsByTagName('label').item(i);
		if (spanEl.getAttribute('id') != null && spanEl.getAttribute('id').search('label_') != -1) {
			spanEl.style.color = '#555';
			spanEl.style.fontWeight = 'normal';
			spanEl.title = '';
		}
	}
}

/**
 * Prompts the customer as to really log out.
 */
function confirmLogout () {
	return confirmAction('Are you sure you want to log out?');
}

/**
 * Prompts the customer as to really log out.
 */
function confirmBuy () {
	return confirmAction('Are you sure you want to buy this vehicle?');
}

/**
 * Prompts the dealer as to really log out.
 */
function confirmDelete () {
	return confirmAction('Are you sure you want to delete this vehicle?');
}

/**
 * Generic, base confirmation window behavior
 */
function confirmAction (msg) {
	return confirm(msg);
}