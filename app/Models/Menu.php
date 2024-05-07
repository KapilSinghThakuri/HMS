<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'display_order',
        'menu_type_id',
        'parent_id',
        'model_id',
        'page_id',
        'menu_name',
        'external_link',
        'status',
    ];

    protected $casts = [
        'menu_name' => 'json',
    ];

    public function models()
    {
        return $this->hasMany(Module::class,'id', 'model_id');
    }
    public function pages()
    {
        return $this->hasMany(DynamicPage::class, 'id', 'page_id');
    }
    public function child_menus()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
    public function parent_menu()
    {
        return $this->belongsTo(Menu::class, 'id', 'parent_id');
    }
}
