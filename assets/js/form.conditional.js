/**
 * Form Field Choices
 *
 * Handles click events and changing the input
 * value for choice fields
 */
var FormConditionalGroup = function(elem) {
    this.elem = elem;
    this.json;
    this.condition = {};

    this.addEventListeners = function () {
        var fieldContainer = document.querySelector('.field-name-' + this.condition.field);
        var field = fieldContainer.querySelector('input, textarea, select');
        field.addEventListener('keyup', this.handleChange.bind(this));
        field.addEventListener('change', this.handleChange.bind(this));

        // Run on load once
        this.runCondition(field.value);
    }

    this.handleChange = function(event) {
        this.runCondition(event.target.value);
    }

    this.runCondition = function(value) {
        var condition = Boolean(false);

        switch(this.condition.operator) {
            case '=':
                condition = Boolean(value == this.condition.value);
                break;

            case '!=':
                condition = value != this.condition.value;
                break;

            case '>=':
                condition = value >= this.condition.value;
                break;

            case '<=':
                condition = value <= this.condition.value;
                break;

            case '>':
                condition = value > this.condition.value;
                break;

            case '<':
                condition = value < this.condition.value;
                break;
        }

        // Check condition is met
        if ( condition === true ) {
            this.elem.removeAttribute('hidden');
        } else {
            this.elem.setAttribute('hidden', true);
        }
    }

    this.init = function() {
        this.elem.setAttribute('hidden', true);
        this.json = this.elem.querySelector('[data-condition]').innerHTML.trim();
        this.condition = JSON.parse(this.json);
        this.addEventListeners();
    }

    this.init();

}

document.addEventListener('DOMContentLoaded', function() {
    var _fields, _instances = [];

    // Get all fields
    _fields = document.querySelectorAll('.field-group.--is-conditional');

    // Create Choices instance for each field
    for ( x = 0; x < _fields.length; x++ ) {
        _instances.push( new FormConditionalGroup(_fields[x]) );
    }

});
