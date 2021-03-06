<?php

namespace Database\Factories;

use App\Models\Artist;
use App\Models\Song;
use App\Models\User;
use Spotify;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
class SongFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Song::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'artist_id' => Artist::inRandomOrder()->first(),
            'author_id' => User::inRandomOrder()->first(),

            'slug' => $this->faker->unique(true)->slug(),
            'title' => $this->faker->sentence(4),
            'text' => '
Bbm
Nie mamy o czym myśleć, ani o czym pisać
D#m                      Fm
Za dużo się zdarzyło żeby się zachwycać
Bbm
Szum wiadomości mnie zalewa z krańców globu
D#m                  Fm
Milionów znaczeń magma wchodzi mi do domu

Bbm
Małe wzruszenia festiwale, piękne sprawy
D#m                       Fm
W czarnych od tuszu łzach na zdjęciach Ci do twarzy
Bbm
Nic się nie stało, słowa ciekną miał być ogień
D#m                       Fm           C#
My mamy pustki w głowach, głowy w telefonie

G#          Bbm
A gdyby tak, choć jeden raz
F#               C#
Nam się zatrzęsła Ziemia
G#            Bbm
Przerwała sen, oderwała nas
F#      F
Od niechcenia

Bbm
Nic nas nie ziębi ani
D#m
Nic nas nie parzy
F#
Przezroczysty świat
F
Przezroczysty świat
Bbm
Nie ma miłości ani
D#m
Nie ma rozpaczy
F#
Przezroczysty świat
Fm
Przezroczysty świat

            ',
            'spotifyId' => Spotify::searchTracks($this->faker->randomLetter())->limit(1)->get('tracks')['items'][0]['id'],
            'deezerId' => '398369572',
            'youtubeId' => 'C0VmrEpcdHU',
            'soundcloudId' => '255455712',
            'key' => $this->faker->randomElement([
                'C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'Bb', 'B'
            ]),
            'isVerified' => $this->faker->boolean(),
            'isOutOfDate' => $this->faker->boolean(),
            'idSong' => $this->faker->unique(true)->randomNumber(),
        ];
    }
}
