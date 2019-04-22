  $(function() {

    // var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //   return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    // if (element.is('li')) {
    //   element.addClass('active');
    // }
    if($('.alert-msg li').hasClass('alert')){
        $('.alert-msg').show(function(){
            setTimeout(function(){
                $('.alert-msg').hide(function(){
                    $(this).remove();
                });
            }, 8000);
        });
    };

  });
