/* ALL THE SCRIPTS IN THIS FILE ARE MADE BY KROWNTHEMES.COM AND ARE LICENSED UNDER ENVATO'S REGULAR/EXTENDED LICENSE --- REDISTRIBUTION IS NOT ALLOWED! */

(function($) {

	$(document).ready(function(){

		$('#scripts').append('<!-- this chunk of code was added by js for design purposes --><span id="rTablet"></span><span id="rMobile"></span><span id="rMini"></span><span id="rNormal"></span>');

		var $body = $('body'),
		$html = $('html'),
		ie8 = $('html').hasClass('ie8'),
		touchM = "ontouchstart" in window,
		$rMobile = $('#rMobile'),
		$rTablet = $('#rTablet'),
		$rNormal = $('#rNormal'),
		rValue = 0;

		$html.removeClass('no-js');

		if(touchM) $('html').removeClass('no-touch');

		if($rNormal.css('display') == 'block') rValue = 0;
		else if($rTablet.css('display') == 'block') rValue = 1;

		$(window).bind('resize', function(){

			if($rNormal.css('display') == 'block' && rValue != 0){
				rValue = 0;  
				handleResize();     
			} else if($rTablet.css('display') == 'block' && rValue != 1){
				rValue = 1;
				handleResize();
			} else if($rMobile.css('display') == 'block' && rValue != 2){
				rValue = 2;
				handleResize();
			}

		});

		handleResize();

		var firstPies = false;
		if($('.rbStats.pie').length > 0){
			if(!firstPies && $(window).scrollTop() > ($('.rbStats.pie').offset().top - $(window).height() + 150)){
				firstPies = true;
				handleResize();
			}
			$(window).scroll(function() {
				if(!firstPies && $(window).scrollTop() > ($('.rbStats.pie').offset().top - $(window).height() + 150)){
					firstPies = true;
					handleResize();
				}
			});
		}

		function handleResize(){

			/* Pie shortcode needs to be here, because it gets reinitialized for the iPad */

			$('.rbStats.pie').each(function(){

				if(!ie8 && firstPies){

					var $this = $(this);
					$this.addClass('initialized');

					if(rValue == 1) {
						var size = 170
						width = 16,
						radius = 69;
					} else {
						var size = 220
						width = 26,
						radius = 84;
					}

					$this.find('.circles').remove();
					$this.append('<div class="circles"><span class="pieBack"></span><canvas class="pieFront" width="' + size + '" height="' + size + '"></canvas></div>'); 

					var $stats = $(this).children('ul').children('li'),
					$value = $(this).children('.holder').children('p'),
					$title = $(this).children('.holder').children('h5');

					var pieCanvas = $(this).find('.pieFront')[0];

					var circle = new ProgressCircle({
						canvas: pieCanvas,
						minRadius: radius,
						arcWidth: width, 
						gapWidth: 2, 
						centerX: size/2,
						centerY: size/2, 
						infoLineLength: 200, 
						horizLineLength: 50, 
						infoLineBaseAngle: Math.PI / 6, 
						infoLineAngleInterval: Math.PI / 8
					});

					var pI, 
					p = 0,
					s = 0;

					circle.addEntry({
						fillColor: '#DBDBDB',
						progressListener: function() {
							return p;
						}
					}); 

					function changeStats(percent, value, title){

						p = 0; 
						clearInterval(pI);
						circle.stop();

						var t = 0, 
						tI = value/percent;
						circle.start(5);

						pI = setInterval(function() {

							p = p + 0.0025;
							t = Math.floor(p*100*tI);

							if(p >= percent/100){
								circle.stop();
								clearInterval(pI);
								p = 0;
							}

							$value.text(t);

						}, 5); 

						$title.stop().fadeOut(100)
						.text(title)
						.fadeIn(100);

					}

					changeStats(parseInt($stats.eq(0).data('percent')), parseInt($stats.eq(0).data('value')), $stats.eq(0).find('h5').text());

					$(this).children('.buttons').children('.btnPrev').click(function(){
						s = s-1 < 0 ? $stats.length-1 : s-1;
						changeStats(parseInt($stats.eq(s).data('percent')), parseInt($stats.eq(s).data('value')), $stats.eq(s).find('h5').text());
						return false;
					});

					$(this).children('.buttons').children('.btnNext').click(function(){
						s = s+1 >= $stats.length ? 0 : s+1;
						changeStats(parseInt($stats.eq(s).data('percent')), parseInt($stats.eq(s).data('value')), $stats.eq(s).find('h5').text());
						return false;
					});

				}

			});

		}

    /* ---------------------------------------------------------------------------------
    ------------------------------   BLOG CUSTOM CODE   ----------------------------------
    ------------------------------------------------------------------------------------*/

    if($body.hasClass('page-template-template-blog-modern-php') || $('.rbPosts.modern.jxtrue').length > 0){

    	var enablePosts = true;
    	var articleOpened = false;
    	var $articleObject = null;

    	var $allPosts = $('article.post');
    	var $allContainer = $('.postsContainer.modern');

    	$('.postsContainer.modern').find('article a').click(function(){
    		$(this).parent().css('height', 'auto');
    		clickArticle($(this));
    		return false;
    	});

    	function clickArticle($this){

    		if($this.data('type') == 'link') {

    			newW = window.open($this.prop('href'));
    			if(window.focus) {
    				newW.focus();
    				return false;
    			}

    		} else {

    			$article = $this.parent();

    			document.location.hash = '#/' + $this.data('slug');

    			if(enablePosts) {

    				if(!$article.hasClass('opened')) {

    					enablePosts = false;

    					if(!articleOpened) {

    						/* Open Article - From Nothing */

    						articleOpened = true;
    						$articleObject = $article;

    						setTimeout(
    							function(){
    								openArticle($article)
    							}, 1);

    					} else {

    						/* Open Article - From Opened Post */

    						setTimeout(
    							function(){
    								openArticle($article)
    							}, 500);

    						closeArticle($articleObject);

    						$articleObject = $article;

    					}

    				} else {

    					/* Close Article */

    					enablePosts = false;
    					articleOpened = false;
    					$articleObject = null;

    					closeArticle($article);

    					document.location.hash = '#/';

    				}

    			}

    		}

    	}

    	function closeArticle($article){
    		$article.find('#pContent').stop().slideUp(300, 'easeInQuad', function(){
    			$(this).parent().removeClass('opened');
    			$(this).remove();
    			enablePosts = true;
    		});
    	}

    	function openArticle($article){

    		$('html,body').animate({scrollTop: $article.offset().top}, 300, 'easeInQuad');

    		$article.addClass('opened');
    		$article.append('<span class="preloader"></span>');

    		$article.find('span.preloader').delay(350).animate({'height': 150}, 150, function(){
    			$.ajax({
    				url: $article.find('a').prop('href') + ($article.find('a').prop('href').indexOf('?') > 0 ? '&m=true' : '?m=true'),
    				dataType: 'html'
    			}).done(function(data){
    				$article
    				.css('min-height', '210px')
    				.find('span.preloader').fadeOut(100, function(){

    					$(this).remove();

    					$article.append($(data).find('#pContent'));
    					$article.find('#pContent').stop().delay(350).slideDown(500, 'easeInSine', function(){
    						enablePosts = true;
    						$article.css('min-height', '0');

    						if($(this).find('.flexslider').length > 0){
    							var $img = $(this).find('.slides').children('li').eq(0).children('img');
    							if(!$img[0].complete)
    								$img.load(function(){
    									initAll();
    								});
    							else
    								initAll();
    						} else {
    							initAll();
    						};
    					});

    				});
    			});
    		});
    	}

    	/* HASH */

    	var hash = document.location.hash.slice(2, document.location.hash.length);
    	var $ok = null;

    	if(hash != ''){

    		$('article a').each(function(){
    			if($(this).data('slug') == hash)
    				$ok = $(this);
    		});

    		if($ok != null){
    			clickArticle($ok);
    		} else {
    			document.location.hash = '#/';
    		}

    	}

    	/* MORE */

    	var enablePag = true;
    	var isPag = $('.pagination').find('.nav-prev').length > 0 ? true : false;
    	var pagURL = isPag ? $('.pagination').find('.nav-prev').prop('href') : '';
    	var $moreSpan = $('a.morePosts span');

    	var kPage = 1, kAt = kItems = parseInt(themeObjects.blogPage), kPages = Math.ceil($allPosts.length/kItems);

    	var $allVPosts = $allPosts.slice(0, kAt);

    	$('.postsContainer.modern').find('a.morePosts').click(function(){

    		if(enablePag){

    			enablePag = false;
    			$moreSpan.text('').addClass('loading');

    			setTimeout(function(){

    				if(kPage < kPages){

    					var kPag = 0;

    					$slicedPosts = $allPosts.slice(kAt, kAt + kItems);

    					$slicedPosts.each(function(){
    						$(this).height(0).delay(50*kPag++).animate({'height': 60}, 100, 'easeOutQuad');
    					});

    					kPage++;
    					kAt += kItems;
    					$allVPosts = $allPosts.slice(0, kAt);

    					if(kPage < kPages){
    						$moreSpan.removeClass('loading').text($moreSpan.data('more'));
    						setTimeout(function(){
    							enablePag = true;
    						}, 1000);
    					} else {
    						$moreSpan.removeClass('loading').text($moreSpan.data('less'));
    						$moreSpan.parent().addClass('nomore');
    						enablePag = false;
    					}

    				} else {

    					$moreSpan.removeClass('loading').text($moreSpan.data('less'));
    					$moreSpan.parent().addClass('nomore');
    					enablePag = false;

    				}

    			}, 500);

    		}

    		return false;

    	});

	function filterBlog(filter){

		document.location.hash = '#/';

		if(articleOpened)
			closeArticle($articleObject);

		$moreSpan.text('').addClass('loading');
		enablePag = false;

		var fK = 0, $fL = $allVPosts.last();
		$filter.addClass('disabled').animate({'opacity': .4}, 50);

		$allVPosts.animate({'height': 0}, 100, 'linear', function(){

			if($(this).prop('id') == $fL.prop('id')){

				if(filter != '*'){

					$allVPosts = $allContainer.find(filter);

					$allVPosts.delay(500).animate({'height': 60}, 100, 'easeOutQuad', function(){
						$filter.removeClass('disabled').animate({'opacity': 1}, 50);
					});

				} else {

					kPage = 1;
					kAt = kItems = parseInt(themeObjects.blogPage);
					kPages = Math.ceil($allPosts.length/kItems);

					$allVPosts = $allPosts.slice(0, kAt);

					$allVPosts.delay(500).animate({'height': 60}, 100, 'easeOutQuad', function(){
						$filter.removeClass('disabled').animate({'opacity': 1}, 50);
					});

				}

			}

			setTimeout(function(){

				if(filter != '*') {
					$moreSpan.removeClass('loading').text($moreSpan.data('less'));
					$moreSpan.parent().addClass('nomore');
					enablePag = false;
				} else {
					$moreSpan.removeClass('loading').text($moreSpan.data('more'));
					$moreSpan.parent().removeClass('nomore');
					enablePag = true;
				}

			}, 1000);

		});

	}

}

    /* ---------------------------------------------------------------------------------
    -----------------------   FILTERS - FOR BLOG & PORTFOLIO   ------------------------
    ------------------------------------------------------------------------------------*/

    var $filter = $('#filter'),
    $filterList = $filter.children('ul'),
    $filterItems = $filterList.children('li'),
    openFilter = true;

    $filterList.data('baseBorder', $filterList.css('borderLeftColor'))
    $filterList.data('baseBack', $filterList.css('backgroundColor'))

    $filterItems.each(function(){
    	$(this).css('display', 'inline');
    	$(this).data('width', $(this).width()+1);
    	$(this).data('height', 20);
    	if(!$(this).hasClass('active')) {
    		$(this).css('width', 0);
    		$(this).css('display', 'none');
    	}
    });

    if(touchM){

    	$filter.click(function(){

    		if(!$(this).hasClass('disabled')) {
    			if(openFilter) {
    				openFilters();
    			}
    		}
    		return false;
    	});

    } else {

    	$filter.hover(function(){

    		if(!$(this).hasClass('disabled')) {
    			if(openFilter) {
    				openFilters();
    			}
    		}

    	}, function(){
    		closeFilters();
    	});

    }

    function openFilters(){

    	$filter.addClass('opened');

    	$('.reactive').removeClass('reactive');

    	$filterList.stop().animate({'backgroundColor': themeObjects.mainColor, 'borderColor': themeObjects.mainColor}, 100);

    	$filterItems.each(function(){
    		if($rMobile.css('display') != 'block') {
    			$(this).css({'width': 1, 'display': 'inline-block'}).stop().animate({'width': $(this).data('width')}, 200);
    		} else {
    			$(this).stop().animate({'height': $(this).data('height')}, 200);
    		}
    	});

    }

    function closeFilters(){

    	$filter.removeClass('opened');

    	$filterList.stop().animate({'backgroundColor': $filterList.data('baseBack'), 'borderColor': $filterList.data('baseBorder')}, 100);

    	$filterItems.each(function(){
    		if(!$(this).hasClass('active')){
    			if($rMobile.css('display') != 'block')
    				$(this).stop().animate({'width': 0}, 100, function(){
    					$(this).css('display', 'none');
    				});
    			else
    				$(this).stop().animate({'height': 0}, 100);
    		}
    	});

    }

    var $folioItems = $('#portfolio').find('#items').children('li');;

    $filterItems.children('a').click(function(){

    	if(!$(this).parent().parent().hasClass('disabled') && !$(this).hasClass('direct')) {

    		if(openFilter && !$(this).parent().hasClass('active')){

    			$filterList.find('.active').removeClass('active');
    			$(this).parent().addClass('active');
    			$(this).parent().addClass('reactive');

    			openFilter = false;
    			closeFilters();

    			setTimeout(function(){
    				openFilter = true;
    			}, 1000);

    			if($(this).parent().parent().hasClass('portfolioFilter')){
    				$('#portfolio #items').isotope({filter: $(this).data('filter')});
    				if(projectOpened)
    					clickCloseProject();
    			} else {
    				filterBlog($(this).data('filter'));
    			}

    		}

    		if(!touchM) 
    			return false;

    	}

    });

    if($body.hasClass('page-template-template-portfolio-php') || $('.portfolio.atrue').length > 0) {

    	/* Portfolio Init */

    	$('#items').imagesLoaded(function(){
    		$('#items').isotope({
    			itemSelector: '.item',
    			layoutMode: 'fitRows',
    			animationOptions: {
    				duration: 1000,
    				easing: 'easeInQuint'
    			}
    		});
    	});

    	/* Portfolio AJAX */

    	var projectEnable = true,
    	projectOpened = false,
    	projectTop = $body.hasClass('page-template-template-portfolio-php') ? 80 : 40;

    	$('.portfolio.atrue, #portfolio.atrue').find('.item a').click(function(){
    		if(projectEnable)
    			preopenProject($(this).prop('href'), $(this).data('slug'));
    		return false;
    	});

    	var $folioHolder = $('#folioDetails'), $folioDetails = null;

    	function preopenProject(href, slug){

    		document.location.hash = '#/' + slug;

    		if(projectEnable){

    			projectEnable = false;

    			if(!projectOpened){
    				openProject(href);
    			} else {

    				$('html,body').animate({scrollTop: $folioHolder.offset().top-projectTop}, 300, 'easeInQuad');

    				$folioDetails.delay(350).animate({'opacity': 0}, 500, function(){
    					$(this).remove();
    				});

    				$folioHolder.delay(350).animate({'height': 60}, 500, function(){
    					$(this).addClass('loading');
    					openProject(href);
    				});

    			}

    		}

    	}

    	function openProject(href){

    		if(!projectOpened)
    			$('html,body').animate({scrollTop: $folioHolder.offset().top-projectTop}, 300, 'easeInQuad');

    		projectOpened = true;

    		$folioHolder.addClass('loading').css('display', 'block').delay(400).animate({'height': 60, 'marginBottom': 50, 'opacity': 1}, 300, function(){

    			$.ajax({
    				url: href,
    				dataType: 'html'
    			}).done(function(data){

    				$folioDetails = $(data).find('#projectDetails');
    				$folioHolder.append($folioDetails);
    				$folioHolder.css('overflow', 'hidden');

    				var imgsLoaded = 0,
    				imgsTotal = $folioDetails.find('img').length;

    				if(imgsTotal > 0){
    					$folioDetails.find('img').each(function(){
    						if(!$(this)[0].complete){
    							$(this).load(function(){
    								imgsLoaded++;
    								testLoading(false);
    							});
    						} else {
    							imgsLoaded++;
    							testLoading(false);
    						}
    					})
    				} else {
    					testLoading(true);
    				}

    				function testLoading(done){
    					if(!done) {
    						if(imgsLoaded == imgsTotal) {
    							initAll();
    							setTimeout(function(){
    								showPage();
    							}, 1000);
    						}
    					} else {
    						initAll();
    						setTimeout(function(){
    							showPage();
    						}, 1000);
    					}
    				}

    				function showPage(){
    					$folioHolder.animate({'height': $folioDetails.outerHeight()}, 1000).removeClass('loading');
    					$folioDetails.delay(300).animate({'opacity': 1}, 500, 'linear', function(){
    						projectEnable = true;
    					})
    				}

    				$folioDetails.find('.btnPrev').on('click', clickOtherProject);
    				$folioDetails.find('.btnNext').on('click', clickOtherProject);
    				$folioDetails.find('.btnClose').on('click', clickCloseProject);

    			});

});

}

function clickOtherProject(e){
	if(projectEnable)
		preopenProject($(e.target).prop('href'), $(e.target).data('slug'));
	return false;
}
function clickCloseProject(){

	$folioDetails.delay(350).animate({'opacity': 0}, 500, function(){
		$(this).remove();
	});

	$folioHolder.delay(350).animate({'height': 0, 'opacity': 0, 'marginBottom': 0}, 500, function(){
		projectEnable = true;
		projectOpened = false;
	});

	document.location.hash = '#/';

	return false;
}

/* HASH */

var hash = document.location.hash.slice(2, document.location.hash.length);
var $ok = null;

if(hash != ''){

	$('.item a').each(function(){
		if($(this).data('slug') == hash)
			$ok = $(this);
	});

	if($ok != null){
		preopenProject($ok.prop('href'), $ok.data('slug'));
	} else {
		document.location.hash = '#/';
	}

}

} else {

	if($('.rbProjects').length>0){

		$('.rbProjects #items').imagesLoaded(function(){
			$(this).isotope({
				itemSelector: '.item',
				layoutMode: 'fitRows',
				animationOptions: {
					duration: 1000,
					easing: 'easeInQuint'
				}
			});
		});

	}

}


    /* -------------------------------
    -----   Menu  -----
    ---------------------------------*/

    var $menu = $('#menu'),
    $oMenu = null;


    $menu.find('li').each(function(){

    	$submenu = $(this).children('ul');

    	if($submenu.length > 0){

    		var minW = 180;
    		$submenu.css('display', 'block');
    		$submenu.children('li').each(function(){
    			$(this).addClass('menuFix');
    			if($(this).width() > minW)
    				minW = $(this).width();
    			$(this).removeClass('menuFix');
    		});
    		$submenu.css('display', 'none').width(minW);
    		$submenu.find('ul').css('left', minW);

    	}

    });

    if(1 == 1){

    	$menu.find('li').hover(function(){
    		openMenu($(this));
    	}, function(){
    		closeMenu($(this));
    	});

    } else {

    	$menu.find('li').each(function(){

    		$(this).click(function(){

    			if($oMenu == null){

    				openMenu($(this));
    				$oMenu = $(this);

    			} else {

    				if($(this)[0] === $oMenu[0]){

    					closeMenu($oMenu);
    					$oMenu = null;

    				} else {

    					closeMenu($oMenu);
    					openMenu($(this));
    					$oMenu = $(this);

    				}
    			}

    			if($(this).find('li').length > 0 && rValue == 0)
    				return false;

    		});

    	});

    }

    function openMenu($this){

    	if($menu.children('.responsive').css('display') != 'block'){

    		if($this.children('ul').length > 0)
    			$this.children('ul').stop().slideDown(200, function(){
    				$(this).css('overflow', 'visible');
    			});

    	}

    }

    function closeMenu($this){

    	if($menu.children('.responsive').css('display') != 'block'){

    		if($this.children('ul').length > 0)
    			$this.children('ul').stop().slideUp(100);

    	}

    }

    $menu.children('.responsive').click(function(){

    	if(!$(this).hasClass('opened')){
    		$(this).addClass('opened');
    		$(menu).children('ul').stop().slideDown(400);
    	} else {
    		$(this).removeClass('opened');
    		$(menu).children('ul').stop().slideUp(300);
    	}

    });

    /* -------------------------------
    -----   General Inits  -----
    ---------------------------------*/

    function initAll(){

      /* -------------------------------
      -----   Init Comments Reply Script  -----
      ---------------------------------*/

      addComment = {
      	moveForm : function(commId, parentId, respondId, postId) {
      		var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');

      		if ( ! comm || ! respond || ! cancel || ! parent )
      			return;

      		t.respondId = respondId;
      		postId = postId || false;

      		if ( ! t.I('wp-temp-form-div') ) {
      			div = document.createElement('div');
      			div.id = 'wp-temp-form-div';
      			div.style.display = 'none';
      			respond.parentNode.insertBefore(div, respond);
      		}

          //comm.parentNode.insertBefore(respond, comm.nextSibling);
          if ( post && postId )
          	post.value = postId;
          parent.value = parentId;
          cancel.style.display = '';

          $('html,body').animate({scrollTop: $('#reply-title').offset().top}, 500, 'easeInQuad');

          cancel.onclick = function() {
          	var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

          	if ( ! temp || ! respond )
          		return;

          	t.I('comment_parent').value = '0';
          	temp.parentNode.insertBefore(respond, temp);
          	temp.parentNode.removeChild(temp);
          	this.style.display = 'none';
          	this.onclick = null;
          	return false;
          }

          try { t.I('comment').focus(); }
          catch(e) {}

          return false;
      },

      I : function(e) {
      	return document.getElementById(e);
      }
  }

  var commentform=$('#comment-form'); 
  commentform.prepend('<div id="comment-status"></div>'); 
  var statusdiv=$('#comment-status');

  commentform.submit(function(){

  	var formdata=commentform.serialize();
  	statusdiv.html('<p>' + themeObjects.commentProcess + '</p>');
  	var formurl=commentform.prop('action');

  	$.ajax({
  		type: 'post',
  		url: formurl,
  		data: formdata,
  		error: function(XMLHttpRequest, textStatus, errorThrown){
  			statusdiv.html('<p class="wdpajax-error">' + themeObjects.commentError + '</p>');
  		},
  		success: function(data, textStatus){
            //if(data=="success")
            statusdiv.html('<p class="ajax-success">' + themeObjects.commentSuccess + '</p>');
            //else
            //statusdiv.html('<p class="ajax-error" >Please wait a while before posting your next comment</p>');
            //commentform.find('textarea[name=comment]').val('');
        }
    });

  	return false;

  });

      /* -------------------------------
      -----   Init Slider - Flexslider FOLIO   -----
      ---------------------------------*/

      setTimeout(function(){
      	$('.rev.blank.fullwidth .tp-bullets.simplebullets').find('.bullet').append('<span></span>');

      }, 100);


      $('.flexslider').flexslider({

      	animation: "slide", /* "slide" or "fade" */
      	direction: "horizontal", /* if the animation is set to slide, this can be either "horizontal" or "vertical" */
      	easing: "easeInSine", /* based on the default jQuery Easing object */
      	keyboard: true, /* this can be true only if you don't plan to add multiple sliders per papge */
      	slideshowSpeed: 5000, /* time between slides(milliseconds) */
      	animationSpeed: 500, /* animation speed(milliseconds) */
      	slideshow: true, /* set the slider to animate automatically */
      	randomize: false, /* randomize slide order, on load */

      	/* do not edit below tihs line! */

      	video: true,
      	pauseOnHover: true,
      	smoothHeight: false,
      	start: function($slider){
      		$slider.css('height', 'auto');
      		$(window).trigger('resize');
      	}

      });
      
      /* -------------------------------
      -----   Init Audio & Video Widgets   -----
      ---------------------------------*/

      $('audio,video').each(function(){
      	var $this = $(this);
      	$(this).mediaelementplayer({
      		alwaysShowControls: true,
      		autosizeProgress: false,
      		iPadUseNativeControls: false,
      		iPhoneUseNativeControls: false,
      		AndroidUseNativeControls: false,
      		enableKeyboard: false,
      		pluginPath: themeObjects.base + '/js/mediaelement/'
    	});
      });

      // Embedded videos

        $('.video-embedded').append('<div class="mejs-overlay-play"><div class="mejs-overlay-button"></div></div>')
            .find('.mejs-overlay-play').click(function(e){

                var $this = $(this).closest('.video-embedded');

                if(!$this.hasClass('loading')) {

                    var href = $this.data('href'),
                        id = $this.data('id');

                    $this.append('<div class="css-loader"></div><a href="#" class="close-iframe close-btn-special"></a><iframe id="video-frame-' + id + '" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + ($html.hasClass('ie') ? ' allowtransparency="true"' : '') + '></iframe>')

                        .addClass('loading')

                        .find('.close-iframe').click(function(){
                            $(this).closest('.video-embedded')
                                .removeClass('loading')
                                .find('iframe, .close-iframe').remove();
                        });

                    $('#video-frame-' + id).prop('src', href)   
                        .load(function(){
                            $(this).animate({'opacity': 1}, 200)
                                .siblings('.css-loader').remove();
                        });

                }     

                e.preventDefault();

            });

      /* -------------------------------
      -----   Comments Actions   -----
      ---------------------------------*/

      $('#comments-title').click(function(){
      	if($(this).hasClass('closed')){

      		$(this).removeClass('closed');
      		$(this).addClass('opened');
      		$(this).text($(this).data('hide') + ' (' + $(this).data('no') + ')');

      		$('#commentsShow').stop().slideDown(300, 'easeInQuad');

      		$('html,body').animate({scrollTop: $(this).offset().top}, 500, 'easeInQuad');

      	} else {

      		$(this).removeClass('opened');
      		$(this).addClass('closed');
      		$(this).text($(this).data('show') + ' (' + $(this).data('no') + ')');

      		$('#commentsShow').stop().slideUp(300);
      	}
      });

      /* -------------------------------
      -----   Enable Smooth Scrolling   -----
      ---------------------------------*/

      $('a[href*=#]').click(function() {
      	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
      		&& location.hostname == this.hostname) {
      		var $target = $(this.hash);
      	$target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
      	if ($target.length) {
      		var targetOffset = $target.offset().top;
      		$('html,body').animate({scrollTop: targetOffset}, 500, 'easeInQuad');
      		return false;     
      	}
      }
  });

      /* -------------------------------
      -----   Accordions   -----
      ---------------------------------*/

      $('.rbAccordion').each(function(){

      	var toggle = $(this).hasClass('toggle') ? true : false,
      	$sections = $(this).children('section'),
      	$opened = $(this).data('opened') == '-1' ? null : $sections.eq(parseInt($(this).data('opened')));

      	if($opened != null){
      		$opened.addClass('opened');
      		$opened.children('div').slideDown(0);
      	}

      	$(this).children('section').children('h4').click(function(){

      		$this = $(this).parent();

      		if(!toggle){
      			if($opened != null){
      				$opened.removeClass('opened');
      				$opened.children('div').stop().slideUp(300);
      			}
      		}

      		if($this.hasClass('opened') && toggle){
      			$this.removeClass('opened');
      			$this.children('div').stop().slideUp(300);
      		} else if(!$this.hasClass('opened')){
      			$opened = $this;
      			$this.addClass('opened');
      			$this.children('div').stop().slideDown(300);
      		}

      	});

      });

      /* -------------------------------
      -----   Fancybox   -----
      ---------------------------------*/

      
      $('img.alignleft, img.alignright, img.aligncenter').parent('a').each(function(){
      	$(this).attr('class', 'fancybox fancybox-thumb ' + $(this).children('img').attr('class'));
      });

      if($('.fancybox').length > 0 || $('div[id*="attachment"]').length > 0){

      	$('.fancybox, div[id*="attachment"] > a').fancybox({
      		padding: 0,
      		margin: 50,
      		aspectRatio: true,
      		scrolling: 'no',
      		mouseWheel: false,
      		openMethod: 'zoomIn',
      		closeMethod: 'zoomOut',
      		nextEasing: 'easeInQuad',
      		prevEasing: 'easeInQuad'
      	}).append('<span></span>');
      }


      /* -------------------------------
      -----   Stats   -----
      ---------------------------------*/

      $('.rbStats.bars, .ie8 .rbStats.pie').each(function(){

      	$bar = $(this).children('ul').children('li').children('p');
      	$bar.html('<span>' + $(this).data('value') + '<span>');
      	$bar.children('span').each(function(){
      		$(this).animate({width: $(this).parent().parent().data('percent') + '%'}, Math.random()*1000+1000, 'easeInQuad');
      	});

      });

      /* -------------------------------
      -----   Tabs   -----
      ---------------------------------*/
      
      $('.rbTabs').each(function(){

      	var $titles = $(this).children('.titles').children('li'),
      	$contents = $(this).children('.contents').children('div'),
      	$openedT = $titles.eq(0),
      	$openedC = $contents.eq(0);

      	$openedT.addClass('opened');

      	$titles.find('a').prop('href', '#').unbind('click');;

      	$titles.click(function(){

      		$openedT.removeClass('opened');
      		$openedT = $(this);
      		$openedT.addClass('opened');

      		$openedC.stop().slideUp(200);
      		$openedC = $contents.eq($(this).index());
      		$openedC.stop().delay(200).slideDown(200);

      		return false;

      	});

      });

  }

  initAll();


    /* ---------------------------------------------------------------------------------
    ------------------------------   FUNCTIONS & TRICKS   ----------------------------------
    ------------------------------------------------------------------------------------*/

    /* -------------------------------
    -----   Open links in popups   -----
    ---------------------------------*/

    $('a.popup').click(function(){
    	var up = window.open($(this).prop('href'), $(this).data('name'), $(this).data('height'), $(this).data('width'));
    	if(window.focus) up.focus();
    	return false;
    })

    /* -------------------------------
    -----   Cool Hover   -----
    ---------------------------------*/

    $('.ch').append('<span class="hover"><span class="circle"><!-- added by js --></span></span>');

    /* -------------------------------
    -----   Input Text Replacement   -----
    ---------------------------------*/

    $('input, textarea').each(function(){

    	if(!$(this).hasClass('submit') && $(this).prop('type') != 'submit' && $(this).prop('type') != 'button' && $(this).parent().parent().prop('id') != 'form_pay'){
    		$(this).data('value', $(this).val())
    		.focus(function(){
    			$(this).addClass('focusInput');
    			if($(this).val() == $(this).data('value')){
    				$(this).val('');
    			} else {
    				$(this).select();
    			}
    		})
    		.blur(function(){
    			$(this).removeClass('focusInput');
    			if($(this).val() == ''){
    				$(this).val($(this).data('value'));
    			}
    		});
    	}

    });

    /* -------------------------------
    -----   Crowdfunding   -----
    ---------------------------------*/

    $('.ignitiondeck .grid_wrap').parent().attr('class', 'clearfix');

    $('.id-widget-wrap, .id-widget.id-mini.ignitiondeck').each(function(){

    	// Declare variables

    	var $idProductTitle = $(this).find('.id-product-title:not(:empty)'),
	    	$progressPercentage = $(this).find('.progress-percentage:not(:empty)'),
	    	$idProgressRaised = $(this).find('.id-progress-raised:not(:empty)'),
	    	$idProductFunding = $(this).find('.id-product-funding:not(:empty)'),
	    	$idProductTotal = $(this).find('.id-product-total:not(:empty)'),
	    	$idProductDays = $(this).find('.id-product-days:not(:empty)'),
	    	$idWidgetDate = $(this).find('.id-widget-date:not(:empty)'),

    		wDomTemp = '';

		// Wrap some elements in proper DOM holders

		if ( $idProgressRaised.length > 0 ) {
			wDomTemp = '<div class="c-holder"><span class="product-goal" style="clear:both;">' + $idProgressRaised.text().replace(' ', '') + '</span><span class="helper">' + themeObjects.idText2 + '</span></div>';
			$idProgressRaised.html(wDomTemp);
		}

		if ( $idProductFunding.length > 0 ) {
			var curr = $idProductFunding.text().match( /\$|Kč|Kr|€|Ft|₪|¥|RM|₱|zł|£|Fr|kr|฿|₤|R$/, '' );
			wDomTemp = '<div class="c-holder"><span class="product-goal" style="clear:both;">' + ( curr != null && curr[0] != '' ? curr[0] : '' ) + $idProductFunding.text().match( /\d/g, '').join('') + '</span><span class="helper">' + themeObjects.idText3 + '</span></div>';
			$idProductFunding.html(wDomTemp);
		}

		if ( $idProductTotal.length > 0 ) {
			wDomTemp = '<div class="c-holder"><span style="clear:both;">' + $idProductTotal.text() + '</span><span class="helper">' + themeObjects.idText4 + '</span></div>';
			$idProductTotal.html(wDomTemp);
		}

		if ( $idWidgetDate.length > 0 ) {
			wDomTemp = '<div class="c-holder"><div style="clear:both;">' + parseDate($idWidgetDate) + '</div><span class="helper">' + themeObjects.idText5 + '</span></div>';			
			$idWidgetDate.html(wDomTemp);
		}

		/*
		if ( $idProductDays.length > 0 ) {
			wDomTemp = '<div class="c-holder days"><div style="clear:both;">' + $idProductDays.text() + '</div><span class="helper">' + themeObjects.idText6 + '</span></div>';			
			$idProductDays.html(wDomTemp);
		}*/

		// Classes, wraps and all kinds of magic stuff

		$(this).find('.c-holder').wrapAll('<div class="wrap1 clearfix">');
		$(this).find('.c-holder:nth-child(odd)').addClass('c1');
		$(this).find('.c-holder:nth-child(even)').addClass('c2');

		$(this).find('.product-wrapper, .id-product-proposed-end, .wrap1').wrapAll('<div class="miniF">');

		$(this).find('.btn-container, .id-product-description, .id-product-levels').wrapAll('<div class="id-widget-wrap nofloat">');

		$idProductTitle.attr('class', 'product-name');
		$(this).find('.img_cur').attr('class', 'product-image-container');

		$(this).attr('class', 'id-widget-wrap nofloat');
		$(this).find('div.id-widget.ignitiondeck').removeClass('ignitiondeck');

		$('.level-binding:odd').find('.level-group').addClass('odd');

		if($(this).find('.id-product-levels').children('*').length<=0){
			$(this).find('.id-product-levels').remove();
		}

		$('.id-product-description:empty').remove();

	});

	$('.grid_wrap').find('.grid_item').click(function(){
		window.location.href = $(this).find('.learn-more-button').attr('href');
	}).attr('style', '');

	$('.id-widget-wrap, .id-widget.id-mini.ignitiondeck').css('display', 'block');

	if($('.grid_wrap').length>0){

		$('.grid_wrap').isotope({
			itemSelector: '.grid_item',
			layoutMode: 'fitRows',
			animationOptions: {
				duration: 1000,
				easing: 'easeInQuint'
			}
		});

	}

if(!ie8) {

	$('.miniF .progress-percentage').each(function(){

		var $this = $(this),
		perc = parseInt($this.text());
		$this.text('').css('textIndent', '0');

		$this.append('<p></p><div class="circles full"><span class="pieBack"></span><canvas class="pieFront" width="56" height="56"></canvas></div>'); 

		$(this).parent().append('<span class="helper h1">' + themeObjects.idText1 + '</span>');

		var $text = $this.find('p');

		var pieCanvas = $(this).find('.pieFront')[0];

		var circle = new ProgressCircle({
			canvas: pieCanvas,
			minRadius: 1,
			arcWidth: 26, 
			gapWidth: 0, 
			centerX: 0,
			centerY: 0, 
			infoLineLength: 200, 
			horizLineLength: 50, 
			infoLineBaseAngle: Math.PI / 6, 
			infoLineAngleInterval: Math.PI / 8
		});

		var pI, 
		p = 0,
		s = 0;

		circle.addEntry({
			fillColor: themeObjects.mainColor,
			progressListener: function() {
				return p;
			}
		}); 

		function changeStats(percent){

			p = 0; 
			clearInterval(pI);
			circle.stop();

			var t = 0, 
			tI = percent;
			circle.start(5);

			pI = setInterval(function() {

				p = p + 0.0025;
				t = Math.floor(p*100*tI);

				$text.text(Math.round(p*100) + '%');

				if(p >= percent/100){
					circle.stop();
					clearInterval(pI);
					p = 0;
				}

			}, 5); 

		}

		changeStats(perc);

	});

}

function parseDate($obj){

	var year = $obj.find('.id-widget-year').text(),
	day = $obj.find('.id-widget-day').text(),
	month = $obj.find('.id-widget-month').text();

	month = month.replace('January', '01');
	month = month.replace('February', '02');
	month = month.replace('March', '03');
	month = month.replace('April', '04');
	month = month.replace('May', '05');
	month = month.replace('June', '06');
	month = month.replace('July', '07');
	month = month.replace('August', '08');
	month = month.replace('September', '09');
	month = month.replace('October', '10');
	month = month.replace('November', '11');
	month = month.replace('December', '12');

	return month + '/' + day + '/' + year.replace('20', '');

}

    /* -------------------------------
    -----   Posts   -----
    ---------------------------------*/

    $('.rbPosts.classic').each(function(){

    	var $holder = $(this).children('.holder'),
    	$articles = $holder.children('article'),
    	no = parseInt($(this).data('no')),
    	page = 1,
    	pages = Math.ceil($articles.length / no),
    	pI = 0,
    	enableBtn = true;

    	$(this).find('.btnNext').click(function(){
    		
    		if(enableBtn && page < pages) {

    			enableBtn = false;

    			var k = 0;
    			for(var i=pI; i<pI+no; i++){
    				$articles.eq(i).stop().fadeOut(250);
    				$articles.eq(i+no).stop().delay(250).fadeIn(250);
    			}

    			page++;
    			pI = pI+no;

    			setTimeout(function(){
    				enableBtn = true;
    			}, 600);

    		}
    		return false;
    	});

    	$(this).find('.btnPrev').click(function(){
    		if(enableBtn && page > 1) {

    			enableBtn = false

    			var k = 0;

    			for(var i=pI; i<pI+no; i++){
    				$articles.eq(i).stop().fadeOut(250);
    				$articles.eq(i-no).stop().delay(250).fadeIn(250);
    			}

    			page--;
    			pI = pI-no;

    			setTimeout(function(){
    				enableBtn = true;
    			}, 600);

    		}
    		return false;
    	});

    	$(this).find('.buttons').css('marginTop', -parseInt($(this).prev('.sectionTitle').css('marginBottom')));

    });

    /* -------------------------------
    -----   Projects   -----
    ---------------------------------*/

    $('.rbProjects').each(function(){

    	$(this).find('.btnAll').css('marginTop', -parseInt($(this).prev('.sectionTitle').css('marginBottom')));

    });

    /* -------------------------------
    -----   Style all selects   -----
    ---------------------------------*/

    jQuery('#form_pay #level_select').addClass('nostyle');
    jQuery('select:not(.nostyle)').styledSelect();

    /* -------------------------------
    -----   Twitter Widget   -----
    ---------------------------------*/

    $('.rbTwitter.rotenabled').each(function(){
    	var $tW = $(this).children('ul').children('li'),
    	tI = 0,
    	tV = setInterval(function(){

    		$tW.eq(tI).fadeOut(250);
    		if(++tI == $tW.length)
    			tI = 0;
    		$tW.eq(tI).delay(260).fadeIn(300);

    	}, 6000);
    });
    
    /* -------------------------------
    -----   Go Top Button   -----
    ---------------------------------*/

    $('#top').click(function(){
    	$('html,body').animate({scrollTop: 0}, 500, 'easeInQuad');
    	return false;
    });

    $('.post.format-link').find('.pTitle').prop('target', '_blank');

    /* -------------------------------
    -----   Contact Forms   -----
    ---------------------------------*/

    $('.rbForm').each(function(){

    	var $form = $(this).find('form'),
    	$name = $(this).find('.name'),
    	$email = $(this).find('.email'),
    	$subject = $(this).find('.subject'),
    	$message = $(this).find('.message'),
    	$success = $(this).find('.successMessage'),
    	$error = $(this).find('.errorMessage');

    	$name.focus(function(){resetError($(this))});
    	$email.focus(function(){resetError($(this))});
    	$subject.focus(function(){resetError($(this))});
    	$message.focus(function(){resetError($(this))});

    	function resetError($input){
    		$input.removeClass('contactErrorBorder');
    		$error.fadeOut();
    	}

    	$form.submit(function(){

    		var ok = true;
    		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    		if($name.val().length < 3 || $name.val() == $name.data('value')){
    			showError($name);
    			ok = false;
    		}

    		if($email.val() == '' || $email.val() == $email.data('value') || !emailReg.test($email.val())){
    			showError($email);
    			ok = false;
    		}

    		if($message.val().length < 5 || $message.val() == $message.data('value')){
    			showError($message);
    			ok = false;
    		}

    		if($(this).hasClass('full') && ($subject.val().length < 3 || $subject.val() == $subject.data('value'))){
    			showError($subject);
    			ok = false;
    		}

    		function showError($input){
    			$input.val($input.data('value'));
    			$input.addClass('contactErrorBorder');
    			$error.fadeIn();
    		}

    		if(ok){

    			$form.fadeOut();

    			$.ajax({
    				type: $form.prop('method'),
    				url: $form.prop('action'),
    				data: $form.serialize(),
    				success: function(){
    					$success.fadeIn();
    				}
    			});

    		}

    		return false;

    	});

	});

    /* -------------------------------
    -----   DPI Cookie   -----
    ---------------------------------*/

    var retina = window.devicePixelRatio > 1;
    document.cookie = 'dpi' + '=' + retina + '; expires=1 Aug 2020';

  /* -------------------------------
  -----   Add social links failsafe   -----
  ---------------------------------*/

  $('.rbSocial li').click(function(){
  	var $a = $(this).find('a');
  	if($a.prop('target') == '')
  		$a.prop('target', '_self');
  	window.open($a.prop('href'), $a.prop('target'));
  	return false;
  });

  /* -------------------------------
  -----   Rework CSS3 Transitions   -----
  ---------------------------------*/

  if($('html').hasClass('no-csstransitions')) {

  	/* Portfolio - A */

  	$('.tone #items a').each(function(){

  		var $this = $(this),
  		$caption = $(this).find('.caption'),
  		$h3 = $(this).find('h3'),
  		$img = $(this).find('img'),

  		iMargin = $(this).css('marginTop'),
  		iPadding = $caption.css('paddingTop'),
  		iHeight = $caption.outerHeight(),
  		iBackground = $caption.css('backgroundColor'),
  		iBorder = $caption.css('borderBottomColor'),
  		iColor = $h3.css('color'),
  		iOpacity = .8;

  		$(this).addClass('iehover');

  		setTimeout(function(){

  			var eMargin = $this.css('marginTop'),
  			ePadding = $caption.css('paddingTop'),
  			eHeight = $caption.outerHeight(),
  			eBackground = $caption.css('backgroundColor'),
  			eBorder = $caption.css('borderBottomColor'),
  			eColor = $h3.css('color'),
  			eOpacity = 1;

  			$this.removeClass('iehover');
  			$img.css('opacity', iOpacity);

  			$this.hover(function(){

  				$this.stop().animate({
  					'marginTop': eMargin
  				}, 250, 'linear');
  				$caption.stop().animate({
  					'paddingTop': ePadding,
  					'height': eHeight,
  					'backgroundColor': eBackground,
  					'borderColor': eBorder
  				}, 250, 'linear');
  				$h3.stop().animate({
  					'color': eColor
  				}, 250, 'linear');
  				$img.stop().animate({
  					'opacity': eOpacity
  				}, 250, 'linear');

  			}, function(){

  				$this.stop().animate({
  					'marginTop': iMargin
  				}, 250, 'linear');
  				$caption.stop().animate({
  					'paddingTop': iPadding,
  					'height': iHeight,
  					'backgroundColor': iBackground,
  					'borderColor': iBorder
  				}, 250, 'linear');
  				$h3.stop().animate({
  					'color': iColor
  				}, 250, 'linear');
  				$img.stop().animate({
  					'opacity': iOpacity
  				}, 250, 'linear');

  			});

  		}, 1);

});

/* Portfolio - B */

$('.ttwo #items a').each(function(){

	var $this = $(this),
	$caption = $(this).find('.caption'),

	iPadding = $caption.css('paddingTop'),
	iOpacity = 0;

	$(this).addClass('iehover');

	setTimeout(function(){

		var ePadding = $caption.css('paddingTop'),
		eOpacity = 1;

		$this.removeClass('iehover');
		$caption.css('opacity', iOpacity);

		$this.hover(function(){

			$caption.stop().animate({
				'paddingTop': ePadding,
				'opacity': eOpacity
			}, 250, 'linear');

		}, function(){

			$caption.stop().animate({
				'paddingTop': iPadding,
				'opacity': iOpacity
			}, 250, 'linear');

		});

	}, 1)

});

}

  /* -------------------------------
  -----   WooCommerce   -----
  ---------------------------------*/

  if($('body').hasClass('woocommerce-page')){

  	/* Move Elements */

  	$('.woocommerce-result-count, .woocommerce-ordering').appendTo('#pageTitle').fadeIn(0);

  	/* Show Slider */

  	$('.price_slider_wrapper').on('slidecreate', 
  		function(event, ui) { 
  			$(this).fadeIn(0);
  			$(this).find('a').addClass('noa');
  		} 
  		);

  	/* Isotope Thumbnails */

  	$('ul.products').imagesLoaded(function(){
  		$('ul.products').isotope({
  			itemSelector: '.product',
  			layoutMode: 'fitRows'
  		});
  	});

  	/* Images Cover */

  	$('.product_list_widget a').prepend('<span class="imgCover"></span>');

  	$('.product').find('.summary').find('.star-rating').addClass('visible').appendTo($('.product').find('.summary').find('.star-rating').prev('div').css('position', 'relative'));

  	/* Add to cart button */

  	$('ul.products').find('a.add_to_cart_button').click(function(){
  		document.location.href = $(this).prop('href');
  		return false;
  	});

  	/* Order by title */

  	$('.woocommerce-ordering').find('.select-replace').text($('.woocommerce-ordering').find('option:selected').text());

  }


});

$(window).load(function(){
   if($('body').hasClass('page-template-template-portfolio-php')){
     setTimeout(function(){
    	$('#portfolio #items').isotope({
    	   itemSelector: '.item',
    	   layoutMode: 'fitRows',
    	   animationOptions: {
              duration: 1000,
    	      easing: 'easeInQuint'
    	   }
    	});
     }, 1000);
   }
});

})(jQuery);