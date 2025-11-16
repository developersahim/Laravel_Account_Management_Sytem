<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','amount','date','payer','description'];
    protected $casts = ['date' => 'date'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

