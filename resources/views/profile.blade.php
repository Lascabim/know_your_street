<x-app-layout>
  <div class="flex flex-col flex-wrap items-center justify-center gap-10 px-8">
    <div class="flex flex-col flex-wrap items-center justify-center rounded-xl bg-white w-[320px]" style="box-shadow: rgba(0, 0, 0, 0.84) 0px 3px 8px;">
      <a href="{{ route('profile/', ['name' => $user->name]) }}" class="group"><h1 class="text-xl">Utilizador: {{ $user->name }}</h1></a>

      <div class="flex justify-start items-center gap-2 py-4 px-6">
        <div>
          @if ($user->profile_photo_path == null )
            @php
              $firstLetter = strtoupper(substr($user->name, 0, 1));
            @endphp
                      
            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
              <img class="h-10 w-16 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{$firstLetter}}&color=7F9CF5&background=EBF4FF" alt="" />
            </button>
          @else
            <img class="rounded-full h-10 w-16" src="/storage/{{ $user->profile_photo_path }}" alt="">            
          @endif
        </div>

        <div class="w-full text-center">
          <h1 class="w-full font-bold text-lg">Publicações {{ count($posts)}}</h1>
        </div>
      </div>
      
      <div>
          @php
            $memberSince = substr($user->created_at, 0, 10);
          @endphp

        <h1 class="font-bold text-lg">Membro desde {{ $memberSince }}</h1>
      </div>
    </div>

    <div class="flex flex-wrap items-center justify-center gap-12">
    @foreach($posts as $post)
      <div class="rounded-lg max-w-xs w-[85vw] mb-14 py-3 bg-white" style="box-shadow: rgba(0, 0, 0, 0.84) 0px 3px 8px;">
          <div class="flex justify-between items-center mb-2 px-3">
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
                  <img class="rounded-full h-14 w-14" src="/storage/{{ $user->profile_photo_path }}" alt="">            
                @endif

                <a href="{{ route('profile/', ['name' => $user->name]) }}" class="group"><h1 class="text-md">{{ $user->name }}</h1></a>
                @endif
            </div>

            @if (Auth::check())
                @if (Auth::user()->name === $post->author)
                  <div>
                    <a href="{{ route('delete/', ['id' => $post->id]) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </div>
                @endif
              @endif
          </div>

          <div class="rounded-xl py-3">
            <img class="w-full font-bold" src="{{ $post->image_path }}" alt="">
          </div>

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
    </div>
  </div>
</x-app-layout>