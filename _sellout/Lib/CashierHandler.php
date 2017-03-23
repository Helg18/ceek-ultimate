<?php

namespace Sellout;

use Event;
use Sellout\User;
use App\Events\CardCharged;

class CashierHandler
{
    protected $user;
    protected $data;

    public function __construct(User $user, $data = null)
    {
        $this->user = $user;
        $this->data = $data;
    }
    public function addCard($data = null)
    {
        if(is_null($this->data)) $this->data = $data;
        $userDetails = $this->_setDescriptionToUserMid();
        $stripeReceipt = $this->_pushStripeData($userDetails);
        return $this->_userHasCreditCardRegistered($this->user)
            ? $this->user
            : abort(400, "Card not added");
    }
    public function addCredits($data = null, $addCreditsToUser = true)
    {
        if(is_null($this->data)) $this->data = $data;
        if(!$this->data['credits'] > 0) return;
        $stripeId = $this->_getUserStripeId();
        $charge = $this->data['credits'];
        $stripeReceipt = $this->_chargeStripe($this->user, $charge);
        $this->_checkStripeReceipt($stripeReceipt);
        $transaction = $this->_saveTransaction($stripeReceipt);
        $this->user->transactions()->save($transaction);
        if($addCreditsToUser) $this->_addUserCredits();
        Event::fire(new CardCharged($this->user, $transaction));
        return $transaction;
    }
    private function _addUserCredits()
    {
        $this->user->credits = $this->user->credits + $this->data['credits'];
        $this->user->push();
    }
    private function _sqlStorable($var)
    {
        if($var !== "")
        {
            $type = gettype($var);
            $storable = (
                $type === 'string' ||
                $type === 'integer' ||
                $type === 'boolean' ||
                $type === 'NULL'
            );
            if($storable) return true;
        }
        return false;
    }
    private function _parseStripeReceipt($stripeReceipt)
    {
        $receipt = $stripeReceipt->__toArray();
        $return['charge_id'] = $receipt['id'];
        unset($receipt['id']);
        foreach($receipt as $k => $v)
        {
            $storable = $this->_sqlStorable($v);
            if($storable) $return[$k] = $v;
        }
        return $return;
    }
    private function _saveTransaction($stripeReceipt)
    {
        return Transaction::create($this->_parseStripeReceipt($stripeReceipt));
    }
    private function _checkStripeReceipt($receipt)
    {
        if($receipt === null || $receipt === false || $receipt['status'] !== 'succeeded')
        {
            throw new \Exception("Charge to customer failed.", 1);
        }
        return true;
    }
    private function _chargeStripe(User $user, $charge)
    {
        return $user->charge($charge);
    }
    private function _getUserStripeId()
    {
        if(!is_null($this->user->stripe_id))
        {
            return $this->user->stripe_id;
        }
        throw new \Exception("User has no stripe account.", 1);
    }
    private function _setDescriptionToUserMid()
    {
        return ['description' => $this->user->mid];
    }
    private function _getNewCardDetails()
    {
        return [
            'name' => $this->data['name'],
            'number' => $this->data['number'],
            'exp_month' => $this->data['exp_month'],
            'exp_year' => $this->data['exp_year'],
            'cvc' => $this->data['cvc'],
        ];
    }
    private function _makeStripeToken()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $token = \Stripe\Token::create(['card' => $this->_getNewCardDetails()]);
        return $token->id;
    }
    private function _userHasCreditCardRegistered(User $user)
    {
        if(isset($user->card_last_four) && !is_null($user->card_last_four))
        {
            return true;
        }
        return false;
    }
    private function _userHasStripeAccount(User $user)
    {
        if(isset($user->stripe_id) && !is_null($user->stripe_id))
        {
            return true;
        }
        return false;
    }
    private function _pushStripeData($userDetails)
    {
        if($this->_userHasStripeAccount($this->user))
        {
            $stripeCustomer = $this->user->updateCard($this->_makeStripeToken());
            return $this->user;
        }
        $stripeCustomer = $this->user->createAsStripeCustomer($this->_makeStripeToken(), $userDetails);
        return $this->user;
    }
}
