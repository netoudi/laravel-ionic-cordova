<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Models\Order;
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
        $result = $this->findWhere(['id' => $orderId, 'user_deliveryman_id' => $deliverymanId]);

        if ($result instanceof Collection) {
            $result = $result->first();
        } else {
            if (isset($result['data']) && count($result['data']) == 1) {
                $result = [
                    'data' => $result['data'][0]
                ];
            } else {
                throw new ModelNotFoundException("Order not found.");
            }
        }

        return $result;
    }

    public function presenter()
    {
        return \CodeDelivery\Presenters\OrderPresenter::class;
    }
}
