let APP_LIST = {};
(function ($) {
  APP_LIST = {
    _offset: 0,
    _limit: 0,
    init() {
      $.ajax({
        type: 'GET',
        dataType: 'json',
        async: true,
        url: AJAX_URL,
        data: {
          action: 'get_venues_list',
          offset: this._offset,
          limit: this._limit
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
    APP_LIST.init();
  })
})(jQuery);