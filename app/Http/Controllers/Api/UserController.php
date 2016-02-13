<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticated()
    {
        $userId = Authorizer::getResourceOwnerId();

        $user = $this->userRepository->skipPresenter(false)->find($userId);

        return $user;
    }

    public function updateDeviceToken(Request $request)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->userRepository->updateDeviceToken($userId, $request->get('device_token'));
    }
}
