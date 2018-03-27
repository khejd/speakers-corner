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
    t = setTimeout(logout(), 30000);  // time is in milliseconds
}

function logout() {
    window.location.href = '../index.html';
}

idleLogout();
