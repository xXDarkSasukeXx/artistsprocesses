$('.slider').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  arrows: false
});
$('.fa-angle-left').click(function(){
  $('.slider').slick('slickPrev');
});
$('.fa-angle-right').click(function(){
  $('.slider').slick('slickPrev');
});
