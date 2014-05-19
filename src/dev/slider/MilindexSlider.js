;(function($){
	
	"use strict";
	
	var LayerTypes = {
		'image' 	: MSImageLayerElement,
		'text'  	: MSLayerElement,
		'video' 	: MSVideoLayerElement,
		'hotspot'	: MSHotspotLayer
	};
	
	window.MilindexSlider = function(){
		
		// Default Options
		this.options = {
			autoplay 		: false,      // Enables the autoplay slideshow.
			loop 			: false,	  // Enables the continuous sliding mode.
			mouse			: true,		  // Whether the user can use mouse drag navigation.
			swipe			: true,		  // Whether the drag/swipe navigation is enabled.
			grabCursor		: true,		  // Whether the slider uses grab mouse cursor.
			space  			: 0,		  // The spacing value between slides in pixels.
			fillMode		: 'fill',  	  // Specifies the slide background scaling method. Its acceptable values are "fill", "fit", "stretch", "center" and "tile". 
			start			: 1,		  // The slider starting slide number.
			view			: 'basic',	  // The slide changing transition. 
			width			: 300,		  // The base width of slides. It helps the slider to resize in correct ratio.
			height			: 150,		  // The base height of slides, It helps the slider to resize in correct ratio.
			inView			: 15, 		  // Specifies number of slides which will be added at a same time in DOM.
			critMargin		: 1,		  // 
			heightLimit		: true,		  // It force the slide to use max height value as its base specified height value.
			smoothHeight	: true,		  // Whether the slider uses smooth animation while its height changes.
			autoHeight		: false,      // Whether the slider adapts its height to each slide height or not. It overrides heightLimit option.
			fullwidth		: false,	  // It enables the slider to adapt width to its parent element. It's very useful for creating full-width sliders. In default it takes max width as its base width value.
			fullheight		: false,	  // It enables the slider to adapt height to its parent element.
			autofill		: false,	  // It enables the slider to adapt width and height to its parent element, It's very useful for creating fullscreen or fullwindow slider.
			layersMode		: 'center',	  // It accepts two values "center" and "full". The "center" value indicates that the slider aligns layers to the center. This option is only effective in full width mode.
			hideLayers		: false,	  // Whether the slider hides all layers before changing slide.
			endPause		: false,	  // Whether the slider pauses slideshow when it stays at the last slide.
			centerControls 	: true,		  // Whether the slider aligns UI controls to center. This option is only effective in full width mode.
			overPause		: true,		  // Whether the slider pauses slideshow on hover.
			shuffle			: false,	  // Enables the shuffle slide order.
			speed			: 17, 		  // Specifies slide changing speed. It accepts float values between 0 and 100.
			dir				: 'h',		  // Specifies slide changing direction. It accepts two values "h" (horizontal) and "v" (vertical).
			preload			: 0,		  // Specifies number of slides which will be loaded by slider. 0 value means the slider loades slides in sequence.
			wheel			: false		  // Whether slider uses mouse wheel for navigation.
		};
		
		this.$element = null;

		this.slides = [];		
		var that = this;
		this.resize_listener = function(){that._resize();};
		$(window).bind('resize', this.resize_listener);
				
	};
	
	MilindexSlider.author  		= 'Averta Ltd. (www.averta.net)';
	MilindexSlider.version 		= '1.5.0';
	MilindexSlider.releaseDate 	= 'February 2014';
	
	var p = MilindexSlider.prototype;
	
	/*-------------- METHODS --------------*/

	p.__setupSlides = function(){
		var that = this,
			new_slide,
			ind = 0;
		
		this.$element.children('.ms-slide').each(function(index) {
			
			var $slide_ele = $(this);
			
			new_slide 			= new MSSlide();
			new_slide.$element 	= $slide_ele;
			new_slide.slider 	= that;
			new_slide.delay  	= $slide_ele.data('delay') 		!== undefined ? $slide_ele.data('delay') 		: 3;
			new_slide.fillMode 	= $slide_ele.data('fill-mode')	!== undefined ? $slide_ele.data('fill-mode') 	: that.options.fillMode;
			new_slide.index 	= ind++;

			// Slide Background Image
			var slide_img = $slide_ele.children('img');
			if(slide_img.length > 0 ) new_slide.setBG(slide_img[0]);
			
			// Slide Video Background
			var slide_video = $slide_ele.children('video');
			if(slide_video.length > 0) new_slide.setBGVideo(slide_video);

			// controls
			if(that.controls){
				for(var i = 0 , l = that.controls.length; i<l ; ++i)
					that.controls[i].slideAction(new_slide);
			}
			
			// Slide Link and Video
			var slide_link = $slide_ele.children('a').each(function(index) {
			  var $this = $(this);
			  if(this.getAttribute('data-type') === 'video'){
			  	new_slide.video = this.getAttribute('href');
			  	$this.remove();
			  }else if(!$this.hasClass('ms-layer')) {
			  	new_slide.link  = this.getAttribute('href');
			  	new_slide.link_targ = this.getAttribute('target');
			  	$this.remove();
			  }
			});//.remove();
			
			// Slide Layers
			that.__createSlideLayers(new_slide , $slide_ele.find('.ms-layer'));
			
			that.slides.push(new_slide);
			that.slideController.view.addSlide(new_slide);

		});
	};
	
	p.__createSlideLayers = function(slide , layers) {
		if(layers.length == 0) return;
		
		layers.each(function(index , domEle){
			var $layer_element,
				$parent_ele;
			
			if (domEle.nodeName === 'A'){
				$parent_ele = $(this);
				$layer_element = $parent_ele.find('img');
			}else{
				$layer_element = $(this);
			} 
			
			var layer = new (LayerTypes[$layer_element.data('type') || 'text']) ();
			
			layer.$element = $layer_element;
			
			layer.link = $parent_ele;
			
			var eff_parameters = {},
				end_eff_parameters = {};
		
			if($layer_element.data('effect')	!== undefined)		eff_parameters.name 			= $layer_element.data('effect');
			if($layer_element.data('ease')		!== undefined) 		eff_parameters.ease 			= $layer_element.data('ease');
			if($layer_element.data('duration')  !== undefined)  	eff_parameters.duration 		= $layer_element.data('duration');
			if($layer_element.data('delay')   	!== undefined)   	eff_parameters.delay			= $layer_element.data('delay');

			if($layer_element.data('hide-effect'))		    		end_eff_parameters.name 		= $layer_element.data('hide-effect');
			if($layer_element.data('hide-ease'))		   			end_eff_parameters.ease 		= $layer_element.data('hide-ease');
			if($layer_element.data('hide-duration') !== undefined)  end_eff_parameters.duration		= $layer_element.data('hide-duration');
			if($layer_element.data('hide-time') 	!== undefined)  end_eff_parameters.time 		= $layer_element.data('hide-time');
			
			if($layer_element.data('resize')   !== undefined) 		layer.resizable					= $layer_element.data('resize');
			if($layer_element.data('swipe')	   !== undefined)  		layer.swipe						= $layer_element.data('swipe');
					
			if($layer_element.data('widthlimit') !== undefined) 	layer.minWidth					= $layer_element.data('widthlimit');
			
			layer.setStartAnim(eff_parameters);
			layer.setEndAnim(end_eff_parameters);
			
			slide.addLayer(layer);
			
		});
		
	};
	
	p._removeLoading = function(){
		$(window).unbind('resize', this.resize_listener);
		this.$element = $('#' + this.id).removeClass('before-init')
										.css('visibility', 'visible')
										.css('height','')
										.css('opacity' , 0);
		CTween.fadeIn(this.$element);
		this.$loading.remove();

		if(this.slideController)
			this.slideController.__resize();
	};
	
	p._init = function(){

		if(this.preventInit) return;
		
		if(this.options.preload !== 'all')
			this._removeLoading();
		//else
		//	this.$element.css('width' , this.$loading[0].clientWidth);
		
		if(this.options.shuffle) 	this._shuffleSlides();

		MSLayerEffects.setup();
		
		this.slideController = new MSSlideController(this);
		this.view = this.slideController.view;
		
		this.api = this.slideController;
		
		if(this.controls){		
			this.$controlsCont = $('<div></div>').addClass('ms-container').appendTo(this.$element);
			if(this.options.centerControls)
				this.$controlsCont.css('max-width' , this.options.width + 'px');
				
			for(var i = 0 , l = this.controls.length; i<l ; ++i)
				this.controls[i].setup();
			
			this.$controlsCont.prepend(this.view.$element);
		}else{
			this.$element.append(this.view.$element);
		}
		
		this.__setupSlides();
		this.slideController.setup();
		
		if(this.controls){
			for(i = 0 , l = this.controls.length; i<l ; ++i)
				this.controls[i].create();
		}
		
		if(this.options.autoHeight){
			this.slideController.view.$element.height(this.slideController.currentSlide.getHeight());
		}
			
		// add grab cursor
		if(this.options.swipe && !window._touch && this.options.grabCursor && this.options.mouse){
			var $view = this.view.$element;
			
			$view.mousedown(function(){
				$view.removeClass('ms-grab-cursor');
				$view.addClass('ms-grabbing-cursor');
			}).addClass('ms-grab-cursor');
			
			$(document).mouseup(function(){
				$view.removeClass('ms-grabbing-cursor');
				$view.addClass('ms-grab-cursor');
			});
		}

		this.slideController.__dispatchInit();
		
	};
	
	p._resize = function(e){
		if(this.$loading){
			var h = this.$loading[0].clientWidth / this.aspect;
			h = this.options.heightLimit ? Math.min(h , this.options.height) : h;
			
			this.$loading.height(h);
			this.$element.height(h);		
		}
	};
	
	p._shuffleSlides = function(){
		var slides = this.$element.children('.ms-slide') , r;

		for(var i = 0 , l = slides.length; i < l ; ++i){
			r = Math.floor(Math.random() * (l - 1));
			if(i != r){
				this.$element[0].insertBefore(slides[i] , slides[r]);
				slides = this.$element.children('.ms-slide');
			}
		}
	};
	
	p.setHeight = function(value){
		if(this.options.smoothHeight){
			if(this.htween){
				if(this.htween.reset)this.htween.reset();
				else	 			 this.htween.stop(true);
			} 
			this.htween = CTween.animate(this.slideController.view.$element , 500 , {height:value} , {ease:'easeOutQuart'});
		}else
			this.slideController.view.$element.height(value);
	};
	
	p.control = function(control , options){
		if(!(control in MSSlideController.SliderControlList)) return;
		
		if(!this.controls) this.controls = [];
		var ins = new MSSlideController.SliderControlList[control](options);
		ins.slider = this;
		this.controls.push(ins);
		
		return this;
	};
	
	p.setup = function(id , options){
		this.id = id;
		this.$element = $('#' + id);

		if(this.$element.length === 0){
			if(console) console.log('Milindex Slider Error: #'+id+' not found.');
			return;
		}

		this.$element.addClass('milindex-slider').addClass('before-init');

		// IE prefix class
		if($.browser.msie){
			this.$element.addClass('ms-ie')
						 .addClass('ms-ie' + $.browser.version.slice(0 , $.browser.version.indexOf('.')));
		}
		
		// Android prefix class
		var ua = navigator.userAgent.toLowerCase();
		var isAndroid = ua.indexOf("android") > -1;
		if(isAndroid) {
		  this.$element.addClass('ms-android');
		}

		var that = this;
		$.extend(this.options, options);
		$(document).ready(function(){that._init();});
		
		this.aspect = this.options.width / this.options.height;
		
		this.$loading = $('<div></div>').
						addClass('ms-loading-container').
						insertBefore(this.$element).
						append($('<div></div>').addClass('ms-loading'));

		this.$loading.parent().css('position' , 'relative');
		
		if(this.options.autofill){
			this.options.fullwidth = true;
			this.options.fullheight = true;
		}
		
		if(this.options.fullheight)
			this.$element.addClass('ms-fullheight');

		this._resize();
		
		return this;
	};
	
	p.destroy = function(){
		
		if(this.controls){
			for(var i = 0 , l = this.controls.length; i<l ; ++i)
				this.controls[i].destroy();
		}
		
		if(this.slideController) 
			this.slideController.destroy();
		
		this.$element.remove();
		if(this.$loading)
			this.$loading.remove();
	};
		
})(jQuery);
