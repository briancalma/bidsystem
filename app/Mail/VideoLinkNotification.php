<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VideoLinkNotification extends Mailable
{
    use Queueable, SerializesModels;

    // public $email;
    public $video_link; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($video_link)
    {
        // $this->$email = $email;
        $this->$video_link = $video_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $video_link;
        return $this->markdown('emails.notification.videolink');
    }
}
