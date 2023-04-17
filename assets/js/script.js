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
// Lấy ra form comment và các input field
const commentForm = document.querySelector('#comment-form');
const nameInput = document.querySelector('#name');
const commentInput = document.querySelector('#comment');

// Lấy ra danh sách các bình luận
const commentList = document.querySelector('#comment-list');

// Khi người dùng submit form comment
commentForm.addEventListener('submit', (event) => {
  event.preventDefault(); // Ngăn chặn form submit mặc định

  // Lấy giá trị từ input field
  const nameValue = nameInput.value;
  const commentValue = commentInput.value;

  // Tạo một thẻ li mới chứa nội dung bình luận
  const commentLi = document.createElement('li');
  commentLi.classList.add('comment-item');
  commentLi.innerHTML = `
    <div class="comment-details">
      <div class="user-details">
        <img src="https://via.placeholder.com/50" alt="User avatar">
        <h3>${nameValue}</h3>
      </div>
      <p class="comment-text">${commentValue}</p>
      <div class="comment-actions">
        <button class="like-button">Like</button>
        <button class="dislike-button">Dislike</button>
        <button class="reply-button">Reply</button>
      </div>
      <ul class="comment-replies"></ul>
    </div>
  `;

  // Thêm bình luận vào danh sách
  commentList.appendChild(commentLi);

  // Reset form
  commentForm.reset();
});

// Khi người dùng nhấn nút Reply
commentList.addEventListener('click', (event) => {
  if (event.target.classList.contains('reply-button')) {
    const commentDetails = event.target.closest('.comment-details');

    // Tạo một form reply mới
    const replyForm = document.createElement('form');
    replyForm.classList.add('reply-form');
    replyForm.innerHTML = `
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="comment">Comment</label>
        <textarea id="comment" name="comment" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <button type="submit">Submit</button>
      </div>
    `;

    // Tạo một thẻ li mới chứa form reply và thêm vào danh sách reply
    const replyLi = document.createElement('li');
    replyLi.classList.add('comment-reply');
    replyLi.appendChild(replyForm);
    commentDetails.querySelector('.comment-replies').appendChild(replyLi);

    // Focus vào input field Name của form reply
    replyForm.querySelector('#name').focus();

    // Xóa nút Reply và hiển thị nút Close form reply
    event.target.style.display = 'none';
    const closeReplyButton = document.createElement('button');
    closeReplyButton.classList.add('close-reply-button');
    closeReplyButton.innerText = 'Close';
    commentDetails.querySelector('.comment-actions').appendChild(closeReplyButton);

    // Khi người dùng nhấn nút Close form reply
closeReplyButton.addEventListener('click', () => {
  // Xóa form reply
  replyLi.remove();

  // Hiển thị lại nút Reply
  event.target.style.display = 'block';

  // Xóa nút Close form reply
  closeReplyButton.remove();
});
}
});

// Khi người dùng nhấn nút Like hoặc Dislike
commentList.addEventListener('click', (event) => {
if (event.target.classList.contains('like-button')) {
const commentDetails = event.target.closest('.comment-details');
const likeButton = commentDetails.querySelector('.like-button');
const dislikeButton = commentDetails.querySelector('.dislike-button');
const likeCount = commentDetails.querySelector('.like-count');
const dislikeCount = commentDetails.querySelector('.dislike-count');
// Tăng số lượt thích và giảm số lượt không thích nếu đã thích trước đó
if (likeButton.classList.contains('active')) {
  likeButton.classList.remove('active');
  likeCount.innerText = parseInt(likeCount.innerText) - 1;
} else {
  likeButton.classList.add('active');
  dislikeButton.classList.remove('active');
  likeCount.innerText = parseInt(likeCount.innerText) + 1;
  dislikeCount.innerText = parseInt(dislikeCount.innerText) - 1;
}
// Tăng số lượt thích và giảm số lượt không thích nếu đã thích trước đó
if (likeButton.classList.contains('active')) {
  likeButton.classList.remove('active');
  likeCount.innerText = parseInt(likeCount.innerText) - 1;
} else {
  likeButton.classList.add('active');
  dislikeButton.classList.remove('active');
  likeCount.innerText = parseInt(likeCount.innerText) + 1;
  dislikeCount.innerText = parseInt(dislikeCount.innerText) - 1;
}
// Tăng số lượt không thích và giảm số lượt thích nếu đã không thích trước đó
if (dislikeButton.classList.contains('active')) {
  dislikeButton.classList.remove('active');
  dislikeCount.innerText = parseInt(dislikeCount.innerText) - 1;
} else {
  dislikeButton.classList.add('active');
  likeButton.classList.remove('active');
  dislikeCount.innerText = parseInt(dislikeCount.innerText) + 1;
  likeCount.innerText = parseInt(likeCount.innerText) - 1;
}
}
});
//Dropdown Login
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

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

