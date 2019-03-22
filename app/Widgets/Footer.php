<?php



namespace App\Widgets;



use Arrilot\Widgets\AbstractWidget;



class footer extends AbstractWidget

{

    /**

     * The configuration array.

     *

     * @var array

     */

    

    protected $config = ['f_type' => 3 ];



    /**

     * Treat this method as a controller action.

     * Return view() or other content to display.

     */

    public function run()

    {

        //



        // return view("widgets.footer", [

        //     'config' => $this->config,

        // ]);

        return self::getFooter($this->config);

    }



    public function getFooter($f_id){

        $getFoot = \App\Footer::Where('f_type', $f_id)->get();

        $data = '';

        foreach ($getFoot as $key => $value) {

          $float = ($value['f_type'] != 2 ? 'float:right;' : '');



          $data .= '<li>

                      <a target="_blank" style="float:left; " class="fa '.$value['f_icon'].'" href="'.$value['f_link'].'"> &nbsp; 

                      <span style="font-family:Open Sans,Arial,sans-serif; line-height: 1.5;  '.$float.'

    padding-left: 9px;

    width: 91%; ">'.$value['f_name'].'</span></a>

                        <div class="clear"></div>

                    </li>';                        

        }      



        return '<ul class="footer-ul">

                  '.$data.'    

                  <div class="clear"></div>            

                </ul>';



        

    }

}