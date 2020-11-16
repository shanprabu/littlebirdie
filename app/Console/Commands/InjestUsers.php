<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client as GuzzleClient;
use App\User;
use App\UserDetail;
use Illuminate\Support\Facades\Hash;

class InjestUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'injestusers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Injest Users from https://reqres.in';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $continue = TRUE;
        $pageCount = 1;
        //Loop to handle multiple pages
        while($continue == TRUE)
        {
            $response = json_decode($this->getUsers($pageCount));
            foreach($response->data as $userItem)
            {
                echo $userItem->first_name . " " . $userItem->last_name . " " . $userItem->email . "\r\n";
                if(User::where('email', $userItem->email)->count()==0)
                {
                    //Add record if not already in the table
                    $userRecord = User::create([
                        'name' => $userItem->first_name . " " . $userItem->last_name,
                        'email' => $userItem->email,
                        'password' => Hash::make("NA")
                    ]);
                    
                    //Add the related data to the sub model
                    $userDetails = $userRecord->details()->create([
                        'first_name' => $userItem->first_name,
                        'last_name' => $userItem->last_name,
                        'email' => $userItem->email,
                        'avatar' => $userItem->avatar
                    ]);
                }
            }
            if($response->page == $response->total_pages)
                $continue = FALSE;
            else
                $pageCount++;
        }
    }

    /**
     * Method to fetch list of users from the API
     */
    public function getUsers($page = 1)
    {
        $client = new GuzzleClient();
        $params = [
            'query' => [
                'page' => $page
            ]
        ];
        $request = $client->get('https://reqres.in/api/users', $params);
        $response = $request->getBody()->getContents();
        return $response;
    }
}
