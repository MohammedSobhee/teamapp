<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/2/18
 * Time: 11:43 PM
 */

namespace App\Repositories\Eloquents;

use App\DeviceToken;
use App\Http\Resources\PlayerResource;
use App\Repositories\Interfaces\UserRepository;
use App\Repositories\Uploader;
use App\User;
use App\VerifyUser;
use Carbon\Carbon;
use DB;
//use Excel;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Lcobucci\JWT\Parser;
use Mail;

class UserEloquent extends Uploader implements UserRepository
{

    private $model, $deviceToken, $notificationSystem;

    public function __construct(User $model, DeviceToken $deviceToken, NotificationSystemEloquent $notificationSystemEloquent)
    {
        $this->model = $model;
        $this->deviceToken = $deviceToken;
        $this->notificationSystem = $notificationSystemEloquent;
    }

    // generate access token
    public function access_token()
    {
        if (\request()->filled('username') && is_numeric(\request()->get('username'))) {
            if (strlen(\request()->get('username')) != 12) {
                return response_api(false, 401, trans('app.incorrect_mobile'), empObj());
            }
        }

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        $response = Route::dispatch($proxy);

        $token_obj = json_decode($response->getContent());

        $statusCode = json_decode($response->getStatusCode());

        if (isset($token_obj->error)) {
//            return response_api(false, 401, trans('app.unauthorized'), new \stdClass());

            return [
                'status' => false,
                'statusCode' => 401,
                'message' => trans('app.unauthorized'),
                'items' => empObj()
            ];
        }

        if (!isset($token_obj->access_token))
            return [
                'status' => false,
                'statusCode' => 422,
                'message' => 'error',
                'items' => empObj()
            ];

        \request()->headers->set('Accept', 'application/json');
        \request()->headers->set('Authorization', 'Bearer ' . $token_obj->access_token);
//
        $request = \request()->create(
            'api/v1/profile',
            'GET'
        );
////
//
//
        $response = Route::dispatch($request);

        $data = json_decode($response->getContent());
        $statusCode = json_decode($response->getStatusCode());

        if ($statusCode == 200) {
            $user = $data->items;

        }

        $token = empObj();

        if (!isset($user)) {
            return response_api(false, 422, trans('auth.failed'), empObj());
        }
        if (!$user->is_active)
            return response_api(false, 422, 'This account is not active', empObj());

        if (!$user->is_confirm_code) {
            return [
                'status' => false, // to go to verification code
                'statusCode' => 405,
                'message' => 'Verification code is not confirmed.',
                'items' => ['token' => $token, 'user' => $user]
            ];
//            return response_api(false, 403, 'Verification code is not confirmed.', []);
        }
//
        $token = empObj();
//
        $token->token_type = $token_obj->token_type;
        $token->expires_in = $token_obj->expires_in;
        $token->access_token = $token_obj->access_token;
        $token->refresh_token = $token_obj->refresh_token;


        if (\request()->filled('device_type')) {
            $device = $this->deviceToken->where('user_id', $user->id)->where('device_id', \request()->get('device_id'))->first();
            if (!isset($device))
                // register device token
                $device = new DeviceToken();
            $device->user_id = $user->id;

            if (\request()->filled('device_id'))
                $device->device_id = \request()->get('device_id');
            $device->device_token = \request()->get('device_token');
            $device->type = \request()->get('device_type');
            $device->status = 'on';

            $device->save();

        }

        return [
            'status' => true,
            'statusCode' => 200,
            'message' => trans('app.success'),
            'items' => ['token' => $token, 'user' => $user]
        ];


    }

    // generate refresh token
    public function refresh_token()
    {

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        $response = Route::dispatch($proxy);
        $token_obj = json_decode($response->getContent());
        $statusCode = json_decode($response->getStatusCode());

        if (isset($token_obj->error)) {
            return [
                'status' => false,
                'statusCode' => $statusCode,
                'message' => $token_obj->message,
                'items' => empObj()
            ];
        }

        \request()->headers->set('Accept', 'application/json');
        \request()->headers->set('Authorization', 'Bearer ' . $token_obj->access_token);
//
        $request = \request()->create(
            'api/v1/profile',
            'GET'
        );
//
        $token = empObj();
//
        $token->token_type = $token_obj->token_type;
        $token->expires_in = $token_obj->expires_in;
        $token->access_token = $token_obj->access_token;
        $token->refresh_token = $token_obj->refresh_token;

        $response = Route::dispatch($request);

        $data = json_decode($response->getContent());
        $statusCode = json_decode($response->getStatusCode());

        if ($statusCode == 200) {
            $user = $data->items;
        }

        return [
            'status' => true,
            'statusCode' => 200,
            'message' => trans('app.success'),
            'items' => [
                'token' => $token, 'user' => $user
            ]
        ];
    }

    function anyData($type)
    {


        $users = $this->model->where('type', $type)->orderByDesc('updated_at');

        return datatables()->of($users)
            ->filter(function ($query) use ($type) {
//
//                $search = request()->get('query')['members_search'];
//
//                if (isset($search)) {
//                    $cities_id = City::where('name_en', 'LIKE', '%' . $search . '%')->pluck('id');
//
//                    $query->where(function ($query) use ($search, $cities_id) {
//                        $query->where('first_name', 'LIKE', '%' . $search . '%')->orWhere('last_name', 'LIKE', '%' . $search . '%')->orWhereIn('city_id', $cities_id);
//                    });
//                }
            })
            ->editColumn('image', function ($user) {
                if (isset($user->image100))
                    return '<img src="' . $user->image100 . '" class="rounded-circle"  width="80%">';
                return '<img src="' . url('assets/img/placeholder-user.png') . '" class="rounded-circle" width="80%">';
            })
            ->addColumn('is_active', function ($user) use ($type) {
                $checked = ($user->is_active) ? 'checked="checked"' : '';

                return '<span class="m-switch m-switch--icon m-switch--primary">
														<label>
														<input type="checkbox" ' . $checked . ' class="status" data-status="' . $user->is_active . '" data-link="' . url(admin_users_url() . '/user/' . $user->id . '/status') . '" name="">
															<span></span>
														</label>
													</span>';
            })
            ->addColumn('action', function ($user) use ($type) {
                return '<a href="' . url(admin_users_url() . '/edit/' . $user->id) . '"
                                   class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                                   title="تعديل"><i class="la la-edit"></i></a>
                                <a href="' . url(admin_users_url() . '/delete-user/' . $user->id) . '"
                                   class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill delete"
                                   title="حذف"><i class="la la-trash"></i></a>';
            })->addIndexColumn()
            ->rawColumns(['image', 'is_active', 'action'])->toJson();
    }

    function changeStatus($id)
    {
        // TODO: Implement delete() method.
        $user = $this->model->find($id);

        if (isset($user)) {
            $user->is_active = !$user->is_active;
            $user->save();
            return response_api(true, 200, trans('app.updated'), []);
        }
        return response_api(false, 422, null, []);

    }

    public function getPlayers(array $attributes)
    {
        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;
        $collection = $this->model->where('type', 'player')->where('is_complete_profile', 1)->where('is_active', 1)->where('is_confirm_code', 1)->where('id', '<>', auth()->user()->id);

        if (isset($attributes['name'])) {
            $collection = $collection->where('first_name', 'LIKE', '%' . $attributes['name'] . '%')->orWhere('last_name', 'LIKE', '%' . $attributes['name'] . '%');
        }
        $count = $collection->count();
        $page_count = page_count($count, $page_size);
        $page_number = $page_number - 1;
        $page_number = $page_number > $page_count ? $page_number = $page_count - 1 : $page_number;

        $object = $collection->take($page_size)->skip((int)$page_number * $page_size)->get();

        if (request()->segment(1) == 'api' || request()->ajax()) {
            return response_api(true, 200, null, $object, $page_count, $page_number, $count);
        }
    }

    function userActive($id)
    {

        $user = $this->model->find($id['user_id']);

        if (isset($user)) {
            $user->is_active = !$user->is_active;

            if ($user->save()) {
                if (!$user->is_active) {
                    $action = 'user_deactivate';
//                    $this->notificationSystem->sendNotification(null, $user->id, $user->id, $action);
                    $this->logout($user->id);
                    return response_api(true, 200);

                }
                return response_api(true, 200);
            }
        }
        return response_api(false, 422);

    }

    function verifyEmail($id)
    {

        $user = $this->model->find($id['user_id']);

        if (isset($user)) {

            if (!isset($user->email_verified_at))
                $user->email_verified_at = Carbon::now();
            else
                $user->email_verified_at = null;

            if ($user->save()) {
                return response_api(true, 200);
            }
        }
        return response_api(false, 422);

    }

    // get all users
    function getAll(array $attributes)
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }

    // get user by email
    function getByEmail($email)
    {
        // TODO: Implement getAll() method.
        return $this->model->where('email', $email)->first();
    }

    //user profile view
    function getById($id)
    {
        // TODO: Implement getById() method.
        if (!isset($id) && auth()->check())
            $user = $this->model->find(auth()->user()->id);
        else
            $user = $this->model->find($id);

        if (\request()->segment(1) == 'api' || \request()->ajax()) {
            if (isset($user)) {
                return response_api(true, 200, null, new PlayerResource($user));
            }
            return response_api(false, 422, trans('app.not_data_found'), empObj());
        }
        return $user;
    }

    function store(array $attributes)
    {
        $user = new User();
        $user->first_name = $attributes['name'];
        $user->last_name = '';
//        $user->nick_name = $attributes['nick_name'];
        $user->username = $attributes['username'];
        $user->email = $attributes['email'];
        $user->password = bcrypt(generateVerificationCode());
        $user->mobile = $attributes['mobile'];
        $user->type = $attributes['type'];
        $user->city_id = $attributes['city_id'];
        if (isset($attributes['address']))
            $user->address = $attributes['address'];

        $user->verification_code = '1234'; // generateVerificationCode();

        if ($user->save()) {
            // send verification code
            $this->sendResetPasswordEmail($attributes);
            if (isset($attributes['image'])) {
                $user->image = $this->storeImageThumb('users', $user->id, $attributes['image']);
                $user->save();
            }
            return response_api(true, 200, trans('app.created'), ['url' => url(admin_users_url() . '/edit/' . $user->id)]);// . ',' . trans('app.sent_email_verification')
        }
        return response_api(false, 422, null, empObj());

    }

    public function sendResetPasswordEmail($request)
    {
        $response = Password::broker()->sendResetLink(
            ['email' => $request['email']]
        );
//
//        return $response == \Illuminate\Support\Facades\Password::RESET_LINK_SENT
//            ? true
//            : false;
    }

    // sign up user not completed
    function create(array $attributes)
    {
        // TODO: Implement create() method.
        $user = new User();
//        $user->first_name = $attributes['first_name'];
//        $user->last_name = $attributes['last_name'];
//        $user->nick_name = $attributes['nick_name'];
        $user->username = $attributes['username'];
        if (isset($attributes['email']))
            $user->email = $attributes['email'];
        $user->password = bcrypt($attributes['password']);
        $user->mobile = $attributes['mobile'];
        $user->type = 'player';

        $user->verification_code = '1234'; // generateVerificationCode();

        if ($user->save()) {

            // send verification code

            if (isset($attributes['image'])) {
                $user->image = $this->storeImageThumb('users', $user->id, $attributes['image']);
                $user->save();
            }

//            VerifyUser::create([
//                'user_id' => $user->id,
//                'token' => str_random(40),
//                'email' => $attributes['email'],
//            ]);


//            Mail::to($user->email)->send(new VerifyMail($user));

            if (\request()->has('device_type')) {
                $device = $this->deviceToken->where('user_id', $user->id)->where('device_id', \request()->get('device_id'))->where('type', \request()->get('device_type'))->first();

                if (!isset($device))
                    // register device token
                    $device = new DeviceToken();
                $device->user_id = $user->id;

                if (\request()->has('device_id'))
                    $device->device_id = \request()->get('device_id');
                $device->device_token = \request()->get('device_token');
                $device->type = \request()->get('device_type');
                $device->status = 'off';
                $device->save();
            }
            $user = $this->model->find($user->id);
//            return $this->access_token();
            return response_api(true, 200, trans('app.user_created'), $user);// . ',' . trans('app.sent_email_verification')
        }
        return response_api(false, 422, null, empObj());

    }

    //update player
    function update(array $attributes, $id = null)
    {
        $message = trans('app.user_updated');
        // TODO: Implement create() method.
        $user = isset($id) ? User::find($id) : auth()->user();
        if (!isset($user)) {
            return response_api(false, 422, null, empObj());
        }

        if (isset($attributes['name'])) {
            $user->first_name = $attributes['name'];
            $user->last_name = null;
        }

        if (isset($attributes['first_name']))
            $user->first_name = $attributes['first_name'];
        if (isset($attributes['last_name']))
            $user->last_name = $attributes['last_name'];
        if (isset($attributes['nick_name']))
            $user->nick_name = $attributes['nick_name'];
        if (isset($attributes['mobile']))
            $user->mobile = $attributes['mobile'];
        if (isset($attributes['username']))
            $user->username = $attributes['username'];
        if (isset($attributes['birth_date']))
            $user->birth_date = $attributes['birth_date'];

        if (isset($attributes['primer_position_id']))
            $user->primer_position_id = $attributes['primer_position_id'];
        if (isset($attributes['secondary_position_id']))
            $user->secondary_position_id = $attributes['secondary_position_id'];

        if (isset($attributes['height']))
            $user->height = $attributes['height'];
        if (isset($attributes['weight']))
            $user->weight = $attributes['weight'];

        if (isset($attributes['favorite_leg']))
            $user->favorite_leg = $attributes['favorite_leg'];
        if (isset($attributes['bio']))
            $user->bio = $attributes['bio'];

        if (isset($attributes['email']) || empty($attributes['email'])) {

            $user->email = $attributes['email'];

        }
        if (isset($attributes['password']) && !isset($id)) {
            if (Hash::check($attributes['old_password'], $user->password)) {
                $user->password = bcrypt($attributes['password']);
            } else {
                return response_api(false, 422, 'password_not_match', empObj());
            }
        }
        if (isset($attributes['country_id'])) {
            $user->country_id = $attributes['country_id'];
        }
        if (isset($attributes['city_id'])) {
            $user->city_id = $attributes['city_id'];
        }
        if (isset($attributes['address'])) {
            $user->address = $attributes['address'];
        }

//
        $user->is_complete_profile = 1;

        if ($user->save()) {
            if (isset($attributes['image'])) {
                $user->image = $this->storeImageThumb('users', $user->id, $attributes['image']);
                $user->save();
            }

            $user = $this->model->find($user->id);
            return response_api(true, 200, $message, $user);
        }
        return response_api(false, 422, null, empObj());

    }

    //update Owner
    function updateOwner(array $attributes, $id = null)
    {
        $message = trans('app.user_updated');
        // TODO: Implement create() method.
        $user = isset($id) ? User::find($id) : auth()->user();
        if (!isset($user)) {
            return response_api(false, 422, null, empObj());
        }

        if (isset($attributes['name'])) {
            $user->first_name = $attributes['name'];
            $user->last_name = null;
        }

        if (isset($attributes['first_name']))
            $user->first_name = $attributes['first_name'];
        if (isset($attributes['last_name']))
            $user->last_name = $attributes['last_name'];
        if (isset($attributes['nick_name']))
            $user->nick_name = $attributes['nick_name'];
        if (isset($attributes['mobile']))
            $user->mobile = $attributes['mobile'];
        if (isset($attributes['username']))
            $user->username = $attributes['username'];
        if (isset($attributes['birth_date']))
            $user->birth_date = $attributes['birth_date'];
        if (isset($attributes['bio']))
            $user->bio = $attributes['bio'];

        if (isset($attributes['email']) || empty($attributes['email'])) {

            $user->email = $attributes['email'];

        }
        if (isset($attributes['password'])) {
            $user->password = bcrypt($attributes['password']);
        }
        if (isset($attributes['city_id'])) {
            $user->city_id = $attributes['city_id'];
        }
        if (isset($attributes['address'])) {
            $user->address = $attributes['address'];
        }
        if (isset($attributes['commission'])) {
            $user->commission = $attributes['commission'];
        }
        if (isset($attributes['discount'])) {
            $user->discount = $attributes['discount'];
        }

//
        $user->is_complete_profile = 1;

        if ($user->save()) {
            if (isset($attributes['image'])) {
                $user->image = $this->storeImageThumb('users', $user->id, $attributes['image']);
                $user->save();
            }

            $user = $this->model->find($user->id);
            return response_api(true, 200, $message, $user);
        }
        return response_api(false, 422, null, empObj());

    }

    // delete user
    function delete($id)
    {
        // TODO: Implement delete() method.
        $user = $this->model->find($id);
        if (isset($user) && $user->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);

    }

    //confirm code
    public function confirm_code(array $attributes)
    {
        $user = $this->model->find($attributes['user_id']);

        $userByMobile = $this->model->where('id', '<>', $attributes['user_id'])->where('mobile', $attributes['mobile'])->first();
        //update mobile
        if (isset($user)) {

            // 'The mobile was being token'
            if (isset($userByMobile)) {
                return response_api(false, 422, trans('app.mobile_token'));
            }
            if ($user->verification_code == $attributes['verification_code']) {
                $user->mobile = $attributes['mobile'];
                $user->is_confirm_code = true;
                $user->save();
                \request()->request->add([
                    'grant_type' => 'password',
                    'client_id' => getClientId(),
                    'client_secret' => getClientSecret(),
                    'username' => $user->username,
                    'password' => $attributes['password'],

                ]);

                return $this->access_token();
            } else {
                //'There is an error in confirmation code'
                return response_api(false, 422, trans('app.error_confirmation'));
            }
        }
    }

    //resend confirm code
    public function resend_confirm_code(array $attributes)
    {
        $user = $this->model->find($attributes['user_id']);
        $userByMobile = $this->model->where('id', '<>', $attributes['user_id'])->where('mobile', $attributes['mobile'])->first();
        if (isset($userByMobile)) {
            return response_api(false, 422, trans('app.mobile_token'));
        }
        if (isset($user)) {
            // send SMS

            $confirm_code = '1234';//$this->generateVerificationCode();
            $user->verification_code = $confirm_code;
            if ($user->save()) {
                try {
                    //SMS::Send($attributes['mobile'], ' Delivery code: ' . $confirm_code);
                    return response_api(true, 200, trans('app.resend_code_success'), $user);
                } catch (\Exception $e) {

                }


            }


        }
        return response_api(false, 422, null, []);

    }

    public function forget(array $attributes)
    {

        $response = Password::sendResetLink($attributes);
        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response_api(true, 200, 'Email was sent', empObj());
            case Password::INVALID_USER:
                return response_api(false, 422, 'Send reset password was failed', empObj());
        }
        return response_api(false, 422, 'Send reset password was failed', empObj());
    }

    //logout
    public function logout($user_id = null)
    {
        if (!isset($user_id)) {
            $user_id = auth()->user()->id;

            $accessToken = auth()->user()->token();

            $token = DB::table('oauth_access_tokens')
                ->where('user_id', '=', $user_id)
                ->update(['revoked' => true]);

            DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update(['revoked' => true]);
        } else {
            $access_token_id = DB::table('oauth_access_tokens')
                ->where('user_id', '=', $user_id)->pluck('id');

            $token = DB::table('oauth_access_tokens')
                ->where('user_id', '=', $user_id)
                ->update(['revoked' => true]);

            DB::table('oauth_refresh_tokens')
                ->whereIn('access_token_id', $access_token_id)
                ->update(['revoked' => true]);
        }
        // token device
        // turn off mobile // registerId : mac address code
        $device_reset = false;
        if (\request()->filled('device_id'))
            $device_reset = $this->deviceToken->where('user_id', $user_id)->where('device_id', \request()->get('device_id'))->update(['status' => 'off']);
        if (\request()->filled('device_type'))
            $device_reset = $this->deviceToken->where('user_id', $user_id)->where('device_type', \request()->get('device_type'))->update(['status' => 'off']);

        if (!$device_reset)
            $this->deviceToken->where('user_id', $user_id)->update(['status' => 'off']);

        if ($token)
            return response_api(true, 200, null, []);
        return response_api(false, 422, null, []);
    }

    // count users
    function count()
    {
        return $this->model->count();
    }

}
