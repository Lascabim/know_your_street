<x-app-layout>
    <button onclick="calcCrow()">A</button>
</x-app-layout>


<script>
    //This function takes in latitude and longitude of two location and returns the distance between them as the crow flies (in km)
    function calcCrow(lat1 = 41.1452, lon1 = -8.5294, lat2 = 41.1, lon2 = -8.524) 
    {
      var R = 6371; // km
      var dLat = toRad(lat2-lat1);
      var dLon = toRad(lon2-lon1);
      var lat1 = toRad(lat1);
      var lat2 = toRad(lat2);

      var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
        Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(lat1) * Math.cos(lat2); 
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
      var d = R * c;
      alert(d);
    }

    // Converts numeric degrees to radians
    function toRad(Value) 
    {
        return Value * Math.PI / 180;
    }
</script>