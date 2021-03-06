<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
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
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    private $with = ['client', 'items', 'cupom'];

    public function __construct(OrderRepository $orderRepository,
                                UserRepository $userRepository,
                                ProductRepository $productRepository,
                                OrderService $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $userId = Authorizer::getResourceOwnerId();

        $clientId = $this->userRepository->find($userId)->client->id;
        $orders = $this->orderRepository->skipPresenter(false)->with($this->with)->scopeQuery(function ($query) use ($clientId) {
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return $orders;
    }

    public function store(Requests\CheckoutRequest $request)
    {
        $userId = Authorizer::getResourceOwnerId();

        $data = $request->all();
        $clientId = $this->userRepository->find($userId)->client->id;
        $data['client_id'] = $clientId;
        $order = $this->orderService->create($data);

        return $this->orderRepository->skipPresenter(false)->with($this->with)->find($order->id);
    }

    public function show($orderId)
    {
        return $this->orderRepository->skipPresenter(false)->with($this->with)->find($orderId);
    }
}
