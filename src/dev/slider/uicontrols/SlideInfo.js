;(function($){
	
	"use strict";
	
	window.MSSlideInfo = function(options){
		BaseControl.call(this , options);
		
		this.options.autohide	= false;
		$.extend(this.options , options);

		this.data_list = [];
	};
	MSSlideInfo.fadeDuratation = 400;
	MSSlideInfo.extend(BaseControl);
	
	var p = MSSlideInfo.prototype;
	var _super = BaseControl.prototype;
	
	/* -------------------------------- */	
	p.setup = function(){
		_super.setup.call(this);

		this.$element = $('<div></div>')
						.addClass(this.options.prefix + 'slide-info')
						.appendTo(this.cont);
		
	};
	
	p.slideAction = function(slide){
		var info_ele = $(slide.$element.find('.ms-info'));
		var that = this;
		info_ele.detach();
		
		this.data_list[slide.index] = info_ele;
	};
	
	p.create = function(){
		_super.create.call(this);
		this.slider.api.addEventListener(MSSliderEvent.CHANGE_START , this.update , this);
		this.cindex =  this.slider.api.index();
		this.switchEle(this.data_list[this.cindex]);
	};
	
	p.update = function(){
		var nindex = this.slider.api.index();
		this.switchEle(this.data_list[nindex]);
		this.cindex = nindex;
	};
	
	p.switchEle = function(ele){
		if(this.current_ele){
			var that = this;
			
			if(this.current_ele[0].tween)this.current_ele[0].tween.stop(true);
			this.current_ele[0].tween = CTween.animate(this.current_ele , MSSlideInfo.fadeDuratation  , {opacity:0} , {complete:function(){this.detach(); this[0].tween = null;} , target:this.current_ele });
			
			clearTimeout(this.tou);
			this.tou = setTimeout(function(){that.__show(ele);} , MSSlideInfo.fadeDuratation+200 );
			
			return;
		}
		this.__show(ele);
	};
	
	p.__show = function(ele){
		ele.appendTo(this.$element).css('opacity','0');
		CTween.fadeIn(ele , MSSlideInfo.fadeDuratation );
		if(ele[0].tween)ele[0].tween.stop(true);
		this.current_ele = ele;
	};
	
	MSSlideController.registerControl('slideinfo' , MSSlideInfo);
})(jQuery);
