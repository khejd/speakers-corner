function getLocation(){
    let deferred = $.Deferred();
    $.ajax({
        url: '../handler/getGeolocationHandler.php',
        type: 'GET',
        success: (result) =>{
            coords = JSON.parse(result);
            deferred.resolve();
        }
    });
    return deferred;
}

function initMap() {
    let coords = '';
    let deferred = getLocation();
    deferred.then(() => {
        let lat = coords['latitude'];
        let lng = coords['longitude'];
        let uluru = {lat: lat, lng: lng};
        let map = new google.maps.Map($('#map'), {
            zoom: 12,
            center: uluru
        });
        let marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    });
}
