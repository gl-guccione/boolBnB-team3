require('./bootstrap');

var places = require('places.js');

const $ = require('jquery');


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

animation();

function opacity() {
  let count = 0;
  setInterval(function() {
        if (count == 9) {
          clearInterval();
        } else {
        count ++;
        $(".photo-carousel.active").css({opacity: "0."+count});
      }
  }, 100);
}

// images slider home guest page
function animation() {

  let x = "a";
  setInterval(function() {
    if (x == "a") {
      $("#first-img").removeClass("first");

      $(".photo-carousel").removeClass("active");
      $("#second-img").addClass("active");

      opacity();
      x = "b";
    } else if (x == "b") {
      $(".photo-carousel").removeClass("active");
      $("#third-img").addClass("active");

      opacity();
      x = "c";
    } else if (x == "c") {
      $(".photo-carousel").removeClass("active");
      $("#fourth-img").addClass("active");

      opacity();
      x = "d";
    } else if (x == "d") {
      $(".photo-carousel").removeClass("active");
      $("#first-img").addClass("active");

      opacity();
      x = "a";
    }
  }, 10000);
}
