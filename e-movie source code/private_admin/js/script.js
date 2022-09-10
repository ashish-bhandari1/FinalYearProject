var close = document.getElementById('close');
var help = document.getElementById('helpBox');
var openx = document.getElementById('open');
var errClose = document.getElementById('errorClose');
var error = document.getElementById('ermsg');

function display(){
    error.style.display = "none";    
}

close.onclick = function(){
        help.style.display = "none";
    
}
openx.onclick = function(){
    help.style.display = "block";

}
errClose.onclick = function(){
    error.style.display = "none";
}

window.addEventListener("dblclick", function(event) {
    if (event.target == help) {
        help.style.display = "none";
    }
});

//for dashboard menu

