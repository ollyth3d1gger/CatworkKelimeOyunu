<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
// use App\SocialIcons;
class PagesController extends Controller
{
    public function index()
    {
      $pages = Page::all();
      return view('admin.pages.index',compact('pages'));
    }

    public function add()
    {
      return view('admin.pages.add');

    }

    public function store(Request $request)
    {


      $newpage = new Page;

      $newpage->name = $request->name;
      $newpage->slug = str_slug($request->name);
      
      if(isset($request->status))
      {
        $newpage->status = "1";
      }else{
        $newpage->status = "0";
      }

      $newpage->details = $request->details;

      $newpage->save();

      return redirect()->route('pages.index')->with('added', 'Page is created !');

    }

    public function edit($id)
    {
      $page = Page::findOrFail($id);
      return view('admin.pages.edit',compact('page'));
    }

    public function show($slug)
    {
        $page = Page::where('slug', '=', $slug)->first();
        // $si = SocialIcons::all();
        return view('admin.pages.show',compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->name = $request->name;
        $page->slug = str_slug($request->name);
        $page->details = $request->details;
        if(isset($request->status)){
        
          $page->status = "1";

        }else{

          $page->status = "0";

        }

        $page->save();

        return redirect()->route('pages.index')->with('updated','Sayfa Güncellendi !');
    }

    public function destroy($id)
    {
      $page = Page::findOrFail($id);
      $page->delete();
      return redirect()->route('pages.index')->with('deleted','Sayfa Silindi!');
    }
}
