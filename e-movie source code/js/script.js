// for navigation
//getting menu icon
var menu = document.getElementById('burgerMenu');
//getting drop down navigation bar
var nav =  document.getElementById('nav');  
//getting user register icon
var usericon = document.getElementById("user");

var loginReg = document.getElementById("loginLink");
//getting id of login form
var form = document.getElementById("login_form");



function responsive(){
        
        document.write("hello world");
        /*do something*/};

menu.onclick= function(){
    if(nav.className === "navbar"){
        nav.className += " navactive";
        menu.className += " toggle";
        menu.style.zIndex = "1";
        }
    else{
        nav.className = "navbar";
        menu.className = "icon";
        menu.style.zIndex="-1";
    }
}
//rotating user icon on click
function loginPopup(){
    if(usericon.className === "user"){
        usericon.className += " rotate_user";
        form.style.display = "block";

    }
    else{
        usericon.className = "user";
        form.style.display = "none";

    }
}

window.addEventListener("dblclick", function(event) {
    if (event.target == form) {
        usericon.className = "user";
        form.style.display = "none";    }
});

//>>>>>>>>>>>>>>>>>>>for body

// Slidding banner


var slideIndex,slides,dots,captionText;
function initGallery(){
    slideIndex = 0;
    slides=document.getElementsByClassName("imageHolder");
    slides[slideIndex].style.opacity=1;

    captionText=document.querySelector(".captionTextHolder .captionText");
    captionText.innerText=slides[slideIndex].querySelector(".captionText").innerText;

    //disable nextPrevBtn if slide count is one
    if(slides.length<2){
        var nextPrevBtns=document.querySelector(".leftArrow,.rightArrow");
        nextPrevBtns.style.display="none";
        for (i = 0; i < nextPrevBtn.length; i++) {
            nextPrevBtn[i].style.display="none";
        }
    }

    //add dots
    dots=[];
    var dotsContainer=document.getElementById("dotsContainer"),i;
    for (i = 0; i < slides.length; i++) {
        var dot=document.createElement("span");
        dot.classList.add("dots");
        dotsContainer.append(dot);
        dot.setAttribute("onclick","moveSlide("+i+")");
        dots.push(dot);
    }
    dots[slideIndex].classList.add("active");
}
initGallery();
function plusSlides(n) {
    moveSlide(slideIndex+n);
}
function moveSlide(n){
    var i;
    var current,next;
    var moveSlideAnimClass={
          forCurrent:"",
          forNext:""
    };
    var slideTextAnimClass;
    if(n>slideIndex) {
        if(n >= slides.length){n=0;}
        moveSlideAnimClass.forCurrent="moveLeftCurrentSlide";
        moveSlideAnimClass.forNext="moveLeftNextSlide";
        slideTextAnimClass="slideTextFromTop";
    }else if(n<slideIndex){
        if(n<0){n=slides.length-1;}
        moveSlideAnimClass.forCurrent="moveRightCurrentSlide";
        moveSlideAnimClass.forNext="moveRightPrevSlide";
        slideTextAnimClass="slideTextFromBottom";
    }

    if(n!=slideIndex){
        next = slides[n];
        current=slides[slideIndex];
        for (i = 0; i < slides.length; i++) {
            slides[i].className = "imageHolder";
            slides[i].style.opacity=0;
            dots[i].classList.remove("active");
        }
        current.classList.add(moveSlideAnimClass.forCurrent);
        next.classList.add(moveSlideAnimClass.forNext);
        dots[n].classList.add("active");
        slideIndex=n;
        captionText.style.display="none";
        captionText.className="captionText "+slideTextAnimClass;
        captionText.innerText=slides[n].querySelector(".captionText").innerText;
        captionText.style.display="block";
    }

}
var timer=null;
function setTimer(){
    timer=setInterval(function () {
        plusSlides(1) ;
    },3000);
}
setTimer();
function playPauseSlides() {
    var playPauseBtn=document.getElementById("playPause");
    if(timer==null){
        setTimer();
        playPauseBtn.style.backgroundPositionY="0px"
    }else{
        clearInterval(timer);
        timer=null;
        playPauseBtn.style.backgroundPositionY="-33px"
    }
}

//trailer
function openFrame(frameID){
    var card = document.getElementById(frameID);
    var text = document.getElementById("trailer-vid"+frameID);
    if(card.style.display === "none"){
        card.style.display = "block";
        if(text.textContent == "Watch Trailer"){
            text.innerHTML = "Close";
        }
        else{
            text.innerHTML = "Watch Trailer";
        }
    }
    else{
        card.style.display = "none";
        text.innerHTML = "Watch Trailer";

    }
}

//load page
function now_showing() {
    document.getElementById("content").innerHTML='<object type="text/html" data="pages/now_showing.php" ></object>';
}

function whatshot() {
    document.getElementById("content").innerHTML='<object type="text/html" data="pages/whats-hot.php" ></object>';
}

function comming_soon() {
    document.getElementById("content").innerHTML='<object type="text/html" data="pages/comming-soon.php" ></object>';
}




//Rating function
function rating(id){
    var star1,star2,star3,star4,star5, input;
    star1 = document.getElementById('rate-1');
    star2 = document.getElementById('rate-2');
    star3 = document.getElementById('rate-3');
    star4 = document.getElementById('rate-4');
    star5 = document.getElementById('rate-5');
    
    input = document.getElementById('star');
    choose = document.getElementById(id);

    if(choose == star1){
        input.value = 1;
        star1.style.color = "orange";       
        star2.style.color = "#3a3a3a";
        star3.style.color = "#3a3a3a";
        star4.style.color = "#3a3a3a";
        star5.style.color = "#3a3a3a";
    }
    if(choose == star2){
        input.value = 2;
        star1.style.color = "orange";
        star2.style.color = "orange";
        star3.style.color = "#3a3a3a";
        star4.style.color = "#3a3a3a";
        star5.style.color = "#3a3a3a";
    }
    if(choose == star3){
        input.value = 3;
        star1.style.color = "orange";
        star2.style.color = "orange";
        star3.style.color = "orange";      
        star4.style.color = "#3a3a3a";
        star5.style.color = "#3a3a3a";
        }
    if(choose == star4){
        input.value = 4;
        star1.style.color = "orange";
        star2.style.color = "orange";
        star3.style.color = "orange";
        star4.style.color = "orange";
        star5.style.color = "#3a3a3a";
    }
    if(choose == star5){
        input.value = 5;
        star1.style.color = "orange";
        star2.style.color = "orange";
        star3.style.color = "orange";
        star4.style.color = "orange";
        star5.style.color = "orange";
        }
}

//Registration function
