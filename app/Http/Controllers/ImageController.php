<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;
use Illuminate\Validation\validate;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $Images  = Images::all();
       // dd($Images);
        return view('images.index' ,compact('Images'));
        $Images = Images::paginate(2);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'image_upload' => 'required',
    ]);
        $data = new Images;
        if ($request->hasfile('image_upload')) {
           $file = $request->file('image_upload');
           $extension = $file->getClientOriginalExtension();
           $filename = time().'.'.$extension;
           $file->move('uploads/images/',$filename);
           $data->image_upload = $filename;
        }
        $data->save();
        return redirect('images')->with('status','image added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Images  = Images::find($id);
        $Images->delete();
        return redirect('images');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $Images  = Images::find($id);

        return view('images.edit' ,compact('Images'));


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
       $Images  = Images::find($id);
        if ($Images->image_upload === $request->file('image_upload')) {
            Images::where('id',$id)->update(['image_upload'=>$request->image_upload]);
        return view('images.index' ,compact('Images'));

        }else{
            if ($request->file('image_upload')) {
               $file = $request->file('image_upload');
               $extension = $file->getClientOriginalExtension();
               $filename = time().'.'.$extension;
               $file->move('uploads/images/',$filename);
                Images::where('id',$id)->update(['image_upload'=>$filename]);
            }

        }
        return redirect('images' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Images  = Images::find($id);
        $Images->delete();
        return redirect('images');

    }

    public function datefilter(Request $request){
         
         $validated = $request->validate([
            'from_date'=>'required',
            'to_date'=>'required',

         ]);
        $Images = Images::whereBetween('created_at', [$request->from_date, $request->to_date])->get();
        return view('images.index',compact('Images'));
    }
}
