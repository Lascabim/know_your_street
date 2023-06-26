<x-app-layout>
    <button onclick="getLocation()">Get Current Distance</button>
</x-app-layout>

<script>
    function calcCrow(lat1, lon1, lat2, lon2) {
      // console.log(lat1);
      // console.log(lon1);
      // console.log(lat2);
      // console.log(lon2);

      var R = 6371; // km
      var dLat = toRad(lat2 - lat1);
      var dLon = toRad(lon2 - lon1);
      var lat1 = toRad(lat1);
      var lat2 = toRad(lat2);

      var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(lat1) * Math.cos(lat2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      var d = R * c;
      alert(d);
    }

    // Converts numeric degrees to radians
    function toRad(Value) {
      return (Value * Math.PI) / 180;
    }

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    }

    function showPosition(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;

      calcCrow(latitude, longitude, latitude+0.035, longitude+0.035);
    }

    // Start the process of obtaining the user's position
    // getLocation();
</script>