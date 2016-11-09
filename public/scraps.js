// 'use strict';

var expanded = false;


var tl = new TimelineLite({paused: true}); //

tl.add(TweenLite.to($('#item-toggle2'), 0.5, {className: '+=small-pull-3'}))
tl.add(TweenLite.to($('#item-toggle2'), 1, {className: '+=small-12'}))
// tl.add(TweenLite.to($('#item-toggle2'), 1, {className:'-=small-4'}))

tl.add(TweenLite.to($('.project-link-img'), 3, {className: '-=small-12'}))
tl.add(TweenLite.to($('.project-link-img'), 1, {className: '+=small-5'}))
// tl.add(TweenLite.to($('.project-link-text'), 1, {className: '+=small-6 end'}))

// tl.add(TweenLite.to($('.portfolio-item-link'), 1, {display: 'flex', flexDirection: 'row'}))

tl.add(TweenLite.to($('#item-toggle2 img'), 0.5, {border:'1px solid black', rotation: 90, className: '+=responsive-img'})) //, width: '50%'
tl.add(TweenLite.to($('#item-toggle2'), 0.5, {backgroundColor: '#fff', onComplete: myFunction, onCompleteParams: ['{self}']}));


var element;

var transformed = false;

$(document).ready(function() {
	console.log('ready!');

	// TweenMax.to('.portfolio-item', 1, {rotation: 45});
	// TweenMax.to('.portfolio-item > *', 1, {rotation: -45});

	// $(window).on('scroll', function() {
	// 	console.log($(window));
	// 	$('header').css({ height: '10vh'});
	// });
	$('#menu-toggle').on('click', function() {

		if( expanded ) {
			$("#slider").animate({left:-250},500, 'linear', menuToggle(false));
			$('#wrapper').animate({left: 0}, 500);
		}
		else {
			$("#slider").animate({left:0},500, 'linear', menuToggle(true));
			$('#wrapper').animate({left: 250}, 500);
		}	

	});

	$('#item-toggle').on('click', function() {
		$(this).unbind('click');
		TweenLite.to($('#item-toggle img'), 1, {rotation: 45, display: 'none'});

		TweenLite.to($(this), 1, {backgroundColor: '#fff', left: '-10%', width: '+=100%', height: '80vh'});
	});

	$('#item-close').on('click', function() {

		TweenLite.to($('#item-toggle'), 1, {right: '10%', rotation: 45, width: '-=150%'}); //
	});

	$('#item-toggle2').on('click', function() {
		// $(this).removeClass('small-4');
		// $(this).addClass('small-12');
		// $(this).addClass('small-pull-3');
		$('.project-link-text', this).fadeOut(300);
		tl.play();
	});	

});

function menuToggle(state) {
	expanded = state;
}

function myFunction(params) {
	console.log(params.target.selector);

	$.ajax({url: 'single.php', success: function(result) {
		// $('.project-link-text' this).html(result).fadeIn();
		$('.project-info').html(result).fadeIn(700);
		$('#close-info').fadeIn();
	}});

}