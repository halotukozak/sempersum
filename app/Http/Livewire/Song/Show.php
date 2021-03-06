<?php

namespace App\Http\Livewire\Song;

use App\Models\Song as Model;
use App\Models\Songbook;
use Illuminate\Support\Collection;
use Laravel\Jetstream\ConfirmsPasswords;
use Livewire\Component;
use Livewire\WithPagination;

class Show extends Component
{
    public $song;
    public int $likes = 0;
    public bool $liked;
    public int $preferred_streaming_service = 3;
    public array $keys = ['Ab', 'A', 'A#', 'Bb', 'B', 'C', 'C#', 'Db', 'D', 'D#', 'Eb', 'E', 'F', 'F#', 'Gb', 'G', 'G#'];
//    public  $songbooks;

    use ConfirmsPasswords;
    use WithPagination;

    public function mount($song)
    {

        if (current_user() && current_user()->isModerator) {
            $this->song = Model::withTrashed()->withLikes()->where('slug', $song)->where('isOutOfDate', false)->latest()->firstOrFail();
        } else {
            $this->song = Model::withLikes()->where('slug', $song)->latest()->firstOrFail();
        }
        $this->liked = $this->song->isLikedBy(current_user());


        if ($this->song->likes) {
            $this->likes = $this->song->likes;
        }

        $this->set_preferred_streaming_service();
    }

    public function like()
    {
        if (current_user()) {
            if ($this->liked) {
                $this->song->dislike();
                $this->likes--;
                $this->liked = false;
            } else {
                $this->song->like();
                $this->likes++;
                $this->liked = true;
            }
        } else {
            $this->redirect(route('login'));
        }
    }

    public function verify(): void
    {
        $this->song->verify();
    }

    public function delete(): void
    {
        $this->ensurePasswordIsConfirmed();
        $this->song->delete();
        $this->redirectRoute('dashboard');
    }

    public function restore(): void
    {
        $this->ensurePasswordIsConfirmed();
        $this->song->restore();
    }

    protected function set_preferred_streaming_service()
    {
        if (current_user()) {
            switch (current_user()->preferred_streaming_service) {
                case ('youtube'):
                    $this->preferred_streaming_service = 1;
                    break;
                case ('spotify'):
                    $this->preferred_streaming_service = 2;
                    break;
                case ('deezer'):
                    $this->preferred_streaming_service = 4;
                    break;
                case ('soundcloud'):
                default:
                    $this->preferred_streaming_service = 3;
                    break;
            }
        } else $this->preferred_streaming_service = 3;

    }

    public function toggleSongToSongbook(Songbook $songbook)
    {
        $songbook->toggleSong($this->song);
    }

    public function paginationView() : string
    {
        return 'songbook-pagination';
    }

    public function render()
    {
        return view('livewire.song.show', [
                'songbooks' => current_user() ? current_user()->songbooks()->paginate(10) : collect()]
        );
    }
}
