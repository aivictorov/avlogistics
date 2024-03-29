<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Page;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.parts.header-nav', 'layouts.parts.header-subnav', 'site.parts.aside-page'], function ($view) {
            $view->with('tree', $this->menu());
        });
    }

    public function menu()
    {
        $res = Page::select('id', 'name', 'parent_id', 'url')->where('menu_show', 1)->orWhere('id', 1)->orderBy('menu_sort')->get()->toArray();

        $dataset = array();

        foreach ($res as $value) {
            $dataset[$value['id']] = $value;
        }

        $tree = array();

        foreach ($dataset as $id => &$node) {

            if ($node['parent_id'] === 0) {
                $tree[$id] = &$node;
            } else {
                $dataset[$node['parent_id']]['children'][$id] = &$node;
            }
        }
    
        return $tree;
    }
}
