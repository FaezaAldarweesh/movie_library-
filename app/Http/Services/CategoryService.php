<?php

namespace App\Http\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResources;
use App\Http\Traits\ApiTrait;
use Illuminate\Support\Facades\Log;

class CategoryService {
    
    use ApiTrait;
    public function getAllCategories(){
        try {
            $category = Category::all();
            //في حال عدم العثور على تصنيفات يرد رسالة خطأ
            if(!$category){
                return $this->customeResponse('not found', 404);
            }
            $allCategory = CategoryResources::collection($category);
            return $this->Response($allCategory, "all categories fetched successfully", 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with fetching categories', 400);
        }
    }

    //========================================================================================================================

    public function createCategory($request){
        try {
            $category = Category::create($request);
            return $this->Response(new CategoryResources($category), "category created successfully", 201);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with creating category', 400);
        }
    }

    //========================================================================================================================

    public function showCategory(Category $category){
        try {
            //في حال عدم العثور على التصنيف يرد رسالة خطأ
            if(!$category){
                return $this->customeResponse('not found', 404);
            }
            return $this->Response(new CategoryResources($category), "view category successfully", 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with view category', 400);
        }
    }

    //========================================================================================================================

    public function updateCategory($request,Category $category){
        try {
            //في حال عدم العثور على تصنيفات يرد رسالة خطأ
            if(!$category){
                return $this->customeResponse('not found', 404);
            }
            $updatecategory = $category;
            $updatecategory->update($request);
            return $this->Response(new CategoryResources($updatecategory), "update category successfully", 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with update category', 400);
        }
    }

    //========================================================================================================================

       public function deleteCategory(Category $category){
        try {
            //في حال عدم العثور على تصنيفات يرد رسالة خطأ
            if(!$category){
                return $this->customeResponse('not found', 404);
            }
            $deletecategory =  $category;
            $deletecategory->delete();
            return $this->Response(null, "delete category successfully", 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->customeResponse('Something went wrong with delete category', 400);
        }
    }
}
