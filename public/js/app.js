var app = {
  // On enregistre la clé ici pour ne pas la perdre
  gmapKey: 'AIzaSyCnH6B49jC0kShCZLi2-gIIrETsRquRVkw',
  init: function() {

    // On récupère le basePath
    app.basePath = $('body').data('path');

    // On cible le champs de recherche
    $('#search').on('keyup', app.searchEvent);

    // On cible le formulaire de création de compte
    // et on surveille l'envoi
    $('#signup').on('submit', app.signup);

    // On surveille la validation du formulaire
    // de connexion
    $('#login').on('submit', app.login);

    // On regarde si on doit créer une Google Map
    var maps = $('.map');
    if (maps.length > 0) app.showGoogleMaps();
  },
  // Affiche une Google Map
  showGoogleMaps: function() {

    // On récupère les adresses à afficher
    var address = $('.map').data('address');
    var userAddress = $('.map').data('user-address');

    // On récupère l'endroit où sera affiché
    // la Google Map (en version vanilla)
    var div = $('.map').get(0);

    // On affiche la map
    app.map = new google.maps.Map(div, {
      center: { lat: 0, lng: 0 },
      zoom: 15
    });

    // On affiche la map centrée sur l'évènement
    if (userAddress) app.getGps(userAddress, app.updateMap);
    app.getGps(address, app.updateMap);

    // On affiche le trajet
    if (userAddress) app.createRoadmap(userAddress, address);
  },
  // Affiche une map une fois qu'on a
  // bien geolocalisé l'adresse
  updateMap: function( lat, lng ) {

    // On centre la map
    app.map.setCenter({ lat:lat, lng:lng });

    // On ajoute un marker
    app.addMarker( lat, lng );
  },
  // Affiche un marker sur la map
  addMarker: function( lat, lng ) {

    new google.maps.Marker({
      map: app.map,
      position: { lat: lat, lng: lng }
    });
  },
  getGps: function( address, callback ) {

    // On crée le geocoder
    var geocoder = new google.maps.Geocoder();

    // On geocode l'adresse
    geocoder.geocode(
      { address: address },
      function(results) {

        // On récupère les coordonnées
        var coords = results[0].geometry.location;
        var lat = coords.lat();
        var lng = coords.lng();

        // On transmet les coordonnées à "createMap"
        callback(lat, lng);
        // app.createMap(lat, lng);
      }
    );
  },
  createRoadmap: function( startAddress, endAddress ) {

    var request = {
      origin: startAddress,
      destination: endAddress,
      travelMode: 'DRIVING'
    };

    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay = new google.maps.DirectionsRenderer();
    directionsDisplay.setMap(app.map);

    directionsService.route(request, function(result, status) {

      directionsDisplay.setDirections(result);
    });
  },
  // Envoie les informations de connexion au serveur
  // et affiche les erreurs éventuelles
  login: function( evt ) {

    // On empêche le rechargement de la page
    evt.preventDefault();

    // On récupère les données
    var email = $('#email').val();
    var password = $('#password').val();

    // On crée la requête AJAX
    $.ajax({
      url: app.basePath + '/login',
      method: 'post',
      data: {
        email: email,
        password: password
      },
      // On indique que la réponse du serveur
      // sera au format JSON
      dataType: 'json'
    })
      .done( app.showLoginErrors );
  },
  showLoginErrors: function( errors ) {

    if (errors.length === 0) {

      // Il n'y a pas d'erreur, les informations
      // du formulaire sont correctes, l'utilisateur
      // a bien été identifié => on redirige
      document.location = app.basePath + '/';
    }
    else {

      // On vide la liste des erreurs
      $('.errors').empty();

      // Il y a une erreur, on l'affiche
      // On crée la <div> qui contient le
      // message d'erreur
      $('<div>')
        .text( errors[0] )
        .addClass('alert alert-danger')
        .appendTo( '.errors' );
    }
  },
  // Envoie les données d'inscription au serveur
  // et affiche les erreurs éventuelles
  signup: function( evt ) {

    // On empêche le rechargement de la page
    evt.preventDefault();

    // On récupère les informations du formulaire
    var data = {};
    var temp = $(this).serializeArray();
    // On transforme le tableau en objet
    temp.forEach(function(item) {
      // item.name = nom du champs
      // item.value = valeur correspondante
      data[ item.name ] = item.value;
    });

    // On crée une requête AJAX qui envoie les
    // informations au serveur
    $.ajax(app.basePath + '/signup', {
      method: 'post',
      data: data,
      dataType: 'json'
    })
      .done(app.showSignupErrors);
  },
  // Affiche la liste des messages d'erreurs
  showSignupErrors: function( errors ) {

    // On vide la liste
    $('.errors').empty();

    if (errors.length === 0) {

      // L'utilisateur est bien inscrit
      // On redirige vers la page de connexion
      document.location = app.basePath + '/login';
      return;
    }

    errors.forEach(function( msg ) {

      $('<div>')
        .text(msg)
        .addClass('alert alert-danger')
        .appendTo( '.errors' );
    });

    // On remonte le scroll
    $('.errors').scrollTop(0);
  },
  // Recherche la liste des évènements
  // qui correspondent au texte saisi
  searchEvent: function() {

    // On récupère la valeur à rechercher
    var value = $(this).val();

    // On regarde si on a suffisament de
    // caractères pour faire la recherche
    if (value.length < 2) {

      // Pas assez de caractères, on masque la liste
      $('.search-results').hide();
      // On s'arrête là
      return;
    }

    // On fait la requête au serveur
    $.ajax( app.basePath + '/events/search', {
      method: 'post',
      data: { search: value },
      // On indique que la réponse sera en JSON
      dataType: 'json'
    })
      .done(app.showResults)
      .fail();
  },
  // Affiche la liste des évènements
  // correspondants à la recherche
  showResults: function( events ) {

    // On cible la liste de résultats
    var div = $('.search-results');
    var list = div.find('ul');

    // On vérifie qu'il y a bien des résultats
    if (events.length === 0) {

      // Aucun résultat, on masque la div
      div.hide();
      return;
    }

    // On vide la liste
    list.empty();

    // On parcours chaque évènement pour
    // l'insérer dans la liste
    events.forEach(function( ev ) {

      // On crée le <li>
      $('<li>')
        .text( ev.name )
        .addClass('list-group-item')
        .on('click', function() {

          // On redirige l'utilisateur vers
          // la page de l'évènement
          document.location = app.basePath + '/events/' + ev.id;
        })
        .appendTo( list );
    });

    // On affiche la liste
    div.show();
  }
};

$(app.init);
