<x-app-layout>
    <div class="flex flex-col items-center justify-center">
      
    @if(count($posts) > 0)
      @foreach($posts as $post)
        <script>
          function getLocation() {
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
            } else {
              console.log("Geolocation is not supported by this browser.");
            }
          }

          function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            var postLatitude = {{ $post->latitude }};
            var postLongitude = {{ $post->longitude }};

            // Get the CSRF token value
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Make an AJAX request to the Laravel route
              $.ajax({
                  url: '/get-location',
                  method: 'POST',
                  data: {
                      latitude: latitude,
                      longitude: longitude,
                      postLatitude: postLatitude,
                      postLongitude: postLongitude          
                  },
                  success: function(response) {
                      // Handle the response from the server
                      console.log(response);

                      if(response.success) {
                        $('#div-' + {{ $loop->index }}).show();
                      } else {
                        $('#div-' + {{ $loop->index }}).hide();
                      }
                  },
                  error: function(xhr) {
                      console.log(xhr.responseText);
                  }
              });
            }

            getLocation();
        </script>
        <div id="div-{{ $loop->index }}" class="rounded-lg max-w-[400px] w-[85vw] mb-14 py-3 " style="box-shadow: rgba(0, 0, 0, 0.84) 0px 3px 8px;">
          <div class="flex justify-between items-center mb-2 px-3">
            <div class="flex justify-start items-center gap-2">
              @foreach($users as $user)
                @if($user->name === $post->author)
                  @if ($user->profile_photo_path == null )
                  @php
                    $firstLetter = strtoupper(substr($user->name, 0, 1));
                  @endphp
                  
                  <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                      <img class="h-14 w-14 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{$firstLetter}}&color=7F9CF5&background=EBF4FF" alt="" />
                  </button>
                @else
                  <img class="rounded-full h-14" src="/storage/{{ $user->profile_photo_path }}" alt="">            
                @endif

                <a href="{{ route('profile/', ['name' => $user->name]) }}" class="group"><h1 class="text-md">{{ $user->name }}</h1></a>
                
                @endif
              @endforeach
            </div>

              @if (Auth::check())
                @if (Auth::user()->name === $post->author)
                  <div>
                    <a href="{{ route('delete/', ['id' => $post->id]) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </div>
                @endif
              @endif
          </div>

          @if ($post->image_path !== null )
            <div class="rounded-xl py-3">
              <img class="w-full font-bold" src="{{ $post->image_path }}" alt="">
            </div>
          @endif

          <div>
            <p class="text-left px-3 mt-2">Message: <strong> {{ $post->title }} </strong></p>
          </div>
          
          <div class="flex items-center justify-between relative px-3 p-3">
            <a href="" class="group">
              <i class="scale-125 fa-regular fa-comments"></i>
            </a>

            <a href="https://www.google.com/maps/search/{{$post->latitude}},{{$post->longitude}}" class="group">
              <i class="scale-125 fa-regular fa-map"></i>
            </a>

            <a href="{{ route('welcome/', ['url' => $post->url]) }}" class="group">
              <i class="scale-125 fa-solid fa-up-right-from-square"></i>
            </a>

          </div>
        </div>
      @endforeach
    @else
          <h1>NÃO HÁ POSTS DISPONÍVEIS NUM RAIO DE 5 KM</h1>
    @endif
    </div>
</x-app-layout>