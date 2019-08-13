console.log("Start up");

document.getElementById("firstname").addEventListener('keypress', function(event) {
    if(event.key === 'Enter')  {
        document.getElementById("lastname").focus();
        console.log("Pressed enter");
        event.preventDefault();
    }
    console.log("Pressed");
});

document.getElementById("lastname").addEventListener('keypress', function(event) {
    if(event.key === 'Enter')  {
        document.getElementById("uuid").focus();
        event.preventDefault();
    }
});

document.getElementById("uuid").addEventListener('keypress', function(event) {
    if(event.key === 'Enter')  {
        document.getElementById("adminuuid").focus();
        event.preventDefault();
    }
});