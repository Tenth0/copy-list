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
            'texts.title',
            'texts.text_content',
            'categories.category_id_first',
            'categories.category_id_second',
            'categories.category_id_third'
        )
        ->where('texts.user_id', $userId)
        ->join('text_categories as categories','texts.id','=','categories.text_id')
        ->orderBy('texts.id')
        ->get();
    }
}
