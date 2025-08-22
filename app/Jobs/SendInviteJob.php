<?php

namespace App\Jobs;

use App\Mail\InviteMail;
use App\Models\UserInvite;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendInviteJob implements ShouldQueue
{
    use Queueable;

    private $token;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $email){
        $this->token = Str::random(40);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        UserInvite::create([
            'email' => $this->email,
            'token' => $this->token,
        ]);

        Mail::to($this->email)->send(new InviteMail($this->email, Hash::make($this->token)));
    }
}
