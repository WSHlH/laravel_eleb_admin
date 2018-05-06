<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $guarded=[];

    static public function menus()
    {
        $first = DB::table('menus')->where('parent_id',0)->get();
//        dd($first);die;
        $html = '';
        foreach($first as $item){
            $children_html='';
            $second= DB::table('menus')->where('parent_id',$item->id)->get();
            foreach($second as $value){
                if (Auth::user()->can($value->url))
                    $children_html .= '<li><a href="'.route($value->url).'">'.$value->name.'</a></li><li role="separator" class="divider"></li>';
            }
            if ($children_html ==''){
                continue;
            }
            $html .= '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$item->name.'<span class="caret"></span></a><ul class="dropdown-menu">';
            $html .= $children_html;
            $html .= '</ul></li>';
        }
        return $html;
    }
}
