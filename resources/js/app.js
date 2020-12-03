require('./bootstrap');

var places = require('places.js');

const $ = require('jquery');
const Handlebars = require("handlebars");

// functions

// algolia function for city
function algoliaCity() {
  var placesAutocomplete = places({
    container: document.querySelector('#city'),
    templates: {
      value: function(suggestion) {
        return suggestion.name;
      }
    }
  }).configure({
    type: 'city'
  });
  placesAutocomplete.on('change', function resultSelected(e) {
    document.querySelector('#city').value = e.suggestion.name || '';

    let latlng = e.suggestion.latlng.lat +","+ e.suggestion.latlng.lng;
    $("#data-algolia").val(latlng);
    $("#city").attr("data-algolia", latlng);
  });
}

// algolia function for address
function algoliaAddress() {
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
}

// opacity function (for carousel)
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

// carousel function
function carousel() {

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

// function getFlats (make an ajax request and get flats)
function getFlats(latlng){

  // selecting the checked options if they exist
  let countOptions = $('.form-check').children('div').length;
  let options = [];

  for (let i = 1; i <= countOptions; i++) {
    if ($('#checkbox_' + i).is(':checked')) {
      options.push(i);
    }
  }
  options = options.toString();

  // ajax request with the data from the form and options
  $.ajax({
    "url": "http://localhost:8000/api/geosearch",
    "method": "GET",
    "data": {
      "latlng": latlng,
      "radius": $("#algolia_radius").val(),
      "rooms": $("#rooms").val(),
      "beds": $("#beds").val(),
      "bathrooms": $("#bathrooms").val(),
      "options": options
    },
    success: function (data) {

      if (data.length != 0) {
      // sort object (rule)
      function compare( a, b ) {
        if ( a.distance_km < b.distance_km ){
          return -1;
        }
        if ( a.distance_km > b.distance_km ){
          return 1;
        }
        return 0;
      }

      // sort obj
      data.sort( compare );
      }

      printFlats(data);

    },
    error: function(error) {
        alert("Errore, controlla la ricerca!")
    }

  });
};

// function printFlats
function printFlats(data) {
  // removing the message "nessun risultato", and the old results
  $(".no-results").remove();
  $(".entry-flat").remove();

  // if results = 0, print "nessun risultato" - else, print the results inside #sponsored (if sponsored) or #not-sponsored (if not sponsored)
  if (data.length == 0) {

    let message = "<h2 class='no-results'> Nessun risultato </h2>"
    $("#results").append(message);

  } else {

    var source = document.getElementById("flat-template").innerHTML;
    var template = Handlebars.compile(source);

    for (var i = 0; i < data.length; i++) {
      let context = {
        'title': data[i].title,
        'description': data[i].description,
        'stars': data[i].stars,
        'price': data[i].price,
        'image': data[i].images[0].path
      }

      var html = template(context);
      if (data[i].sponsored) {
        $("#sponsored").append(html);
        $('.entry-flat').addClass('sponsored-flat');
      } else {
        $("#not-sponsored").append(html);
        $('.entry-flat').addClass('not-sponsored-flat');
      }
    }
  }
}

// function that check if all the required parameters are set (guest_search)
function checkParameters() {
  console.log($("#city").attr("data-algolia"));

  if ($("#city").attr("data-algolia") == "") {
    alert('inserisci una città!');
    return false;
  }
  if ($("#check_in").val() == "") {
    alert('inserisci una data di check-in!');
    return false;
  }
  if ($("#check_out").val() == "") {
    alert('inserisci una data di check-out!');
    return false;
  }
  if ($("#adults").val() == "" || $("#adults").val() < 1) {
    alert('inserisci il numero di ospiti!');
    return false;
  }

  return true;
}

// function that show map for flats

(function() {
  var placesAutocomplete = places({
    // appId: '<YOUR_PLACES_APP_ID>',
    // apiKey: '<YOUR_PLACES_API_KEY>',
    container: document.querySelector('#input-map')
  });

  var map = L.map('map-example-container', {
    scrollWheelZoom: false,
    zoomControl: false
  });

  var osmLayer = new L.TileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      minZoom: 1,
      maxZoom: 13,
      // attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
    }
  );

  var markers = [];

  map.setView(new L.LatLng(0, 0), 1);
  map.addLayer(osmLayer);

  placesAutocomplete.on('suggestions', handleOnSuggestions);
  placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
  placesAutocomplete.on('change', handleOnChange);
  placesAutocomplete.on('clear', handleOnClear);

  function handleOnSuggestions(e) {
    markers.forEach(removeMarker);
    markers = [];

    if (e.suggestions.length === 0) {
      map.setView(new L.LatLng(0, 0), 1);
      return;
    }

    e.suggestions.forEach(addMarker);
    findBestZoom();
  }

  function handleOnChange(e) {
    markers
      .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
          markers = [marker];
          marker.setOpacity(1);
          findBestZoom();
        } else {
          removeMarker(marker);
        }
      });
    console.log(e.suggestion.latlng);

  }

  function handleOnClear() {
    map.setView(new L.LatLng(0, 0), 1);
    markers.forEach(removeMarker);
  }

  function handleOnCursorchanged(e) {
    markers
      .forEach(function(marker, markerIndex) {
        if (markerIndex === e.suggestionIndex) {
          marker.setOpacity(1);
          marker.setZIndexOffset(1000);
        } else {
          marker.setZIndexOffset(0);
          marker.setOpacity(0.5);
        }
      });
  }

  function addMarker(suggestion) {
    var marker = L.marker(suggestion.latlng, {opacity: .4});
    marker.addTo(map);
    markers.push(marker);
  }

  function removeMarker(marker) {
    map.removeLayer(marker);
  }

  function findBestZoom() {
    var featureGroup = L.featureGroup(markers);
    map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
  }
})();
// _______________________________________________________________________________________________________________________________________________


jQuery(function() {

  // function to activate toast notifications
  $('.toast').toast('show');

  // loading algoliaCity inside home and search
  if($("#guest_home").length || $("#guest_search").length) {
    algoliaCity();
  }

  // functions to load inside homepage
  if ($("#guest_home").length) {
    carousel();
  }

  // functions to load inside search
  if ($("#guest_search").length) {

      // open filter div on click
      $('#filters').on('click', function() {
        $('.form-check').addClass('block').toggle();
      });

      // start getFlats on load page if the attribute 'data-algolia' is set
      if($('#city').attr('data-algolia') != '') {
        // TODO check if the required parameters is set
        if (checkParameters()) {
          getFlats($("#city").attr("data-algolia"));
        }
      }

      // start getFlats on button click
      $("#submitSearch").click(function() {
        // TODO check if the required parameters is set
        if (checkParameters()) {
          getFlats($("#city").attr("data-algolia"));
        }
      });

  }

  // function to load inside admin.flats.create
  if ($("#admin_flats_create").length) {
    algoliaAddress();
  }




































});
