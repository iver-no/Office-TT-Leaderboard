console.log("Start up");

$(document).on("keydown", "form input[type='text']", function(event) {
    if (event.key == "Enter") {
        event.preventDefault();
    }
});

