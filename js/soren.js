// page fader
jQuery(document).ready(function() {

	jQuery('body').css('display', 'none');

	jQuery('body').fadeIn(500);

	jQuery('.pushy a, .soren-fader').click(function(event) {
		event.preventDefault();
		newLocation = this.href;
		jQuery('body').fadeOut(400, newpage);
	});

	function newpage() {
		window.location = newLocation;
	}

});

// parallax
(function($) {

    $.fn.parallax = function(options) {

        var windowHeight = $(window).height();

        // Establish default settings
        var settings = $.extend({
            speed        : 0.15
        }, options);

        // Iterate over each object in collection
        return this.each( function() {

        	// Save a reference to the element
        	var $this = $(this);

        	// Set up Scroll Handler
        	$(document).scroll(function(){

    		        var scrollTop = $(window).scrollTop();
            	        var offset = $this.offset().top;
            	        var height = $this.outerHeight();

    		// Check if above or below viewport
			if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
				return;
			}

			var yBgPosition = Math.round((offset - scrollTop) * settings.speed);

                        // Apply the Y Background Position to Set the Parallax Effect
    			$this.css('background-position', 'center ' + yBgPosition + 'px');

        	});
        });
    }
}(jQuery));


/*! scrollNav - v2.1.0 - 2013-11-15
* http://scrollnav.com
* Copyright (c) 2013 James Wilson; Licensed MIT */
(function(s){var t=function(t,e,n,i){if(s(t).length>0){var o=s(t).offset().top;e=i?e:0,s("html:not(:animated),body:not(:animated)").animate({scrollTop:o-n},e)}},e=function(){return window.location.hash},n={classes:{loading:"sn-loading",failed:"sn-failed",success:"sn-active"},defaults:{sections:"h2",subSections:!1,sectionElem:"section",showHeadline:!0,headlineText:"Scroll To",showTopLink:!0,topLinkText:"Top",fixedMargin:40,scrollOffset:40,animated:!0,speed:500,insertLocation:"insertBefore",arrowKeys:!1,onInit:null,onRender:null,onDestroy:null},_set_body_class:function(t){var e=s("body");"loading"===t?e.addClass(n.classes.loading):"success"===t?e.removeClass(n.classes.loading).addClass(n.classes.success):e.removeClass(n.classes.loading).addClass(n.classes.failed)},_find_sections:function(t){var e=n.settings.sections,i=[];if(n.settings.showTopLink){var o=t.children().first();o.is(e)||i.push(o.nextUntil(e).andSelf())}t.find(e).each(function(){i.push(s(this).nextUntil(e).andSelf())}),n.sections={raw:i}},_setup_sections:function(t){var e=[];s(t).each(function(t){var i=[],o=s(this),a="scrollNav-"+(t+1),l=function(){return 0===t},c=function(){return!o.eq(0).is(n.settings.sections)},r=n.settings.showTopLink&&l()&&c()?n.settings.topLinkText:o.filter(n.settings.sections).text();if(o.wrapAll("<"+n.settings.sectionElem+' id="'+a+'" class="scroll-nav__section" />'),n.settings.subSections){var d=o.filter(n.settings.subSections);d.length>0&&d.each(function(t){var e=a+"-"+(t+1),n=s(this).text(),l=o.filter(s(this).nextUntil(d).andSelf());l.wrapAll('<div id="'+e+'" class="scroll-nav__sub-section" />'),i.push({id:e,text:n})})}e.push({id:a,text:r,sub_sections:i})}),n.sections.data=e},_tear_down_sections:function(t){s(t).each(function(){var t=this.sub_sections;s("#"+this.id).children().unwrap(),t.length>0&&s(t).each(function(){s("#"+this.id).children().unwrap()})})},_setup_nav:function(t){var e=s("<span />",{"class":"scroll-nav__heading",text:n.settings.headlineText}),i=s("<div />",{"class":"scroll-nav__wrapper"}),o=s("<nav />",{"class":"scroll-nav",role:"navigation"}),a=s("<ol />",{"class":"scroll-nav__list"});s.each(t,function(t){var e,n=0===t?s("<li />",{"class":"scroll-nav__item active"}):s("<li />",{"class":"scroll-nav__item"}),i=s("<a />",{href:"#"+this.id,"class":"scroll-nav__link",text:this.text});this.sub_sections.length>0&&(n.addClass("is-parent-item"),e=s("<ol />",{"class":"scroll-nav__sub-list"}),s.each(this.sub_sections,function(){var t=s("<li />",{"class":"scroll-nav__sub-item"}),n=s("<a />",{href:"#"+this.id,"class":"scroll-nav__sub-link",text:this.text});e.append(t.append(n))})),a.append(n.append(i).append(e))}),n.settings.showHeadline?o.append(i.append(e).append(a)):o.append(i.append(a)),n.nav=o},_insert_nav:function(){var s=n.settings.insertLocation,t=n.settings.insertTarget;n.nav[s](t)},_setup_pos:function(){var t=n.nav,e=s(window).height(),i=t.offset().top;s.each(n.sections.data,function(){var t=s("#"+this.id),e=t.height();this.top_offset=t.offset().top,this.bottom_offset=this.top_offset+e}),n.dims={vp_height:e,nav_offset:i}},_check_pos:function(){var t=n.nav,e=s(window).scrollTop(),i=e+n.settings.scrollOffset,o=e+n.dims.vp_height-n.settings.scrollOffset,a=[];e>n.dims.nav_offset-n.settings.fixedMargin?t.addClass("fixed"):t.removeClass("fixed"),s.each(n.sections.data,function(){(this.top_offset>i&&o>this.top_offset||this.bottom_offset>i&&o>this.bottom_offset||i>this.top_offset&&this.bottom_offset>o)&&a.push(this)}),t.find(".scroll-nav__item").removeClass("active").removeClass("in-view"),s.each(a,function(s){0===s?t.find('a[href="#'+this.id+'"]').parents(".scroll-nav__item").addClass("active").addClass("in-view"):t.find('a[href="#'+this.id+'"]').parents(".scroll-nav__item").addClass("in-view"),s++,n.sections.active=a})},_init_scroll_listener:function(){s(window).on("scroll",function(){n._check_pos()})},_rm_scroll_listeners:function(){s(window).off("scroll")},_init_resize_listener:function(){s(window).on("resize",function(){n._setup_pos(),n._check_pos()})},_rm_resize_listener:function(){s(window).off("resize")},_init_click_listener:function(){s(".scroll-nav").find("a").click(function(e){e.preventDefault();var i=s(this).attr("href"),o=n.settings.speed,a=n.settings.scrollOffset,l=n.settings.animated;t(i,o,a,l)})},_init_keyboard_listener:function(e){n.settings.arrowKeys&&s(document).on("keydown",function(s){if(40===s.keyCode||38===s.keyCode){var i=function(s){var t=0,i=e.length;for(t;i>t;t++)if(e[t].id===n.sections.active[0].id){var o=40===s?t+1:t-1,a=void 0===e[o]?void 0:e[o].id;return a}},o=i(s.keyCode);if(void 0!==o){s.preventDefault();var a="#"+o,l=n.settings.speed,c=n.settings.scrollOffset,r=n.settings.animated;t(a,l,c,r)}}})},_rm_keyboard_listener:function(){s(document).off("keydown")},init:function(i){return this.each(function(){var o=s(this);n.settings=s.extend({},n.defaults,i),n.settings.insertTarget=n.settings.insertTarget?s(n.settings.insertTarget):o,o.length>0?(n.settings.onInit&&n.settings.onInit.call(this),n._set_body_class("loading"),n._find_sections(o),o.find(n.settings.sections).length>0?(n._setup_sections(n.sections.raw),n._setup_nav(n.sections.data),n.settings.insertTarget.length>0?(n._insert_nav(),n._setup_pos(),n._check_pos(),n._init_scroll_listener(),n._init_resize_listener(),n._init_click_listener(),n._init_keyboard_listener(n.sections.data),n._set_body_class("success"),t(e()),n.settings.onRender&&n.settings.onRender.call(this)):(console.log('Build failed, scrollNav could not find "'+n.settings.insertTarget+'"'),n._set_body_class("failed"))):(console.log('Build failed, scrollNav could not find any "'+n.settings.sections+'s" inside of "'+o.selector+'"'),n._set_body_class("failed"))):(console.log('Build failed, scrollNav could not find "'+o.selector+'"'),n._set_body_class("failed"))})},destroy:function(){return this.each(function(){n._rm_scroll_listeners(),n._rm_resize_listener(),n._rm_keyboard_listener(),s("body").removeClass("sn-loading sn-active sn-failed"),s(".scroll-nav").remove(),n._tear_down_sections(n.sections.data),n.settings.onDestroy&&n.settings.onDestroy.call(this),n.settings=[],n.sections=void 0})}};s.fn.scrollNav=function(){var t,e=arguments[0];if(n[e])e=n[e],t=Array.prototype.slice.call(arguments,1);else{if("object"!=typeof e&&e)return s.error("Method "+e+" does not exist in the scrollNav plugin"),this;e=n.init,t=arguments}return e.apply(this,t)}})(jQuery);

/*!
	Slimbox v2.05 - The ultimate lightweight Lightbox clone for jQuery
	(c) 2007-2013 Christophe Beyls <http://www.digitalia.be>
	MIT-style license.
*/
(function(w){var E=w(window),u,f,F=-1,n,x,D,v,y,L,r,m=!window.XMLHttpRequest,s=[],l=document.documentElement,k={},t=new Image(),J=new Image(),H,a,g,p,I,d,G,c,A,K;w(function(){w("body").append(w([H=w('<div id="lbOverlay" />').click(C)[0],a=w('<div id="lbCenter" />')[0],G=w('<div id="lbBottomContainer" />')[0]]).css("display","none"));g=w('<div id="lbImage" />').appendTo(a).append(p=w('<div style="position: relative;" />').append([I=w('<a id="lbPrevLink" href="#" />').click(B)[0],d=w('<a id="lbNextLink" href="#" />').click(e)[0]])[0])[0];c=w('<div id="lbBottom" />').appendTo(G).append([w('<a id="lbCloseLink" href="#" />').click(C)[0],A=w('<div id="lbCaption" />')[0],K=w('<div id="lbNumber" />')[0],w('<div style="clear: both;" />')[0]])[0]});w.slimbox=function(O,N,M){u=w.extend({loop:false,overlayOpacity:0.8,overlayFadeDuration:400,resizeDuration:400,resizeEasing:"swing",initialWidth:250,initialHeight:250,imageFadeDuration:400,captionAnimationDuration:400,counterText:"Image {x} of {y}",closeKeys:[27,88,67],previousKeys:[37,80],nextKeys:[39,78]},M);if(typeof O=="string"){O=[[O,N]];N=0}y=E.scrollTop()+(E.height()/2);L=u.initialWidth;r=u.initialHeight;w(a).css({top:Math.max(0,y-(r/2)),width:L,height:r,marginLeft:-L/2}).show();v=m||(H.currentStyle&&(H.currentStyle.position!="fixed"));if(v){H.style.position="absolute"}w(H).css("opacity",u.overlayOpacity).fadeIn(u.overlayFadeDuration);z();j(1);f=O;u.loop=u.loop&&(f.length>1);return b(N)};w.fn.slimbox=function(M,P,O){P=P||function(Q){return[Q.href,Q.title]};O=O||function(){return true};var N=this;return N.unbind("click").click(function(){var S=this,U=0,T,Q=0,R;T=w.grep(N,function(W,V){return O.call(S,W,V)});for(R=T.length;Q<R;++Q){if(T[Q]==S){U=Q}T[Q]=P(T[Q],Q)}return w.slimbox(T,U,M)})};function z(){var N=E.scrollLeft(),M=E.width();w([a,G]).css("left",N+(M/2));if(v){w(H).css({left:N,top:E.scrollTop(),width:M,height:E.height()})}}function j(M){if(M){w("object").add(m?"select":"embed").each(function(O,P){s[O]=[P,P.style.visibility];P.style.visibility="hidden"})}else{w.each(s,function(O,P){P[0].style.visibility=P[1]});s=[]}var N=M?"bind":"unbind";E[N]("scroll resize",z);w(document)[N]("keydown",o)}function o(O){var N=O.which,M=w.inArray;return(M(N,u.closeKeys)>=0)?C():(M(N,u.nextKeys)>=0)?e():(M(N,u.previousKeys)>=0)?B():null}function B(){return b(x)}function e(){return b(D)}function b(M){if(M>=0){F=M;n=f[F][0];x=(F||(u.loop?f.length:0))-1;D=((F+1)%f.length)||(u.loop?0:-1);q();a.className="lbLoading";k=new Image();k.onload=i;k.src=n}return false}function i(){a.className="";w(g).css({backgroundImage:"url("+n+")",visibility:"hidden",display:""});w(p).width(k.width);w([p,I,d]).height(k.height);w(A).html(f[F][1]||"");w(K).html((((f.length>1)&&u.counterText)||"").replace(/{x}/,F+1).replace(/{y}/,f.length));if(x>=0){t.src=f[x][0]}if(D>=0){J.src=f[D][0]}L=g.offsetWidth;r=g.offsetHeight;var M=Math.max(0,y-(r/2));if(a.offsetHeight!=r){w(a).animate({height:r,top:M},u.resizeDuration,u.resizeEasing)}if(a.offsetWidth!=L){w(a).animate({width:L,marginLeft:-L/2},u.resizeDuration,u.resizeEasing)}w(a).queue(function(){w(G).css({width:L,top:M+r,marginLeft:-L/2,visibility:"hidden",display:""});w(g).css({display:"none",visibility:"",opacity:""}).fadeIn(u.imageFadeDuration,h)})}function h(){if(x>=0){w(I).show()}if(D>=0){w(d).show()}w(c).css("marginTop",-c.offsetHeight).animate({marginTop:0},u.captionAnimationDuration);G.style.visibility=""}function q(){k.onload=null;k.src=t.src=J.src=n;w([a,g,c]).stop(true);w([I,d,g,G]).hide()}function C(){if(F>=0){q();F=x=D=-1;w(a).hide();w(H).stop().fadeOut(u.overlayFadeDuration,j)}return false}})(jQuery);

// AUTOLOAD CODE BLOCK (MAY BE CHANGED OR REMOVED)
if (!/android|iphone|ipod|series60|symbian|windows ce|blackberry/i.test(navigator.userAgent)) {
	jQuery(function($) {
		$("a[rel^='lightbox']").slimbox({/* Put custom options here */}, null, function(el) {
			return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
		});
	});
}