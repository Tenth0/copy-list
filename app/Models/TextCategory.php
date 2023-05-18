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
        'category_id_1',
        'category_id_2',
        'category_id_3'
    ];
}
