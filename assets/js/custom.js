$(function () {
  var owl = $('#grid-section'),
    owlOptions = {
      loop: true,
      margin: 20,
      nav: true,
      dots: false,
      touchDrag: false,
      mouseDrag: false,
      responsive: {
        0: {
          items: 1,
          touchDrag: true,
          mouseDrag: true,
        },
        600: {
          items: 3,
        },
        1000: {
          items: 3,
        },
      },
    }

  if ($(window).width() < 768) {
    var owlActive = owl.owlCarousel(owlOptions)
  } else {
    owl.addClass('off')
  }

  $(window).resize(function () {
    if ($(window).width() < 768) {
      if ($('.owl-carousel').hasClass('off')) {
        var owlActive = owl.owlCarousel(owlOptions)
        owl.removeClass('off')
      }
    } else {
      if (!$('.owl-carousel').hasClass('off')) {
        owl.addClass('off').trigger('destroy.owl.carousel')
        owl.find('.owl-stage-outer').children(':eq(0)').unwrap()
      }
    }
  })
})

// mobile search js
var stat = false;
$('.mobile-search-btn').click(function () {
  stat = !stat;
  $('.search-list').removeClass('active')
  if(stat){
    $('.mobile-search-btn').html('<i class="bx  bx-x"></i>')
  } else{
    $('.mobile-search-btn').html('<i class="bx bx-search"></i>')
  }
  $('.mobile-search-input').toggleClass('search-input');
  $('.search-list li').toggleClass('show');
});


const inputBox = document.querySelector(".mobile-search-input");
const suggBox = document.querySelector(".search-list");

// if user press any key and release
 var productdata;
fetch('./product.json')
    .then((response) => response.json())
    .then((json) => productdata = json)
inputBox.onkeyup = (e)=>{
    let userData = e.target.value; //user enetered data
    let emptyArray = [];
    if(userData){
        emptyArray = productdata.filter((data)=>{
            //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
            return data.name.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
        });
        emptyArray = emptyArray.map((data)=>{
            // passing return data inside li tag
            return data = `<a href="${data.slug}"><li>${data.name}</li></a>`;
        });
        suggBox.classList.add("active"); //show autocomplete box
        showSuggestions(emptyArray);

    }else{
        suggBox.classList.remove("active"); //hide autocomplete box
    }
}
function showSuggestions(list){
    let listData;
    if(!list.length){
        listData = `<li>No search</li>`;
    }else{
      listData = list.join('');
    }
    suggBox.innerHTML = listData;
}
// mobile search js

// category show on hover 
// $('#categoryBtn').click(function () {
//   $(this).toggleClass('active')
// })
// category show on hover 

// menu js 
  $('.menu-btn').click(function () {
    $('.mobile-quick-links-ul').toggleClass('show')
  })
// menu js 