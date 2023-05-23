<?php

namespace App\Http\Controllers\Text;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTextRequest;
use App\Models\UserCategory;
use App\Models\Text;
use App\Models\TextCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CopyTextController extends Controller
{
    private $userCategoryModel;
    private $textModel;
    private $textCategoryModel;

    public function __construct(
        UserCategory $userCategoryModel,
        Text $textModel,
        TextCategory $textCategoryModel,
    )
    {
        $this->userCategoryModel = $userCategoryModel;
        $this->textModel = $textModel;
        $this->textCategoryModel = $textCategoryModel;
        $this->middleware('auth');
    }

    public function insertText(CreateTextRequest $request)//: RedirectResponse
    {
        $userId = (int) auth()->id();
        $textData = [
            'user_id' => $userId,
            'text_content' => $request['text_content'],
        ];
        
        $this->textModel->saveText($textData);

        $textId = $this->textModel->getLastInsertId($userId)->id;
        $categoryIdFirst = isset($request['category_name_first'])   ? $this->userCategoryModel->getCategoryId($request['category_name_first']) : null;
        $categoryIdSecond = isset($request['category_name_second']) ? $this->userCategoryModel->getCategoryId($request['category_name_second']) : null;
        $categoryIdThird = isset($request['category_name_third'])   ? $this->userCategoryModel->getCategoryId($request['category_name_third']) : null;
        $textCategoryData = [
            'text_id' => $textId,
            'category_id_first' => $categoryIdFirst,
            'category_id_second' => $categoryIdSecond,
           'category_id_third' => $categoryIdThird 
        ];        
        $this->textCategoryModel->saveCategory($textCategoryData);
        return redirect()->route('home')->with('insert-success', '追加が完了しました');
    }

}
