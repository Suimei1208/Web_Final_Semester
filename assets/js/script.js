var slides = document.querySelectorAll('.slide');
var btns = document.querySelectorAll('.btn');
let currentSlide = 1;

// Javascript cho image slider
var manualNav = function(manual){
    slides.forEach((slide) =>{
        slide.classList.remove('active');

        btns.forEach((btn) =>{
            btn.classList.remove('active');
        })
    })
    slides[manual].classList.add('active');
    btns[manual].classList.add('active');
}
btns.forEach((btn,i) => {
    btn.addEventListener("click",() =>{
        manualNav(i);
        currentSlide = i;
    })
})
//autoplay
var repeat = function(activeClass){
    let active = document.getElementsByClassName('active');
    let i = 1;

    var repeater = () =>{
        setTimeout(function(){

            slides[i].classList.add('active');
            btns[i].classList.add('active');
            i++;
            if(slides.length == i ){
                i = 0;
            }
            if(i >=slides.length){
                return;
            }
            repeater();
        },5000);

    }
    repeater();
}
repeat();

var headerHeight = document.querySelector('header').offsetHeight;
var mainHeight = document.querySelector('main').offsetHeight;
var totalHeight = headerHeight + mainHeight;
document.querySelector('footer').style.marginTop = 100 + totalHeight + 'px';
