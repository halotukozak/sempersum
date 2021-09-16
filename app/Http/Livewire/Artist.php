<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Artist extends Component
{
    public $artist;
    public $songs;

    public function mount($artist)
    {
        $this->artist = \App\Models\Artist::with('songs')->where('slug', $artist)->firstOrFail();
        $this->songs = $this->artist->songs->where('isVerified', true)->where('isOutOfDate', false);
    }

    public function render()
    {
        return view('livewire.artist')
            ->with('songbooks', current_user() ? $this->songbooks = current_user()->songbooks()->paginate(3) : $this->songbooks = collect())
;
    }
}
