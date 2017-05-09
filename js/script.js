// Slick slider config
$('.slider').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 2000,
  arrows: false
});
$('.fa-angle-left').click(function(){
  $('.slider').slick('slickPrev');
});
$('.fa-angle-right').click(function(){
  $('.slider').slick('slickPrev');
});

// Sidebar in backoffice
$('.fa-bars').on('click', function(){
  if( $('.sidebar').hasClass('toggled')) {
      $('.sidebar').animate({ 'height': '100vh' }, 'slow', function(){
        $('.sidebarBody').fadeIn();
        $('.sidebar').removeClass('toggled');
      });
  }else{
    $('.sidebarBody').fadeOut();
    $('.sidebar').animate({ 'height': '60px' }, 'slow', function(){
      $('.sidebar').addClass('toggled');
    });
  }
});

// Show content without reload on backoffice
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
