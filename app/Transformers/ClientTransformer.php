<?php

namespace CodeDelivery\Transformers;

use CodeDelivery\Models\Client;
use League\Fractal\TransformerAbstract;

/**
 * Class ClientTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{

    /**
     * Transform the \Client entity
     * @param \Client $model
     *
     * @return array
     */
    public function transform(Client $model)
    {
        return [
            'id' => (int)$model->id,
            'name' => $model->user->name,
            'email' => $model->user->email,
            'phone' => $model->phone,
            'address' => $model->address,
            'zipcode' => $model->zipcode,
            'city' => $model->city,
            'state' => $model->state
        ];
    }
}
