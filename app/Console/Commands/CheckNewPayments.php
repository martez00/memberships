<?php

namespace App\Console\Commands;

use App\StripeSession;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Stripe;

class CheckNewPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:new';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check new payments';

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
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $events = Stripe\Event::all([
            'created' => [
                'gte' => time() - 60 * 24 * 24,
            ],
        ]);

        $stripeSessions = StripeSession::all();
        foreach ($stripeSessions as $stripeSession) {
            $stripeSession->session_id = Crypt::decryptString($stripeSession->session_id);
        }

        foreach ($events->autoPagingIterator() as $event) {
            $session = $event->data->object;
            $stripeSession = $stripeSessions->where('session_id', $session->id)->first();
            if ($stripeSession) {
                if ($event->type == "checkout.session.completed") {
                    $stripeSession->userMembership->start_date = Carbon::now();
                    $stripeSession->userMembership->end_date = Carbon::now()->addMinutes(5);
                    $stripeSession->userMembership->status = "ACTIVE";
                    $stripeSession->userMembership->save();
                    $stripeSession->delete();
                    $stripeSessions->forget($stripeSession);
                } else {
                    $stripeSession->userMembership->delete();
                    $stripeSessions->forget($stripeSession);
                }
            }
        }

        foreach ($stripeSessions as $stripeSession) {
            //delete user membership after 15 minutes
            if (time() - strtotime($stripeSession->created_at) > 60 * 15) {
                $stripeSession->userMembership->delete();
            }
        }
    }
}
