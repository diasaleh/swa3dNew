$(function() {

  $('#search-button').on('click', function(e) {
    if($('#search-input-container').hasClass('hdn')) {
      e.preventDefault();
      $('#search-input-container').removeClass('hdn')
      return false;
    }
  });

  $('#hide-search-input-container').on('click', function(e) {
    e.preventDefault();
    $('#search-input-container').addClass('hdn')
    return false;
  });
});
$(function () {
    $('a[href="#search"]').on('click', function(event) {
        event.preventDefault();
        $('#search').addClass('open');
        $('#search > form > input[type="search"]').focus();
    });

    $('#search, #search button.close').on('click keyup', function(event) {
        if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
            $(this).removeClass('open');
        }
    });


  
});
