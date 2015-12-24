<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class DeliverymanCheckoutController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository, OrderService $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $deliverymanId = Authorizer::getResourceOwnerId();

        $orders = $this->orderRepository->with('items')->scopequery(function ($query) use ($deliverymanId) {
            return $query->where('user_deliveryman_id', '=', $deliverymanId);
        })->paginate();

        return $orders;
    }

    public function show($orderId)
    {
        $deliverymanId = Authorizer::getResourceOwnerId();

        return $this->orderRepository->getByIdAndDeliveryman($orderId, $deliverymanId);
    }

    public function updateStatus(Request $request, $orderId)
    {
        $deliverymanId = Authorizer::getResourceOwnerId();

        $order = $this->orderService->updateStatus($orderId, $deliverymanId, $request->get('status'));

        if ($order) {
            return $order;
        }

        abort(400, "Pedido não encontrado.");
    }
}
