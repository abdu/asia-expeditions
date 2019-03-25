<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Province;
use App\Tour;
use App\Supplier;
use App\User;
use App\Film;
class AdminController extends Controller
{
    //''
    public function searchData(Request $req){
    	$data = [];
        $hotel = [];
        if ($req->action == 'province') {
            foreach (Province::where('country_id', $req->dataId)->orderBy('province_name', 'ASC')->get() as $key => $pro) {
                $data[] = [
                    'id' => $pro->id,
                    'title' => $pro->province_name
                ];
            }
            foreach (Supplier::where(['business_id'=>1, 'country_id'=> $req->dataId])->orderBy('supplier_name', 'ASC')->get() as $key => $h) {
                $hotel[] = [
                    'id' => $h->id,
                    'name' => $h->supplier_name
                ];
            }
            return response()->json(['data'=>$data, 'hotel'=>$hotel, 'status'=>'yes']);
        }
    }

    public function checkHotel (Request $req){
        if ($req->type == 'hotel') {
            \DB::table('program_tour_suppliers')
                ->where(['program_tour_id'=>$req->tour_id, 
                        'suppliers_id'=> $req->data_id])->delete();
        } else if($req->type == 'category'){
            \DB::table('category_program_tour')
                ->where(['program_tour_id'=>$req->tour_id, 
                        'category_id'=> $req->data_id])->delete();
        }       
        return response()->json(['hotel' => 'Delete Successfully']);
    }

    public function getDelete(Request $req, $id){
        if ($req->action == 'tour') {
            $tour = Tour::find($id);
            $tour->tour_status = 0;
            $tour->save();
            $message = ' Delete Successfully';
        } else if ($req->action == 'client') {
            $client = User::find($id);
            $client->banned = 1;
            $client->save();
            $message = ' Deactive Successfully';
        }
        else if ($req->action == 'film') {
            $client = Film::find($id);
            $client->delete();
            $message = ' Delete Successfully';
        }
       
        return back()->with('message', $message);
    }
}
