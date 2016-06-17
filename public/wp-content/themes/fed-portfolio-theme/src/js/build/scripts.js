(function($){
 	$.fn.extend({  		
	    //pass the options variable to the function
		percentcircle: function(options) {
		//Set the default values, use comma to separate the settings, example:
			var defaults = {
			        animate : true,
					diameter : 150,
					guage: 20,
					coverBg: '#fff',
					bgColor: '#000',
					fillColor: 'green',
					percentSize: '1rem',
					percentWeight: '800'
				},
				styles = {
				    cirContainer : {
					    'width':defaults.diameter,
						'height':defaults.diameter
					},
					cir : {
					    'position': 'relative',
					    'text-align': 'center',
					    'width': defaults.diameter,
					    'height': defaults.diameter,
					    'border-radius': '100%',
					    'background-color': defaults.bgColor,
					    'background-image' : 'linear-gradient(91deg, transparent 50%, '+defaults.bgColor+' 50%), linear-gradient(90deg, '+defaults.bgColor+' 50%, transparent 50%)'
					},
					cirCover: {
						'position': 'relative',
					    'top': defaults.guage,
					    'left': defaults.guage,
					    'text-align': 'center',
					    'width': defaults.diameter - (defaults.guage * 2),
					    'height': defaults.diameter - (defaults.guage * 2),
					    'border-radius': '100%',
					    'background-color': defaults.coverBg
					},
					percent: {
						'display':'block',
						'width': defaults.diameter,
					    'height': defaults.diameter,
					    'line-height': defaults.diameter + 'px',
					    'vertical-align': 'middle',
					    'font-size': defaults.percentSize,
					    'font-weight': defaults.percentWeight,
					    'color': '#202020'
                    }
				};
			
			var that = this,
					template = '<div class="center-block"><div class="ab" style="opacity: 0.8;"><div class="cir cc"><span class="perc">{{percentage}}</span></div></div></div>',					
					options =  $.extend(defaults, options)					

			function init(){
				that.each(function(){
					var $this = $(this),
					    //we need to check for a percent otherwise set to 0;
						perc = Math.round($this.data('percent')), //get the percentage from the element
						deg = perc * 3.6,
						stop = options.animate ? 0 : deg,
						$chart = $(template.replace('{{percentage}}',perc+'%'));
						//set all of the css properties for the chart
						$chart.css(styles.cirContainer).find('.ab').css(styles.cir).find('.cir').css(styles.cirCover).find('.perc').css(styles.percent);
					
					$this.append($chart); //add the chart back to the target element
					setTimeout(function(){
						animateChart(deg,parseInt(stop),$chart.find('.ab')); //both values set to the same value to keep the function from looping and animating	
					},250)
	   	    	});
			}

			var animateChart = function (stop,curr,$elm){
				var deg = curr;
				if(curr <= stop){
					if (deg>=180){
						$elm.css('background-image','linear-gradient(' + (90+deg) + 'deg, transparent 50%, '+options.fillColor+' 50%),linear-gradient(90deg, '+options.fillColor+' 50%, transparent 50%)');
			  	    }else{
			  		    $elm.css('background-image','linear-gradient(' + (deg-90) + 'deg, transparent 50%, '+options.bgColor+' 50%),linear-gradient(90deg, '+options.fillColor+' 50%, transparent 50%)');
			  	    }
					curr ++;
					setTimeout(function(){
						animateChart(stop,curr,$elm);
					},1);
				}
			};			
			
			init(); //kick off the goodness
   	    }
	});
	
})(jQuery);
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

jQuery(document).ready(function() {

	initScrollTl();

	var scrollDownScene = new ScrollMagic.Scene({triggerElement: '#about-anchor'}).on('start', function() {
			stopScrollIndicator();
		});

		// scrollDownScene.addIndicators();
		scrollDownScene.addTo(controller);

	if( !skills ) {
		var scene = new ScrollMagic.Scene({ triggerElement: '.about h2'}).on('start', function() {
			TweenLite.to(jQuery('.about h3'), .3, {opacity: 4, ease: Power2.easeOut, onComplete: animateSkills});
			// animateSkills();
		});
		// scene.addIndicators();
		scene.addTo(controller);
	}

	if( !itemsOnScreen ) {
		var portfolioScene = new ScrollMagic.Scene({triggerElement: '.portfolio'}).on('start', function() {
			initPortfolioTl();

		});
		// portfolioScene.addIndicators();
		portfolioScene.addTo(controller);
	}

	jQuery('#menu-toggle').on('click', function() {
		animateMenu();	
	});
	
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
		jQuery('.demo').html('');
		skills = false;
		animateSkills();
	});
});

function initItemTl(element) {
	var scope = jQuery(element).parent(); /* Stores a scope to be used as context */

	// tl.add(TweenLite.to(jQuery(document), .3, {height: '+= 50vh' })) // .7
	

	tl.add(TweenLite.to(jQuery('.portfolio-item-listing', jQuery(scope).parent()), 1, {opacity: 0, width: '0px' })) // .7
	tl.add(TweenLite.to(jQuery('.project-link-text', element), .3, {opacity: 0, display: 'none'})) //.5
	tl.add(TweenLite.to(jQuery('.project-link-img img', element), .7, {rotation: 45, ease: Bounce.easeOut})) //.4
	tl.add(TweenLite.to(jQuery('.project-link-img img', element), .5, {opacity: 0, ease: 'Power2.easeOut'})) //.4. display: none, ger en rörig animation men vore bra...
	tl.add(TweenLite.to(jQuery('.project-link-img img', element), .1, {width: 'initial'}))
	tl.add(TweenLite.to(jQuery('.project-link-img', element), 1, {backgroundColor: 'rgba(0,0,0,0.6)', minHeight: '75vh', ease: 'Power2.easeOut', onComplete: openProject, onCompleteParams: [jQuery(element).attr('href'), scope]})) // .1
	tl.add(TweenLite.to(jQuery(element).parent(), 1.1, {className: '+= large-12', ease: 'Power2.easeOut'})) //.7
	tl.play();
//Don't want this to be reversed later on so leave out from timeline
	TweenLite.to(window, 1.2, {scrollTo: {y: jQuery(scope).offset().top - 50}, ease: 'Power2.easeInOut'})
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
		tl.reverse();
	});
}

function disableCloseInfo() {
	jQuery('.close-info').unbind('click');
}

function animateMenu() {
	if( !expanded ) {
		TweenLite.to(jQuery('#slider'), .8, {left: 0, ease: Power1.easeOut, onComplete: menuToggle, onCompleteParams: [true]});
		TweenLite.to(jQuery('#wrapper'), .8, {left: 250, ease: Power1.easeOut});
	}
	else if( expanded ) {
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
	tl.pause(0, true); //Go back to the start (true is to suppress events)
	tl.clear();
	jQuery('.project-link-text').fadeIn(400);
	transformed = false;
}

function animateSkills() {
	if( !skills ) {
		jQuery('.demo').percentcircle();
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




/*Anonymous function for being able to write proper jQuery code within wordpress

(function($) {
	// $ Works! You can test it with next line if you like
	// console.log($);
})( jQuery );
*/


/* First Scroll Magic test  
	var controller = new ScrollMagic.Controller();

	var fooTween = new TweenLite.to(jQuery('body'), 2, {backgroundColor: 'rgba(255,0,0,0.5)'})

	var scene = new ScrollMagic.Scene({ triggerElement: '.about'});

	scene.setTween(skills)
	// scene.setPin('#me')
	scene.addIndicators()
	scene.addTo(controller);
*/

/* Prev ajax vers. 
function ajaxFetchSingle(params, _url) {
	console.log(params.target.selector);
	console.log(ajaxCall.ajaxUrl)

	// jQuery('.project-link-img img', params.target.selector).attr('src', 'img/mask-white.svg');

	var url = _url;

	if(typeof(_url) == 'object') {
		url = _url[0];
	}


	// jQuery('.project-link-img', params.target.selector).addClass('toggle-img');

	jQuery.get(url, function(result) {
		// console.log(result)
		jQuery('.project-info', params.target.selector).html(result).fadeIn(700);

	});


	jQuery.ajax({url: ajaxCall.ajaxUrl, success: function(result) {
		jQuery('.project-info', params.target.selector).html(result).fadeIn(700);
		// jQuery('#close-info').fadeIn();
	}});


}
*/
/* Prev ajax vers. 
function initItemTl(element, _url) {
	console.log(element, _url);

	tl.add(TweenLite.to(jQuery('img', element), 0.5, {rotation: 45}))
	
	tl.add(TweenLite.to(element, 0.5, {className: '+=small-pull-3'}))

	tl.add(TweenLite.to(jQuery(element).parent().find('.portfolio-item-listing'), 0.5, {opacity: 0}))


	// tl.add(TweenLite.to(element, 2, {className: '+=small-12'}))

	// tl.add(TweenLite.to(jQuery('.project-link-img', element), 0.5, {className: '+=small-5'}))
	// tl.add(TweenLite.to(jQuery('.project-link-img', element), 0.5, {className: '-=small-12'}))

	tl.add(TweenLite.to(element, 1, {className: '+=small-12'}));

	// tl.add(TweenLite.to(jQuery('img', element), 0.2, {opacity: 0}))


	tl.add(TweenLite.to(jQuery('.project-link-img', element), 0.5, {className: '+=small-5'}))
	tl.add(TweenLite.to(jQuery('.project-link-img', element), 0.5, {className: '-=small-12'}))

	// tl.add(TweenLite.to(jQuery(element).parent().find('.portfolio-item-listing'), 0.5, {opacity: 0}))


	// tl.add(TweenLite.to(jQuery('img', element), 0.5, {rotation: 90, className: '+=responsive-img'})) //, width: '50%', border:'1px solid black'

	// tl.add(TweenLite.to(jQuery('img', element), {attr: {src: 'img/portrait.jpg'}}))
	
	tl.add(TweenLite.to(jQuery('img', element), 0.2, {opacity: 0}))

	// tl.add(TweenLite.to(element, 0.5, {backgroundColor: '#fff', onComplete: ajaxFetchSingle, onCompleteParams: ['{self}']}))
	tl.add(TweenLite.to(element, 0.5, {backgroundColor: '#fff', onComplete: ajaxFetchSingle, onCompleteParams: ['{self}', _url]}))

	tl.play();
}
*/

/* Pre dynamic click solution
	jQuery('#item-2').on('click', function(e) {

		if( e.target.id != 'close-info' ) {
			initItemTl('#item-2');

			jQuery('.project-link-text', this).fadeOut(300);
			// jQuery(this).unbind('click');
		}
	});
*/

/* Un-transform timeline försök

		tlOut.add(TweenLite.to(jQuery('.project-info'), 1, {display: 'none'}))
		tlOut.add(TweenLite.to(tl.pause(0, true)))
		tlOut.add(TweenLite.to(tl.clear()))
		tlOut.add(TweenLite.to(tlOut.clear()));

		tlOut.play();
*/


/* After element flyttat till function

tl.add(TweenLite.to(element, 0.5, {className: '+=small-pull-3'}))
tl.add(TweenLite.to(element, 0.5, {className: '+=small-12'}))
// tl.add(TweenLite.to(jQuery('#item-toggle2'), 1, {className:'-=small-4'}))

tl.add(TweenLite.to(jQuery('.project-link-img', element), 0.5, {className: '-=small-12'}))
tl.add(TweenLite.to(jQuery('.project-link-img', element), 0.5, {className: '+=small-5'}))

tl.add(TweenLite.to(jQuery('img', element), 0.5, {border:'1px solid black', rotation: 90, className: '+=responsive-img'})) //, width: '50%'
tl.add(TweenLite.to(element, 0.5, {backgroundColor: '#fff', onComplete: ajaxFetchSingle, onCompleteParams: ['{self}']}));


var tlOut = new TimelineLite({paused: true});

*/


/* Before element:

	tl.add(TweenLite.to(jQuery('#item-toggle2'), 0.5, {className: '+=small-pull-3'}))
	tl.add(TweenLite.to(jQuery('#item-toggle2'), 1, {className: '+=small-12'}))
	// tl.add(TweenLite.to(jQuery('#item-toggle2'), 1, {className:'-=small-4'}))

	tl.add(TweenLite.to(jQuery('.project-link-img'), 3, {className: '-=small-12'}))
	tl.add(TweenLite.to(jQuery('.project-link-img'), 1, {className: '+=small-5'}))

	tl.add(TweenLite.to(jQuery('#item-toggle2 img'), 0.5, {border:'1px solid black', rotation: 90, className: '+=responsive-img'})) //, width: '50%'
	tl.add(TweenLite.to(jQuery('#item-toggle2'), 0.5, {backgroundColor: '#fff', onComplete: ajaxFetchSingle, onCompleteParams: ['{self}']}));

*/


/* Old animation structure:

	jQuery('#item-toggle').on('click', function() {
		jQuery(this).unbind('click');
		TweenLite.to(jQuery('#item-toggle img'), 1, {rotation: 45, display: 'none'});

		TweenLite.to(jQuery(this), 1, {backgroundColor: '#fff', left: '-10%', width: '+=100%', height: '80vh'});
	});

	jQuery('#item-close').on('click', function() {

		TweenLite.to(jQuery('#item-toggle'), 1, {right: '10%', rotation: 45, width: '-=150%'}); //
	});
*/