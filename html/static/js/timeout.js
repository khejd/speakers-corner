function idleLogout() {
        let t = '';
        window.onload = resetTimer(t);
        window.onmousemove = resetTimer(t);
        window.onmousedown = resetTimer(t); // catches touchscreen presses
        window.onclick = resetTimer(t);     // catches touchpad clicks
        window.onscroll = resetTimer(t);    // catches scrolling with arrow keys
        window.onkeypress = resetTimer(t);
}

/** @param t*/
function resetTimer(t) {
    clearTimeout(t);
    t = window.setTimeout(redirect, 6000);  // time is in milliseconds
}

function redirect(){
    window.location.href = '/speak';
}
idleLogout();
