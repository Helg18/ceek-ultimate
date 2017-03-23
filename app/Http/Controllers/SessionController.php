<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;

use Auth;
use Sellout\User;
use Sellout\Token;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordResetRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;


class SessionController extends Controller
{
    use ResetsPasswords;

    public function store(LoginRequest $request)
    {
        $credentials = [
            'login_name' => strToLower($request->input('email')),
            'password' => $request->input('password')
        ];
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            Token::generate($user, $request->header('deviceid'));
            return response()->json(['session' => $user->load('token','avatar')]);
        }
        return abort(403, 'Login failed.');
    }
    public function destroy()
    {
        $return = 'You are not logged in.';
        if(Auth::check())
        {
            $tokenModel = new Token;
            $tokenModel->deleteOldTokens(Auth::user());
            Auth::logout();
            $return = ['message' => 'Logged out'];
        }
        return response()->json(['status' => $return]);
    }
    public function requestPasswordReset(PasswordResetRequest $request)
    {
        return $this->sendResetLinkEmail($request);
    }
    /**
     * Get the response for after a successful password reset.
     *
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetSuccessResponse($response)
    {
        // return redirect($this->redirectPath())->with('status', trans($response));
        return response()->json(['message' => 'success']);
    }

    /**
     * Get the response for after a failing password reset.
     *
     * @param  Request  $request
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetFailureResponse(Request $request, $response)
    {
        // return redirect()->back()
        //     ->withInput($request->only('email'))
        //     ->withErrors(['email' => trans($response)]);
        return response()->json(['message' => 'Password reset request failed.'], 500);
    }
    /**
     * Get the response for after the reset link has been successfully sent.
     *
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getSendResetLinkEmailSuccessResponse($response)
    {
        return response()->json(['message' => 'success']);
    }

    /**
     * Get the response for after the reset link could not be sent.
     *
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getSendResetLinkEmailFailureResponse($response)
    {
        return response()->json(['message' => 'Password reset request failed.'], 500);
    }
}
