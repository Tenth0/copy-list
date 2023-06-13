<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Text extends Model
{
    use HasFactory ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'category_id',
        'text_content',
        'is_delete'
    ];

    protected $hidden = [];

    public $timestamps = false;

    public $table = 'texts';

    public static function saveText(array $textData): void {
        Text::create($textData);
    }

    // テキストをすべて取得
    public function getAllText(int $user_id): Collection {
        return $this->query()
            ->select('text_content')
            ->where('user_id',$user_id)
            ->join('text_category','user_id',$user_id)
            ->get();
    }

    // 登録するデータのテキストIDを取得
    public function getLastInsertId(int $user_id): int {
        return $this->query()
        ->select('id')
        ->where('user_id',$user_id)
        ->latest('id')
        ->first()
        ->id;
    }

    public function getUserTextData($userId): Collection {
        return $this->query()
        ->select(
            'texts.id',
            'texts.title',
            'texts.text_content',
            'categories.category_id_first',
            'categories.category_id_second',
            'categories.category_id_third'
        )
        ->where('texts.user_id', $userId)
        ->where('texts.is_delete', 0)
        ->join('text_categories as categories','texts.id','=','categories.text_id')
        ->orderBy('texts.id')
        ->get();
    }

    public function searchText($userId, $searchTitle, $searchCategory) {
        $query = $this->query()
        ->select(
            'texts.title',
            'texts.text_content',
            'categories.category_id_first',
            'categories.category_id_second',
            'categories.category_id_third'
        )
        ->where('texts.is_delete', 0)
        ->where('texts.user_id', $userId);

        $this->searchTitle($query, $searchTitle);
        $this->searchCategory($query, $searchCategory);
        $query->join('text_categories as categories','texts.id','=','categories.text_id')
        ->orderBy('texts.id')
        ->get();
        return $query->get();
    }

    function searchTitle($query, $searchTitle) {
        if (isset($searchTitle)) {
            return $query->where('texts.title', 'like', "%$searchTitle%");
        }
    }

    function searchCategory($query, $searchCategory) {
        if (isset($searchCategory)) {
            return $query->where('categories.category_id_first', 'like', "%$searchCategory%")
            ->orWhere('categories.category_id_second', 'like', "%$searchCategory%")
            ->orWhere('categories.category_id_third', 'like', "%$searchCategory%");
        }
    }

    function deleteText($textId) {
        return $this->query()
        ->where('id', $textId)
        ->update(['is_delete' => 1]);
    }
}
