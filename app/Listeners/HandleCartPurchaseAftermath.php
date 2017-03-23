<?php

namespace App\Listeners;

use Sellout\User;
use Sellout\Cart;
use Sellout\Receipt;
use Sellout\Purchase;
use Sellout\Hardware;
use Sellout\Transaction;
use Sellout\MailHandler;
use Sellout\ReceiptHandler;
use App\Events\CartPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HandleCartPurchaseAftermath
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
    public function handle(CartPurchased $event)
    {
        if($event->ships) $this->_handleShipping($event->cart);
        $receipt = $this->_buildReceipt($event->user, $event->cart, $event->purchases, $event->transaction);
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
    private function _buildReceipt(User $user, Cart $cart, $purchases, Transaction $transaction = null)
    {
        $receipt = new ReceiptHandler;
        $receipt->user = $user;
        $receipt->cart = $cart;
        $receipt->purchases = $purchases;
        $receipt->transaction = $transaction;
        return $receipt->create();
    }
    private function _handleShipping($cart)
    {
        // Shipping related logic
    }
}
