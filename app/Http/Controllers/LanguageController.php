<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LanguageController extends Controller
{
    public function switchLang(Request $request, $route_name,$lang)
    
    {
        $nextLang=($lang==='es')?'en':'es';
        
        if(Lang::has('routes.' . $route_name, $nextLang)){
            return redirect()->to($nextLang.'/' .  trans('routes.' . $route_name, [], $nextLang));
        }
        $previous_url = url()->previous();
        $previous_request = app('request')->create($previous_url);
        $segments = $previous_request->segments();
        if($segments[0]==='es'){
            $segments[0]='en';
        }
        else{
            array_unshift($segments, "es");
        }

        return redirect()->to(implode('/', $segments));
        
    }
    
}