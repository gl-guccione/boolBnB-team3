require('./bootstrap');
var places = require('places.js');
var jQuery = require('jquery');


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

$("#sponsored-flats").on("mouseenter", ".box_flat",
  function (){
    $(this).find(".overlay").slideDown();

  });

  $("#sponsored-flats").on("mouseleave", ".box_flat",
  function (){
    $(this).find(".overlay").hide();
  });
