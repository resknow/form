/**
 * Form Field Choices
 *
 * Handles click events and changing the input
 * value for choice fields
 */
var FormFieldChoices = function(elem) {
    this.elem = elem;
    this.choices = null;
    this.input = null;
    this.currentChoice = null;

    // Get Choices
    this.getChoices = function() {
        this.choices = ( NodeList.prototype.isPrototypeOf(this.choices) ? this.choices : this.elem.querySelectorAll('.field-type-choices__button') );
    }

    // Add Event Listeners
    this.addEventListeners = function() {

        // Get buttons
        var buttons = this.choices;

        // Attach event listeners to each button
        for ( i = 0; i < buttons.length; i++ ) {
            buttons[i].addEventListener('click', this.selectChoice.bind(this));
        }

    }

    // Select Choice Handler
    this.selectChoice = function( event ) {
        event.preventDefault();
        var _this, value, choices;

        // Get target
        _this = event.target;

        // Get all choices
        choices = this.choices;

        // Get choice value
        value = _this.getAttribute('data-value');

        // If this choice is not already selected
        if ( this.currentChoice != value ) {

            // Clear choice styles
            for ( i = 0; i < choices.length; i++ ) {
                choices[i].classList.remove('is-selected');
            }

            // Update choice
            this.currentChoice = value;
            this.input.value = value;

            // Update style
            _this.classList.add('is-selected');

        }

    }

    // Get Input
    this.getInput = function() {
        this.input = this.elem.querySelector('input');
    }

    // Init
    this.init = function() {
        this.getChoices()
        this.addEventListeners();
        this.getInput();
    }

    // Run Init
    this.init();
}

document.addEventListener('DOMContentLoaded', function() {
    var _fields, _instances = [];

    // Get all fields
    _fields = document.querySelectorAll('.field-type-choice');

    // Create Choices instance for each field
    for ( x = 0; x < _fields.length; x++ ) {
        _instances.push( new FormFieldChoices(_fields[x]) );
    }

});
