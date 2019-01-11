<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class NewsController extends Controller
{


    public function show($id)
        {
            $single = \App\News::find($id);
            return view('show', compact('single'));
        }


    public function create()
        {
          if(Auth::user()->admin == 0) {
            return redirect('/news');
          }else{
            $news = \App\News::distinct()->get(['category']);
            return view('form', compact('news'));
          }
          $news = \App\News::all();
          return view('news', compact('news'));
        }

    public function store(Request $request)
        {
        if($request->hasFile('file')){
          $filename = $request->file->getClientOriginalName();
          $request->file->storeAs('public/upload/', $filename);

          if($request->get('category')==null && $request->get('categorys')==null){
            $request->validate([
              'categorys'=>'required',
              'category'=>'required',
              'title'=>'required',
              'content'=> 'required',
              'author' => 'required',
              // 'image' => 'required'
            ]);
            $share = new \App\News([
              'title' => $request->get('title'),
              'content'=> $request->get('content'),
              'author'=> $request->get('author'),
              'category'=> $request->get('category'),
              'category' => $request->get('categorys'),
              'image' => $filename
            ]);
          }else if($request->get('category')!=null && $request->get('categorys')==null){
            $request->validate([
                   'title'=>'required',
                   'content'=> 'required',
                   'author' => 'required',
                   // 'image' => 'required'
                 ]);
                 $share = new \App\News([
                   'title' => $request->get('title'),
                   'content'=> $request->get('content'),
                   'author'=> $request->get('author'),
                   'category'=> $request->get('category'),
                   'image' => $filename
                 ]);
          }else if($request->get('category')==null && $request->get('categorys')!=null){
            $request->validate([
                   'title'=>'required',
                   'content'=> 'required',
                   'author' => 'required',
                   // 'image' => 'required'
                 ]);
                 $share = new \App\News([
                   'title' => $request->get('title'),
                   'content'=> $request->get('content'),
                   'author'=> $request->get('author'),
                   'category'=> $request->get('categorys'),
                   'image' => $filename
                 ]);
          }
          $share->save();
        }


          return redirect('/news')->with('success', 'Stock has been added');
        }

    public function index()
        {
          $news = \App\News::all();

          return view('index', compact('news'));
        }

    public function edit($id)
        {
          $news = \App\News::find($id);

          return view('edit', compact('news'));
        }

    public function update(Request $request, $id)
        {
              $request->validate([
                'title'=>'required',
                'content'=> 'required'
              ]);

              $share = \App\News::find($id);
              $share->title = $request->get('title');
              $share->content = $request->get('content');
              $share->save();

              return redirect('/news')->with('success', 'Stock has been updated');
        }

    public function destroy($id)
        {
             $news = \App\News::find($id);
             $news->delete();

             return redirect('/news')->with('success', 'Stock has been deleted Successfully');
        }

    public function search(Request $request){
      if(Auth::user()->admin == 0) {
      $term = $request->input('search');
      $news = \App\News::where('title', 'LIKE', '%' . $term . '%')->orderBy('created_at', 'desc')->paginate(5);
      $category = \App\News::distinct()->get(['category']);
      return view('/news', compact('news'), compact('category'));
    }else{
      $term = $request->input('search');
      $news = \App\News::where('title', 'LIKE', '%' . $term . '%')->orderBy('created_at', 'desc')->paginate(5);
      $category = \App\News::distinct()->get(['category']);
      return view('adminNews', compact('news'), compact('category'));
    }
    }

    public function sort(Request $request){
      if(Auth::user()->admin == 0) {
        $sort = $request->input('sort');
        $term = $request->input('search');
        $searchSorted = (new \App\News)->newQuery();
        if($request->has('sort')){

          $searchSorted->where('category', $sort)->where('title', 'LIKE', '%' . $term . '%');
        }
        if($request->has('search')){
          $searchSorted->where('title', 'LIKE', '%' . $term . '%');

        }
        //$single = \App\News::find($id);
        $news = $searchSorted->orderBy('created_at', 'desc')->paginate(5);
        // $news = \App\News::where('category', $sort)->where('title', 'LIKE', '%' . $term . '%')->orderBy('created_at', 'desc')->paginate(5);
        $category = \App\News::distinct()->get(['category']);
        return view('/category.index', compact('news'), compact('category'), compact('sort'));
      }else{
        $sort = $request->input('sort');
        $term = $request->input('search');
        $searchSorted = (new \App\News)->newQuery();
        if($request->has('sort')){

          $searchSorted->where('category', $sort)->where('title', 'LIKE', '%' . $term . '%');
        }
        if($request->has('search')){
          $searchSorted->where('title', 'LIKE', '%' . $term . '%');

        }
        //$single = \App\News::find($id);
        $news = $searchSorted->orderBy('created_at', 'desc')->paginate(2);
        // $news = \App\News::where('category', $sort)->where('title', 'LIKE', '%' . $term . '%')->orderBy('created_at', 'desc')->paginate(5);
        $category = \App\News::distinct()->get(['category']);
        return view('/adminNews', compact('news'), compact('category'), compact('sort'));
      }
    }
    // public function searchSorted(Request $request){
    //   $sort = $request->get('sort');
    //   $term = $request->get('search');
    //   $url = $request->url();
    //   $news = \App\News::where('category', $sort)->where('title', 'LIKE', '%' . $term . '%')->orderBy('created_at', 'desc')->paginate(5);
    //   $category = \App\News::distinct()->get(['category']);
    //   return view('/category.index', compact('news'), compact('category'));
    // }
}
