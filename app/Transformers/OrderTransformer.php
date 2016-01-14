<?php

namespace CodeDelivery\Transformers;

use CodeDelivery\Models\Order;
use CodeDelivery\Models\User;
use League\Fractal\TransformerAbstract;

/**
 * Class OrderTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['client', 'items', 'cupom', 'deliveryman'];

    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id' => (int)$model->id,
            'total' => (float)$model->total,
            'status' => (int)$model->status,
            'created' => $model->created_at
        ];
    }

    public function includeClient(Order $model)
    {
        return $this->item($model->client, new ClientTransformer());
    }

    public function includeItems(Order $model)
    {
        return $this->collection($model->items, new OrderItemTransformer());
    }

    public function includeCupom(Order $model)
    {
        if (!$model->cupom) {
            return null;
        }

        return $this->item($model->cupom, new CupomTransformer());
    }

    public function includeDeliveryman(Order $model)
    {
        if (!$model->deliveryman) {
            return null;
        }

        return $this->item($model->deliveryman, new DeliverymanTransformer());
    }
}
