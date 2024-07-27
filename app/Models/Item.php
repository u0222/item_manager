<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // created_atとupdated_atの自動挿入を無効化
    public $timestamps = false;

    // INSERT、UPDATEで許可するカラムを指定
    protected $fillable = [
        "name",
        "price",
        "category_id",
    ];

    public function category(){
        return $this->belongsTO(Category::class);
    }
}
