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
