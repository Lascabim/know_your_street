<div>
    <form wire:submit.prevent="submit" class="flex flex-col items-center justify-center h-4/5">
            <h1 class="font-bold text-lg">Título do Post</h1>
            <input type="text" style="box-shadow: red 0px 0px 7px;" class="w-full mb-12" required minlength="5" wire:model="title">

            <div class="max-w-xs pb-1 rounded-xl bg-stone-300" style="box-shadow: red 0px 5px 15px;">
                <div class="relative rounded-xl">
                    <label for="arquivo" class="cursor-pointer absolute w-full h-full text-transparent">Enviar arquiv</label>
                    <input class="hidden" type="file" wire:model="image" name="arquivo" id="arquivo">

                    <div class="max-w-xs h-[400px]">
                        @if ($image == false or $errors->has('image'))
                            <img class="w-full h-[400px] rounded-t-xl object-cover object-center" src="/assets/add.png" alt="Post Image">
                        @else
                            <img class="w-full h-[400px] rounded-t-xl object-cover object-center" src="{{ $image->temporaryUrl() }}" alt="Post Image">
                        @endif
                    </div> 
                </div>

                <div class="flex flex-col items-center justify-center">  
                    @if ($title)
                        <h1 class="py-1 px-2 font-bold mt-1 text-center">{{ $title }}</h1>                     
                    @else 
                        <h1 class="py-1 px-2 font-bold mt-1 text-center"></h1>                     
                    @endif  
                </div>
            </div>

            <select wire:model="duration" id="countries" class="mt-8 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Duração da Publicação</option>
                <option value="hour">1 Hora</option>
                <option value="halfday">12 Horas</option>
                <option value="day">1 Dia</option>
                <option value="week">1 Semana</option>
                <option value="month">1 Mês</option>
            </select>
            
            <button onclick="getLocation()"  class="rounded-lg mt-3 mb-1 py-2 px-4 bg-red-500 text-white font-bold text-md  duration-100 hover:transform hover:bg-red-400 hover:scale-105">Publicar</button>

            <input type="hidden" wire:model="latitude" id="latitude">
            <input type="hidden" wire:model="longitude" id="longitude">
    </form>


    @if($errors->any())
        <p class="font-bold text-md text-center text-red-600 mt-4"> {{ $errors->first() }} </p>
    @endif 
                
    @if(session()->has('success'))
        <p class="font-bold text-md text-center text-green-600 mt-4"> {{ session()->get('success') }} </p>
    @endif

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            Livewire.emit('locationReceived', {
                latitude: position.coords.latitude,
                longitude: position.coords.longitude
            });
        }

        window.onload = function() {
            getLocation();
        };
    </script>
</div>