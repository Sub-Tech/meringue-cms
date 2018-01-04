$(window).scroll(function(){
  var a = 112;
  var pos = $(window).scrollTop();
  if(pos > a) {
   $('body').addClass('scrolled');
  }
  else {
    $('body').removeClass('scrolled');
  }
});