<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomStyleController extends Controller
{
	public function addStyle()
    {
      $css_get = @file_get_contents('css/custom-style.css');
      $js_get  = @file_get_contents('js/custom-js.js');
      return view('admin.customstyle.add',compact('css_get','js_get'));
    }
    
    public function storeCSS(Request $request)
    {
        $this->validate($request,array(
          'css' => 'required'
        ));
        $css = $request->css;
        file_put_contents("css/custom-style.css",$css.PHP_EOL);
        return redirect()->route('customstyle')->with('added','Özel CSS Eklendi!');
    }

    public function storeJS(Request $request)
    {
      $this->validate($request,array(
        'js' => 'required'
      ));

      $js = $request->js;
      file_put_contents("js/custom-js.js",$js.PHP_EOL);
      return redirect()->route('customstyle')->with('added','Özel Javascript Eklendi !');
    }

 
}
