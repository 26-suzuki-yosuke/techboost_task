<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下を追記することでNews Modelが扱えるようになる
use App\Profile;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        // 以下を追記
        // Varidationを行う
        $this->validate($request, Profile::$rules);
        
        $prof = new Profile;
        $form = $request->all();
        
        /*
        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $prof->image_path = basename($path);
        } else {
            $prof->image_path = null;
        }
        */
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        //unset($form['image']);
        
        // データベースに保存する
        $prof->fill($form);
        $prof->save();
        return redirect('admin/profile/create');
    }

    public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $prof = profile::find($request->id);
        if (empty($prof)) {
            abort(404);    
        }
        return view('admin.profile.edit', ['prof_form' => $prof]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, profile::$rules);
          
        // News Modelからデータを取得する
        $prof = profile::find($request->id);
          
        // 送信されてきたフォームデータを格納する
        $prof_form = $request->all();
        if (isset($prof_form['image'])) {
            $path = $request->file('image')->store('public/image');
            $prof->image_path = basename($path);
            unset($prof_form['image']);
        } elseif (isset($request->remove)) {
            $prof->image_path = null;
            unset($prof_form['remove']);
        }
        unset($prof_form['_token']);
          
        // 該当するデータを上書きして保存する
        $prof->fill($prof_form)->save();
      
        return redirect('admin/profile');
    }
    
    // 以下を追記
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = profile::where('name', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = profile::all();
        }
        
        return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $prof = profile::find($request->id);
        // 削除する
        $prof->delete();
        return redirect('admin/profile/');
    }
}
