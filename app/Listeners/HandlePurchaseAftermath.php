<?php

namespace App\Listeners;

use Sellout\User;
use Sellout\Catalog;
use Sellout\Receipt;
use Sellout\Purchase;
use Sellout\Hardware;
use Sellout\Transaction;
use Sellout\MailHandler;
use Sellout\ReceiptBuilder;
use App\Events\PurchaseCompleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandlePurchaseAftermath
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
     * @param  HardwareWasPurchased  $event
     * @return void
     */
    public function handle(PurchaseCompleted $event)
    {
        if($event->catalog->ships) $this->_handleShipping($event->catalog->hardwares);
        $receipt = $this->_buildReceipt($event->user, $event->catalog, $event->purchase, $event->transaction);
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
    private function _buildReceipt(User $user, Catalog $catalog, Purchase $purchase, Transaction $transaction = null)
    {
        //Dirty hack
        $cart = collect();
        $cart->push($catalog);

        $receipt = new ReceiptBuilder;
        $receipt->user = $user;
        $receipt->cart = $cart;
        $receipt->purchase = $purchase;
        $receipt->transaction = $transaction;
        return $receipt->create();
    }
    private function _handleShipping($hardwares)
    {
        // Shipping related logic
    }
}
