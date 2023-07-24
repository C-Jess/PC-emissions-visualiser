// jQuery functions to manipulate the main page and handle communication with
// the web service via Ajax.
//
// Note that there is very little error handling in this file.  In particular, there
// is no validation in the handling of form data.  This is to avoid obscuring the
// core concepts that the demo is supposed to show.

function getAllCountries() {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "/countries",
      type: "GET",
      cache: false,
      dataType: "json",
      success: function (data) {
        resolve(data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR + "\n" + textStatus + "\n" + errorThrown);
        reject(error);
      },
    });
  });
}

function getCarbonIntensity(country_code) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: `/countries/${country_code}`,
      type: "GET",
      cache: false,
      dataType: "json",
      success: function (data) {
        resolve(data);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR + "\n" + textStatus + "\n" + errorThrown);
        reject(error);
      },
    });
  });
}
