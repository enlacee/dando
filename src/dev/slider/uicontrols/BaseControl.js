;(function($){
	
	"use strict";
	
	var BaseControl = function(){
		this.options = {
			prefix:'ms-',
			autohide:true,
			overVideo:true	
		};
		
		
	};
	
	var p = BaseControl.prototype;
	
	/* -------------------------------- */
	
	p.slideAction = function(slide){};
	
	p.create = function(){
		var that = this;
		if(this.options.autohide && !window._touch){
			
			this.hide(true);
			
			this.slider.$controlsCont.mouseenter(function(){
				if(!that._disableAH && !that.mdown)that.visible();
				that.mleave = false;
			}).mouseleave(function(){
				that.mleave = true;
				if(!that.mdown)that.hide();
			}).mousedown(function(){
				that.mdown = true;
			});
			
			$(document).mouseup(function(){
				if(that.mdown && that.mleave)that.hide();
				that.mdown = false;
			});
		}
	};
	
	p._hideOnvideoStarts = function(){
		var that = this;
		slider.api.addEventListener(MSSliderEvent.VIDEO_PLAY , function(){
   			 that._disableAH = true;
   			 that.hide();
		});
		 
		slider.api.addEventListener(MSSliderEvent.VIDEO_CLOSE , function(){
		     that._disableAH = false;
   			 that.visible();
		});
	};
	
	p.hide = function(fast){
		if(fast) this.$element.css('opacity' , 0);
		else	 CTween.fadeOut(this.$element , 400 , false);
		
		this.$element.addClass('ms-ctrl-hide');
	};
	
	p.visible = function(){
		CTween.fadeIn(this.$element , 400 );
		this.$element.removeClass('ms-ctrl-hide');
	};
	
	p.setup = function(){		
		this.cont = this.options.insertTo ? $(this.options.insertTo) : this.slider.$controlsCont;
		if(!this.options.overVideo) this._hideOnvideoStarts();
	};
	
	p.destroy = function(){
		
	};
	
	window.BaseControl = BaseControl;
	
})(jQuery);
