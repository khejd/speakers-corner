'use strict';

// This is a superDuperSecret
var SECRET = 'superDuperSecret';

if (!localStorage.getItem('secret')) {
    var password = prompt('Do you know the secret password?');
    // TODO: serverside handling
    if (password !== SECRET) {
        window.location.replace('../');
    } else {
        localStorage.setItem('secret', 'you know my secret');
    }
}