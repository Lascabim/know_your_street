<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Posts;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ImagePreview extends Component
{
    use WithFileUploads;

    public $image;
    public $title;
    public $duration;
    public $latitude;
    public $longitude;

    public function render()
    {
        return view('livewire.image-preview');
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|mimes:png,jpg|max:2048',
        ]);
    }

    protected $listeners = ['locationReceived'];

    public function locationReceived($location)
    {
        $this->latitude = $location['latitude'];
        $this->longitude = $location['longitude'];
    }

    public function submit()
    {
        
        $this->validate([
            'title' => 'required',
            'image' => 'required',
            'duration' => 'required|not_in:Duração da Publicação'
        ]);

        // dd($this->duration);
        // dd($this->latitude);
        // dd($this->longitude);

        $expiration = null;
        $duration = $this->duration;
    
        if ($duration === 'hour') {
            $expiration = Carbon::now()->addHour();
        } elseif ($duration === 'halfday') {
            $expiration = Carbon::now()->addHours(12);
        } elseif ($duration === 'day') {
            $expiration = Carbon::now()->addDay();
        } elseif ($duration === 'week') {
            $expiration = Carbon::now()->addWeek();
        } elseif ($duration === 'month') {
            $expiration = Carbon::now()->addMonth();
        }    

        $post = new Posts();

        if ($this->image !== null) {
            $fileName = now()->format('Y-m-d-H-i-s') . "_" . $this->image->getClientOriginalName();
            $filePath = $this->image->storeAs('posts', $fileName, 'posts');
            $post->image_path = '/assets/' . $filePath;
        }

        $post->title = $this->title;
        $post->author = (Auth::user()->name);
        $post->latitude = $this->latitude;
        $post->longitude = $this->longitude;
        $post->date = now();
        $post->expire = $expiration;

        // Generate a unique URL for the post
        do {
            $url = Str::random(16);
        } while (Posts::where('url', $url)->exists());

        $post->url = $url;

        $post->save();

        $this->reset(['image', 'title']);
        $this->resetErrorBag();
        return back()->with('success', 'Post criado com sucesso.');
    }
}
