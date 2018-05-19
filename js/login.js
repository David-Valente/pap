$('#login-button').click(function(){
  $('#login-button').fadeOut("slow",function(){
    $("#container.login").fadeIn();
    $("#container.register").fadeOut();
    $("#register-button").show();
  });
});

$("#close-btn-login").click(function(){
  TweenMax.from("#container.login", .4, { scale: 1, ease:Sine.easeInOut});
  TweenMax.to("#container.login", .4, { left:"0px", scale: 0, ease:Sine.easeInOut});
});


$('#register-button').click(function(){
  $('#register-button').fadeOut("slow",function(){
    $("#container.register").fadeIn();
    $("#container.login").fadeOut();
    $("#login-button").show();
  });
});

$("#close-btn-register").click(function(){
  TweenMax.from("#container.register", .4, { scale: 1, ease:Sine.easeInOut});
  TweenMax.to("#container.register", .4, { left:"0px", scale: 0, ease:Sine.easeInOut});
});
