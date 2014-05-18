;(function($){
	
	"use strict";
	
	var MSTimerbar = function(options){
		BaseControl.call(this);
		this.options.autohide = false;
		$.extend(this.options , options);
	};
	
	MSTimerbar.extend(BaseControl);
	
	var p = MSTimerbar.prototype;
	var _super = BaseControl.prototype;
	
	/* -------------------------------- */
	
	p.setup = function(){
		var that = this;
		_super.setup.call(this);
		
		this.$element = $('<div></div>')
					.addClass(this.options.prefix + 'timerbar')
					.appendTo(this.cont);
					
		this.$bar = $('<div></div>')
					.addClass('ms-time-bar')
					.appendTo(this.$element);

	};
	
	p.create = function(){
		_super.create.call(this);
		this.slider.api.addEventListener(MSSliderEvent.WATING , this._update , this);
		this._update();
	};
	
	p._update = function(){
		this.$bar[0].style.width = this.slider.api._delayProgress  + '%';
	};
	
	p.destroy = function(){
		this.slider.api.removeEventListener(MSSliderEvent.WATING , this._update , this);
		this.$element.remove();
	};
	
	window.MSTimerbar = MSTimerbar;
	MSSlideController.registerControl('timebar' , MSTimerbar);
})(jQuery);
