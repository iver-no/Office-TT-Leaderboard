window.onload = function(){
    if(!!$.cookie("display-mode")){
        console.log($.cookie("display-mode"));
        if($.cookie("display-mode") == "light-mode"){
            console.log("light-mode");
            var body = document.getElementById("body");
            body.className = "light-mode";
            document.getElementById("display-switch").checked = false;
            return;
        }            
        if($.cookie("display-mode") == "dark-mode"){
            console.log("dark-mode");
            var body = document.getElementById("body");
            body.className = "dark-mode";
            document.getElementById("display-switch").checked = true;
            return;
        }
        
    } else {
        var CookieSet = $.cookie("display-mode","light-mode");
    }
}