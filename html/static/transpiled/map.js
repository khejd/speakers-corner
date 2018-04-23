'use strict';

function getLocation() {
    var deferred = $.Deferred();
    $.ajax({
        url: '../handler/getGeolocationHandler.php',
        type: 'GET',
        dataType: 'json',
        success: function success(result) {
            coords = result;
            deferred.resolve();
        }
    });
    return deferred;
}