<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DonasiBaruNotification extends Notification
{
    use Queueable;

    protected $donasi;

    /**
     * Create a new notification instance.
     */
    public function __construct($donasi)
    {
        $this->donasi = $donasi;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [

            'title' => 'Donasi Baru',

            'message' =>
                'Donasi dari '.$this->donasi->nama.
                ' sebesar Rp '.number_format($this->donasi->jumlah,0,',','.'),

            'icon' => '💰',

            'color' => 'success',

            'url' => route('admin.donasis.show',$this->donasi->id),

            'time' => now()

        ];
    }
}
