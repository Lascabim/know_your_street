<x-app-layout>
    <div class="flex flex-col items-center justify-center">
      <button onclick="getLocation()">Get Current Distance</button>

      @foreach($posts as $post)
        <div class="rounded-lg max-w-[400px] w-[85vw] mb-14 px-5 py-3" style="box-shadow: rgba(0, 0, 0, 0.84) 0px 3px 8px;">
          <div class="flex justify-between items-center mb-2">
            <div class="flex justify-start items-center gap-2">
              @foreach($users as $user)
                @if($user->name === $post->author)
                  @if ($user->profile_photo_path == null )
                  @php
                    $firstLetter = strtoupper(substr($user->name, 0, 1));
                  @endphp
                  
                  <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                      <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{$firstLetter}}&color=7F9CF5&background=EBF4FF" alt="" />
                  </button>
                @else
                  <img class="rounded-full h-14" src="/storage/{{ $user->profile_photo_path }}" alt="">            
                @endif

                <h1 class="text-md">{{ $user->name }}</h1>
                @endif
              @endforeach
            </div>
          </div>

          <div class="rounded-xl" style="box-shadow: rgba(0, 0, 0, 0.34) 0px 3px 8px;">
            <img class="w-full font-bold rounded-xl" src="{{ $post->image_path }}" alt="">
          </div>

          <div>
            <p class="text-center mt-2">Message: <strong> {{ $post->title }} </strong></p>
          </div>
          
          <div class="flex items-center justify-between relative p-3">
            <a href="" class="group">
              <i class="scale-125 mt-3 bottom-4 fa-regular fa-comments"></i>
            </a>

            <a href="https://www.google.com/maps/search/{{$post->latitude}},{{$post->longitude}}" class="group">
              <i class="scale-125 mt-3 bottom-4 fa-regular fa-map"></i>
            </a>

            <a href="{{ route('welcome/', ['url' => $post->url]) }}" class="group">
              <i class="scale-125 mt-3 bottom-4 fa-solid fa-up-right-from-square"></i>
            </a>

          </div>
        </div>
      @endforeach
    </div>
    
</x-app-layout>



<script>
    function calcCrow(lat1, lon1, lat2, lon2) {

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
</script>