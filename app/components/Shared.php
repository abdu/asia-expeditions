<?php 



namespace App\components;

/**

* 

*/

class Shared 
{

        
    // return base_path(); = D:\wamp64\www\asia-expeditions
    private static $instance;
    private $Web_uri = 'https://system.asia-expeditions.com'; 
    // private $baseUrl = 'home3/asiagolf/public_html/system';


    private $baseUrl = '/home3/asiagolf/public_html/system';

    // Private $baseUrl = "D:\wamp64\www\dbtour";
    public static $NoImg = "/img/no_image.png";
    
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    
    public static function currency($curren =0 ){
        $currency = ['USD', 'Kyat', 'Rupee'];
        switch ($curren) {
            case 1:
                $money = $currency[1];
                break;
            case 2:
                $money = $currency[2];
                break;
            default:
                $money = $currency[0];
                break;
        }
        return $money;
    }

    public static function money($money){
        if (is_numeric($money)) {
            return $money > 0 ? number_format($money,2):'';
        }
        
    }

   

    public function urlResource($filename, $userId = 0){
        $user = \App\User::find($userId);        
        $userDir = isset($user->name) ? $user->name : "";
        if ( file_exists($this->baseUrl."/public/storage/thumbnail/".$filename) ) {
            return $file = $this->Web_uri."/storage/thumbnail/".$filename;
        }elseif ( file_exists(public_path('storage/thumbnail/'.$filename)) ) {
            $file = asset("storage/thumbnail/".$filename);
        }else{ 
            $file = self::$NoImg;
        } 
        return $file;
    }

    public function urlResourceBig($filename, $userId = 0  ){
        $user = \App\User::find($userId);        
        $userDir = isset($user->name) ? $user->name : '';
        if ( file_exists($this->baseUrl."/public/storage/".$filename) ) {
            return $file = $this->Web_uri."/storage/".$filename;
        }elseif ( file_exists(public_path('storage/'.$filename)) ) {
            $file = asset("storage/".$filename);
        }else{ 
            $file = self::$NoImg;
        } 
        return $file;
    }

    public function urlPdf($foldProject, $file, $folder = '/userfiles/pdf/'){
        if ($file) {
            $image = $this->url.$folder.$foldProject.'/'.$file;
        }else{
            $image = 'javascript:void(0)';
        }
        return $image;
    }


} 