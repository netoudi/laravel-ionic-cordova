<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class OrderRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getByIdAndDeliveryman($orderId, $deliverymanId)
    {
        $result = $this->model
            ->where('id', $orderId)
            ->where('user_deliveryman_id', $deliverymanId)
            ->first();

        if ($result) {
            return $this->parserResult($result);
        }

        throw (new ModelNotFoundException())->setModel(get_class($this->model));
    }

    public function presenter()
    {
        return \CodeDelivery\Presenters\OrderPresenter::class;
    }
}
