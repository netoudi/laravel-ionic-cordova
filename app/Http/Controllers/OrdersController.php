<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\OrderItemRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;

class OrdersController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $repository;
    /**
     * @var OrderItemRepository
     */
    private $orderItemRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param OrderRepository $repository
     * @param OrderItemRepository $orderItemRepository
     * @param UserRepository $userRepository
     */
    public function __construct(OrderRepository $repository, OrderItemRepository $orderItemRepository, UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->orderItemRepository = $orderItemRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $orders = $this->repository->with('client')->paginate();

        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id)
    {
        $order = $this->repository->with('client')->findWhere(['id' => $id])->first();
        $deliveryman = $this->userRepository->findWhere(['role' => 'deliveryman'])->lists('name', 'id');

        return view('admin.orders.form', compact('order', 'deliveryman'));
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request->all(), $id);

        return redirect()->route('admin.orders.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.orders.index');
    }

    public function view($id)
    {
        $order = $this->repository->find($id);
        $items = $this->orderItemRepository->with('product')->findWhere(['order_id' => $id]);

        return view('admin.orders.view', compact('order', 'items'));
    }
}
