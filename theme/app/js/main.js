/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/css/main.css":
/*!*****************************!*\
  !*** ./assets/css/main.css ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./assets/js/main.js":
/*!***************************!*\
  !*** ./assets/js/main.js ***!
  \***************************/
/***/ (() => {



function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = _unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t["return"] || t["return"](); } finally { if (u) throw o; } } }; }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
var main = {
  /**
   * Theme's components/functions list
   * Comment out or delete the unnecessary component.
   * Some components have dependencies (plugins).
   * Do not forget to remove dependency from src/js/vendor/ and recompile.
   */
  init: function init() {
    main.stickyHeader();
    main.subMenu();
    main.offCanvas();
    main.isotope();
    main.onepageHeaderOffset();
    main.spyScroll();
    main.anchorSmoothScroll();
    main.svgInject();
    main.backgroundImage();
    main.backgroundImageMobile();
    main.imageHoverOverlay();
    main.rellax();
    main.scrollCue();
    main.swiperSlider();
    main.lightbox();
    main.plyr();
    main.progressBar();
    main.loader();
    main.pageProgress();
    main.counterUp();
    main.bsTooltips();
    main.bsPopovers();
    main.bsModal();
    main.iTooltip();
    main.forms();
    main.passVisibility();
    main.pricingSwitcher();
    main.textRotator();
    main.codeSnippet();
  },
  /**
   * Sticky Header
   * Enables sticky behavior on navbar on page scroll
   * Requires assets/js/vendor/headhesive.min.js
  */
  stickyHeader: function stickyHeader() {
    var navbar = document.querySelector(".navbar");
    if (navbar == null) return;
    var options = {
      offset: 350,
      offsetSide: 'top',
      classes: {
        clone: 'navbar-clone fixed',
        stick: 'navbar-stick',
        unstick: 'navbar-unstick'
      },
      onStick: function onStick() {
        var navbarClonedClass = this.clonedElem.classList;
        if (navbarClonedClass.contains('transparent') && navbarClonedClass.contains('navbar-dark')) {
          this.clonedElem.className = this.clonedElem.className.replace("navbar-dark", "navbar-light");
        }
      }
    };
    var banner = new Headhesive('.navbar', options);
  },
  /**
   * Sub Menus
   * Enables multilevel dropdown
   */
  subMenu: function subMenu() {
    (function ($bs) {
      var CLASS_NAME = 'has-child-dropdown-show';
      $bs.Dropdown.prototype.toggle = function (_original) {
        return function () {
          document.querySelectorAll('.' + CLASS_NAME).forEach(function (e) {
            e.classList.remove(CLASS_NAME);
          });
          var dd = this._element.closest('.dropdown').parentNode.closest('.dropdown');
          for (; dd && dd !== document; dd = dd.parentNode.closest('.dropdown')) {
            dd.classList.add(CLASS_NAME);
          }
          return _original.call(this);
        };
      }($bs.Dropdown.prototype.toggle);
      document.querySelectorAll('.dropdown').forEach(function (dd) {
        dd.addEventListener('hide.bs.dropdown', function (e) {
          if (this.classList.contains(CLASS_NAME)) {
            this.classList.remove(CLASS_NAME);
            e.preventDefault();
          }
          e.stopPropagation();
        });
      });
    })(bootstrap);
  },
  /**
   * Offcanvas
   * Enables offcanvas-nav, closes offcanvas on anchor clicks, focuses on input in search offcanvas
   */
  offCanvas: function offCanvas() {
    var navbar = document.querySelector(".navbar");
    if (navbar == null) return;
    var navOffCanvasBtn = document.querySelectorAll(".offcanvas-nav-btn");
    var navOffCanvas = document.querySelector('.navbar:not(.navbar-clone) .offcanvas-nav');
    var bsOffCanvas = new bootstrap.Offcanvas(navOffCanvas, {
      scroll: true
    });
    var scrollLink = document.querySelectorAll('.onepage .navbar li a.scroll');
    var searchOffcanvas = document.getElementById('offcanvas-search');
    navOffCanvasBtn.forEach(function (e) {
      e.addEventListener('click', function (event) {
        bsOffCanvas.show();
      });
    });
    scrollLink.forEach(function (e) {
      e.addEventListener('click', function (event) {
        bsOffCanvas.hide();
      });
    });
    if (searchOffcanvas != null) {
      searchOffcanvas.addEventListener('shown.bs.offcanvas', function () {
        document.getElementById("search-form").focus();
      });
    }
  },
  /**
   * Isotope
   * Enables isotope grid layout and filtering
   * Requires assets/js/vendor/isotope.pkgd.min.js
   * Requires assets/js/vendor/imagesloaded.pkgd.min.js
   */
  isotope: function isotope() {
    var grids = document.querySelectorAll('.itemgrid');
    if (grids != null) {
      grids.forEach(function (g) {
        var itemgrid = g.querySelector('.isotope');
        var filtersElem = g.querySelector('.isotope-filter');
        var buttonGroups = g.querySelectorAll('.isotope-filter');
        var iso = new Isotope(itemgrid, {
          itemSelector: '.item',
          layoutMode: 'masonry',
          masonry: {
            columnWidth: itemgrid.offsetWidth / 12
          },
          percentPosition: true,
          transitionDuration: '0.7s'
        });
        imagesLoaded(itemgrid).on("progress", function () {
          iso.layout({
            masonry: {
              columnWidth: itemgrid.offsetWidth / 12
            }
          });
        }), window.addEventListener("resize", function () {
          iso.arrange({
            masonry: {
              columnWidth: itemgrid.offsetWidth / 12
            }
          });
        }, true);
        if (filtersElem != null) {
          filtersElem.addEventListener('click', function (event) {
            if (!matchesSelector(event.target, '.filter-item')) {
              return;
            }
            var filterValue = event.target.getAttribute('data-filter');
            iso.arrange({
              filter: filterValue
            });
          });
          for (var i = 0, len = buttonGroups.length; i < len; i++) {
            var buttonGroup = buttonGroups[i];
            buttonGroup.addEventListener('click', function (event) {
              if (!matchesSelector(event.target, '.filter-item')) {
                return;
              }
              buttonGroup.querySelector('.active').classList.remove('active');
              event.target.classList.add('active');
            });
          }
        }
      });
    }
  },
  /**
   * Onepage Header Offset
   * Adds an offset value to anchor point equal to sticky header height on a onepage
   */
  onepageHeaderOffset: function onepageHeaderOffset() {
    var navbar = document.querySelector(".navbar");
    if (navbar == null) return;
    var header_height = document.querySelector(".navbar").offsetHeight;
    var shrinked_header_height = 75;
    var sections = document.querySelectorAll(".onepage section");
    sections.forEach(function (section) {
      section.style.paddingTop = shrinked_header_height + 'px';
      section.style.marginTop = '-' + shrinked_header_height + 'px';
    });
    var first_section = document.querySelector(".onepage section:first-of-type");
    if (first_section != null) {
      first_section.style.paddingTop = header_height + 'px';
      first_section.style.marginTop = '-' + header_height + 'px';
    }
  },
  /**
   * Spy Scroll
   * Highlights the active nav link while scrolling through sections
   */
  spyScroll: function spyScroll() {
    var section = document.querySelectorAll('section[id]');
    var navLinks = document.querySelectorAll('.nav-link.scroll');
    window.onscroll = function () {
      section.forEach(function (sec) {
        var top = window.scrollY; //returns the number of pixels that the document is currently scrolled vertically.
        var offset = sec.offsetTop - 0; //returns the distance of the outer border of the current element relative to the inner border of the top of the offsetParent, the closest positioned ancestor element
        var height = sec.offsetHeight; //returns the height of an element, including vertical padding and borders, as an integer
        var id = sec.getAttribute('id'); //gets the value of an attribute of an element
        if (top >= offset && top < offset + height) {
          navLinks.forEach(function (links) {
            links.classList.remove('active');
            document.querySelector(".nav-link.scroll[href*=".concat(id, "]")).classList.add('active');
            //[att*=val] Represents an element with the att attribute whose value contains at least one instance of the substring "val". If "val" is the empty string then the selector does not represent anything.
          });
        }
      });
    };
  },
  /**
   * Anchor Smooth Scroll
   * Adds smooth scroll animation to links with .scroll class
   * Requires assets/js/vendor/smoothscroll.js
   */
  anchorSmoothScroll: function anchorSmoothScroll() {
    var links = document.querySelectorAll(".scroll");
    var _iterator = _createForOfIteratorHelper(links),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var link = _step.value;
        link.addEventListener("click", clickHandler);
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
    function clickHandler(e) {
      e.preventDefault();
      this.blur();
      var href = this.getAttribute("href");
      var offsetTop = document.querySelector(href).offsetTop;
      scroll({
        top: offsetTop,
        behavior: "smooth"
      });
    }
  },
  /**
   * SVGInject
   * Replaces an img element with an inline SVG so you can apply colors to your SVGs
   * Requires assets/js/vendor/svg-inject.min.js
   */
  svgInject: function svgInject() {
    SVGInject.setOptions({
      onFail: function onFail(img, svg) {
        img.classList.remove('svg-inject');
      }
    });
    document.addEventListener('DOMContentLoaded', function () {
      SVGInject(document.querySelectorAll('img.svg-inject'), {
        useCache: true
      });
    });
  },
  /**
   * Background Image
   * Adds a background image link via data attribute "data-image-src"
   */
  backgroundImage: function backgroundImage() {
    var bg = document.querySelectorAll(".bg-image");
    for (var i = 0; i < bg.length; i++) {
      var url = bg[i].getAttribute('data-image-src');
      bg[i].style.backgroundImage = "url('" + url + "')";
    }
  },
  /**
   * Background Image Mobile
   * Adds .mobile class to background images on mobile devices for styling purposes
   */
  backgroundImageMobile: function backgroundImageMobile() {
    var isMobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1 || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) ? true : false;
    if (isMobile) {
      document.querySelectorAll(".image-wrapper").forEach(function (e) {
        e.classList.add("mobile");
      });
    }
  },
  /**
   * Image Hover Overlay
   * Adds span.bg inside .overlay for simpler markup and styling purposes
   */
  imageHoverOverlay: function imageHoverOverlay() {
    var overlay = document.querySelectorAll('.overlay > a, .overlay > span');
    for (var i = 0; i < overlay.length; i++) {
      var overlay_bg = document.createElement('span');
      overlay_bg.className = "bg";
      overlay[i].appendChild(overlay_bg);
    }
  },
  /**
   * Rellax.js
   * Adds parallax animation to shapes and elements
   * Requires assets/js/vendor/rellax.min.js
   */
  rellax: function rellax() {
    if (document.querySelector(".rellax") != null) {
      window.onload = function () {
        var rellax = new Rellax('.rellax', {
          speed: 2,
          center: true,
          breakpoints: [576, 992, 1201]
        });
        var projects_overflow = document.querySelectorAll('.projects-overflow');
        imagesLoaded(projects_overflow, function () {
          rellax.refresh();
        });
      };
    }
  },
  /**
   * scrollCue.js
   * Enables showing elements by scrolling
   * Requires assets/js/vendor/scrollCue.min.js
   */
  scrollCue: function (_scrollCue) {
    function scrollCue() {
      return _scrollCue.apply(this, arguments);
    }
    scrollCue.toString = function () {
      return _scrollCue.toString();
    };
    return scrollCue;
  }(function () {
    scrollCue.init({
      interval: -400,
      duration: 700,
      percentage: 0.8
    });
    scrollCue.update();
  }),
  /**
   * Swiper Slider
   * Enables carousels and sliders
   * Requires assets/js/vendor/swiper-bundle.min.js
   */
  swiperSlider: function swiperSlider() {
    var carousel = document.querySelectorAll('.swiper-container');
    for (var i = 0; i < carousel.length; i++) {
      var slider1 = carousel[i];
      slider1.classList.add('swiper-container-' + i);
      var controls = document.createElement('div');
      controls.className = "swiper-controls";
      var pagi = document.createElement('div');
      pagi.className = "swiper-pagination";
      var navi = document.createElement('div');
      navi.className = "swiper-navigation";
      var prev = document.createElement('div');
      prev.className = "swiper-button swiper-button-prev";
      var next = document.createElement('div');
      next.className = "swiper-button swiper-button-next";
      slider1.appendChild(controls);
      controls.appendChild(navi);
      navi.appendChild(prev);
      navi.appendChild(next);
      controls.appendChild(pagi);
      var sliderEffect = slider1.getAttribute('data-effect') ? slider1.getAttribute('data-effect') : 'slide';
      if (slider1.getAttribute('data-items-auto') === 'true') {
        var slidesPerViewInit = "auto";
        var breakpointsInit = null;
      } else {
        var sliderItems = slider1.getAttribute('data-items') ? slider1.getAttribute('data-items') : 3; // items in all devices
        var sliderItemsXs = slider1.getAttribute('data-items-xs') ? slider1.getAttribute('data-items-xs') : 1; // start - 575
        var sliderItemsSm = slider1.getAttribute('data-items-sm') ? slider1.getAttribute('data-items-sm') : Number(sliderItemsXs); // 576 - 767
        var sliderItemsMd = slider1.getAttribute('data-items-md') ? slider1.getAttribute('data-items-md') : Number(sliderItemsSm); // 768 - 991
        var sliderItemsLg = slider1.getAttribute('data-items-lg') ? slider1.getAttribute('data-items-lg') : Number(sliderItemsMd); // 992 - 1199
        var sliderItemsXl = slider1.getAttribute('data-items-xl') ? slider1.getAttribute('data-items-xl') : Number(sliderItemsLg); // 1200 - end
        var sliderItemsXxl = slider1.getAttribute('data-items-xxl') ? slider1.getAttribute('data-items-xxl') : Number(sliderItemsXl); // 1500 - end
        var slidesPerViewInit = sliderItems;
        var breakpointsInit = {
          0: {
            slidesPerView: Number(sliderItemsXs)
          },
          576: {
            slidesPerView: Number(sliderItemsSm)
          },
          768: {
            slidesPerView: Number(sliderItemsMd)
          },
          992: {
            slidesPerView: Number(sliderItemsLg)
          },
          1200: {
            slidesPerView: Number(sliderItemsXl)
          },
          1400: {
            slidesPerView: Number(sliderItemsXxl)
          }
        };
      }
      var sliderSpeed = slider1.getAttribute('data-speed') ? slider1.getAttribute('data-speed') : 500;
      var sliderAutoPlay = slider1.getAttribute('data-autoplay') !== 'false';
      var sliderAutoPlayTime = slider1.getAttribute('data-autoplaytime') ? slider1.getAttribute('data-autoplaytime') : 5000;
      var sliderAutoHeight = slider1.getAttribute('data-autoheight') === 'true';
      var sliderResizeUpdate = slider1.getAttribute('data-resizeupdate') !== 'false';
      var sliderAllowTouchMove = slider1.getAttribute('data-drag') !== 'false';
      var sliderReverseDirection = slider1.getAttribute('data-reverse') === 'true';
      var sliderMargin = slider1.getAttribute('data-margin') ? slider1.getAttribute('data-margin') : 30;
      var sliderLoop = slider1.getAttribute('data-loop') === 'true';
      var sliderCentered = slider1.getAttribute('data-centered') === 'true';
      var swiper = slider1.querySelector('.swiper:not(.swiper-thumbs)');
      var swiperTh = slider1.querySelector('.swiper-thumbs');
      var sliderTh = new Swiper(swiperTh, {
        slidesPerView: 5,
        spaceBetween: 10,
        loop: false,
        threshold: 2,
        slideToClickedSlide: true
      });
      if (slider1.getAttribute('data-thumbs') === 'true') {
        var thumbsInit = sliderTh;
        var swiperMain = document.createElement('div');
        swiperMain.className = "swiper-main";
        swiper.parentNode.insertBefore(swiperMain, swiper);
        swiperMain.appendChild(swiper);
        slider1.removeChild(controls);
        swiperMain.appendChild(controls);
      } else {
        var thumbsInit = null;
      }
      var slider = new Swiper(swiper, {
        on: {
          beforeInit: function beforeInit() {
            if (slider1.getAttribute('data-nav') !== 'true' && slider1.getAttribute('data-dots') !== 'true') {
              controls.remove();
            }
            if (slider1.getAttribute('data-dots') !== 'true') {
              pagi.remove();
            }
            if (slider1.getAttribute('data-nav') !== 'true') {
              navi.remove();
            }
          },
          init: function init() {
            if (slider1.getAttribute('data-autoplay') !== 'true') {
              this.autoplay.stop();
            }
            this.update();
          }
        },
        autoplay: {
          delay: sliderAutoPlayTime,
          disableOnInteraction: false,
          reverseDirection: sliderReverseDirection,
          pauseOnMouseEnter: false
        },
        allowTouchMove: sliderAllowTouchMove,
        speed: parseInt(sliderSpeed),
        slidesPerView: slidesPerViewInit,
        loop: sliderLoop,
        centeredSlides: sliderCentered,
        spaceBetween: Number(sliderMargin),
        effect: sliderEffect,
        autoHeight: sliderAutoHeight,
        grabCursor: true,
        resizeObserver: false,
        updateOnWindowResize: sliderResizeUpdate,
        breakpoints: breakpointsInit,
        pagination: {
          el: carousel[i].querySelector('.swiper-pagination'),
          clickable: true
        },
        navigation: {
          prevEl: slider1.querySelector('.swiper-button-prev'),
          nextEl: slider1.querySelector('.swiper-button-next')
        },
        thumbs: {
          swiper: thumbsInit
        }
      });
    }
  },
  /**
   * GLightbox
   * Enables lightbox functionality
   * Requires assets/js/vendor/glightbox.js
   */
  lightbox: function lightbox() {
    var lightbox = GLightbox({
      selector: '*[data-glightbox]',
      touchNavigation: true,
      loop: false,
      zoomable: false,
      autoplayVideos: true,
      moreLength: 0,
      slideExtraAttributes: {
        poster: ''
      },
      plyr: {
        css: '',
        js: '',
        config: {
          ratio: '',
          fullscreen: {
            enabled: false,
            iosNative: false
          },
          youtube: {
            noCookie: true,
            rel: 0,
            showinfo: 0,
            iv_load_policy: 3
          },
          vimeo: {
            byline: false,
            portrait: false,
            title: false,
            transparent: false
          }
        }
      }
    });
  },
  /**
   * Plyr
   * Enables media player
   * Requires assets/js/vendor/plyr.js
   */
  plyr: function plyr() {
    var players = Plyr.setup('.player', {
      loadSprite: true,
      fullscreen: {
        enabled: true,
        iosNative: true
      },
      muted: false
    });
  },
  /**
   * Progressbar
   * Enables animated progressbars
   * Requires assets/js/vendor/progressbar.min.js
   * Requires assets/js/vendor/noframework.waypoints.min.js
   */
  progressBar: function progressBar() {
    var pline = document.querySelectorAll(".progressbar.line");
    var pcircle = document.querySelectorAll(".progressbar.semi-circle");
    pline.forEach(function (e) {
      var line = new ProgressBar.Line(e, {
        strokeWidth: 6,
        trailWidth: 6,
        duration: 3000,
        easing: 'easeInOut',
        text: {
          style: {
            color: 'inherit',
            position: 'absolute',
            right: '0',
            top: '-30px',
            padding: 0,
            margin: 0,
            transform: null
          },
          autoStyleContainer: false
        },
        step: function step(state, line) {
          line.setText(Math.round(line.value() * 100) + ' %');
        }
      });
      var value = e.getAttribute('data-value') / 100;
      new Waypoint({
        element: e,
        handler: function handler() {
          line.animate(value);
        },
        offset: 'bottom-in-view'
      });
    });
    pcircle.forEach(function (e) {
      var circle = new ProgressBar.SemiCircle(e, {
        strokeWidth: 6,
        trailWidth: 6,
        duration: 2000,
        easing: 'easeInOut',
        step: function step(state, circle) {
          circle.setText(Math.round(circle.value() * 100));
        }
      });
      var value = e.getAttribute('data-value') / 100;
      new Waypoint({
        element: e,
        handler: function handler() {
          circle.animate(value);
        },
        offset: 'bottom-in-view'
      });
    });
  },
  /**
   * Loader
   * 
   */
  loader: function loader() {
    var preloader = document.querySelector('.page-loader');
    if (preloader != null) {
      document.body.onload = function () {
        setTimeout(function () {
          if (!preloader.classList.contains('done')) {
            preloader.classList.add('done');
          }
        }, 1000);
      };
    }
  },
  /**
   * Page Progress
   * Shows page progress on the bottom right corner of pages
   */
  pageProgress: function pageProgress() {
    var progressWrap = document.querySelector('.progress-wrap');
    if (progressWrap != null) {
      var progressPath = document.querySelector('.progress-wrap path');
      var pathLength = progressPath.getTotalLength();
      var offset = 50;
      progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
      progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
      progressPath.style.strokeDashoffset = pathLength;
      progressPath.getBoundingClientRect();
      progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
      window.addEventListener("scroll", function (event) {
        var scroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var progress = pathLength - scroll * pathLength / height;
        progressPath.style.strokeDashoffset = progress;
        var scrollElementPos = document.body.scrollTop || document.documentElement.scrollTop;
        if (scrollElementPos >= offset) {
          progressWrap.classList.add("active-progress");
        } else {
          progressWrap.classList.remove("active-progress");
        }
      });
      progressWrap.addEventListener('click', function (e) {
        e.preventDefault();
        window.scroll({
          top: 0,
          left: 0,
          behavior: 'smooth'
        });
      });
    }
  },
  /**
   * Counter Up
   * Counts up to a targeted number when the number becomes visible
   * Requires assets/js/vendor/counterup.min.js
   * Requires assets/js/vendor/noframework.waypoints.min.js
   */
  counterUp: function counterUp() {
    var counterUp = window.counterUp["default"];
    var counters = document.querySelectorAll(".counter");
    counters.forEach(function (el) {
      new Waypoint({
        element: el,
        handler: function handler() {
          counterUp(el, {
            duration: 1000,
            delay: 50
          });
          this.destroy();
        },
        offset: 'bottom-in-view'
      });
    });
  },
  /**
   * Bootstrap Tooltips
   * Enables Bootstrap tooltips
   * Requires Poppers library
   */
  bsTooltips: function bsTooltips() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        trigger: 'hover'
      });
    });
    var tooltipTriggerWhite = [].slice.call(document.querySelectorAll('[data-bs-toggle="white-tooltip"]'));
    var tooltipWhite = tooltipTriggerWhite.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl, {
        customClass: 'white-tooltip',
        trigger: 'hover',
        placement: 'left'
      });
    });
  },
  /**
   * Bootstrap Popovers
   * Enables Bootstrap popovers
   * Requires Poppers library
   */
  bsPopovers: function bsPopovers() {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl);
    });
  },
  /**
   * Bootstrap Modal
   * Enables Bootstrap modal popup
   */
  bsModal: function bsModal() {
    if (document.querySelector(".modal-popup") != null) {
      var myModalPopup = new bootstrap.Modal(document.querySelector('.modal-popup'));
      setTimeout(function () {
        myModalPopup.show();
      }, 200);
    }
    // Fixes jumping of page progress caused by modal
    var innerWidth = window.innerWidth;
    var clientWidth = document.body.clientWidth;
    var scrollSize = innerWidth - clientWidth;
    var myModalEl = document.querySelectorAll('.modal');
    var navbarFixed = document.querySelector('.navbar.fixed');
    var pageProgress = document.querySelector('.progress-wrap');
    function setPadding() {
      if (navbarFixed != null) {
        navbarFixed.style.paddingRight = scrollSize + 'px';
      }
      if (pageProgress != null) {
        pageProgress.style.marginRight = scrollSize + 'px';
      }
    }
    function removePadding() {
      if (navbarFixed != null) {
        navbarFixed.style.paddingRight = '';
      }
      if (pageProgress != null) {
        pageProgress.style.marginRight = '';
      }
    }
    myModalEl.forEach(function (myModalEl) {
      myModalEl.addEventListener('show.bs.modal', function (e) {
        setPadding();
      });
      myModalEl.addEventListener('hidden.bs.modal', function (e) {
        removePadding();
      });
    });
  },
  /**
   * iTooltip
   * Enables custom tooltip style for image hover docs/elements/hover.html
   * Requires assets/js/vendor/itooltip.min.js
   */
  iTooltip: function (_iTooltip) {
    function iTooltip() {
      return _iTooltip.apply(this, arguments);
    }
    iTooltip.toString = function () {
      return _iTooltip.toString();
    };
    return iTooltip;
  }(function () {
    var tooltip = new iTooltip('.itooltip');
    tooltip.init({
      className: 'itooltip-inner',
      indentX: 15,
      indentY: 15,
      positionX: 'right',
      positionY: 'bottom'
    });
  }),
  /**
   * Form Validation and Contact Form submit
   * Bootstrap validation - Only sends messages if form has class ".contact-form" and is validated and shows success/fail messages
   */
  forms: function forms() {
    (function () {
      "use strict";

      window.addEventListener("load", function () {
        var forms = document.querySelectorAll(".needs-validation");
        var inputRecaptcha = document.querySelector("input[data-recaptcha]");
        window.verifyRecaptchaCallback = function (response) {
          inputRecaptcha.value = response;
          inputRecaptcha.dispatchEvent(new Event("change"));
        };
        window.expiredRecaptchaCallback = function () {
          var inputRecaptcha = document.querySelector("input[data-recaptcha]");
          inputRecaptcha.value = "";
          inputRecaptcha.dispatchEvent(new Event("change"));
        };
        var validation = Array.prototype.filter.call(forms, function (form) {
          form.addEventListener("submit", function (event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add("was-validated");
            if (form.checkValidity() === true) {
              event.preventDefault();
              form.classList.remove("was-validated");
              // Send message only if the form has class .contact-form
              var isContactForm = form.classList.contains('contact-form');
              if (isContactForm) {
                var data = new FormData(form);
                var alertClass = 'alert-danger';
                fetch("assets/php/contact.php", {
                  method: "post",
                  body: data
                }).then(function (data) {
                  if (data.ok) {
                    alertClass = 'alert-success';
                  }
                  return data.text();
                }).then(function (txt) {
                  var alertBox = '<div class="alert ' + alertClass + ' alert-dismissible fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' + txt + '</div>';
                  if (alertClass && txt) {
                    form.querySelector(".messages").insertAdjacentHTML('beforeend', alertBox);
                    form.reset();
                    grecaptcha.reset();
                  }
                })["catch"](function (err) {
                  console.log(err);
                });
              }
            }
          }, false);
        });
      }, false);
    })();
  },
  /**
   * Password Visibility Toggle
   * Toggles password visibility in password input
   */
  passVisibility: function passVisibility() {
    var pass = document.querySelectorAll('.password-field');
    var _loop = function _loop() {
      var passInput = pass[i].querySelector('.form-control');
      var passToggle = pass[i].querySelector('.password-toggle > i');
      passToggle.addEventListener('click', function (e) {
        if (passInput.type === "password") {
          passInput.type = "text";
          passToggle.classList.remove('uil-eye');
          passToggle.classList.add('uil-eye-slash');
        } else {
          passInput.type = "password";
          passToggle.classList.remove('uil-eye-slash');
          passToggle.classList.add('uil-eye');
        }
      }, false);
    };
    for (var i = 0; i < pass.length; i++) {
      _loop();
    }
  },
  /**
   * Pricing Switcher
   * Enables monthly/yearly switcher seen on pricing tables
   */
  pricingSwitcher: function pricingSwitcher() {
    if (document.querySelector(".pricing-switchers") != null) {
      var wrapper = document.querySelectorAll(".pricing-wrapper");
      wrapper.forEach(function (wrap) {
        var switchers = wrap.querySelector(".pricing-switchers");
        var switcher = wrap.querySelectorAll(".pricing-switcher");
        var price = wrap.querySelectorAll(".price");
        switchers.addEventListener("click", function (e) {
          switcher.forEach(function (s) {
            s.classList.toggle("pricing-switcher-active");
          });
          price.forEach(function (p) {
            p.classList.remove("price-hidden");
            p.classList.toggle("price-show");
            p.classList.toggle("price-hide");
          });
        });
      });
    }
  },
  /**
   * ReplaceMe.js
   * Enables text rotator
   * Requires assets/js/vendor/replaceme.min.js
   */
  textRotator: function textRotator() {
    if (document.querySelector(".rotator-zoom") != null) {
      var replace = new ReplaceMe(document.querySelector('.rotator-zoom'), {
        animation: 'animate__animated animate__zoomIn',
        speed: 2500,
        separator: ',',
        clickChange: false,
        loopCount: 'infinite'
      });
    }
    if (document.querySelector(".rotator-fade") != null) {
      var replace = new ReplaceMe(document.querySelector('.rotator-fade'), {
        animation: 'animate__animated animate__fadeInDown',
        speed: 2500,
        separator: ',',
        clickChange: false,
        loopCount: 'infinite'
      });
    }
  },
  /**
   * Clipboard.js
   * Enables clipboard on docs
   * Requires assets/js/vendor/clipboard.min.js
   */
  codeSnippet: function codeSnippet() {
    var btnHtml = '<button type="button" class="btn btn-sm btn-white rounded-pill btn-clipboard">Copy</button>';
    document.querySelectorAll('.code-wrapper-inner').forEach(function (element) {
      element.insertAdjacentHTML('beforebegin', btnHtml);
    });
    var clipboard = new ClipboardJS('.btn-clipboard', {
      target: function target(trigger) {
        return trigger.nextElementSibling;
      }
    });
    clipboard.on('success', function (event) {
      event.trigger.textContent = 'Copied!';
      event.clearSelection();
      setTimeout(function () {
        event.trigger.textContent = 'Copy';
      }, 2000);
    });
    var copyIconCode = new ClipboardJS('.btn-copy-icon');
    copyIconCode.on('success', function (event) {
      event.clearSelection();
      event.trigger.textContent = 'Copied!';
      window.setTimeout(function () {
        event.trigger.textContent = 'Copy';
      }, 2300);
    });
  }
};
main.init();

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/main": 0,
/******/ 			"css/main": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunksandbox"] = self["webpackChunksandbox"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/main"], () => (__webpack_require__("./assets/js/main.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/main"], () => (__webpack_require__("./assets/css/main.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;