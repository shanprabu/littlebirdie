<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Client as GuzzleClient;

use App\User;
use App\UserDetail;
use Illuminate\Support\Facades\Log;

class sendToReqres implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $userData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new GuzzleClient();
        //Guzzle client converts the below array to JSON payload
        $params = [
            'json' => [
                'first_name' => $this->userData['first_name'],
                'last_name' => $this->userData['last_name'],
                'email' => $this->userData['email'],
                'avatar' => $this->userData['avatar'],
                'state' => $this->userData['state'],
                'postcode' => $this->userData['postcode'],
            ]
        ];
        $request = $client->put('https://reqres.in/api/users/' . $this->userData['id'], $params);
        $response = $request->getBody()->getContents();
        Log::debug("Message : " . $response);
    }
}
