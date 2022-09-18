let APP_DETAIL = {};
(function ($) {
  APP_DETAIL = {
    init() {
      $.ajax({
        type: 'GET',
        dataType: 'json',
        async: true,
        url: AJAX_URL,
        data: {
          action: 'get_venues_detail',
          id: 32
        },
        success: (data) => {
          console.log(data);
        },
        error: (error) => {
          console.log(error);
        }
      })
    }
  }

  $(document).ready(function () {
    APP_DETAIL.init();
  })
})(jQuery);