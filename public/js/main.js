//COMMENT EDITING FUNCTIONALITY
var commentId = 0;
var bookId = 0;
var postBodyElement = null;

$('.post').find('.interaction').find('.edit').on('click', function(event) {
	event.preventDefault();
	postBodyElement = event.target.parentNode.parentNode.childNodes[1];
	var commentBody = postBodyElement.textContent;
	commentId = event.target.parentNode.parentNode.dataset['commentid'];
	$('#comment-body').val(commentBody);
	$('#edit-modal').modal();
});

$('#modal-save').on('click', function() {
	$.ajax({
		method:'POST',
		url: url,
		data: {body: $('#comment-body').val(), commentId: commentId, _token: token }
	})
	.done(function(msg) {
		$(postBodyElement).text(msg['new_body']);
		$('#edit-modal').modal('hide');
	});
});

//LIKE AND DISLIKE FUNCTIONALITY
$('.like').on('click', function(event){
	event.preventDefault();
	bookId = event.target.parentNode.parentNode.dataset['bookid'];
	var isLike = event.target.previousElementSibling == null ? true : false;
	$.ajax({
		method:'POST',
		url: urlLike,
		data: {isLike: isLike, bookId: bookId, _token: token }
	})
		.done(function(){
			event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this Book' : 'Like': event.target.innerText == 'Dislike' ? 'You don\'t like this Book': 'Dislike';
			if(isLike){
				event.target.nextElementSibling.innerText = 'Dislike';
			}
			else{
				event.target.previousElementSibling.innerText = 'Like';
			}
		});
});

//TEXT AREA CHARACTER COUNTER FUNCTIONALITY
var text_max = 300;

$('#bio-body').keyup(function() {
  var text_length = $('#bio-body').val().length;
  var text_remaining = text_max - text_length;
  $('#count_message').html(text_remaining + ' remaining');
});

//BIO EDITING FUNCTIONALITY
var bioId = 0;
var bioBodyElement = null;

$('.bio').find('.interaction').find('.edit').on('click', function(event) {
	event.preventDefault();
	bioBodyElement = event.target.parentNode.parentNode.childNodes[1];
	var bioBody = bioBodyElement.textContent;
	userId = event.target.parentNode.parentNode.dataset['userid'];
	$('#bio-body').val(bioBody);
	$('#edit-bio-modal').modal();
});

$('#modal-save-bio').on('click', function() {
	$.ajax({
		method:'POST',
		url: url,
		data: {bio: $('#bio-body').val(), userId: userId, _token: token }
	})
	.done(function(msg) {
		$(bioBodyElement).text(msg['new_bio']);
		$('#edit-bio-modal').modal('hide');
	});
});

