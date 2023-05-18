<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'users_categories';
    protected $fillable = [
        'id',
        'category_name',
        'user_id'
    ];
}
