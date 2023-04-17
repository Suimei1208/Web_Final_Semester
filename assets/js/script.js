var slides = document.querySelectorAll('.slide');
var btns = document.querySelectorAll('.btn');
let currentSlide = 1;

// Javascript cho image slider
var manualNav = function(manual){
    slides.forEach((slide) =>{
        slide.classList.remove('active');

        btns.forEach((btn) =>{
            btn.classList.remove('active');
        });
    });
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
            [...active].forEach((activeSlide) =>{
                activeSlide.classList.remove('active');
            });
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
$(document).ready(function() {
	// load existing comments
	loadComments();

	// add event listener for form submission
	$("#comment-form").submit(function(e) {
		e.preventDefault();
		var name = $("#name").val();
		var comment = $("#comment").val();
		if (name.trim() === "" || comment.trim() === "") {
			alert("Please enter your name and comment.");
			return;
		}
		var date = new Date();
		var timestamp = date.getTime();
		var newComment = {
			name: name,
			comment: comment,
			timestamp: timestamp
		};
		var comments = getComments();
		comments.push(newComment);
		saveComments(comments);
		displayComment(newComment);
		$("#comment-form")[0].reset();
	});

	// function to load existing comments from localStorage
	function getComments() {
		var comments = localStorage.getItem("comments");
		if (comments === null) {
			return [];
		} else {
			return JSON.parse(comments);
		}
	}

	// function to save comments to localStorage
	function saveComments(comments) {
		localStorage.setItem("comments", JSON.stringify(comments));
	}

	// function to display a comment on the page
	function displayComment(comment) {
		var date = new Date(comment.timestamp);
		var dateString = date.toLocaleString();
		var commentHtml = '<div class="comment">' +
			'<p><span class="comment-author">' + comment.name + '</span>' +
			'<span class="comment-date">' + dateString + '</span></p>' +
			'<p>' + comment.comment + '</p>' +
			'</div>';
		$("#comments-container").append(commentHtml);
	}

	// function to load existing comments and display them on the page
	function loadComments() {
		var comments = getComments();
		for (var i = 0; i < comments.length; i++) {
			displayComment(comments[i]);
		}
	}
});