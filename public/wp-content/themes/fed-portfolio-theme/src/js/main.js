'use strict';

var expanded = false; //menu
var skills = false; //Animates SKill charts
var transformed = false; //portfolio single posts
var itemsOnScreen = false; //portfolio item visibilty
var scrollIndicator = true; //scroll down arrows animation
var loading; //Holds loading tween

var tl = new TimelineLite({paused: true, onReverseComplete: closeItem}); // single portfolio items timeline
var tlp = new TimelineLite({paused: true, onComplete: resetPortfolioTl}); //potfolio-items animation timeline
var tls = new TimelineLite({onComplete: function() {
	this.restart();
}});

var controller = new ScrollMagic.Controller();

var userAgent = window.navigator.userAgent;

if( userAgent.indexOf('MSIE') > -1 || Object.hasOwnProperty.call(window, "ActiveXObject") && !window.ActiveXObject || !Modernizr.flexbox) {
	jQuery('body').html('');
}

jQuery(document).ready(function() {

	initScrollTl();

	var scrollDownScene = new ScrollMagic.Scene({triggerElement: '#about-anchor'}).on('start', function() {
			stopScrollIndicator();
		});
		scrollDownScene.addTo(controller);

	if( !skills ) {
		var scene = new ScrollMagic.Scene({ triggerElement: '.about h2'}).on('start', function() {
			TweenLite.to(jQuery('.charts h4'), .3, {opacity: 1, ease: Power2.easeOut, onComplete: animateSkills});
		});
		scene.addTo(controller);
	}

	if( !itemsOnScreen ) {
		var portfolioScene = new ScrollMagic.Scene({triggerElement: '.portfolio'}).on('start', function() {
			initPortfolioTl();
		});
		portfolioScene.addTo(controller);
	}

	jQuery('#menu-toggle').on('click', function() {
		animateMenu();	
	});

	jQuery('.main-menu a').on('click', function(e) {
		e.preventDefault();

		target = jQuery(this).attr('href'); //

		TweenLite.to(window, 1.5, {scrollTo: {y: jQuery(target).offset().top}, ease: Power2.easeInOut});
	})
	
	jQuery('#user_portrait img').attr('width', '');
	jQuery('#user_portrait img').attr('height', '');

	jQuery('.custom-post-link').on('click', function(e) {
		e.preventDefault();

		if( e.target.id != 'close-info' && transformed == false) {
			jQuery('.close-info', this).fadeIn(300);
			initItemTl(jQuery(this));
			return false;
		}
	});

	jQuery('#repeat-skill-animation').on('click', function() {
		jQuery('.chart').html('');
		skills = false;
		animateSkills();
	});
});

function initItemTl(element) {
	var scope = jQuery(element).parent(); /* Stores a scope to be used as context */

/*Fuckar upp responsive på tillbakavägen. Halvdan lösning nedan */
	tl.add(TweenLite.to(jQuery('.portfolio-item-listing', jQuery(scope).parent()), .8, {opacity: 0, width: '0' })) // Om % så blir det jättefel
	tl.add(TweenLite.to(jQuery('.project-link-text', element), .2, {opacity: 0, display: 'none'}))
	tl.add(TweenLite.to(jQuery('.project-link-img img', element), .6, {rotation: 45, ease: Bounce.easeOut}))
	tl.add(TweenLite.to(jQuery('.project-link-img img', element), .4, {opacity: 0, ease: 'Power2.easeOut'}))

	tl.add(TweenLite.to(jQuery('.project-link-img', element), .8, {backgroundColor: 'rgba(0,0,0,0.6)', minHeight: '75vh', ease: 'Power2.easeOut'}))
	tl.add(TweenLite.to(jQuery('.project-link-img img', element), .4, {width: '50%', ease: Power2.easeInOut})) //Orsakar lite höpp
	
	tl.add(TweenLite.to(jQuery(element).parent(), .1, {maxWidth: '850px', onComplete: openProject, onCompleteParams: [jQuery(element).attr('href'), scope]})) //Ändrat från none...
	tl.add(TweenLite.to(jQuery(element).parent(), .8, {className: '+= large-10', ease: 'Power2.easeOut'}))

	tl.play();

//Don't want this to be reversed later on so leave out from timeline
	TweenLite.to(window, 1.2, {scrollTo: {y: jQuery(scope).offset().top - 50}, ease: 'Power2.easeInOut'})

/* Halvbra lösning utanför tl
	TweenLite.to(jQuery('.portfolio-item-listing', jQuery(scope).parent()), 1, {opacity: 0, width: '0%' })
	TweenLite.to(jQuery('.portfolio-item-listing', jQuery(scope).parent()), 1, {opacity: 1, width: '50%' })
*/

}

function openProject(_url, scope) {

	inProgress(scope, true);
	var url = _url;

	if(typeof(_url) == 'object') {
		url = _url[0];
	}

	jQuery.get(url, function(result) {
		jQuery('.project-info', jQuery(scope).parent()).html(result);
		inProgress(scope, false);
		jQuery('.project-info', scope).fadeIn(300);
		transformed = true;
		enableCloseInfo();
	});
}

function enableCloseInfo() {
	jQuery('.close-info').on('click', function(e) {
		jQuery('.close-info').fadeOut(200);
		jQuery('.project-info').fadeOut(400);
		tl.timeScale(1).reverse();
	});
}

function disableCloseInfo() {
	jQuery('.close-info').unbind('click');
}

function animateMenu() {
	if( !expanded ) {
		jQuery('#menu-toggle i').removeClass('fa-bars').addClass('fa-times-circle');
		TweenLite.to(jQuery('#slider'), .8, {left: 0, ease: Power1.easeOut, onComplete: menuToggle, onCompleteParams: [true]});
		TweenLite.to(jQuery('#wrapper'), .8, {left: 250, ease: Power1.easeOut});
	}
	else if( expanded ) {
		jQuery('#menu-toggle i').removeClass('fa-times-circle').addClass('fa-bars');
		TweenLite.to(jQuery('#slider'), .6, {left: -250, ease: Power1.easeIn, onComplete: menuToggle, onCompleteParams: [false]});
		TweenLite.to(jQuery('#wrapper'), .6, {left: 0, ease: Power1.easeIn});
	}
	else {
		return false;
	}
}
function menuToggle(state) {
	expanded = state;
}

function closeItem() {
	disableCloseInfo();
	tl.pause(0, true); //Go back to the start (true to suppress events)
	tl.clear();
	jQuery('.project-link-text').fadeIn(400);
	transformed = false;
}

function animateSkills() {
	if( !skills ) {
		jQuery('.chart').percentcircle();
		skills = true;
	}
}

function initPortfolioTl() {

	if( !itemsOnScreen ) {
		elementsScrollFix();
		tlp.add(TweenLite.to(jQuery('.portfolio-item'), .1, {float: 'none'}))
		tlp.add(TweenLite.to(jQuery('.portfolio-item'), 1, {ease: 'Power3.easeOut', left: 0}))
		tlp.play();
		itemsOnScreen = true;
	}
	else if( itemsOnScreen ) {
		elementsScrollFix();
		tlp.add(TweenLite.to(jQuery('.portfolio-item'), .5, {ease: 'Power2.easeIn', left: -5000}))
		tlp.add(TweenLite.to(jQuery('.portfolio-item'), .1, {float: 'left'}))
		tlp.play();
		itemsOnScreen = false;
	}
	else {
		return false;
	}	
}

function resetPortfolioTl() {
	tl.pause(0); //Go back to the start (true is to suppress events)
	tlp.clear();
}
function initScrollTl() {
	tls.add(TweenLite.to(jQuery('#scroll-down .fa'), .5, {y: 15, easing: Bounce.easeOut}))
	tls.add(TweenLite.to(jQuery('#scroll-down .fa'), .5, {y: 0}))
	// tls.reverse();
}
function stopScrollIndicator() {
	tls.pause(0); //Go back to the start (true is to suppress events)
	tls.clear();
}

function inProgress(scope, state) {

	if( state ) {
		jQuery('#loading', scope).fadeIn(100);

		loading = TweenLite.to(jQuery('#loading i', scope), .3,{rotation: '+45', onComplete: function() {
			this.restart();
			console.log('spinning');
		}})
	}
	else if( !state ) {
		loading.kill()
		jQuery('#loading', scope).fadeOut(100);
	}
	else {
		return false;
	}
}

 //In case some items are expanded when scrolling away from portfolio
function elementsScrollFix() {
	closeItem();
	jQuery('.project-info').fadeOut(100);
	jQuery('.close-info').fadeOut(100);
	jQuery('#loading').fadeOut(100);
}