<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Http\Requests;
use Validator, Session, Input;

class AboutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::orderBy('id');
        return view (about.index)->with('abouts', $abouts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(abouts.create);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validate = Validator::make($request->all(), About::valid());
      if($validate->fails()) {
        return back()->withErrors($validate)->withInput();
      } else {
        try {
          $add = new About();
          $add->title = $request['title'];
          $add->content = $request['content'];
          $add->save();

          Session::flash('notice', 'Add about Success');
          return redirect('abouts');
        } catch(\Exception $e) {
          dd($e);
        }
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $abouts = About::find($id);
        return view ('abouts.show')->with('abouts', $abouts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $abouts = About::find($id);
        return view('abouts.edit')->with('abouts', $abouts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), About::valid());
        if($validate) {
          return back()->withErrors($validate)->withInput();
        } else {
          $update = About::where('id', $id)->first();
          $update->title = $request['title'];
          $update->content = $request['content'];
          $update->update();
          Session::Flash('notice', 'Update Success');
          return redirect('abouts');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = About::find($id);
        if ($about->delete()) {
          Session::flash('notice', 'Delete Success');
          return redirect('abouts');
        } else {
          Session::flash('notice', 'Delete Failed');
          return redirect('abouts');
        }
    }
}
