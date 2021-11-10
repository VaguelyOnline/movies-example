<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MovieUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $movie;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($movie, $user)
    {
        $this->movie = $movie;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Movie updated!')
            ->view('mail.movies.updated');
    }
}
