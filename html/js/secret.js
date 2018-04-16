// This is a superDuperSecret
const SECRET = 'superDuperSecret';

if (!localStorage.getItem('secret')){
    let password = prompt('Do you know the secret password?');
    // TODO: serverside handling
    if (password !== SECRET) {
        window.location.replace('comments.html');
    } else {
        localStorage.setItem('secret', 'you know my secret');
    }
}
