// Retrieve comments from localStorage or set empty array if none exist
let comments = JSON.parse(localStorage.getItem('comments')) || [];

// Function to display comments on page
function displayComments() {
  let commentsContainer = $('#comments-container');
  commentsContainer.empty();
  for (let i = 0; i < comments.length; i++) {
    let comment = comments[i];
    let commentDiv = $('<div>').addClass('comment');
    let commentContent = $('<p>').text(comment.comment);
    let commentAuthor = $('<span>').addClass('comment-author').text(comment.name);
    let commentDate = $('<span>').addClass('comment-date').text(comment.date);
    let likeButton = $('<button>').addClass('like-button').text('Like');
    let dislikeButton = $('<button>').addClass('dislike-button').text('Dislike');
    let likeCount = $('<span>').addClass('like-count').text(comment.likes);
    let dislikeCount = $('<span>').addClass('dislike-count').text(comment.dislikes);
    let replyForm = $('<form>').addClass('reply-form').hide();
    let replyLabel = $('<label>').attr('for', 'reply').text('Reply:');
    let replyInput = $('<textarea>').attr('id', 'reply').attr('name', 'reply');
    let replySubmit = $('<input>').attr('type', 'submit').attr('value', 'Submit');
    replyForm.append(replyLabel, replyInput, replySubmit);
    commentDiv.append(commentContent, commentAuthor, commentDate, likeButton, likeCount, dislikeButton, dislikeCount, replyForm);
    commentsContainer.append(commentDiv);
  }
}

// Function to add a new comment
function addComment(name, comment) {
  let newComment = {
    name: name,
    comment: comment,
    date: new Date().toLocaleString(),
    likes: 0,
    dislikes: 0,
    replies: []
  };
  comments.push(newComment);
  localStorage.setItem('comments', JSON.stringify(comments));
  displayComments();
}

// Function to add a like to a comment
function addLike(index) {
  comments[index].likes += 1;
  localStorage.setItem('comments', JSON.stringify(comments));
  displayComments();
}

// Function to remove a like from a comment
function removeLike(index) {
  comments[index].likes -= 1;
  localStorage.setItem('comments', JSON.stringify(comments));
  displayComments();
}

// Function to add a dislike to a comment
function addDislike(index) {
  comments[index].dislikes += 1;
  localStorage.setItem('comments', JSON.stringify(comments));
  displayComments();
}

// Function to remove a dislike from a comment
function removeDislike(index) {
  comments[index].dislikes -= 1;
  localStorage.setItem('comments', JSON.stringify(comments));
  displayComments();
}

// Function to toggle the like button and increment/decrement like count
function toggleLike(index) {
  let likeButton = $('.comment').eq(index).find('.like-button');
  let likeCount = $('.comment').eq(index).find('.like-count');
  if (likeButton.hasClass('liked')) {
    likeButton.removeClass('liked');
    removeLike(index);
  } else {
    likeButton.addClass('liked');
    addLike(index);
    if (dislikeButton.hasClass('disliked')) {
      dislikeButton.removeClass('disliked');
      removeDislike(index);
    }
  }
  likeCount.text(comments[index].likes);
}

// Function to toggle the dislike button and increment/decrement dislike count
function toggleDislike(index) {
  let dislikeButton = $('.comment').eq(index).find('.dislike-button');
  let dislikeCount = $('.comment').eq(index).find('.dislike-count');
  if (dislikeButton.hasClass('disliked')) {
    dislikeButton.removeClass('disliked');
    removeDislike(index);
  } else {
    dislikeButton.addClass('disliked');
    addDislike(index);
    if (likeButton.hasClass('liked')) {
      likeButton.removeClass('liked');
      removeLike(index);
    }
  }
  dislikeCount.text(comments[index].dislikes);
}
// Function to add a reply to a comment
function addReply(index, name, reply) {
  let newReply = {
    name: name,
    reply: reply,
    date: new Date().toLocaleString()
  };
  comments[index].replies.push(newReply);
  localStorage.setItem('comments', JSON.stringify(comments));
  displayComments();
}
// Event listener for form submission to add a new comment
$('#comment-form').submit(function(e) {
  e.preventDefault();
  let name = $('#name').val();
  let comment = $('#comment').val();
  if (name && comment) {
    addComment(name, comment);
    $('#name').val('');
    $('#comment').val('');
  }
});
// Event listener for click on like button to toggle like and update like count
$(document).on('click', '.like-button', function() {
  let index = $(this).closest('.comment').index();
  toggleLike(index);
});

// Event listener for click on dislike button to toggle dislike and update dislike count
$(document).on('click', '.dislike-button', function() {
  let index = $(this).closest('.comment').index();
  toggleDislike(index);
});

// Event listener for click on reply button to show/hide reply form
$(document).on('click', '.reply-button', function() {
  let replyForm = $(this).closest('.comment').find('.reply-form');
  replyForm.toggle();
});

// Event listener for form submission to add a reply to a comment
$(document).on('submit', '.reply-form', function(e) {
  e.preventDefault();
  let index = $(this).closest('.comment').index();
  let name = $(this).find('input[name="name"]').val();
  let reply = $(this).find('textarea[name="reply"]').val();
  if (name && reply) {
addReply(index, name, reply);
$(this).find('input[name="name"]').val('');
$(this).find('textarea[name="reply"]').val('');
}
});
// Function to display comments on the page
function displayComments() {
let commentsSection = $('#comments-section');
commentsSection.empty();

for (let i = 0; i < comments.length; i++) {
let comment = comments[i];
let commentHtml = `
  <div class="comment">
    <div class="comment-details">
      <div class="comment-name">${comment.name}</div>
      <div class="comment-date">${comment.date}</div>
    </div>
    <div class="comment-content">${comment.comment}</div>
    <div class="comment-actions">
      <button class="like-button ${comment.liked ? 'liked' : ''}"></button>
      <span class="like-count">${comment.likes}</span>
      <button class="dislike-button ${comment.disliked ? 'disliked' : ''}"></button>
      <span class="dislike-count">${comment.dislikes}</span>
      <button class="reply-button">Reply</button>
    </div>
    <div class="reply-form" style="display:none;">
      <form>
        <input type="text" name="name" placeholder="Name" required>
        <textarea name="reply" placeholder="Your reply" required></textarea>
        <button type="submit">Post reply</button>
      </form>
    </div>
    <div class="replies">
      ${displayReplies(comment.replies)}
    </div>
  </div>
`;

commentsSection.append(commentHtml);
}
}

// Function to display replies to a comment
function displayReplies(replies) {
let repliesHtml = '';

for (let i = 0; i < replies.length; i++) {
let reply = replies[i];
let replyHtml = <div class="reply"> <div class="reply-details"> <div class="reply-name">${reply.name}</div> <div class="reply-date">${reply.date}</div> </div> <div class="reply-content">${reply.reply}</div> </div> ;
repliesHtml += replyHtml;
}

return repliesHtml;
}

// Function to add a comment to the comments array and update local storage
function addComment(name, comment) {
let newComment = {
name: name,
comment: comment,
date: new Date().toLocaleString(),
likes: 0,
dislikes: 0,
liked: false,
disliked: false,
replies: []
};
comments.push(newComment);
localStorage.setItem('comments', JSON.stringify(comments));
displayComments();
}

// Function to toggle the like button and increment/decrement like count
function toggleLike(index) {
let likeButton = $('.comment').eq(index).find('.like-button');
let likeCount = $('.comment').eq(index).find('.like-count');
if (likeButton.hasClass('liked')) {
likeButton.removeClass('liked');
removeLike(index);
} else {
likeButton.addClass('liked');
addLike(index);
if (dislikeButton.hasClass('disliked')) {
dislikeButton.removeClass('disliked');
removeDislike(index);
}
}
likeCount.text(comments[index].likes);
}

// Function to add a like to a comment
function addLike(index) {
comments[index].likes++;
comments[index].liked = true;
localStorage.setItem('comments', JSON.stringify(comments));
}
// Function to remove a like from a comment
function removeLike(index) {
comments[index].likes--;
comments[index].liked = false;
localStorage.setItem('comments', JSON.stringify(comments));
}

// Function to toggle the dislike button and increment/decrement dislike count
function toggleDislike(index) {
let dislikeButton = $('.comment').eq(index).find('.dislike-button');
let dislikeCount = $('.comment').eq(index).find('.dislike-count');
if (dislikeButton.hasClass('disliked')) {
dislikeButton.removeClass('disliked');
removeDislike(index);
} else {
dislikeButton.addClass('disliked');
addDislike(index);
if (likeButton.hasClass('liked')) {
likeButton.removeClass('liked');
removeLike(index);
}
}
dislikeCount.text(comments[index].dislikes);
}

// Function to add a dislike to a comment
function addDislike(index) {
comments[index].dislikes++;
comments[index].disliked = true;
localStorage.setItem('comments', JSON.stringify(comments));
}

// Function to remove a dislike from a comment
function removeDislike(index) {
comments[index].dislikes--;
comments[index].disliked = false;
localStorage.setItem('comments', JSON.stringify(comments));
}

// Function to add a reply to a comment
function addReply(index, name, reply) {
let newReply = {
name: name,
reply: reply,
date: new Date().toLocaleString()
};
comments[index].replies.push(newReply);
localStorage.setItem('comments', JSON.stringify(comments));
displayComments();
}

// Load comments from local storage on page load
if (localStorage.getItem('comments')) {
comments = JSON.parse(localStorage.getItem('comments'));
displayComments();
} else {
comments = [];
}