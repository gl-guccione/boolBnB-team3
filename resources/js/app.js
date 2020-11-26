require('./bootstrap');

var places = require('places.js');

(function() {
  var placesAutocomplete = places({
    container: document.querySelector('#street_name'),
    templates: {
      value: function(suggestion) {
        return suggestion.name;
      }
    }
  }).configure({
    type: 'address'
  });
  placesAutocomplete.on('change', function resultSelected(e) {
    // document.querySelector('#form-address2').value = e.suggestion.administrative || '';
    document.querySelector('#city').value = e.suggestion.city || '';
    document.querySelector('#zip_code').value = e.suggestion.postcode || '';

   // completamento form indirizzo 
    document.getElementById('street_name').value = e.suggestion.name;
    document.getElementById('zip_code').value = e.suggestion.postcode;
    document.getElementById('city').value = e.suggestion.city;
    document.getElementById('lat').value = e.suggestion.latlng.lat;
    document.getElementById('lng').value = e.suggestion.latlng.lng;

  });
})();