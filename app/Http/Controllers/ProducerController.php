<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Producer;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index()
    {
        $this->AuthLogin();
        $producer = Producer::Paginate(5);

        return view('admin.Producer.show_producer', compact('producer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $producer = new Producer();
        $producer->Ten= $data['Ten'];
        $producer->Email= $data['Email'];
        $producer->DiaChi= $data['DiaChi'];
        $producer->SDT= $data['SDT'];
        $producer->save();

        return redirect()->route('producer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producer = Producer::find($id);

        return view('admin.Producer.update_producer', compact('producer'));

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
        $data = $request->all();

        $producer = Producer::find($id);
        $producer->Ten= $data['Ten'];
        $producer->Email= $data['Email'];
        $producer->DiaChi= $data['DiaChi'];
        $producer->SDT= $data['SDT'];
        $producer->save();

        return redirect()->route('producer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
