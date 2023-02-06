(function ($) {
	"use strict";

	// Mean Menu
	$('.mean-menu').meanmenu({
		meanScreenWidth: "991"
	});

	// Header Sticky
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 120) {
			$('.navbar-area').addClass("is-sticky");
		}
		else {
			$('.navbar-area').removeClass("is-sticky");
		}
	});

	// Others Option For Responsive JS
	$(".others-option-for-responsive .dot-menu").on("click", function () {
		$(".others-option-for-responsive .container .container").toggleClass("active");
	});

	// Search Menu JS
	$(".others-option .search-icon i").on("click", function () {
		$(".search-overlay").toggleClass("search-overlay-active");
	});
	$(".search-overlay-close").on("click", function () {
		$(".search-overlay").removeClass("search-overlay-active");
	});

	// Home Slides
	$('.home-slides').owlCarousel({
		items: 1,
		nav: true,
		loop: true,
		dots: false,
		autoplay: true,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		],
		responsive: {
			0: {
				autoHeight: true
			},
			576: {
				autoHeight: false
			},
			768: {
				autoHeight: false
			},
			992: {
				autoHeight: false
			},
			1200: {
				autoHeight: false
			}
		}
	});

	// Banner Slides
	$('.banner-slides').owlCarousel({
		items: 1,
		nav: false,
		loop: true,
		dots: true,
		autoplay: true,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		]
	});

	// Categories Slides
	$('.categories-slides').owlCarousel({
		nav: true,
		margin: 25,
		loop: true,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 2
			},
			768: {
				items: 3
			},
			992: {
				items: 4
			},
			1200: {
				items: 5
			}
		}
	});

	// Products Slides
	$('.products-slides').owlCarousel({
		nav: true,
		margin: 25,
		loop: true,
		dots: false,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 2
			},
			768: {
				items: 2
			},
			992: {
				items: 4
			},
			1200: {
				items: 4
			}
		}
	});

	// Odometer JS
	$('.odometer').appear(function (e) {
		var odo = $(".odometer");
		odo.each(function () {
			var countNumber = $(this).attr("data-count");
			$(this).html(countNumber);
		});
	});

	// Popup Image
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	// Popup Video
	$('.popup-video').magnificPopup({
		disableOn: 320,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});

	// Feedback Slides
	$('.feedback-slides').owlCarousel({
		items: 1,
		nav: false,
		loop: true,
		dots: true,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [
			"<i class='bx bx-chevron-left'></i>",
			"<i class='bx bx-chevron-right'></i>",
		]
	});

	// Input Plus & Minus Number JS
	$('.input-counter').each(function () {
		var spinner = jQuery(this),
			input = spinner.find('input[type="text"]'),
			btnUp = spinner.find('.plus-btn'),
			btnDown = spinner.find('.minus-btn'),
			min = input.attr('min'),
			max = input.attr('max');
		btnUp.on('click', function () {
			var oldValue = parseFloat(input.val());
			if (oldValue >= max) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue + 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
		btnDown.on('click', function () {
			var oldValue = parseFloat(input.val());
			if (oldValue <= min) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue - 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});
	});

	// Country Select
	$("#country_selector, #country_selector2").countrySelect({
		preferredCountries: ['ca', 'gb', 'us']
	});

	// Countdown
	$(document).ready(function () {
		loopcounter('counter-class');
	});

	// Price Range Slider JS
	$(".js-range-of-price").ionRangeSlider({
		type: "double",
		drag_interval: true,
		min_interval: null,
		max_interval: null
	});

	// Products Details Image Slides
	$('.products-details-thumbs-image-slides').slick({
		dots: true,
		speed: 500,
		fade: false,
		slide: 'li',
		slidesToShow: 1,
		autoplay: true,
		autoplaySpeed: 4000,
		prevArrow: false,
		nextArrow: false,
		responsive: [{
			breakpoint: 800,
			settings: {
				arrows: false,
				centerMode: false,
				centerPadding: '30px',
				variableWidth: false,
				slidesToShow: 1,
				dots: true
			},
			breakpoint: 1200,
			settings: {
				arrows: false,
				centerMode: false,
				centerPadding: '30px',
				variableWidth: false,
				slidesToShow: 1,
				dots: true
			}
		}],
		customPaging: function (slider, i) {
			return '<button class="tab">' + $('.slick-thumbs li:nth-child(' + (i + 1) + ')').html() + '</button>';
		}
	});

	// Subscribe form
	$(".newsletter-form").validator().on("submit", function (event) {
		if (event.isDefaultPrevented()) {
			// handle the invalid form...
			formErrorSub();
			submitMSGSub(false, "Please enter your email correctly.");
		} else {
			// everything looks good!
			event.preventDefault();
		}
	});
	function callbackFunction(resp) {
		if (resp.result === "success") {
			formSuccessSub();
		}
		else {
			formErrorSub();
		}
	}
	function formSuccessSub() {
		$(".newsletter-form")[0].reset();
		submitMSGSub(true, "Thank you for subscribing!");
		setTimeout(function () {
			$("#validator-newsletter").addClass('hide');
		}, 4000)
	}
	function formErrorSub() {
		$(".newsletter-form").addClass("animated shake");
		setTimeout(function () {
			$(".newsletter-form").removeClass("animated shake");
		}, 1000)
	}
	function submitMSGSub(valid, msg) {
		if (valid) {
			var msgClasses = "validation-success";
		} else {
			var msgClasses = "validation-danger";
		}
		$("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
	}
	// AJAX MailChimp
	$(".newsletter-form").ajaxChimp({
		url: "https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9", // Your url MailChimp
		callback: callbackFunction
	});

	// Go to Top
	$(function () {
		// Scroll Event
		$(window).on('scroll', function () {
			var scrolled = $(window).scrollTop();
			if (scrolled > 600) $('.go-top').addClass('active');
			if (scrolled < 600) $('.go-top').removeClass('active');
		});
		// Click Event
		$('.go-top').on('click', function () {
			$("html, body").animate({ scrollTop: "0" }, 500);
		});
	});

}(jQuery));

function product_popup(x){
	var pro_id = $(x).data('pro_id');
	//alert(pro_id)
	$.ajax({
		type: 'POST',
		url: 'product_popup.php',
		dataType: 'html',
		data: {
		  btn: 'product_popup',
		  pro_id: pro_id,
		},
		success: function (data) {
			$("#productsPopupContent").html(data);

			console.log(data);
			$('#productsQuickView').modal('show');
		},
	});
}

function addTocart(x){
	var btn_id= $(x).attr('id');
    var id = $(x).data('proid');
    var name = $(x).data('name');
    var category = $(x).data('category');
    var img = $(x).data('proimg');
    var price = $(x).data('price');
    var qty = $(x).data('qty');
    // var qty = $('#pro_quantity').val();
    var userid = $(x).data('userid');
	var status = 'cart';
    $.ajax({
        type: 'POST',
        url: 'include/action.php',
        dataType: 'json',
        data: {
          btn: 'addTocart',
          pro_name: name,
          pro_category: category,
          pro_price: price,
          pro_qty: qty,
          pro_img: img,
          pro_id:id,
          userid: userid,
		  status: status,
        },
        success: function (data) {
          var json = $.parseJSON(JSON.stringify(data))
		  var msg = json.msg;
	
			if(msg='inserted'){
				getCartcount();
				$('#'+btn_id).hide();
				$('#'+btn_id).siblings().show();
				$('.addCartbtn').hide();
				$('.checkOutbtn').show();
				
			}
        },
      });
 }
function addTowish(x){
	
    var id = $(x).data('proid');
    var name = $(x).data('name');
    var category = $(x).data('category');
    var img = $(x).data('proimg');
    var price = $(x).data('price');
    var qty = $(x).data('qty');
    var userid = $(x).data('userid');
	var status = 'wishlist';    
    $.ajax({
        type: 'POST',
        url: 'include/action.php',
        dataType: 'json',
        data: {
          btn: 'addTocart',
          pro_name: name,
          pro_category: category,
          pro_price: price,
          pro_qty: qty,
          pro_img: img,
          pro_id:id,
          userid: userid,
		  status: status,
        },
        success: function (data) {
          var json = $.parseJSON(JSON.stringify(data))
		  var msg = json.msg;
	
			if(msg='inserted'){
				getWishcount();
				$('.Wishlistadd'+id).hide();
			}
        },
      });
 }
function getCartcount(){
	$.ajax({
		type: 'POST',
		url: 'include/action.php',
		dataType: 'html',
		data: {
		  btn: 'cartCount'
		},
		success: function (data) {
			$('#total_product_count').html(data);
		},
	});
}
getCartcount();

function getWishcount(){
	$.ajax({
		type: 'POST',
		url: 'include/action.php',
		dataType: 'html',
		data: {
		  btn: 'wishCount'
		},
		success: function (data) {
			$('#total_wish_count').html(data);
		},
	});
}
getWishcount();

function deleteCartproduct(id){
	$.ajax({
		type: 'POST',
		url: 'include/action.php',
		dataType: 'html',
		data: {
		  btn: 'deleteProductcart',
		  pro_cartid: id,
		},
		success: function (data) {
//			$('#total_product_count').html(data);
			if(data=='deleted'){
				getCartpageproduct();
				getCartcount();
			}
		},
	});
}

function getCartpageproduct(){
	$.ajax({
		type: 'POST',
		url: 'include/action.php',
		dataType: 'json',
		data: {
		  btn: 'getCartpageproduct'
		},
		success: function (data) {
			
			var json = $.parseJSON(JSON.stringify(data))
		  	var html_content = json.html_content;
			var sideCarttotal = json.sideCarttotal;
			
			$('#get_updateCartproduct').html(html_content);
			$('#sideCarttotal').html(sideCarttotal);
			// $('#subtotal_cart').html(subtotal);
			// $('#final_total').html(total);
			
		},
	});
}
getCartpageproduct();


function getWishpageproduct(){
	$.ajax({
		type: 'POST',
		url: 'include/action.php',
		dataType: 'json',
		data: {
		  btn: 'getWishlistpageproduct'
		},
		success: function (data) {
			var json = $.parseJSON(JSON.stringify(data))
		  	var html_content = json.html_content;	
			$('#wishlist_products').html(html_content);
			//$('#sideCarttotal').html(sideCarttotal);
			// $('#subtotal_cart').html(subtotal);
			// $('#final_total').html(total);
			
		},
	});
}
getWishpageproduct();

function deleteWishlistproduct(id){
	if(confirm("Do you want to delete?")) {
	$.ajax({
		type: 'POST',
		url: 'include/action.php',
		dataType: 'html',
		data: {
		  btn: 'deleteProductwishlist',
		  pro_wishlistid: id,
		},
		success: function (data) {
//			$('#total_product_count').html(data);
			if(data=='deleted'){
				getWishpageproduct();
				getWishcount();
			}
		},
	});
	}
}

function changeQuantity(x){
	var classname = $(x).attr('class');
	var value = $(x).val();
	var id = $(x).data('cartpro_id');
	$.ajax({
		type: 'POST',
		url: 'include/action.php',
		dataType: 'html',
		data: {
		  btn: 'updateProductcart',
		  pro_qty: value,
		  pro_cartid: id,
		},
		success: function (data) {
//			$('#total_product_count').html(data);
			if(data=='updated'){
				getCartpageproduct();
				getCartcount();
			}
		},
	});
}

function changeProductprice(x){
	var classname = $(x).attr('class');
	var value = $(x).val();
	var id = $(x).data('cartpro_id');
	var price = $("#productPrice").val();
	let totalprice = price * value;
	$('.addcartProduct').attr('data-qty',value);
	$(".updatedPrice").html(totalprice)
}
$("#userRegistration").validate({
	rules: {
	  name: "required",
	  email: "required",
	  phone: "required",
	  password:"required",
	},
	message: {
	},
	submitHandler: function (form) {
		$.ajax({
			url: 'include/action.php',
			type: 'post',
			data: new FormData(form),
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {  
		  //    alert(data)
			 
				if(data=='done')
				{
					window.location='https://doggtasticadventures.com/'
				   // $("#contactForm").trigger("reset"); 
				}
				else
				{
					alert("Some Technical Issue")
				}
  
			}
  
			});
		}
  
	});

	$("#userLogin").validate({
		rules: {
		  email: "required",
		  password:"required",
		},
		message: {
		},
		submitHandler: function (form) {
			$.ajax({
				url: 'include/action.php',
				type: 'post',
				data: new FormData(form),
				contentType: false,
				cache: false,
				processData: false,
				success: function (data) {  
			  //    alert(data)
				 
					if(data=='done')
					{
						location.reload()
//						window.location='https://doggtasticadventures.com/'
					   // $("#contactForm").trigger("reset"); 
					}
					else
					{
						alert("Some Technical Issue")
					}
	  
				}
	  
				});
			}
	  
		});

  // checkout data form
  $("#checkoutForm").validate({
	rules: {
	  fname: "required",
	  lname: "required",
	  email: "required",
	  phone: "required",
	  address:"required",
	  city:"required",
	  pincode:"required",
	  state:"required",
	  country:"required",
	},
	message: {
	},
	submitHandler: function (form) {
		$.ajax({
			url: 'include/action.php',
			type: 'post',
			data: new FormData(form),
			contentType: false,
			cache: false,
			processData: false,
			success: function (data) {  
				window.location='https://doggtasticadventures.com/payment/'+data;
			}
			});
		}
  
	});


	$(function(){
		$('#dropdownMenuButton2,.dropdown-menu').hover(function() {
		  $('.dropdown-menu').addClass('display');
		}, function() {
		  $('.dropdown-menu').removeClass('display');
		})
	  })

        function addQuantity(){
            
	    var pro_count = $('#pro_quantity').val();    
	    var total = Number(pro_count)+1;
	    if(total<=5){
	        $('#pro_quantity').val(total);
	        
	    }else{
	        alert("Quantity should be less than 5")
	    }
	    }
	    
	    function removeQuantity(){
	    var pro_count = $('#pro_quantity').val();    
	    var total = Number(pro_count)-1;
	     if(total>=1){
	        $('#pro_quantity').val(total);
	        
	    }else{
	        alert("Atleast 1 quantity required");
	    }
	    }