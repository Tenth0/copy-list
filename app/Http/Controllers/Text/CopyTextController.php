<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTextRequest;
use App\Models\Category;
use App\Models\Text;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CopyTextController extends Controller
{
    public function list(): View
    {
        $user_id = auth()->user()->id;
        $allText = getAllText($user_id);
        return view('Home',[
            'items' => $this->ItemService->list(),
            'categories' => $this->CategoryService->list(),
        ]);
    }

    public function insertText(CreateTextRequest $request)
    {
        $user_id = auth()->user()->id;

        $category_id_first = isset($request['category_name_first']) ? $this->getCategoryId($request['category_name_first']) : 0;
        $category_id_second = isset($request['category_name_second']) ? $this->getCategoryId($request['category_name_second']) : 0;
        $category_id_third = isset($request['category_name_third']) ? $this->getCategoryId($request['category_name_third']) : 0;
        $categoryIds = [
           'category_id_first' => $category_id_first,
           'category_id_second' => $category_id_second,
           'category_id_third' => $category_id_third 
        ];

        $textData = [
            'user_id' => $user_id,
            'text_content' => $request['text_content'],
        ];
        
        $this->saveText($textData);
        $this->saveCategory($categoryIds);

        return redirect('home');
    }

    private function getCategoryId(int $category): Collection {
        return Category::select('id')->where($category)->get();
    }

    private function saveText(array $textData): void {
        Text::create($textData);
    }

    private function saveCategory(array $categoryData): void {
        Text::create($categoryData);
    }

    private function getAllText(int $user_id) {
        Text::select('text_content')
            ->where('user_id',$user_id)
            ->join()
            ->get();
    }

    /*
    public function router(): Response
    {
        return Inertia::render('Index',[
            'items' => $this->ItemService->list(),
            'categories' => $this->CategoryService->list(),
        ]);
    }



    public function searchList(Request $request)
    {
        $items = $this->ItemService->searchList($request);
        
        return $items;
    }
    
    public function insertItem(ItemRequest $request)
    {
        $Item = $this->ItemService->insertItem($request); // 配列を create メソッドの引数として渡す
        return $Item;
    }
    

    public function insertItemForm()
    {
        return Inertia::render('InsertItem',[
            'categories' => $this->CategoryService->list(),
        ]);
    }

    public function store(Request $request)
    {
        $this->ItemService->insertItem($request);
        return redirect()->route('insertItemForm')->with("create_success", __("Create success"));
    }
    
    public function update(UpdateItemRequest $request)
    {
        $this->ItemService->updateItem($request);
        return redirect()->route('itemList')->with("create_success", __("Create success"));
    }

    public function deleteItem(Request $request)
    {
        $id = $request->input('id');
        if (!$this->ItemService->deleteItem($id)) {
            return redirect()->route('itemList')->with("record_not_exist", __("Record not exist"));
        }
        return redirect()->route('itemList')->with("create_success", __("Create success"));
    }

    public function changeIsFavorite(Request $request)
    {
        $item = $this->ItemService->changeIsFavorite($request);
        return $item;
    }
    */
}
