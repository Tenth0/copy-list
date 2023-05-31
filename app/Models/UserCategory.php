<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class UserCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'users_categories';
    protected $fillable = [
        'id',
        'category_name',
        'user_id'
    ];

    public function saveUserCategory(array $userCategoryData): void {
        $this->create($userCategoryData);
    }

    public function getCategoryId(int $category): Collection {
        return $this->select('id')->where('category_name',$category)->get();
    }

    public function getUserCategoryNames(int $userId): Collection {
        return $this->query()
            ->select('category_name')
            ->where('user_id',$userId)
            ->orderBy('id')
            ->get();
    }

}
