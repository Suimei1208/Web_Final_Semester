// //daynight
// const modeSwitch = document.getElementById('mode-switch');
// modeSwitch.addEventListener('change', () => {
//   document.body.classList.toggle('dark');
// });
const header = document.querySelector('.header');        
  window.addEventListener('scroll', () => {
  if (window.scrollY > 50) {
      header.classList.add('header-scrolled');
  } else {
      header.classList.remove('header-scrolled');
  }
});
var slides = document.querySelectorAll('.slide');
var btns = document.querySelectorAll('.btn');
let currentSlide = 1;

var manualNav = function(manual){
    slides.forEach((slide) =>{
        slide.classList.remove('active');

        btns.forEach((btn) =>{
            btn.classList.remove('active');
        });
    });
    slide[manual].classList.add('active');
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
function scrollToTop(){
  window.scrollTo(0,0);
}
//Dropdown Login

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn-Log')) {
    var dropdowns = document.getElementsByClassName("dropdown-content-Log");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
function changeIcon() {
  // Check if user is logged in
  if (isLoggedIn()) {
    // Add bookmark logic here
    showAlert('Page bookmarked!', 'success');
  } else {
    showAlert('Please log in to bookmark this page.', 'error');
    return;
  }
  
  var icon = document.getElementById('bookmark-icon');

  if (icon.classList.contains('fa-bookmark')) {
    icon.classList.remove('fa-bookmark');
    icon.classList.add('fa-times-circle');
    document.getElementById('bookmark-button').textContent = 'REMOVE BOOKMARK';
  } else {
    icon.classList.remove('fa-times-circle');
    icon.classList.add('fa-bookmark');
    document.getElementById('bookmark-button').textContent = 'BOOKMARK';
  }
}
function showAlert(message, type) {
  const alertDiv = document.createElement('div');
  alertDiv.classList.add('alert', `alert-${type}`);
  alertDiv.textContent = message;

  document.body.appendChild(alertDiv);

  setTimeout(() => {
    alertDiv.remove();
  }, 2000);
}

function isLoggedIn() {
  // Replace this with your own logic to check if the user is logged in
  return true; // Return true if the user is logged in, false otherwise
}
function myresponsive() {
  var x = document.getElementById("myTopnav");
  if (x.className === "navigation") {
    x.className += " responsive";
  } else {
    x.className = "navigation";
  }
}
function myFunction() {
  console.log("Button clicked!");
  var caretIcon = document.querySelector('.fa-solid');
  var dropdownMenu = document.getElementById("myDropdown");
  
  if (caretIcon.classList.contains('fa-caret-up')) {
    caretIcon.classList.remove('fa-caret-up');
    caretIcon.classList.add('fa-caret-down');
    dropdownMenu.classList.remove('show');
  } else {
    caretIcon.classList.remove('fa-caret-down');
    caretIcon.classList.add('fa-caret-up');
    dropdownMenu.classList.toggle('show');
  }
}
function changeImage() {
  const fileInput = document.getElementById('file-input');
  const image = document.getElementById('image');

  fileInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = (event) => {
      image.src = event.target.result;
    }
    reader.readAsDataURL(file);
  });
}






   
