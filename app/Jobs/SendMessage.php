<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\WhatsappApiService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $phone;
    protected $message;

    public function __construct($phone, $message)
    {
        $this->phone = $phone;
        $this->message = $message;
    }

    public function handle()
    {
        $create = new WhatsappApiService();

        // You can move the logic for sending the message via cURL here, or call a separate service class.
        $create->sendCurlRequest($this->phone, $this->message);  // Assuming sendCurlRequest is a globally available function.
    }
}
