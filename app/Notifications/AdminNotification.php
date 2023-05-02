<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class AdminNotification extends Notification
{
    use Queueable;
protected $admin_data;
    
    public function __construct($admin_data)
    {
        $this->admin_data=$admin_data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'admin_data'=>$this->admin_data,
            'user'=>$notifiable
        ];
    }
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
