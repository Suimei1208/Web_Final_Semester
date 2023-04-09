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
var mainHeight = document.querySelector('main') ? document.querySelector('main').offsetHeight : null;
var totalHeight = headerHeight + (mainHeight || 0);
if(mainHeight){
    document.querySelector('footer').style.marginTop = 100+totalHeight + 'px';
}else{
    document.querySelector('footer').style.marginTop = 1500 + 'px';
}

function getPageList(totalPages,page,maxLength){
    function range(start,end){
        return Array.from(Array(end-start + 1),(_,i)=> i +start);
    }
    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth * 2 - 3)>>1;
    var rightWidth = (maxLength - sideWidth *2 - 3)>>1;

    if(totalPages <= maxLength){
        return range(1,totalPages);
    }

    if(page <= maxLength - sideWidth - 1 - rightWidth){
        return range(1,maxLength - sideWidth - 1).concat(0,range(totalPages - sideWidth + 1,totalPages));
    }

    if(page >= totalPages - sideWidth - 1 -rightWidth){
        return range(1,sideWidth).concat(0,range(totalPages - sideWidth - 1 - rightWidth -leftWidth,totalPages));
    }
    return range(1,sideWidth).concat(0,range(page- leftWidth,page+rightWidth),0,range(totalPages - sideWidth +1,totalPages));
}

$(function(){
    var numberOfItems = $(".card-content .card").length;
    var limitPerPage = 4;
    var totalPages = Math.ceil(numberOfItems/limitPerPage);
    var paginationSize = 7;
    var currentpage;

    function showPage(whichPage){
        if(whichPage <1 || whichPage > totalPages) return false;
        
        currentpage = whichPage;

        $(".card-content .card").hide().slice((currentpage - 1) *limitPerPage,currentpage * limitPerPage).show();
        $(".pagination li").slice(1,-1).remove();
        getPageList(totalPages,currentpage,paginationSize).forEach(item =>{
            $("<li>").addClass("page-item").addClass(item ? "current-page" : "dots")
                .toggleClass("active",item === currentpage).append($("<a>").addClass("page-link")
                    .attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next-page");
        });

        $(".previous-page").toggleClass("disable",currentpage ===1);
        $(".next-page").toggleClass("disable",currentpage ===totalPages);
        return true;
    }
    $(".pagination").append(
        $("<li>").addClass("page-item").addClass("previous-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Prev")),
        $("<li>").addClass("page-item").addClass("next-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Next"))

    );
    $(".card-content").show();
    showPage(1);
    $(document).on("click", ".pagination li.curent-page:not(.active)", function(){
        return showPage(+$(this).text());
    });
    $(".next-page").on("click",function(){
        return showPage(currentpage + 1);
    });
    $(".previous-page").on("click",function(){
        return showPage(currentpage - 1);
    });
});