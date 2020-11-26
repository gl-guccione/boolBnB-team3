require('./bootstrap');
var places = require('places.js');
var jQuery = require('jquery')


(function() { 
  var placesAutocomplete = places({ 
    container: document.querySelector('#address') 
  });  
  var $address = document.querySelector('#address-value') 
    placesAutocomplete.on('change', function(e) { 
      $address.textContent = e.suggestion.value 
      console.log(e.suggestion.latlng); 
    });  
    placesAutocomplete.on('clear', function() { 
    $address.textContent = 'none'; 
  });  
})();
