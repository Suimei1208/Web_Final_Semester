
// Javascript cho image slider
var manualNav = function(manual){

        btns.forEach((btn) =>{
    });
}
btns.forEach((btn,i) => {
var repeat = function(activeClass){
    let active = document.getElementsByClassName('active');

    var repeater = () =>{
        setTimeout(function(){
                slides[j].classList.toggle('active', j === i);
                btns[j].classList.toggle('active', j === i);
            }
            currentSlide = i;
            slides[i].classList.add('active');
            btns[i].classList.add('active');
            i++;
            if (i >= slides.length) {
            if(slides.length == i ){
                i = 0;
            }
            }
            repeater();
};
        },5000);

// Start autoplay
}
repeat();

// var headerHeight = document.querySelector('header').offsetHeight;
// var mainHeight = document.querySelector('main').offsetHeight;
// var totalHeight = headerHeight + mainHeight ;
// if(mainHeight>1500){
//     document.querySelector('footer').style.marginTop = 1500+totalHeight + 'px';
// }else if(mainHeight<1100 && mainHeight >700){
//     document.querySelector('footer').style.marginTop = 2100 + 'px';
// }else if(mainHeight<700){
//     document.querySelector('footer').style.marginTop = 750 + 'px';
// }

function getPageList(totalPages, page, maxLength) {
    function range(start, end) {
      return Array.from(Array(end - start + 1), (_, i) => i + start);
    }
    var sideWidth = maxLength < 9 ? 1 : 2;
    var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
    var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;
  
    if (totalPages <= maxLength) {
      return range(1, totalPages);
    }
  
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
      return range(1, maxLength - sideWidth - 1).concat(range(totalPages - sideWidth + 1, totalPages));
    }
  
    if (page >= totalPages - sideWidth - 1 - rightWidth) {
      return range(1, sideWidth).concat(range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages));
    }
    return range(1, sideWidth).concat(
      range(page - leftWidth, page + rightWidth),
      range(totalPages - sideWidth + 1, totalPages)
    );
  }
  
  $(function () {
    var numberOfItems = $(".card-content .card").length;
    var limitPerPage = 16;
    var totalPages = Math.ceil(numberOfItems / limitPerPage);
    var paginationSize = 7;
    var currentPage;
  
    function showPage(whichPage) {
      if (whichPage < 1 || whichPage > totalPages) return false;
  
      currentPage = whichPage;
  
      $(".card-content .card")
        .hide()
        .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage)
        .show();
      $(".pagination li").slice(1, -1).remove();
      getPageList(totalPages, currentPage, paginationSize).forEach((item) => {
        $("<li>")
          .addClass("page-item")
          .addClass(item ? "current-page" : "dots")
          .toggleClass("active", item === currentPage)
          .append(
            $("<a>")
              .addClass("page-link")
              .attr({ href: "javascript:void(0)" })
              .text(item || "...")
          )
          .insertBefore(".next-page");
      });
  
      $(".previous-page").toggleClass("disable", currentPage === 1);
      $(".next-page").toggleClass("disable", currentPage === totalPages);
      return true;
    }
    $(".pagination").append(
      $("<li>")
        .addClass("page-item")
        .addClass("previous-page")
        .append($("<a>").addClass("page-link").attr({ href: "javascript:void(0)" }).text("Prev")),
      $("<li>")
        .addClass("page-item")
        .addClass("next-page")
        .append($("<a>").addClass("page-link").attr({ href: "javascript:void(0)" }).text("Next"))
    );
    $(".card-content").show();
    showPage(1);
    $(document).on("click", ".pagination li.current-page:not(.active)", function () {
      return showPage(+$(this).text());
    });
    $(".next-page").on("click", function () {
      return showPage(currentPage + 1);
    });
    $(".previous-page").on("click", function () {
      return showPage(currentPage - 1);
    });
  });
//tooltip
var spanText = document.getElementsByClassName('tooltip');

window.onmousemove = function(e) {
  var x = e.clientX,
      y = e.clientY;
  
  for (var i = 0; i < spanText.length; i++) {
    spanText[i].style.top = (y + 20) + 'px';
    spanText[i].style.left = (x + 20) + 'px';
  }
};
