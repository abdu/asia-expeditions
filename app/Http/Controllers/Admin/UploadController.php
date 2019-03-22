<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageManagerStatic as Image;
// use App\
use App\Company;

class UploadController extends Controller
{
    protected $site_settings;
    protected $dir_path;
    public function fileUploaded(){
        $this->dir_path = public_path('storage/');
        $this->dir_thumb = public_path('storage/thumbnail/');
        $datafile = "No File Exiting";
        $status = false;
        // return storage_path();
        $dirFile = glob($this->dir_thumb."*", GLOB_BRACE);
        $dirFileUser = glob(public_path('storage/'.\Auth::user()->name.'/thumbnail/')."*", GLOB_BRACE);
        // $dirFile = \Storage::files('public/thumbnail/');
            if ($dirFile) {
                $datafile = [];
                $index = 2;          
                foreach( $dirFile as $key => $files){
                    $file = explode('/', $files);
                    // return $file[7]; for server
                    // return $file[3]; //for local
                    $datafile[]=['file'=>$file[$index],'name'=>basename($file[$index]),'url'=> '/storage/thumbnail/'.$file[$index]];
                }
                $status = true;
            }
        return response()->json(['files'=> $datafile, 'status' => $status]);    
    }

    public function removeFile(Request $req){
        if (file_exists(public_path('storage/').$req->pathImg)) {
            unlink("storage/thumbnail/".$req->pathImg);
            unlink("storage/".$req->pathImg);
            $message = "Yes";
        }elseif (file_exists(public_path("storage/").\Auth::user()->name."/".$req->pathImg)) {
            unlink('storage/'.\Auth::user()->name."/thumbnail/".$req->pathImg);
            unlink('storage/'.\Auth::user()->name."/".$req->pathImg);
            $message = "Yes";
        }else{
            $message = "not";
        }   
        return response()->json(['message'=> $message]);
    }

    public function uploadFile(Request $req){
        $this->dir_path = public_path("storage/");
        $this->dir_thumb = public_path("storage/thumbnail");
        $message = 'Folder Exiting';
        if (!file_exists($this->dir_path) && !is_dir($this->dir_path)) {
            mkdir($this->dir_path);
        }
        if (!file_exists($this->dir_thumb) && !is_dir($this->dir_thumb)) {
            mkdir($this->dir_thumb);
        }
        if ( $req->hasFile("uploadfile") ) {
            foreach ($req->file("uploadfile") as $key=>$image) {
                $filename = str_slug(time()."_".pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME), "_").'.'.$image->getClientOriginalExtension();
                $img = Image::make($image->getRealPath())->fit(360, 260);
                $img->save($this->dir_thumb."/".$filename);
                $image->move($this->dir_path, $filename); 
                $message = "Uploaded Successfully";
            }
        }
        return response()->json(['message'=>$message]);
    }

    public function uploadOnlyFile(Request $req){
        $this->dir_path = public_path('storage/avata');
        if ( $req->hasFile("onlyFile")) {
            $image = $req->file("onlyFile");
            $filename = str_slug(time()."_".$image->getClientOriginalName(), "_").'.'.$image->getClientOriginalExtension();
            $image->move($this->dir_path, $filename); 
            $cp = Company::find($req->cp_id);
            $cp->logo = $filename;
            $cp->save();
            $message = "Uploaded Successfully";           
        }
        return response()->json(['message'=>$message, 'onlyFile'=>$filename, 'collect'=> $req->all()]);
    }

    public function RemoveLogo(Request $req){
        $cp = Company::find($req->cp_id);
        $cp->logo = '';
        if ($cp->save()) {
            unlink(public_path('storage/avata')."/".$req->filename);
        }
        return response()->json(['message'=>"Image Remove Successfully"]);
    }
}
