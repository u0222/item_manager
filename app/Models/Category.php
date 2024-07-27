<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // created_at, updated_atの自動挿入を無効化
    public $timestamps = false;

    // INSERT,UPDATEで許可するカラムを指定
    protected $fillable = [
        "name"
    ];

    public function items(){
        return $this->hasMany(Item::class);
    }
}
