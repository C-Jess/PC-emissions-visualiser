function calculate(event) {
  event.preventDefault();

  const idle = 0.3; // percentage of full wattage when PC is idle

  // get form values
  const wattage = event.target["wattage"].value;
  const green = event.target["green"].value;
  const time_on = event.target["time_on"].value;
  const time_game = event.target["time_game"].value;
  const carbonIntensity = event.target["year"].value;

  // calculate kg of CO2 per day
  const totalkWh =
    (wattage * time_game + wattage * (time_on - time_game)) / 1000;
  const dirtykWh = (100 - green) * totalkWh;
  const gCO2 = dirtykWh * carbonIntensity;
  const roundedkgCO2 = Math.round((gCO2 / 1000) * 100) / 100;

  // calculate distance in car
  const gCO2PerMile = 404; // https://www.epa.gov/greenvehicles/greenhouse-gas-emissions-typical-passenger-vehicle
  const miles = gCO2 / gCO2PerMile;
  const roundedmiles = Math.round(miles * 100) / 100;

  document.getElementById("result").innerHTML =
    "<h3>The electricity that your PC uses emits " +
    roundedkgCO2 +
    " kg of CO2 per day</h3><h3>That is equivilant of driving " +
    roundedmiles +
    " miles in an average car</h3>";
  document.getElementById("result").hidden = false;

  initMap(miles);
}

function initMap(miles) {
  document.getElementById("map").innerHTML = "Loading Map...";

  const london = new google.maps.LatLng(51.509865, -0.118092);
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        // user accepted
        // set coordinates
        var location = new google.maps.LatLng(
          position.coords.latitude,
          position.coords.longitude
        );

        // center map on user location
        drawMap(location, miles);
      },
      () => {
        // user denied or couldn't get location
        drawMap(london, miles);
      }
    );
  } else {
    // browser doesn't support
    alert("Error: Your browser doesn't support geolocation.");
    drawMap(london, miles);
  }
}

function drawMap(location, miles) {
  // draw map
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 5,
    center: location,
  });
  // radius circle
  var circle = new google.maps.Circle({
    map: map,
    radius: miles * 1609.3, // miles to metres
    fillColor: "#AA0000",
  });
  // location marker circle is centered on
  var marker = new google.maps.Marker({
    map: map,
    position: location,
    title: "Your Location",
  });
  // draw circle
  circle.bindTo("center", marker, "position");
}
