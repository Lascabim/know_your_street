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
        <div id="div-{{ $loop->index }}" class="bg-white rounded-lg max-w-[400px] w-[85vw] mb-14 py-3 " style="box-shadow: rgba(0, 0, 0, 0.84) 0px 3px 8px;">
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
      <div class="flex items-center justify-center h-[80vh] relative">
        <div class="text-center">
          <h1 class="text-4xl font-bold">Parece que não há nenhum post num raio de 5km...</h1>
          <h2 class="text-2xl mt-4">Procurando na base de dados ...</h2>
        </div>

        <div class="absolute bottom-64" role="status">
            <svg aria-hidden="true" class="w-16 h-16 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
        </div>
      </div>
    @endif
    </div>
</x-app-layout>