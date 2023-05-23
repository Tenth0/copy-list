<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Text extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'category_id',
        'text_content'
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
    public function getLastInsertId(int $user_id) {
        return $this->query()
        ->select('id')
        ->where('user_id',$user_id)
        ->latest('id')
        ->first();
    }
}
