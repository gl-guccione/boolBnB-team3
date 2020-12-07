require('./bootstrap');

var places = require('places.js');

const $ = require('jquery');
const Handlebars = require("handlebars");
const moment = require("moment");
const slick = require("slick-carousel");

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
        'image': data[i].images[0].path,
        'link': data[i].link
      }

      var html = template(context);
      if (data[i].sponsored) {
        $("#sponsored").append(html);
        $('.card_container').addClass('sponsored-flat');
      } else {
        $("#not-sponsored").append(html);
        $('.card_container').addClass('not-sponsored-flat');
      }
    }
  }
}

// function that check if all the required parameters are set (guest_search)
function checkParameters() {

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

// _______________________________________________________________________________________________________________________________________________


jQuery(function() {

  // function to activate toast notifications adn tooltips
  $('.toast').toast('show');
  $('[data-toggle="tooltip"]').tooltip()

  // loading algoliaCity and function to check "check-in and check-out" inside home and search
  if($("#guest_home").length || $("#guest_search").length) {

    algoliaCity();

    $("#check_in").change(function () {

      let checkInValue = $("#check_in").val();
      let checkOut = moment($("#check_out").val());
      let endDate = moment(checkInValue).add(1, 'days');
      let endDateSet = endDate.format('YYYY-MM-DD');

      $("#check_out").attr('min', endDateSet);

      if (checkOut.isBefore(endDate)) {
        $("#check_out").val(endDateSet);
      }

    });
  }

  // functions to load inside homepage
  if ($("#guest_home").length) {

    $('.carousel').slick({
      infinite: true,
      arrows: false,
      autoplay: true,
      lazyLoad: 'progressive',
      adaptiveHeight: true,
      autoplaySpeed: 6000
    });

    $("#children").change(function() {
      if (($("#children").val() > 0) && ($("#adults").val() == "")) {
        $("#adults").val(1);
        alert('inserire almeno un adulto!');
      }
    })

  }

  // functions to load inside search
  if ($("#guest_search").length) {

      // open filter div on click
      $('#filters').on('click', function() {
        $('.form-check').addClass('block').toggle();
      });

      // start getFlats on load page if the attribute 'data-algolia' is set
      if($('#city').attr('data-algolia') != '') {
        if (checkParameters()) {
          getFlats($("#city").attr("data-algolia"));
        }
      }

      // start getFlats on button click
      $("#submitSearch").click(function() {
        if (checkParameters()) {
          getFlats($("#city").attr("data-algolia"));
        }
      });

  }

  // function to load inside admin.flats.create and admin.flats.edit
  if ($("#admin_flats_create").length || $("#admin_flats_edit").length) {
    algoliaAddress();
  }




































});
