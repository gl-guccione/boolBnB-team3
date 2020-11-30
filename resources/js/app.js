require('./bootstrap');

var places = require('places.js');

const $ = require('jquery');
const Handlebars = require("handlebars");

jQuery(function() {

  // algolia input search
  // (function() {
  //   var placesAutocomplete = places({
  //     container: document.querySelector('#street_name'),
  //     templates: {
  //       value: function(suggestion) {
  //         return suggestion.name;
  //       }
  //     }
  //   }).configure({
  //     type: 'address'
  //   });
  //   placesAutocomplete.on('change', function resultSelected(e) {
  //     // document.querySelector('#form-address2').value = e.suggestion.administrative || '';
  //     document.querySelector('#city').value = e.suggestion.city || '';
  //     document.querySelector('#zip_code').value = e.suggestion.postcode || '';

  //   // completamento form indirizzo
  //     document.getElementById('street_name').value = e.suggestion.name;
  //     document.getElementById('zip_code').value = e.suggestion.postcode;
  //     document.getElementById('city').value = e.suggestion.city;
  //     document.getElementById('lat').value = e.suggestion.latlng.lat;
  //     document.getElementById('lng').value = e.suggestion.latlng.lng;

  //   });
  // })();

  // TODO load function only inside homepage
  // animation();

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


  if($("#SearchPage").length) {
      // algolia input search
      (function() {
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

          $("#city").attr("data-algolia", e.suggestion.latlng.lat +","+ e.suggestion.latlng.lng);
        });
      })();

      function getFlats(){
        $.ajax({
          "url": "http://localhost:8000/api/geosearch",
          "method": "GET",
          "data": {
            "latlng": $("#city").attr("data-algolia"),
            "radius": $("#algolia_radius").val(),
            "rooms": $("#rooms").val(),
            "beds": $("#beds").val(),
            "bathrooms": $("#bathrooms").val(),
          },
          success: function (data) {

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

            if (data.length == 0) {
              let message = "<h2 class='no-results'> Nessun risultato </h2>"
              $("#results").append(message);
            } else {
              var source = document.getElementById("flat-template").innerHTML;
              var template = Handlebars.compile(source);
              $(".no-results").remove();
              $(".entry-flat").remove();

              for (var i = 0; i < data.length; i++) {
                console.log(data[i].images[0].path);

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
                }
              }
            }

          },
          error: function(error) {
              alert("Errore, controlla la ricerca!")
          }

        });
      };

      if($('#city').attr('data-algolia') != '') {
        // TODO check if the required parameters is set
        getFlats();
      }


      $("#submitSearch").click(function() {
        // TODO check if the required parameters is set
        getFlats();
      });
  };


  if($("#HomePage").length) {
    (function() {
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

        $("#data-algolia").val(e.suggestion.latlng.lat +","+ e.suggestion.latlng.lng);
      });
    })();
  }























});
