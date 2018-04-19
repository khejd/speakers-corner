function idleTimer() {
    let t;
    window.onload = resetTimer;
    window.onmousemove = resetTimer; // catches mouse movements
    window.onmousedown = resetTimer; // catches mouse movements
    window.onclick = resetTimer;     // catches mouse clicks
    window.onscroll = resetTimer;    // catches scrolling
    window.onkeypress = resetTimer;  //catches keyboard actions

    function redirect(){
        window.location.href = '/speak';
    }

    function resetTimer() {
        clearTimeout(t);
        t = setTimeout(redirect, 45000);  // time is in milliseconds (1000 is 1 second)
    }
}
idleTimer();
