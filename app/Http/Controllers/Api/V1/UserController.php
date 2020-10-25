<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\User\ConfirmCodeRequest;
use App\Http\Requests\Api\User\CreateUserRequest;
use App\Http\Requests\Api\User\ForgetRequest;
use App\Http\Requests\Api\User\GetRequest;
use App\Http\Requests\Api\User\LoginRequest;

use App\Http\Requests\Api\User\ResendConfirmCodeRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Repositories\Eloquents\UserEloquent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    //
    private $user;

    public function __construct(UserEloquent $userEloquent)
    {
        $this->user = $userEloquent;
    }

    // generate access token
    public function access_token(LoginRequest $request)
    {
        return $this->user->access_token();
    }

    // generate refresh token
    public function refresh_token()
    {
        return $this->user->refresh_token();
    }

    // Sign up
    public function postUser(CreateUserRequest $request)
    {
        return $this->user->create($request->all());
    }

    // User update
    public function putUser(UpdateUserRequest $request)//,$id = null
    {
        return $this->user->update($request->all());
    }

//     get User by id
    public function getProfile($id = null)
    {
        return $this->user->getById($id);
    }


    // post confirm code
    public function postConfirmCode(ConfirmCodeRequest $request)
    {
        return $this->user->confirm_code($request->all());
    }

    // resent confirm code
    public function resendConfirmCode(ResendConfirmCodeRequest $request)
    {
        return $this->user->resend_confirm_code($request->all());
    }

    //forget password "We have to establish an email account from mail server"
    public function forget(ForgetRequest $request)
    {
        return $this->user->forget($request->all());
    }

    // logout user
    public function logout(Request $request)
    {
        return $this->user->logout();
    }

    // list of players
    public function getPlayers(GetRequest $request)
    {
        return $this->user->getPlayers($request->all());
    }

    //

}
