<?php

namespace CodeDelivery\Http\Controllers;

use CodeDelivery\Http\Requests\AdminProductRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Http\Requests;

class ProductsController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $repository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository,CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $products = $this->repository->paginate();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->lists();

        return view('admin.products.form', compact('categories'));
    }

    public function store(AdminProductRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.products.index');
    }

    public function edit($id)
    {
        $product = $this->repository->find($id);
        $categories = $this->categoryRepository->lists();

        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(AdminProductRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

        return redirect()->route('admin.products.index');
    }

    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.products.index');
    }
}
