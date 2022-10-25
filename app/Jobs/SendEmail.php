<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var String
     */
    protected ?String $email;

    /**
     * @var String
     */
    protected ?String $ccEmail;

    /**
     * @var Mailable
     */
    protected ?Mailable $mailable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Mailable $mailable = null, string $email = "", string $ccEmail = "")
    {
        $this->email = $email;
        $this->ccEmail = $ccEmail;
        $this->mailable = $mailable;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->email)->cc($this->ccEmail)->send($this->mailable);
        } catch (\Throwable $th) {
            //
        }
    }
}
