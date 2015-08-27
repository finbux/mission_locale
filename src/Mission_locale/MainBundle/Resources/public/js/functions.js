var map;
var panel;
var initialize;
var calculate;
var direction;
var infowindow;

initialize = function(){

  var pathImg = "http://lasson-jeremy.fr/mission_locale/web/bundles/main/img/";
  var latLng = new google.maps.LatLng(49.950005,2.312767);
  var iconBase = pathImg + "marker.png";
  var iconHome = pathImg + "marker_home.png";
  var iconBus =  pathImg + "marker_bus.png";
  var zoneMl;


  var map = new google.maps.Map(document.getElementById("map"),{
                  zoom : 9,
                  center : latLng,
                  mapTypeId : google.maps.MapTypeId.ROADMAP,
                  mapTypeControl: false,
                  minZoom :9

 });
  panel    = document.getElementById('panel');

    downloadUrl(Routing.generate('antenne_xml'), function(data) {

        var markers = data.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
            var latlng = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
                parseFloat(markers[i].getAttribute("lng")));

            var marker = createMarker(markers[i].getAttribute("nom"), latlng,markers[i].getAttribute("horaire"),markers[i].getAttribute("adresse"), markers[i].getAttribute("pathImg"));
        }
    });

    function createMarker(nom, latlng,horaire,adresse,pathImg) {
        var marker = new google.maps.Marker({position: latlng, map: map, icon: iconHome});
        google.maps.event.addListener(marker, "click", function() {
            if (infowindow) infowindow.close();

            var content ='<div id="marker">' +
                nom +
                '<p>'+ adresse +'</p>'+


                '<p>'+
                '<strong>Horaire d\'ouverture :</strong> <br>'+
                ''+ horaire +'</p>'+
            '</div>';


            infowindow = new google.maps.InfoWindow({content: content });
            infowindow.open(map, marker);
        });
        return marker;
    }

    /*var markers_home = [
        ['<div id="marker"><h2>Doullens</h2><img class="img_antennes" src="'+ pathImg +'img_doullens.png"><p>AGORA <br/>2, rue des Sœurs Grises <br/>80600 DOULLENS</p></div><p><strong>Horaires d\'ouverture :</strong><br/>Du Lundi au Jeudi : de 8h45 à 12h30 et de 13h30 à 17h30Le Vendredi : de 8h45 à 12h30</p>'
            , 50.156175, 2.338603],
        ['<div id="marker"><h2>Amiens Nord</h2><img class="img_antennes" src="'+ pathImg +'img_amiens_nord.png"><p>ATRIUM 39, avenue de la Paix 80080 AMIENS</p><p><strong>Horaires d\'ouverture :</strong><br/>Le Lundi : de 13h30 à 17h30 Du Mardi au Jeudi : de 8h45 à 12h30 et de 13h30 à 17h30 Le Vendredi : de 8h45 à 12h30 et de 13h30 à 16h30</p></div>', 49.911662, 2.306914],
        ['<div id="marker"><h2>Amiens Ouest</h2><img class="img_antennes" src="'+ pathImg +'img_amiens_ouest.png"><p>30, avenue de Picardie 80000 AMIENS</p><p><strong>Horaires d\'ouverture :</strong><br/>Lundi : de 13h30 à 17h30 Du Mardi au Jeudi : de 8h45 à 12h30 et de 13h30 à 17h30 Le Vendredi : de 8h45 à 12h30 et de 13h30 à 16h30</p></div>', 49.914321, 2.251011],
        ['<div id="marker"><h2>Amiens Sud et Est</h2><img class="img_antennes" src="'+ pathImg +'img_amiens_sud_est.png"><p>Pôle de Service – Tour du Marais Rue Simone Signoret 80090 AMIENS</p><p><strong>Horaires d\'ouverture :</strong><br/>Le Lundi : de 13h30 à 17h30 Du Mardi au Jeudi : de 8h45 à 12h30 et de 13h30 à 17h30 Le Vendredi : de 8h45 à 12h30 et de 13h30 à 16h30</p></div>', 49.874921, 2.334188],
        ['<div id="marker"><h2>Amiens Centre</h2><img class="img_antennes" src="'+ pathImg +'img_amiens_centre.png"><p>10, rue Gresset - BP 80419 <br/>80004 AMIENS Cedex 01</p><p><strong>Horaires d\'ouverture :</strong><br/>Le Lundi : de 13h30 à 17h30 Du Mardi au Jeudi : de 8h45 à 12h30 et de 13h30 à 17h30 Le Vendredi : de 8h45 à 12h30 et de 13h30 à 16h30</p></div>', 49.893954, 2.294438],
        ['<div id="marker"><h2>Poix-de-Picardie</h2><img class="img_antennes" src="'+ pathImg +'img_poix_de_picardie.png"><p>16, route d’Aumale 80290 POIX DE PICARDIE</p>' +
        '<p><strong>Horaires d\'ouverture :</strong><br/>Le Lundi : de 13h30 à 17h30 Du Mardi au Jeudi : de 8h45 à 12h30 et de 13h30 à 17h30 Le Vendredi : de 8h45 à 12h30 et de 13h30 à 16h30</p></div>', 49.778936, 1.977807],
    ];
    */
  var markers = [

  //['<div id="marker"><h2>Bernaville</h2></div>', 50.132574,2.163936],
  //['<div id="marker"><h2>Saint-Léger-lès-Domart</h2></div>', 50.054383,2.140261],
  //['<div id="marker"><h2>Flixecourt</h2></div>', 50.016399,2.080866],
  //['<div id="marker"><h2>Vignacourt</h2></div>', 50.015571,2.196895],
  //['<div id="marker"><h2>Villers-Bocage</h2></div>', 50.006415,2.319381],
  //['<div id="marker"><h2>Camon</h2></div>', 49.890874,2.343838],
  //['<div id="marker"><h2>Ailly-sur-Somme</h2></div>', 49.93034,2.199127],
  //['<div id="marker"><h2>Oisemont</h2></div>', 49.955804,1.765696],
  //['<div id="marker"><h2>Conty</h2></div>', 49.747556,2.151207],
  //['<div id="marker"><h2>Senarpont</h2></div>', 49.897731,1.716506],
  //['<div id="marker"><h2>Liomer</h2></div>', 49.858626,1.818138],
  ];

  var markers_bus = [
  //['<div id="marker"><h2>Airaines</h2></div>', 49.967675,1.943352],
  //['<div id="marker"><h2>Molliens-Dreuil</h2></div>', 49.886451,2.019226],
  //['<div id="marker"><h2>Picquigny</h2></div>', 49.94636,2.143165],
  //['<div id="marker"><h2>Quevauvillers</h2></div>', 49.827242,2.079479],
  //['<div id="marker"><h2>Plachy-Buyon</h2></div>', 49.819047,2.217667],
  //['<div id="marker"><h2>Longueau</h2></div>', 49.87738,2.35514],
  //['<div id="marker"><h2>Salouël</h2></div>', 49.872513,2.247549],
  //['<div id="marker"><h2>Boves</h2></div>', 49.848056,2.390015],
  //['<div id="marker"><h2>Villers-Bretonneux</h2></div>', 49.867644,2.520279],
  //['<div id="marker"><h2><h2>Corbie</h2></h2></div>', 49.910556,2.511894],
  ];



    var zoneMlCoords = [
        new google.maps.LatLng(50.236202, 2.413862),
        new google.maps.LatLng(50.204570, 2.092512),
        new google.maps.LatLng(49.983438, 1.934584),
        new google.maps.LatLng(49.945324, 1.941130),
        new google.maps.LatLng(49.936068, 1.882740),
        new google.maps.LatLng(49.991943, 1.767383),
        new google.maps.LatLng(49.980243, 1.646362),
        new google.maps.LatLng(49.933085, 1.646877),
        new google.maps.LatLng(49.786456, 1.767211),
        new google.maps.LatLng(49.702595, 1.849094),
        new google.maps.LatLng(49.719690, 1.932521),
        new google.maps.LatLng(49.710810, 2.034831),
        new google.maps.LatLng(49.698598, 2.260738),
        new google.maps.LatLng(49.657054, 2.421413),
        new google.maps.LatLng(49.672278, 2.529752),
        new google.maps.LatLng(49.756191, 2.509839),
        new google.maps.LatLng(49.764619, 2.452161),
        new google.maps.LatLng(49.816483, 2.437741),
        new google.maps.LatLng(49.849810, 2.645603),
        new google.maps.LatLng(49.940751, 2.699337),
        new google.maps.LatLng(49.988853, 2.600627),
        new google.maps.LatLng(50.042241, 2.573162),
        new google.maps.LatLng(50.009156, 2.461582),
        new google.maps.LatLng(50.050839, 2.407680),
        new google.maps.LatLng(50.088962, 2.424159),
        new google.maps.LatLng(50.109223, 2.376094),
        new google.maps.LatLng(50.163357, 2.403217),
        new google.maps.LatLng(50.180289, 2.448535),
        new google.maps.LatLng(50.201830, 2.491794),
    ];

    zoneMl = new google.maps.Polygon({
        paths: zoneMlCoords,
        strokeColor: '#97bf0d',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#97bf0d',
        fillOpacity: 0.35
    });

    zoneMl.setMap(map);


  /*var infowindow = new google.maps.InfoWindow(), marker_home, i;
               for (i = 0; i < markers_home.length; i++) {
                  marker_home = new google.maps.Marker({
                      position: new google.maps.LatLng(markers_home[i][1], markers_home[i][2]),
                      map: map,
                      icon: iconHome
                  });

                  google.maps.event.addListener(marker_home, 'click', (function(marker_home, i) {
                      return function() {
                          infowindow.setContent(markers_home[i][0]);
                          infowindow.open(map, marker_home);

                      }
                  })(marker_home, i));
              }
*/
  direction = new google.maps.DirectionsRenderer({
    map   : map,
    panel : panel
  });

};

calculate = function(){
    origin      = document.getElementById('origin').value; // Le point départ
    destination = document.getElementById('destination').value; // Le point d'arrivé
    if(origin && destination){
        var request = {
            origin      : origin,
            destination : destination,
            travelMode  : google.maps.DirectionsTravelMode.DRIVING // Mode de conduite
        }
        var directionsService = new google.maps.DirectionsService();
        directionsService.route(request, function(response, status){
            if(status == google.maps.DirectionsStatus.OK){
                direction.setDirections(response);
            }
        });
    }
};

initialize();
