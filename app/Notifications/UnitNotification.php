<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UnitNotification extends Notification
{
    use Queueable;
    public  $product;

    /**
     * Create a new notification instance.
     */
    public function __construct($product)
    {
        if ($product instanceof Product) {
            $this->product = $product;
        } elseif (is_numeric($product)) {
            $this->product = Product::find($product);
        } else {
            throw new \InvalidArgumentException('Invalid product argument.');
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
  

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
           'title' => "Create Product",
           "product_title"=> $this->product->title,
           "product_id"=> $this->product->id,
           "message" => "success is create product"
        ];
    }
}
