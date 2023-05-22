<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TextCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'text_categories';
    protected $fillable = [
        'id',
        'category_id_first',
        'category_id_second',
        'category_id_third'
    ];

    public function saveCategory(array $categoryIds): void {
        $this->create($categoryIds);
    }
}
