<?php

namespace App\Http\Controllers\Text;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTextRequest;
use App\Models\UserCategory;
use App\Models\Text;
use App\Models\TextCategory;
use Illuminate\Contracts\View\View;
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

    public function insertText(CreateTextRequest $request): RedirectResponse
    {
        $userId = (int) auth()->id();
        $textData = [
            'user_id' => $userId,
            'title' => $request['title'],
            'text_content' => $request['text_content'],
        ];
        
        $this->textModel->saveText($textData);

        $textId = $this->textModel->getLastInsertId($userId);
        $categoryIdFirst = isset($request['category_name_first'])   ? $request['category_name_first'] : null;
        $categoryIdSecond = isset($request['category_name_second']) ? $request['category_name_second']  : null;
        $categoryIdThird = isset($request['category_name_third'])   ? $request['category_name_third'] : null;
        $textCategoryData = [
            'text_id' => $textId,
            'category_id_first' => $categoryIdFirst,
            'category_id_second' => $categoryIdSecond,
            'category_id_third' => $categoryIdThird 
        ];
        $this->textCategoryModel->saveCategory($textCategoryData);
        return redirect()->route('home')->with('insert-success', '追加が完了しました');
    }

    public function searchText(Request $request): View
    {
        $userId = (int) auth()->id();
        $searchTitle = $request['title'];
        $searchCategory = $request['category'];
        $texts = $this->textModel->searchText($userId, $searchTitle, $searchCategory);
        $category = $this->userCategoryModel->getUserCategory($userId);
        return view(
            'home',
            [
                'categories' => $category,
                'texts' => $texts,                
            ]
        );
    }

    public function deleteText(Request $request)
    {
        $textId = $request['id'];
        $this->textModel->deleteText($textId);
        return redirect()->route('home')->with('delete-success', '削除が完了しました');
    }
}
