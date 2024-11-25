<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function AllType(){
        $types = PropertyType::latest()->get();

        return view("backend.type.all_type",compact('types'));
    }
    
    public function AddType(Request $request){
     
        return view('backend.type.add_type');
    }

     public function storeType(Request $request){

          $request->validate([
            'type_name'=> 'required|unique:property_types|max:200',
            'type_icon' => 'required',
        ]);

        PropertyType::create($request->all());
        // PropertyType::insert([
        //     'type_name'=> $request->type_name,
        //     'type_icon '=> $request->type_icon,
        // ]);

        $notification = array(
            'message' => 'Property Type Creted Successfully',
            'alert-type'=> 'success'
        );

        return redirect()->route('all.type')->with($notification);
    }
    public function EditType($id){

        $type = PropertyType::find($id);
        return view('backend.type.edit_type',compact('type'));
    }

    public function updateType(Request $request){
        $pid = $request->id;

        PropertyType::findOrFail($pid)->update([
            'amenities_name'=> $request->type_name,
        ]);
        // dd($request->all());

        $notification = array(
            'message'=> 'Property Type Creted Successfully',
            'alert-type'=> 'success'
            );
            return redirect()->route('all.type')->with($notification);
    }

    public function DeleteType($id){

        PropertyType::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Property Type Delete Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    // ''''''''''''''''''''''''''  ALL AMENITIES FUNCTIONS '''''''''''''''''''''''''''''''''''''//

    public function AllAmenities(){
        $amenities = Amenities::latest()->get();

        return view("backend.amenities.all_amenities",compact('amenities'));
    }
    
    public function AddAmenities(Request $request){
     
        return view('backend.amenities.add_amenities');
    }

     public function storeAmenities(Request $request){

          $request->validate([
            'amenities_name'=> 'required',
        ]);

        Amenities::create($request->all());
        // Amenities::insert([
        //     'type_name'=> $request->type_name,
        //     'type_icon '=> $request->type_icon,
        // ]);

        $notification = array(
            'message' => 'Property Amenities Creted Successfully',
            'alert-type'=> 'success'
        );

        return redirect()->route('all.amenities')->with($notification);
    }
    public function EditAmenities($id){

        $amenities = Amenities::find($id);
        return view('backend.amenities.edit_amenities',compact('amenities'));
    }

    public function updateAmenities(Request $request){
        $pid = $request->id;

        Amenities::findOrFail($pid)->update([
            'amenities_name'=> $request->amenities_name,
        
        ]);
        // dd($request->all());

        $notification = array(
            'message'=> 'Property Amenities Creted Successfully',
            'alert-type'=> 'success'
            );
            return redirect()->route('all.amenities')->with($notification);
    }

    public function DeleteAmenities($id){

        Amenities::findOrFail($id)->delete();
        $notification = array(
            'message'=> 'Property Amenities Delelete Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

}
