<?php

namespace App\Http\Controllers;

use App\Models\UserCategory;
use App\Models\Text;
use App\Models\TextCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class HomeController extends Controller
{
    private UserCategory $userCategoryModel;
    private Text $textModel;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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

    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        $userId = (int) auth()->id();
        $texts = $this->textModel->getUserTextData($userId);
        $category = $this->userCategoryModel->getUserCategory($userId);
        return view(
            'home',
            [
                'categories' => $category,
                'texts' => $texts,
            ]
        );
    }
}
