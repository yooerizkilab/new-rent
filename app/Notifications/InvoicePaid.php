<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Inisiatif\WhatsappQontakPhp\Message\Message;
use Inisiatif\WhatsappQontakPhp\Message\Receiver;
use Inisiatif\WhatsappQontakPhp\Illuminate\Envelope;
use Inisiatif\WhatsappQontakPhp\Illuminate\QontakChannel;
use Inisiatif\WhatsappQontakPhp\Illuminate\QontakNotification;

class InvoicePaid extends Notification implements QontakNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [QontakChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toQontak($notifiable): Envelope
    {
        // First create message object
        $receiver = new Receiver('+62895341341001', 'Test');
        $message = new Message($receiver);

        // Then create envelope object and return it
        return new Envelope('92e1ea85-0d2d-4aa8-b1e8-d2b2c24dd904', '0a62d1f1-bfc6-4d82-8197-9dbfda6ba41a', $message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
