<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    /**
     * construct to inject Category Services
     * @param CategoryService $categoryservices
     */
    protected $categoryservices;
    public function __construct(CategoryService $categoryservices)
    {
        $this->categoryservices = $categoryservices;
    }

    //========================================================================================================================
    /**
     * method to view all category
     * @return /Illuminate\Http\JsonResponse
     */
    public function index()
    {  
        return $this->categoryservices->getAllCategories();
    }

    //========================================================================================================================
    /**
     * method to store a new category
     * @param  StoreCategoryRequest $request
     * @return /Illuminate\Http\JsonResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = $request->validated();
        return $this->categoryservices->createCategory($category);
    }

    //========================================================================================================================
    /**
     * method to show category alraedy exist
     * @param  Category $category
     * @return /Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        return $this->categoryservices->showCategory($category);
    }

    //========================================================================================================================
    /**
     * method to update category alraedy exist
     * @param  UpdateCategoryRequest $request
     * @param  Category $category
     * @return /Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryRequest $request,Category $category)
    {
        return $this->categoryservices->updateCategory($request->validated(),$category);
    }

    //========================================================================================================================
    /**
     * method to destroy category alraedy exist
     * @param  Category $category
     * @return /Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        return $this->categoryservices->deleteCategory($category);
    }
}
