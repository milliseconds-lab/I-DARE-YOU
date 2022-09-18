const APP_LIST = (function () {
  let offset = 0
  const limit = 0

  function init() {
    fetch(AJAX_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams({
        action: 'get_venues_list', offset, limit
      })
    })
      .then((response) => response.json())
      .then(data => console.log(data))
      .catch((error) => {
        console.log(error);
      })
  }

  return {
    init() {
      return init();
    }
  }
})();
APP_LIST.init();