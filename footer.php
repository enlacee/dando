
<div class="container"> <img src="images/banner/banner4.jpg"> </div>
<footer id="footer">
  <?php /*?><section class="footersocial">
    <div class="container">
      <div class="row">
        <div class="span3 info">
          <h2> <i class="icon-link"></i> Links </h2>
          <ul>
            <li><a href="#">My Account</a> </li>
            <li><a href="#">Brands</a> </li>
            <li><a href="#">Privacy Policy</a> </li>
            <li><a href="#">Terms &amp; Conditions</a> </li>
            <li><a href="#">Affiliates</a> </li>
            <li><a href="#">Newsletter</a> </li>
            <li><a href="#">Sitemap</a> </li>
          </ul>
        </div>
        <div class="span3 contact">
          <h2> <i class="icon-phone-sign"></i> Contact </h2>
          <ul>
            <li class="location"> Inn Rd, London, United Kingdom‎.‎</li>
            <li class="phone"> +123 456 7890, +123 456 7890</li>
            <li class="mobile"> +123 456 7890, +123 456 78900</li>
            <li class="email"> test@test.com</li>
          </ul>
        </div>
        <div class="span3 twitter">
          <h2> <i class="icon-twitter-sign"></i> Twitter </h2>
          <div id="twitter"> </div>
        </div>
        <div class="span3 facebook">
          <h2> <i class="icon-facebook-sign"></i> Facebook </h2>
          <div class="seperator"></div>
          <div class="seperator1"></div>
          <div id="fb-root"></div>
          <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "../../../connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
          <div class="fb-like-box" data-href="http://www.facebook.com/envato" data-width="292" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-show-border="false" data-header="false"  data-height="240"></div>
        </div>
      </div>
    </div>
  </section><?php */?>
  <section class="copyrightbottom">
    <div class="container">
      <div class="row">
        <div class="span5 social">
          <ul>
            <li><a href="#"><i class="icon-facebook"></i></a></li>
            <li><a href="#"><i class="icon-twitter"></i></a></li>
            <li><a href="#"><i class="icon-linkedin"></i></a></li>
            <li><a href="#"><i class="icon-google-plus"></i></a></li>
            <li><a href="#"><i class="icon-pinterest"></i></a></li>
          </ul>
        </div>
        <div class="span2 textcenter"> &copy; 2013 dando-dando.com </div>
      </div>
    </div>
  </section>
</footer>

<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

<script type="text/javascript" src="js/validate/jquery.validate.js"></script>
<script type="text/javascript" src="js/validate/jquery.metadata.js"></script>
<script type="text/javascript" src="js/validate/messages_es.js"></script>



<script type="text/javascript" src="milindexslider/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="milindexslider/js/milindexslider.min.js"></script>
<script type="text/javascript" src="milindexslider/js/milindexslider.staff.carousel.js"></script>



<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> 
<script type="text/javascript" src="js/jquery.easing.js"></script> 
<script src="js/respond.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script defer src="js/jquery.flexslider.js"></script> 
<script src="layerslider/js/jquery-transit-modified.js" type="text/javascript"></script> 
<script src="layerslider/js/layerslider.transitions.js" type="text/javascript"></script> 
<script src="layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script> 
<script type="text/javascript" src="js/jquery.tweet.js"></script> 
<script  src="js/cloud-zoom.1.0.2.js"></script> 
<script type="text/javascript"  src="js/jquery.carouFredSel-6.1.0-packed.js"></script> 
<script type="text/javascript"  src="js/jquery.mousewheel.min.js"></script> 
<script type="text/javascript"  src="js/jquery.touchSwipe.min.js"></script> 
<script type="text/javascript" src="js/jquery.gmap.js"></script> 
<script type="text/javascript" src="js/jquery.countdown.js"></script> 
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>


<script src="carrousel_slider_milindex/js/jquery.easing.1.3.js"></script>
<script src="carrousel_slider_milindex/js/jquery.milindex.min.js"></script>


<script type="text/javascript">
$(function(){
	
	/* Fullwidth slider */
	$('#fullwidth_slider').milindex({
		mode: 'carousel',
		moveSlides: 1,
		slideEasing: 'easeInOutCubic',
		slideDuration: 700,
		itemHeight: false, 
		navigation: true,
		keyboard: true,
		nextNav: '<span class="alt-arrow">Next</span>',
		prevNav: '<span class="alt-arrow">Next</span>',
		ticker: false,
		tickerAutoStart: true,
		tickerHover: true,
		tickerTimeout: 2000
	});
	
	
});
</script>


<script type="text/javascript">      
 
    var slider = new MilindexSlider();
    slider.setup('milindexslider' , {
        width:400,
        height:260,
        space:3,
        view:'scale'
    });
     
    slider.control('arrows');  
    slider.control('thumblist' , {autohide:false ,dir:'h',arrows:false});
     
</script>


<script>
	$(function() {
		$( "#dialog" ).dialog({
		autoOpen: true,
		width: 400,
		show: {
		effect: "fade",
		duration: 1000
		},
		hide: {
		effect: "explode",
		duration: 1000
		}
		});
		$( "#opener" ).click(function() {
		$( "#dialog" ).dialog( "open" );
		});
	});
</script>
