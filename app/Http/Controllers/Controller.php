<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Zizaco\Entrust\EntrustFacade as Entrust;
use Auth;
use View;
use App\Tip;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    
    //作者或则admin才有权，没权直接终止
    public function authorOrAdminPermissioinRequire($author_id)
    {    
         if (! Entrust::can('manage_topics') && $author_id != Auth::id()) {
            dd('您没有这个权限');
        }
    }

    protected function setupLayout()
    {
        View::share('siteStat', app('App\good\Stat\Stat')->getSiteStat());
        View::share('siteTip', Tip::getRandTip());
    }
}
