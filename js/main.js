

	$('#primary').addClass('fixed');
	$("#toggle").click(function(){
		$("#primary").addClass('open');
		$("#header").addClass('closed');
	});
	$("#close-primary, #close-primary-hidden").click(function(){
		$("#primary").removeClass('open');
		$("#header").removeClass('closed');
	});
	$(document).on('keyup',function(evt) {
	    if (evt.keyCode == 27) {
	       $("#primary").removeClass('open');
		   $("#header").removeClass('closed');
	    }
	});

	$(".subcat").addClass('close');
	$(".filter").click(function(){
		$(".subcat").addClass('close');
	});

	// Shop Lookbook Widget
	$("#lookbook-modal").addClass('fixed');
	$(".open-lookbook").click(function(){
		$("#lookbook-modal").addClass('open');
	});
	$(document).on('keyup',function(evt) {
	    if (evt.keyCode == 27) {
	       $("#lookbook-modal").removeClass('open');
	    }
	});
	$(".close-lookbook").click(function(){
		$("#lookbook-modal").removeClass('open');
	});

	// Shop Size Chart
	$(".open-size-chart").click(function(){
		$('.size-chart').addClass('open');
	});
	$(".close-size-chart").click(function(){
		$('.size-chart').removeClass('open');
	});

	// FitVids Init
    $("article, header").fitVids();
	$(".show-comments").click(function(){
		$(".comments").addClass('show');
	});

	//Scroll Animations
	$(window).scroll(function() {
	if ($(this).scrollTop() > 200){
	    $('#header, .logo-subtitle, #primary').addClass("scrolled");
	  }
	  else{
	    $('#header, .logo-subtitle, #primary').removeClass("scrolled");
	  }
	});

	// Slick Slider
	$('.product-slider').slick({
	  dots: true,
		arrows: false,
	  speed: 500
	});
	$('#lookbook').slick({
	  dots: true,
	  speed: 500
	});

	// Enlax parallax scrolling
	$(window).enllax();


	//Instafeed Init

  //  var feed = new Instafeed({
	//	get: 'user',
	//	userId: 5000335,
  //  clientId: '513b251ee14d416fa01ad5f53eddf91c',
	//	accessToken: '2023173.513b251.cd34ad7e35264358a1c22909729fa537',
	//	template: '<a href="{{link}}"><img src="{{image}}" /></a>',
	//	limit: 3,
	//	resolution: 'standard_resolution',
  //  });
  //  feed.run();
