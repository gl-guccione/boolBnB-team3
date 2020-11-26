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

function changeMargin() {
  let count = 0;
  setInterval(function() {
        if (count == 9) {
          clearInterval();
        } else {
        count ++;
        $(".photo-carousel.active").css({opacity: "0."+count});
      }
  }, 200);
  }

/*function opacity() {
  let count = 9;
  setInterval(function() {
        if (count == 0) {
          clearInterval();
        } else {
        count--;
        $(".photo-carousel.active").css({opacity: "0."+count});
      }
  }, 100);
}*/

// images slider home guest page
function animation() {

  let x = "a";
  setInterval(function() {
    if (x == "a") {
      $("#first-img").removeClass("first");

      $(".photo-carousel").removeClass("active");
      $("#second-img").addClass("active");
    
      changeMargin();
      x = "b";
    } else if (x == "b") {
      $(".photo-carousel").removeClass("active");
      $("#third-img").addClass("active");
    
      changeMargin();
      x = "c";
    } else if (x == "c") {
      $(".photo-carousel").removeClass("active");
      $("#fourth-img").addClass("active");
    
      changeMargin();
      x = "d";
    } else if (x == "d") {
      $(".photo-carousel").removeClass("active");
      $("#first-img").addClass("active");
    
      changeMargin();
      x = "a";
    } 
  }, 10000);
}