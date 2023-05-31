<?php

namespace App\Http\Controllers\Text;

use App\Http\Controllers\Controller;
use App\Models\UserCategory;
use App\Models\TextCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    private $userCategoryModel;
    private $textCategoryModel;

    public function __construct(
        UserCategory $userCategoryModel,
        TextCategory $textCategoryModel
    )
    {
        $this->userCategoryModel = $userCategoryModel;
        $this->textCategoryModel = $textCategoryModel;
        $this->middleware('auth');
    }

    public function insertCategory(Request $request): RedirectResponse
    {
        $categoryData = [
            'category_name' => $request['category'],
            'id' => auth()->id()
        ];

        $this->userCategoryModel->saveUserCategory($categoryData);

        return redirect()->route('home')->with('insert-success', '追加が完了しました');
    }

}
