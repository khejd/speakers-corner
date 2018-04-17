$(() =>{
   let location = '';
   let deferred = getLocation();
   deferred.then(() =>{
      let lat = location['latitude'];
      let lng = location['longitude'];
      initMap(lat, lng);
   });
});


function getLocation(){
    let deferred = $.Deferred();
    $.ajax({
        url: '../handler/getGeolocationHandler.php',
        type: 'GET',
        success: (result) =>{
            location = JSON.parse(result);
            deferred.resolve();
        }
    });
    return deferred;
}

function initMap(lat, lng) {
    let uluru = {lat: lat, lng: lng};
    let map = new google.maps.Map($('#map'), {
        zoom: 12,
        center: uluru
    });
    let marker = new google.maps.Marker({
        position: uluru,
        map: map
    });
}
