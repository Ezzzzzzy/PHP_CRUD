var $stars;

jQuery(document).ready(function ($) {

  // Custom whitelist to allow for using HTML tags in popover content
  var myDefaultWhiteList = $.fn.tooltip.Constructor.Default.whiteList
  myDefaultWhiteList.textarea = [];
  myDefaultWhiteList.button = [];

  $stars = $('.rate-popover');
  var index = '';
  $stars.on('mouseover', function () {
    index = $(this).attr('data-index');
    markStarsAsActive(index);
  });

  function markStarsAsActive(index) {
    unmarkActive();
    for (var i = 0; i <= index; i++) {
      $($stars.get(i)).addClass('amber-text');
    }
  }

  function unmarkActive() {
    $stars.removeClass('amber-text');
  }

  $stars.on('click', function () {
    $stars.popover('hide');
  });

  // Submit, you can add some extra custom code here
  // ex. to send the information to the server
  $('#rateMe').on('click', '#voteSubmitButton', function (e) {
    var product_id = document.getElementsByName("product_id_modal")[0].value
    console.log(product_id);
    console.log(index);

    window.location.replace("./ajax/addRate.php?product_id="+product_id+"&rate="+index);
    $stars.popover('hide');
  });

  // Cancel, just close the popover
  $('#rateMe').on('click', '#closePopoverButton', function () {
    $stars.popover('hide');
  });

});
