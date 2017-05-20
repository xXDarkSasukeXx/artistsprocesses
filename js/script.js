$(document).ready(function() {
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
    $('.slider').slick('slickNext');
  });

  // Sidebar in backoffice
  $('.sidebar-toggle').on('click', function(){
    if($('.sidebar-ap').hasClass('toggled-me')){
      $('.sidebar-ap').animate({ 'width': '20vw' }, 'fast', function(){
        $('.sidebarBody').fadeIn();
        $('.sidebar-ap').removeClass('toggled-me');
        $('.mainBackoffice').animate({ 'margin-left' : '20vw'}, 'fast');
        $('.mainBackoffice').animate({ 'width' : '80vw'}, 'fast');
      });
    }else{
      $('.sidebarBody').fadeOut();
      $('.sidebar-ap').animate({ 'width': '0vw' }, 'fast');
      $('.sidebar-ap').addClass('toggled-me');
      $('.mainBackoffice').animate({ 'margin-left' : '0vw'}, 'fast');
      $('.mainBackoffice').animate({ 'width' : '100vw'}, 'fast');
    }
  });


  $('.fa-bars').on('click', function(){
    if( $('.sidebar-ap').hasClass('toggled')) {
        $('.sidebar-ap').animate({ 'height': '100vh' }, 'slow', function(){
          $('.sidebarBody').fadeIn();
          $('.sidebar-ap').removeClass('toggled');
        });
    }else{
      $('.sidebarBody').fadeOut();
      $('.sidebar-ap').animate({ 'height': '60px' }, 'slow', function(){
        $('.sidebar-ap').addClass('toggled');
      });
    }
  });


  // Show content without reload on backoffice
  $('#myTabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  });

});
