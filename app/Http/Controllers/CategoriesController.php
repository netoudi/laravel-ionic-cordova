<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Http\Requests;

class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = $this->repository->paginate();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.form');
    }

    public function store(AdminCategoryRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.categories.index');
    }

    public function edit($id)
    {
        $category = $this->repository->find($id);

        return view('admin.categories.form', compact('category'));
    }

    public function update(AdminCategoryRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

        return redirect()->route('admin.categories.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.categories.index');
    }
}
