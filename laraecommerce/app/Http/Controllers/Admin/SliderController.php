<?php

namespace App\Http\Controllers\Admin;
use App\Models\Sliders;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Sliders::all();
        return view('admin.slider.index', compact('sliders'));
    }


    public function create()
    {
        return view('admin.slider.create');
    }


    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'. $ext;
            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = "uploads/slider/$filename";

        }
        $validatedData['status'] = $request->status == true? '1':'0';


        Sliders::create([
            'title'=>$validatedData['title'],
            'description'=>$validatedData['description'],
            'image'=>$validatedData['image'],
            'status'=>$validatedData['status'],
        ]);
        return redirect('admin/sliders')->with('message','slider Added Successfully');
    }



    public function edit(Sliders $slider)
    {
      return view('admin.slider.edit', compact('slider'));                                                                       
    }



    public function update(SliderFormRequest $request, Sliders $slider)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')){

            $destination = $slider->image;
            if(File::exists( $destination)){
                File::delete( $destination);
            }


            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'. $ext;
            $file->move('uploads/slider/', $filename);
            $validatedData['image'] = "uploads/slider/$filename";

        }
        $validatedData['status'] = $request->status == true? '1':'0';


        Sliders::where('id',$slider->id)->update([
            'title'=>$validatedData['title'],
            'description'=>$validatedData['description'],
            'image'=>$validatedData['image'] ?? $slider->image,
            'status'=>$validatedData['status'],
        ]);
        return redirect('admin/sliders')->with('message','slider Updated Successfully');
    }
    public function destroy(Sliders $slider)
    {
        if($slider->count()>0){
        $destination = $slider->image;
        if(File::exists( $destination)){
            File::delete( $destination);
        }
        $slider->delete();
        return redirect('admin/sliders')->with('message','slider deleted successfully');
        }
        return redirect('admin/sliders')->with('message','something went wrong');

    }
}
