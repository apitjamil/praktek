<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Validator, Session, Input;
use App\Http\Requests;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = services::orderBy('id');
        return view (services.index)->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view (services.idex);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), Service::valid());
        if($valdate->fails()) {
          return back()->withErrors($validate)->withInput();
        } else {
          try {
            $add = new Service();
            $add->title = $request['title'];
            $add->content = $request['content'];
            $add->save();

            Session::flash('notice', 'Add service Success');
            return redirect('services');
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
      $services = About::find($id);
      return view ('services.show')->with('services', $services);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $services = About::find($id);
      return view('services.edit')->with('services', $services);
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
        $update = Service::where('id', $id)->first();
        $update->title = $request['title'];
        $update->content = $request['content'];
        $update->update();
        Session::Flash('notice', 'Update Success');
        return redirect('services');
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
        $services = Service::find($id);
        if ($service->delete()) {
          Session::flash('notice', 'Delete Success');
          return redirect('services');
        } else {
          Session::flash('notice', 'Delete Failed');
          return redirect('services');
        }
    }
}
