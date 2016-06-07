'use strict';

var expanded = false; //menu

// var element = '#item-toggle2';

var transformed = false;

var tl = new TimelineLite({paused: true, onReverseComplete: closeItem}); //



$(document).ready(function() {


	// $('#parallax').parallax({imageSrc: 'img/background.jpeg'});

	var controller = new ScrollMagic.Controller();
	var fooTween = new TweenLite.to($('body'), 2, {backgroundColor: 'rgba(255,0,0,0.5)'})

	var scene = new ScrollMagic.Scene({ triggerElement: '.about'});

	scene.setTween(fooTween)
	scene.setPin('#me')
	scene.addIndicators()
	scene.addTo(controller);


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


	$('.portfolio-item-link').on('click', function(e) {


		if( e.target.id != 'close-info' ) {

			$('.project-link-text', this).fadeOut(300);

			// $(this).parent().find('.portfolio-item-listing').fadeOut(100);

			initItemTimeLine('#' + e.currentTarget.id);
			$('.close-info', this).fadeIn();

			// $(this).unbind('click');
		}
	});


	$('.close-info').on('click', function(e) {

		$('.close-info').fadeOut(200);
		$('.project-info').fadeOut(400);

		// TweenLite.to($('.portfolio-item-link'), 2, {opacity: '0.1', onComplete: closeItem});

		tl.reverse();
		// closeItem();

		// tl.pause(0, true); //Go back to the start (true is to suppress events)
		// tl.clear();
		// $('.project-link-text').show();
	});

});

function menuToggle(state) {
	expanded = state;
}

function myFunction(params) {
	console.log(params.target.selector);

	// $('.project-link-img img', params.target.selector).attr('src', 'img/mask-white.svg');

	$('.project-link-img', params.target.selector).addClass('toggle-img');

	$.ajax({url: 'single.php', success: function(result) {
		$('.project-info', params.target.selector).html(result).fadeIn(700);
		// $('#close-info').fadeIn();
	}});

}

function initItemTimeLine(element) {

	tl.add(TweenLite.to($('img', element), 0.5, {rotation: 45}))
	
	tl.add(TweenLite.to(element, 0.5, {className: '+=small-pull-3'}))

	tl.add(TweenLite.to($(element).parent().find('.portfolio-item-listing'), 0.5, {opacity: 0}))


	// tl.add(TweenLite.to(element, 2, {className: '+=small-12'}))

	// tl.add(TweenLite.to($('.project-link-img', element), 0.5, {className: '+=small-5'}))
	// tl.add(TweenLite.to($('.project-link-img', element), 0.5, {className: '-=small-12'}))

	tl.add(TweenLite.to(element, 1, {className: '+=small-12'}));

	// tl.add(TweenLite.to($('img', element), 0.2, {opacity: 0}))


	tl.add(TweenLite.to($('.project-link-img', element), 0.5, {className: '+=small-5'}))
	tl.add(TweenLite.to($('.project-link-img', element), 0.5, {className: '-=small-12'}))

	// tl.add(TweenLite.to($(element).parent().find('.portfolio-item-listing'), 0.5, {opacity: 0}))


	// tl.add(TweenLite.to($('img', element), 0.5, {rotation: 90, className: '+=responsive-img'})) //, width: '50%', border:'1px solid black'

	// tl.add(TweenLite.to($('img', element), {attr: {src: 'img/portrait.jpg'}}))
	
	tl.add(TweenLite.to($('img', element), 0.2, {opacity: 0}))

	tl.add(TweenLite.to(element, 0.5, {backgroundColor: '#fff', onComplete: myFunction, onCompleteParams: ['{self}']}))

	tl.play();
}


/* If closing shoul dbe in a seperate function: */
function closeItem() {
		tl.pause(0, true); //Go back to the start (true is to suppress events)
		tl.clear();
		$('.project-link-text').fadeIn(400);
}


/* Pre dynamic click solution
	$('#item-2').on('click', function(e) {

		if( e.target.id != 'close-info' ) {
			initItemTimeLine('#item-2');

			$('.project-link-text', this).fadeOut(300);
			// $(this).unbind('click');
		}
	});
*/

/* Un-transform timeline försök

		tlOut.add(TweenLite.to($('.project-info'), 1, {display: 'none'}))
		tlOut.add(TweenLite.to(tl.pause(0, true)))
		tlOut.add(TweenLite.to(tl.clear()))
		tlOut.add(TweenLite.to(tlOut.clear()));

		tlOut.play();
*/


/* After element flyttat till function

tl.add(TweenLite.to(element, 0.5, {className: '+=small-pull-3'}))
tl.add(TweenLite.to(element, 0.5, {className: '+=small-12'}))
// tl.add(TweenLite.to($('#item-toggle2'), 1, {className:'-=small-4'}))

tl.add(TweenLite.to($('.project-link-img', element), 0.5, {className: '-=small-12'}))
tl.add(TweenLite.to($('.project-link-img', element), 0.5, {className: '+=small-5'}))

tl.add(TweenLite.to($('img', element), 0.5, {border:'1px solid black', rotation: 90, className: '+=responsive-img'})) //, width: '50%'
tl.add(TweenLite.to(element, 0.5, {backgroundColor: '#fff', onComplete: myFunction, onCompleteParams: ['{self}']}));

var tlOut = new TimelineLite({paused: true});

*/


/* Before element:

	tl.add(TweenLite.to($('#item-toggle2'), 0.5, {className: '+=small-pull-3'}))
	tl.add(TweenLite.to($('#item-toggle2'), 1, {className: '+=small-12'}))
	// tl.add(TweenLite.to($('#item-toggle2'), 1, {className:'-=small-4'}))

	tl.add(TweenLite.to($('.project-link-img'), 3, {className: '-=small-12'}))
	tl.add(TweenLite.to($('.project-link-img'), 1, {className: '+=small-5'}))

	tl.add(TweenLite.to($('#item-toggle2 img'), 0.5, {border:'1px solid black', rotation: 90, className: '+=responsive-img'})) //, width: '50%'
	tl.add(TweenLite.to($('#item-toggle2'), 0.5, {backgroundColor: '#fff', onComplete: myFunction, onCompleteParams: ['{self}']}));
*/


/* Old animation structure:

	$('#item-toggle').on('click', function() {
		$(this).unbind('click');
		TweenLite.to($('#item-toggle img'), 1, {rotation: 45, display: 'none'});

		TweenLite.to($(this), 1, {backgroundColor: '#fff', left: '-10%', width: '+=100%', height: '80vh'});
	});

	$('#item-close').on('click', function() {

		TweenLite.to($('#item-toggle'), 1, {right: '10%', rotation: 45, width: '-=150%'}); //
	});
*/