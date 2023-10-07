<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::latest()->get();
        return response()->json([
            'success'=>true,
            'message'=>'Category Created Successfully',
            'data'=>$categories
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255',
        ]);

       if($validator->fails()){
        return response()->json([
            'success'=>false,
            'message'=>'error',
            'errors'=>$validator->getMessageBag(),
        ]);
       }
       $fromData = $validator->validated();
       $fromData['slug'] = Str::slug($fromData['name']);
       $category=Category::create($fromData);

       return response()->json([
        'success'=>true,
        'message' => 'Category Created Successfully',
        'data' =>$category
       ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        if($category){
              return response()->json([
             'success'=>true,
             'message'=>'successfully',
             'data'=>$category
          ]);
        }
        return response()->json([
            'success'=>false,
            'message'=>'error',
            'errors'=>'Category Not Found!',
        ],404);
      
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
         if(!$category){
              return response()->json([
             'success'=>false,
             'message'=>'Category Not Found',
             'data'=>[]
          ]);
        }
        
           $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name'.$category->$id,
        ]);

       if($validator->fails()){
        return response()->json([
            'success'=>false,
            'message'=>'error',
            'errors'=>$validator->getMessageBag(),
        ]);
       }
       $fromData = $validator->validated();
       $fromData['slug'] = Str::slug($fromData['name']);
       $category->update($fromData);

       return response()->json([
        'success'=>true,
        'message' => 'Category Update Successfully',
        'data' =>[]
       ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
         if(!$category){
              return response()->json([
             'success'=>false,
             'message'=>'Category Not Found',
             'data'=>[]
          ],404);
        }
        $category->delete();
         return response()->json([
             'success'=>true,
             'message'=>'Category Deleted Successfully',
             'data'=>[]
          ],404);
    }
}
