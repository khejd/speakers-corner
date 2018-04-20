function getLocation(){
    let deferred = $.Deferred();
    $.ajax({
        url: '../handler/getGeolocationHandler.php',
        type: 'GET',
        dataType: 'json',
        success: (result) =>{
            coords = result;
            deferred.resolve();
        }
    });
    return deferred;
}
