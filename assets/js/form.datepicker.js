document.addEventListener('DOMContentLoaded', function() {
    var datePickers = [], dateFields;

    // Get fields
    dateFields = document.querySelectorAll('[data-datepicker]');

    // Setup Pikaday on the date field
    for ( i = 0; i < dateFields.length; i++ ) {
        datePickers.push( new Pikaday({ field: dateFields[i] }) );
    }

});
