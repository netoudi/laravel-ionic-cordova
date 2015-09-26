<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminClientRequest;
use CodeDelivery\Http\Requests;
use CodeDelivery\Repositories\ClientRepository;

class ClientsController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $repository;

    /**
     * @param ClientRepository $repository
     */
    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $clients = $this->repository->paginate();

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.form');
    }

    public function store(AdminClientRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.clients.index');
    }

    public function edit($id)
    {
        $client = $this->repository->with('user')->findWhere(['id'=> $id])->first();

        return view('admin.clients.form', compact('client'));
    }

    public function update(AdminClientRequest $request, $id)
    {
        $this->repository->update($request->all(), $id)->user()->update($request->user);

        return redirect()->route('admin.clients.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.clients.index');
    }
}
