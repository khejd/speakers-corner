if ('geolocation' in navigator){
    navigator.geolocation.getCurrentPosition((position) => {
        $.ajax({
            url: '../handler/geolocationHandler.php',
            type: 'POST',
            data: {
                longitude: position.coords.longitude,
                latitude: position.coords.latitude,
                accuracy: position.coords.accuracy
            },
        });
    });
}
