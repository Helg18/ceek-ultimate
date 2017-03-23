<?php

namespace App\Listeners;

use Sellout\User;
use Sellout\Receipt;
use Sellout\Transaction;
use Sellout\MailHandler;
use Sellout\ReceiptHandler;
use App\Events\CardCharged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleCardChargedAftermath
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CardCharged  $event
     * @return void
     */
     public function handle(CardCharged $event)
     {
         $receipt = $this->_buildReceipt($event->user, $event->transaction);
         if($receipt === false)
         {
             return false;
         }
         return $this->_mail($event->user, $receipt);
     }
     private function _mail(User $user, Receipt $receipt)
     {
         $mailer = new MailHandler;
         $mailer->user = $user;
         $mailer->type = 'receipt';
         $mailer->receipt = $receipt;
         if(env('EMAIL_RECEIPT') === true) return $mailer->send();
     }
     private function _buildReceipt(User $user, Transaction $transaction)
     {
         $receipt = new ReceiptHandler;
         $receipt->user = $user;
         $receipt->transaction = $transaction;
         return $receipt->create();
     }
}
