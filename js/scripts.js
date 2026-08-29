jQuery(document).ready(function ($) {


//hide/show gated area on webinars/videos
jQuery(document).on('gform_confirmation_loaded', function(event, loadedFormId) {
    if (loadedFormId === formId) {
        jQuery('.gatedVideo').show();
        jQuery('.gatedForm').hide();
        jQuery('.hasGatedForm').removeClass('hasGatedForm');
    }
});



//accordion slider
$('[id^="accSlider-"]').each(function(){
  $(this).accordionSlider({
    width:'100%',
    height:500,
    startPanel:0,
    openedPanelSize:'50%',
    maxOpenedPanelSize:'700px',
    openPanelDuration:150,
    closePanelDuration:150,
    panelDistance:10,
    visiblePanels:5,
    shadow:false,
    mouseWheel:false,
    closePanelsOnMouseOut:false,
    autoplay:false,
    openPanelOn:'click',
    responsiveMode:'custom',
    breakpoints:{
      1200:{panelDistance:5,openedPanelSize:'50%'},
      1024:{panelDistance:5,openedPanelSize:'66%'},
      768:{visiblePanels:5,panelDistance:2,openedPanelSize:'75%'},
      600:{visiblePanels:1,panelDistance:2,openedPanelSize:'100%'}
    }
  });
});



 
//card flip
setTimeout(function() {
  var tallest = 0;
  $('.card .cardSizer').each(function() {
    var h = $(this).outerHeight();
    if (h > tallest) tallest = h;
  });
  $('.flipCard').css('height', tallest);
}, 100);



//eyebrow search
$(document).ready(function(){
  var $icon = $('span.search-icon');
  var width = $icon.outerWidth();
  $icon.css('width', width);
  $('input#mega-search-116').css('margin-right', width + 2);
});


//margin adjustments for inline images
$('img.alignleft, img.alignright').each(function() {
  $(this).prev().addClass('increaseMar1');
});





$('.photoColumns .col .content p:last-child').each(function() {
  if ($(this).children('a.btn').length) {
    $(this).addClass('anchorBot');
  }
});



/*==============================================================*/
// filter anchor
/*==============================================================*/
// Ensure the #filters hash is appended on page load (in case it's not there already)
window.onload = function() {
    var currentUrl = new URL(window.location.href);
    
    // Check if there are search parameters (query parameters) in the URL indicating a search was performed
    if (currentUrl.search) {
        // If the page was reloaded and the URL doesn't have the #filters hash, add it
        if (!currentUrl.hash) {
            currentUrl.hash = '#filters';
            history.replaceState(null, null, currentUrl.toString()); // Use replaceState to avoid adding a new entry to the history
        }

        // If the hash exists, trigger the scroll to that element
        if (currentUrl.hash) {
            setTimeout(function() {
                var target = document.querySelector(currentUrl.hash);
                if (target) {
                    // Adjust the scroll position by adding 70px offset
                    window.scrollTo({
                        top: target.getBoundingClientRect().top + window.pageYOffset - 70,
                        behavior: 'smooth'
                    });
                }
            }, 300); // Timeout to allow the page to load fully before scrolling
        }
    }
};





/*==============================================================*/
// ol tweaks
/*==============================================================*/
$('ol > li').each(function(){
  var first = $(this).contents().filter(function(){ return this.nodeType === 1 || (this.nodeType === 3 && $.trim(this.nodeValue)); }).first();
  if (first.is('strong, b') || (first.is('p') && first.contents().filter(function(){ return this.nodeType === 1; }).first().is('strong, b'))) {
    $(this).addClass('boldNum');
  }
});






/*==============================================================*/
 // filterbar
 /*==============================================================*/
$(document).on('click','.filterbar .usa-accordion__button',function(){
  var $this=$(this);setTimeout(function(){
    if($this.attr('aria-expanded')==='true'){
      $this.addClass('open');
    } else {
      $this.removeClass('open');
    }
  },10);
});

$(document).on('click', '#clearUrl', function(e) {
  e.preventDefault();
  window.location.href = window.location.origin + window.location.pathname;
});

/*==============================================================*/
// popups
/*==============================================================*/
$(document).on('click', '.popTrigger', function() {
  var btnId = $(this).attr('id'); // e.g. "btn3"
  var targetId = btnId.replace('trigger', 'modal'); 
  
  $('.popModal').removeClass('open');
  var $target = $('#' + targetId);
  $target.addClass('open');

  var viewport = $(window).height();

  // Use a delay to ensure all content is rendered and dimensions are calculated
  setTimeout(function() {
    var formHeight = $target.find('.popup').outerHeight();
    $target.toggleClass('tallPop', formHeight > viewport);
  }, 50);
});

$(document).on('click', '.closeModal, .overlay', function(){
  $('.popModal').removeClass('open');
});









/*==============================================================*/
// load more
/*==============================================================*/
let currentPage = 1;

$('#loadMore').on('click', function() {
  currentPage++; // Increment the page number

  $.ajax({
    type: 'POST',
    url: '/wp-admin/admin-ajax.php',
    dataType: 'html', // Expecting HTML response
    data: {
      action: 'loadMoreEvents',
      paged: currentPage,
    },
    success: function (res) {
      // Append the HTML content returned from the server
      if (res) {
        $('.eventRoll').append(res);
      }

      // Check the hasMore JavaScript variable to hide the button if no more posts
      if (typeof hasMore !== 'undefined' && !hasMore) {
        $('#loadMore').fadeOut();
      }
    },
    error: function (xhr, status, error) {
      console.log('AJAX error:', status, error);
    }
  });
});






/*==============================================================*/
// h5 eyebrow centering
/*==============================================================*/
$('h5').filter(function() {
  return $(this).attr('style') && $(this).attr('style').includes('text-align: center');
}).addClass('centered').each(function() {
  if (!$(this).children('span').length) {
    $(this).wrapInner('<span></span>');
  }
});

/*==============================================================*/
// callout box hovers
/*==============================================================*/
// var $box = $('.boxedCallouts.type-imgroll .box');
//     var $rollover = $box.find('.rollover');
//     $box.height($box.height() + $rollover.outerHeight());
//     $rollover.hide();
// $('.box').hover(
//     function() {
//         $(this).find('.rollover').stop(true).slideDown(500);  // Slide up on hover
//     }, 
//     function() {
//         $(this).find('.rollover').stop(true).slideUp(500);  // Slide down when not hovered
//     }
// );

/*==============================================================*/
// footer
/*==============================================================*/
    $('footer#colophon .col li.label > a').each(function () {
        var text = $(this).html();
        $(this).replaceWith('<span>' + text + '</span>');
    });

    
/*==============================================================*/
// menu stuff
/*==============================================================*/
$('.icon-close').click(function() {
  $('.mega-menu-toggle').toggleClass('mega-menu-open'); //only if using with mm
});

$('.mobTop').wrapAll('<div class="mobTopWrap"></div>');
$('.mobHead').wrapAll('<div class="mobHeadWrap"></div>');

$('.mobTop.searchField').hide(); // hide it initially

$('.openMobSearch').on('click', function() {
  $('.mobTop.searchField').stop(true, true).slideToggle(300);
});


/*==============================================================*/
// nav stick
/*==============================================================*/
$(function() {
  var $nav = $("nav#primaryNav"),
      navHeight = $nav.outerHeight(),
      navOffset = $nav.offset().top;

  $(window).on("scroll", function() {
    var isStuck = $(window).scrollTop() >= navOffset;
    $nav.toggleClass("stick", isStuck);

    if (isStuck) {
      $('body').css('padding-top', navHeight + 'px');
    } else {
      $('body').css('padding-top', '');
    }
  }).trigger("scroll");
});




/*==============================================================*/
// prettify multiple buttons in p tag
/*==============================================================*/
$('.btn, .btnOutline, .btnOutline-dark, .btnOutline-white').hide();
$('.btn, .btnOutline, .btnOutline-dark, .btnOutline-white').each(function() {
    if ($(this).prev('.btn, .btnOutline, .btnOutline-dark, .btnOutline-white').length) {
        $(this).closest('p').addClass('multiBtn');
    }
});
$('.btn, .btnOutline, .btnOutline-dark, .btnOutline-white').fadeIn(0);


/*==============================================================*/
// counter
/*==============================================================*/

//*==============================================================*/
// Stat Slider Module
//*==============================================================*/


if($('.stat-slider').length)

$('.stat-slider').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: false,
  arrows: true,
  dots: false,
  responsive: [
  {
    breakpoint: 768,
    settings: {
      slidesToShow: 2,
      slidesToScroll: 1
    }
  },
  {
    breakpoint: 480,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1
    }
  }
]
});


//*==============================================================*/
// Stat Slider Module
//*==============================================================*/
function toggleSlick() {
    if ($(window).width() < 900) {
      if (!$('.flipSlider').hasClass('slick-initialized')) {
        $('.flipSlider').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
          dots: false,
          variableWidth: true,
          centerMode: true,
          infinite: false,
          prevArrow: $('.prev'),
          nextArrow: $('.next'),
        });
      }
    } else {
      if ($('.flipSlider').hasClass('slick-initialized')) {
        $('.flipSlider').slick('unslick');
      }
    }
  }

  toggleSlick();
  $(window).on('resize', toggleSlick);

/*===================================*/
// stat counter slider
/*===================================*/
var windowWidth = $(window).width();
if (windowWidth > 479) {
  $('.counter').counterUp({
      delay: 15,
      time: 1500,
  });
}

var numSlick = 0;

$('.col4 .statSlider').each( function() {
  numSlick++;
  $(this).addClass( 'slider-' + numSlick ).slick({
    adaptiveHeight: false,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    responsive: [
      {breakpoint: 1170, settings: {slidesToShow: 3,}},
      {breakpoint: 768, settings: {slidesToShow: 2,}},
      {breakpoint: 480, settings: {slidesToShow: 1,}},
    ]
  });
});

$('.col3 .statSlider').each( function() {
  numSlick++;
  $(this).addClass( 'slider-' + numSlick ).slick({
    adaptiveHeight: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    responsive: [
      {breakpoint: 768, settings: {slidesToShow: 2,}},
      {breakpoint: 480, settings: {slidesToShow: 1,}},
    ]
  });
});


$('.slides-four').on('click', '.slick-next', function () {
  if (windowWidth > 479 && windowWidth < 768 ) {
    var $slider = $(this).closest('.slick-slider');
    var $currentSlide = $slider.find('.slick-current');
    var $nextSlide = $currentSlide.next('.stat');
    $nextSlide.find('.counter').counterUp({
        delay: 15,
        time: 1500
    });
  }
});







/*==============================================================*/
//  slider
/*==============================================================*/
var numSlick = 0;
$('.logoSlider-col3').each( function() {
  numSlick++;
  $(this).addClass( 'slider-' + numSlick ).slick({
    autoplay: true,
    autoplaySpeed: 8000,
    adaptiveHeight: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    asNavFor: '.logoSlider-col3',
    responsive: [
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
      }
    },
  ]
  });
});
$('.logoSlider-col2').each( function() {
  numSlick++;
  $(this).addClass( 'slider-' + numSlick ).slick({
    autoplay: true,
    autoplaySpeed: 8000,
    adaptiveHeight: false,
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    asNavFor: '.logoSlider-col2',
  });
});

$('.testiSlider').each( function() {
  numSlick++;
  $(this).addClass( 'slider-' + numSlick ).slick({
    adaptiveHeight: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
  });
});


$('.factsheetSlider').each( function() {
  numSlick++;
  $(this).addClass( 'slider-' + numSlick ).slick({
    autoplay: false,
    adaptiveHeight: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    responsive: [
        {breakpoint: 1024,settings: {slidesToShow: 2,}},
        {breakpoint: 650,settings: {slidesToShow: 1,}},
    ]
  });
});



$('.productSlider').each( function() {
  numSlick++;
  $(this).addClass( 'slider-' + numSlick ).slick({
    adaptiveHeight: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: $('.prev'),
    nextArrow: $('.next'),
    dots: false,
  });
});




/*==============================================================*/
// smooth anchor scrolling
/*==============================================================*/
$("a").on('click', function(event) {
    linkUrl = this.href.match(/(^[^#]*)/)[0];
    currentUrl = document.location.href.match(/(^[^#]*)/)[0];
    if (this.hash !== "" && linkUrl == currentUrl) {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
        scrollTop: $(hash).offset().top - 125
      }, 800, function(){
        window.location.hash = hash;
      });
    } 
  });





/*==============================================================*/
// wrap iframe automatically so they can paste in embed code from youtube
/*==============================================================*/
$(".resourceSingle .primary .contentEditor iframe").wrap("<div class='embedContainer'>");



/*==============================================================*/
// ol tweaks to help imported content
/*==============================================================*/
$('ol').each(function(){
  var start = parseInt($(this).attr('start')) || 1
  $(this).css('counter-reset', 'numerals ' + (start - 1))
})





/*==============================================================*/
// closing arguments
/*==============================================================*/
});
