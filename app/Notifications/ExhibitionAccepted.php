<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ExhibitionAccepted extends Notification
{
    use Queueable;

    protected $exhibition;

    // Constructor to inject the exhibition
    public function __construct($exhibition)
    {
        $this->exhibition = $exhibition;
    }

    // Define the notification channels
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    // Define the mail representation of the notification
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Your exhibition post has been accepted.')
                    ->action('View Exhibition', url('/exhibitions/' . $this->exhibition->id))
                    ->line('Thank you for using our application!');
    }

    // Define the database representation of the notification
    public function toArray($notifiable)
    {
        return [
            'exhibition_id' => $this->exhibition->id,
            'message' => "Your exhibition '{$this->exhibition->exhibition_name}' has been accepted.",
            'details' => [
                'name' => $this->exhibition->exhibition_name,
                'status' => 'Approved',
                'date_accepted' => now()->format('Y-m-d H:i:s'),
            ]
        ];
    }

    // Define the broadcast representation of the notification
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'exhibition_id' => $this->exhibition->id,
            'message' => 'Your exhibition post has been accepted.',
        ]);
    }
}