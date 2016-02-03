<?php

namespace CodeDelivery\Transformers;

use CodeDelivery\Models\Cupom;
use League\Fractal\TransformerAbstract;

/**
 * Class CupomTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class CupomTransformer extends TransformerAbstract
{

    /**
     * Transform the \Cupom entity
     * @param \Cupom $model
     *
     * @return array
     */
    public function transform(Cupom $model)
    {
        return [
            'id' => (int)$model->id,
            'code' => $model->code,
            'value' => (float)$model->value
        ];
    }
}
