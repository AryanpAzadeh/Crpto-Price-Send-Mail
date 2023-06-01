<?php

namespace App\Jobs;

use App\Mail\PriceMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $api_result = file_get_contents('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin%2Clitecoin%2Cethereum%2Cdogecoin&vs_currencies=usd');
        $data = json_decode($api_result, true);
        $MailData = [
            'bitcoin' => $data['bitcoin']['usd'],
            'ethereum' => $data['ethereum']['usd'],
        ];
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->queue(new PriceMail($MailData));
            info('price send to ' . $user->email . ' successfully');
        }
    }
}
