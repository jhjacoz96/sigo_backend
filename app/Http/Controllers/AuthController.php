<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use App\User;
use App\Utils\Enums\EnumResponse;
use App\Http\Requests\UserUpdatePasswordRequest;
use App\Services\UserService;
use App\Http\Resources\AuthResource;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;

class AuthController extends Controller
{
    function __construct(UserService $_UserService)
    {
        $this->serviceUser = $_UserService;
    }


    public function login (LoginRequest $request) {
        try {
            $data = $request->validated();
            $credentials = request(['email', 'password']);

            if(!Auth::attempt($credentials))
            {
                $data = [
                    'message' => __('auth.failed') 
                ];
                return bodyResponseRequest( EnumResponse::UNAUTHORIZED, $data);
            }
                 
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
            $organization = Organization::find(1);
            $data = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'user' => new AuthResource($user),
                'organization' => new OrganizationResource($organization),
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ];
            return bodyResponseRequest(EnumResponse::ACCEPTED, $data);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function updatePassword(UserUpdatePasswordRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $user = $this->serviceUser->find($id);
            if(!$user){
                $data = [
                    'message' => __('response.bad_request_long')
                ];
                return bodyResponseRequest(EnumResponse::NOT_FOUND, $data);
            } else {
                $user = $this->serviceUser->updatePassword($data, $user['id']);
                return bodyResponseRequest(EnumResponse::SUCCESS_OK);
            }
          } catch (\Exception $e) {
            return $e;
          }
    }
    
    public function logout () {
        
    }
}
