<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tour;
use Intervention\Image\ImageManagerStatic as Image;
use App\SlideShow;

use Illuminate\Support\Facades\Storage;


class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $conId = isset($req->loc) ? $req->loc : \Auth::user()->country_id;
        $tours = Tour::where(['tour_status'=> 1, 'web'=>1, 'post_type'=>0, 'country_id'=> $conId])->orderBy('tour_name','ASC')->get();
        return view('admin.tours.tourList', compact('tours', 'conId'));
    }

    public function ourNewsList(Request $req){
        $conId = isset($req->loc) ? $req->loc : \Auth::user()->country_id;
        $tours = Tour::where(['tour_status'=> 1, 'web'=>1, 'post_type'=>1, 'country_id'=> $conId])->orderBy('tour_name','ASC')->get();
        return view("admin.ourNews.our_news_list", compact('tours', 'conId'));
    }

    public function ourNewsForm(Request $req){
        $tour  = Tour::find($req->eid);
        $conId = isset($tour->country_id) ? $tour->country_id : \Auth::user()->country_id;
        $proId = isset($tour->province_id) ? $tour->province_id : \Auth::user()->province_id;
        return view('admin.ourNews.our_news_form', compact('tour', 'proId', 'conId'));
    }

    public function ourNewsCreate( Request $req){
        $gallery = '';
        if ($req->gallery) {
            foreach ($req->gallery as $key => $img) {
                $gallery .= $img."|";
            }
        }
        if (isset($req->eid) && !empty($req->eid)) {
            $aTour = Tour::find($req->eid);
            $message = 'Our News Successfully Updated';
        }else{
            $aTour = new Tour;    
            $message = 'Our News  Successfully Added';
        }
        $aTour->tour_name = $req->title;
        $aTour->slug = str_slug($req->title,'-');
        $aTour->country_id = $req->country;
        $aTour->province_id = $req->province;
        $aTour->web = 1;
        $aTour->post_type = 1;
        $aTour->user_id = \Auth::user()->id;
        $aTour->tour_desc = $req->tour_desc;
        $aTour->tour_photo = $req->image;
        $aTour->tour_picture = $gallery;
        if($aTour->save()){
            return redirect()->route("ourNewsList")->with(['message'=> $message]);
        }
    }

    public function slideList(Request $req){
        $slides = SlideShow::where('status', 1)->orderBy('order', 'ASC')->get();
        return view('admin.slide_show.slide_list', compact('slides'));
    }

    public function SlideForm(Request $req){
        $slide = SlideShow::find($req->eid);
        $conId = isset($slide->country_id) ? $slide->country_id : \Auth::user()->country_id;
        $proId = isset($slide->province_id) ? $slide->province_id : \Auth::user()->province_id;
        return view('admin.slide_show.slide_form', compact('slide', 'conId', 'proId'));
    
    }

    public function createSlide(Request $req){
        if (isset($req->eid) && !empty($req->eid)) {
            $addSlide = SlideShow::find($req->eid);
            $message = 'Slide  Successfully Updated';
        }else{
            $addSlide = New SlideShow;
            $message = 'Slide Successfully Added';
        } 
        $addSlide->title = $req->title;
        $addSlide->photo = $req->image;
        $addSlide->country_id = $req->country;
        $addSlide->province_id = $req->province;
        $addSlide->intro = $req->tour_desc;
        $addSlide->order = $req->order;
        if($addSlide->save()){
            return redirect()->route("slideList")->with(['message'=> $message]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tours.tourForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {   
        try{
            $galleries = '';
            $photo ='';
            if($req->hasFile('gallery')){
                foreach ($req->gallery as $key => $tmpGallary) {
                    $gallery = time().'-'.$tmpGallary->getClientOriginalName();
                    $gimg = Image::make($tmpGallary->getRealPath())->fit(310, 200);
                    $gimg->save(public_path('photos/shares/thumbs/'.$gallery));
                    $tmpGallary->move(public_path('photos/shares/'), $gallery);
                    $galleries .= $gallery.'|';
                }
            }
            if ( $req->hasFile('image') ) {
                $image = $req->file('image');
                $photo = time().'-'.$image->getClientOriginalName();
                $img = Image::make($image->getRealPath())->fit(310, 200);
                $img->save(public_path('photos/shares/thumbs/'.$photo));
                $image->move(public_path('photos/shares/'), $photo);   
            } 
            $aTour = new Tour;
            $aTour->tour_name = $req->title;
            $aTour->tour_slug = str_slug($req->title,'-');
            $aTour->tour_country = $req->country;
            $aTour->tour_province = $req->province;
            $aTour->tour_dest = $req->destination;
            $aTour->web =1;
            $aTour->user_id = \Auth::user()->id;
            $aTour->tour_daynight = $req->daynight;
            $aTour->tour_price = $req->price;
            $aTour->tour_remark = $req->include;
            $aTour->tour_intro = $req->hightlight;
            $aTour->tour_desc = $req->desc;
            $aTour->tour_photo = $galleries;
            $aTour->tour_picture = $photo;
            $aTour->save();
            if ($req->hotel) {
                $aTour->supplier()->sync($req->hotel, false);                
            }
            if ($req->cat) {
                $aTour->category()->sync($req->cat, false);                
            }
            return back()->with('message', 'Published Successfully');
        }catch(Exception $ex ){
            return back()->with('message', 'Look like something went wrong, Please check and try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tour_id
     * @return \Illuminate\Http\Response
     */
    public function show($tour_id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $tour_id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($tour_id)
    {        
        $tour = Tour::find($tour_id);   
        // $proTour = \DB::table('program_tour_suppliers')->where(['program_tour_id'=>$tour->tour_id])->get();
        // $catTour = \DB::table('category_program_tour')->where(['program_tour_id'=>$tour->tour_id])->get();
        // $data = '';
        // $catdata ='';
        // foreach ($catTour as $key => $val) {
        //     $catdata .= $val->category_id.',';
        // }
        // if ($proTour) {
        //     foreach ($proTour as $key => $val) {
        //         $data .= $val->suppliers_id.',';
        //     }
        // }
        return view('admin.tours.tourFormedit', compact('tour', 'data', 'catdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $tour_id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $tour_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tour_id)
    {
        //
    }
}
