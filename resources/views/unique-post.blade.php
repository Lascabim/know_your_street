<x-app-layout>
    <div class="flex flex-col items-center justify-center gap-4">
      <div class="rounded-lg max-w-[400px] w-[85vw] px-5 py-3" style="box-shadow: rgba(0, 0, 0, 0.84) 0px 3px 8px;">
          <div class="flex justify-between items-center mb-2">
            <div class="flex justify-start items-center gap-2">
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

        <a href="{{ route('createpost') }}" :active="request()->routeIs('createpost')">
          <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-white bg-blue-500 hover:text-gray-100 hover:bg-blue-600 focus:outline-none focus:bg-blue-500 active:bg-blue-700 transition">
            CREATE A NEW POST !
          </button>
        </a>
    </div>
</x-app-layout>