<?php

namespace App\Helpers;

use App\Models\Menu;

/**
 *
 */
class MenuHelper
{

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function engMenudropdown()
    {
        $menuData = $this->menu->all();

        // Handle undefined JSON keys
        $menuList = $menuData->mapWithKeys(function ($menu) {
            // Check if 'menu_name' and 'en' key exist
            $enValue = isset($menu['menu_name']['en']) ? $menu['menu_name']['en'] : '';
            return [$menu->id => $enValue];
        });
        return $menuList;
    }

    public function menus()
    {
        return $this->menu->orderBy('display_order','asc')->get();
    }
}