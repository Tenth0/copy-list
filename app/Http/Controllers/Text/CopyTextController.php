<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTextRequest;
use App\Models\Category;
use App\Models\Text;
use App\Models\TextCategory;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CopyTextController extends Controller
{
    private $categoryModel;
    private $textModel;
    private $textCategoryModel;

    public function __construct(
        Category $categoryModel,
        Text $textModel,
        TextCategory $textCategoryModel
    )
    {
        $this->categoryModel = $categoryModel;
        $this->textModel = $textModel;
        $this->textCategoryModel = $textCategoryModel;
    }

    public function insertText(CreateTextRequest $request)
    {
        $user_id = auth()->user()->id;

        $category_id_first = isset($request['category_name_first']) ? $this->categoryModel->getCategoryId($request['category_name_first']) : null;
        $category_id_second = isset($request['category_name_second']) ? $this->categoryModel->getCategoryId($request['category_name_second']) : null;
        $category_id_third = isset($request['category_name_third']) ? $this->categoryModel->getCategoryId($request['category_name_third']) : null;
        $categoryIds = [
           'category_id_first' => $category_id_first,
           'category_id_second' => $category_id_second,
           'category_id_third' => $category_id_third 
        ];

        $textData = [
            'user_id' => $user_id,
            'text_content' => $request['text_content'],
        ];
        
        $this->textModel->saveText($textData);
        $this->textCategoryModel->saveCategory($categoryIds);

        return redirect()->route('home')->with('insert-success', '追加が完了しました');
    }

}
