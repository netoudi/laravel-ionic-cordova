<?php

namespace CodeDelivery\Repositories;

use CodeDelivery\Models\Client;
use CodeDelivery\Models\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ClientRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Client::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $data)
    {
        $user = User::create($data['user']);

        $user->client()->save(new Client($data));
    }

    public function presenter()
    {
        return \CodeDelivery\Presenters\ClientPresenter::class;
    }
}
