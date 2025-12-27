<?php

namespace App\Models;

// --- HAI DÒNG NÀY RẤT QUAN TRỌNG (ĐỪNG XÓA) ---
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'shop_phone', 
        'shop_address', 
        'shop_email', 
        'shop_website', 
        'social_facebook',
        'social_twitter'
    ];
}