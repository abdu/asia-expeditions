<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use \App\Country;

class DestinationMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    

    protected $config = ['web' => 1];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        // return view("widgets.destination_menu", [
        //     'config' => $this->config,
        // ]);
        return self::getMenu($this->config);
    }

    public function getMenu($type){
        $menu = '';
        foreach (Country::getDestination(1) as  $con) {
            $menu .='<li><a  href="/destination/'.$con->country_slug.'">'.$con->country_name.'</a></li>';
        }

        $allCoun ='<ul class="dropdown-menu des" role="menu" style="margin-top: -674px;">
                    '.$menu.'    
                    </ul>';
        return $allCoun;
    }
}