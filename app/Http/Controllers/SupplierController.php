<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Business;
use App\Supplier;
use App\Company;
use PDF;
use App\Driver;
use Excel;
class SupplierController extends Controller
{ 
    //
    public function supplierList(Request $req){
        $locationid = isset($req->location) ? $req->location: \Auth::user()->country_id;
    	$suppliers  = Supplier::where(['country_id'=>$locationid, 'company_id'=> \Auth::user()->company_id])->orderBy('id','DESC')->get();
    	return view('admin.supplier.supplier', compact('suppliers', 'locationid'));
    }

    public function supplierBusiness(Request $req, $supplierName){
        $locationid = isset($req->location) ? $req->location: \Auth::user()->country_id;
    	$business   = Business::where('slug', $supplierName)->first();
        $suppliers  = Business::find($business->id)->supplier()->where(['country_id'=>$locationid, 'company_id'=> \Auth::user()->company_id])->orderBy('supplier_name', 'ASC')->get();
    	return view("admin.supplier.supplier", compact('suppliers', 'supplierName', 'business', 'locationid'));
    }

    public function getSupplierReport(Request $req, $supId, $type){
        $currentAction = $req->path();
        $supplier      = Supplier::find($supId);
        $essittype     = isset($req->type) ? $req->type : '';
        if ($essittype == 'selling') {
            $priceType = $req->type;
            return view('admin.supplier.supplierReport', compact('supplier', 'type', 'priceType', 'currentAction'));
        }elseif ($essittype == 'contract') {
            $priceType      = $req->type;
            return view('supplier.supplierReport', compact('supplier', 'type', 'priceType', 'currentAction'));
        }else{
            $priceType = "";
            return view('admin.supplier.supplierReport', compact('supplier', 'type' ,'currentAction', 'priceType'));
        }
    }

    public function sortHotelRateReport(Request $req, $supId, $type){
        $currentAction = $req->path();
        $supplier      = Supplier::find($supId);
        $fmonth        = $req->fmonth;
        $tmonth        = $req->tmonth;
        $year          = $req->year;
        if (isset($req->type) == 'selling') {
            $priceType = "selling";
            return view('admin.supplier.supplierReport', compact('supplier', 'type', 'priceType', 'currentAction', 'fmonth','tmonth', 'year'));
        }else{
            $priceType = "";
            return view('admin.supplier.supplierReport', compact('supplier', 'type', 'priceType', 'currentAction', 'fmonth','tmonth', 'year'));
        }
    }

    public function getSupplierForm( Request $req){
        $locationid = isset($req->location)? $req->location: \Auth::user()->country_id;
        $type       = isset($req->type) ? $req->type : '';
        $business   = Business::where('slug', $type)->first();
        return view('admin.supplier.supplierForm', compact('locationid','type','business'));
    }    

    public function createSupplier(Request $req){
        $gallery = '';
        if (isset($req->gallery)) {
            foreach ($req->gallery as $key => $g) {
                $gallery .= $g."|";
            }
        }
        $addsup = New Supplier;
        $addsup->supplier_name         = $req->title;
        $addsup->supplier_contact_name = $req->contact_name;
        $addsup->country_id            = $req->country;
        $addsup->province_id           = $req->city;
        $addsup->user_id               = \Auth::user()->id;
        $addsup->company_id            = \Auth::user()->company_id;
        $addsup->business_id           = $req->business_type;
        $addsup->supplier_phone        = $req->phone_one;
        $addsup->supplier_phone2       = $req->phone_two;
        $addsup->supplier_fax          = $req->fax_number;
        $addsup->supplier_email        = $req->email_one;
        $addsup->supplier_email2       = $req->email_two;
        $addsup->supplier_website      = $req->website;
        $addsup->supplier_photo        = $req->image;
        $addsup->supplier_picture      = $gallery;
        $addsup->supplier_remark       = $req->remark;
        $addsup->supplier_intro        = $req->desc;
        $addsup->supplier_address      = $req->address;
        $addsup->supplier_status       = $req->status;
        $addsup->save();
        return back()->with(['message'=>"<strong> $req->title</strong> Supplier successful Created",  'status'=> 'success', 'status_icon'=> 'fa-check-circle']); 
    }

    public function getEditSupplier($supplierId){
        $supplier = Supplier::find($supplierId);
        return view('admin.supplier.supplierFormEdit', compact('supplier'));
    }


    public function getDriver($id){
        $driver = Driver::where(["supplier_id"=>$id, "status"=> 1])->orderBy('driver_name', "ASC")->get();
        return view('admin.supplier.driver', compact('driver'));
    }

    public function getSupplierDownload(Request $req, $supId){
            $supplier = Supplier::find($supId);
            $pdf      = PDF::loadView('admin.supplier.supplierReport', compact('supplier'));
            return $pdf->download($supplier->supplier_name.'.pdf');
    }
}
