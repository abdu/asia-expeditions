<!DOCTYPE ">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>Mailto</title>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
<style type="text/css">
html { -webkit-text-size-adjust: none; -ms-text-size-adjust: none;}

   @media only screen and (min-device-width: 750px) {
      .table750 {width: 750px !important;}
   }
   @media only screen and (max-device-width: 750px), only screen and (max-width: 750px){
      table[class="table750"] {width: 100% !important;}
      .mob_b {width: 93% !important; max-width: 93% !important; min-width: 93% !important;}
      .mob_b1 {width: 100% !important; max-width: 100% !important; min-width: 100% !important;}
      .mob_left {text-align: left !important;}
      .mob_soc {width: 50% !important; max-width: 50% !important; min-width: 50% !important;}
      .mob_menu {width: 50% !important; max-width: 50% !important; min-width: 50% !important; box-shadow: inset -1px -1px 0 0 rgba(255, 255, 255, 0.2); }
      .mob_center {text-align: center !important;}
      .top_pad {height: 15px !important; max-height: 15px !important; min-height: 15px !important;}
      .mob_pad {width: 15px !important; max-width: 15px !important; min-width: 15px !important;}
      .mob_div {display: block !important;}
   }
   @media only screen and (max-device-width: 550px), only screen and (max-width: 550px){
      .mod_div {display: block !important;}
   }
   .table750 {width: 750px;}
</style>
</head>
<body style="margin: 0; padding: 0;">

<table cellpadding="0" cellspacing="0" border="0" width="100%" style="background: #f3f3f3; min-width: 350px; font-size: 1px; line-height: normal;">
   <tr>
      <td align="center" valign="top">          
        
         <table cellpadding="0" cellspacing="0" border="0" width="750" class="table750" style="width: 100%; max-width: 750px; min-width: 350px; background: #f3f3f3;">
            <tr>
               <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
               <td align="center" valign="top" style="background: #ffffff;">

                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
                     <tr>
                        <td align="right" valign="top">
                           <div class="top_pad" style="height: 25px; line-height: 25px; font-size: 23px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 88%; max-width: 100%;">
                     <tr>
                        <td align="center" valign="top">
                           <div style="height: 10px; line-height: 39px; font-size: 37px;">&nbsp;</div>
                           <a href="https://www.asia-expeditions.com" target="_blank" style="display: block; max-width: 300px;">
                              <img src="https://www.asia-expeditions.com/public/img/asia-expeditions.png" alt="img" width="128" border="0" style="display: block; width: 300px;" />
                           </a> 
                           <div style="height: 10px; line-height: 39px; font-size: 37px;">&nbsp;</div>                         
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 90% !important; min-width: 90%; max-width: 90%; border-width: 1px; border-style: solid; border-color: #e8e8e8; border-bottom: none; border-left: none; border-right: none;">
                     <tr>
                        <td align="left" valign="top">
                           <font face="'Source Sans Pro', sans-serif" color="#1a1a1a" style="font-size: 52px; line-height: 60px; font-weight: 300; letter-spacing: -1.5px;">
                              <span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 30px; line-height: 60px; font-weight: 600; letter-spacing: -1.5px;">
                                 <!-- text -->

                             General Information                          
                              </span>
                           </font>                          
                           <font face="'Source Sans Pro', sans-serif" color="#585858" style="font-size: 24px; line-height: 32px;">
                            <p>Name  : {{$data['fname']." ".$data['lname'] }}</p>
                            <p>Email : {{$data['email']}}</p>
                            <p>Phone : {{$data['mobile']}}</p>                          
                        
                           </font>
                                 <table class="mob_btn" cellpadding="0" cellspacing="0" border="0" style="background: #27cbcc; border-radius: 4px;">
                              <tr>
                                 <td align="center" valign="top">
                                 <?php $getdata=\App\User::where('email',$data['email'])->first();?>
                                 @if(\App\User::getpass($data['email'],$getdata->password)) 
                                    <a href="{{route('showlogin', ['url'=> encrypt($data['email'])])}}" target="_blank" style="display: block; border: 1px solid #27cbcc; border-radius: 4px; padding: 5px 20px; font-family: 'Source Sans Pro', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                                       <font face="'Source Sans Pro', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                                          <span style="font-family: 'Source Sans Pro', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">Create&nbsp;Your Password</span>
                                       </font>
                                    </a>
                                 @else
                                   <a href="{{route('register')}}" target="_blank" style="display: block; border: 1px solid #27cbcc; border-radius: 4px; padding: 5px 20px; font-family: 'Source Sans Pro', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                                       <font face="'Source Sans Pro', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                                          <span style="font-family: 'Source Sans Pro', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">Go to&nbsp;account</span>
                                       </font>
                                    </a>
                                 @endif
                                 </td>
                              </tr>
                           </table>
                           <div style="height: 15px; line-height: 75px; font-size: 73px;">&nbsp;</div>

                          

                           <font face="'Source Sans Pro', sans-serif" color="#1a1a1a" style="font-size: 52px; line-height: 60px; font-weight: 300; letter-spacing: -1.5px;">
                              <span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 30px; line-height: 60px; font-weight: 600; letter-spacing: -1.5px;">             
                                 <!-- text -->


                              Tour Details
                              </span>
                           </font>

                           
                           <font face="'Source Sans Pro', sans-serif" color="#585858" style="font-size: 24px; line-height: 32px;">
                              <span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #585858; font-size: 24px; line-height: 32px;">
                           <?php $getdata=\App\Tour::where('id',$data['tour_id'])->first();?>
                            <p>Tour Name  : <a href="{{route('tourDetails', ['url'=> $getdata->slug])}}" style="text-decoration: none;">{{$getdata->tour_name}}</a></p>
                            <p>From Date  : {{$data['fdate']}}</p>
                            <p>To Date    : {{$data['tdate']}}</p>
                            <p>Additional Requests : {{$data['textarea']}}</p>

                              </span>
                           </font>
                         
                           <table class="mob_btn" cellpadding="0" cellspacing="0" border="0" style="background: #27cbcc; border-radius: 4px;">
                              <tr>
                                 <td align="center" valign="top"> 
                                    <a href="{{route('tourDetails', ['url'=> $getdata->slug])}}" target="_blank" style="display: block; border: 1px solid #27cbcc; border-radius: 4px; padding: 5px 25px; font-family: 'Source Sans Pro', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                                       <font face="'Source Sans Pro', sans-serif" color="#ffffff" style="font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">
                                          <span style="font-family: 'Source Sans Pro', Arial, Verdana, Tahoma, Geneva, sans-serif; color: #ffffff; font-size: 20px; line-height: 30px; text-decoration: none; white-space: nowrap; font-weight: 600;">Read&nbsp;more</span>
                                       </font>
                                    </a>
                                 </td>
                              </tr>
                           </table>
                           <div style="height: 75px; line-height: 75px; font-size: 73px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>

                  <table cellpadding="0" cellspacing="0" border="0" width="90%" style="width: 90% !important; min-width: 90%; max-width: 90%; border-width: 1px; border-style: solid; border-color: #e8e8e8; border-bottom: none; border-left: none; border-right: none;">
                     <tr>
                        <td align="left" valign="top">
                           <div style="height: 15px; line-height: 15px; font-size: 13px;">&nbsp;</div>
                        </td>
                     </tr>
                  </table>



                  <table cellpadding="0" cellspacing="0" border="0" width="100%" style="width: 100% !important; min-width: 100%; max-width: 100%; background: #f3f3f3;">
                     <tr>
                        <td align="center" valign="top">
                       
                           <table cellpadding="0" cellspacing="0" border="0" width="88%" style="width: 88% !important; min-width: 88%; max-width: 88%;">
                              <tr>
                                 <td align="center" valign="top">                              
                                    <div style="height: 34px; line-height: 34px; font-size: 32px;">&nbsp;</div>
                                    <font face="'Source Sans Pro', sans-serif" color="#868686" style="font-size: 17px; line-height: 20px;">
                                       <span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #868686; font-size: 17px; line-height: 20px;"><p>Power By ©<a target="_blank" href="http://jngtravelpro.com">www.jngtravelpro.com</a></p></span>
                                    </font>
                                    <div style="height: 3px; line-height: 3px; font-size: 1px;">&nbsp;</div>
                                    <font face="'Source Sans Pro', sans-serif" color="#1a1a1a" style="font-size: 17px; line-height: 20px;">
                                       <span style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px;"><a href="#" target="_blank" style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">+855 (23) 432 007 </a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" target="_blank" style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">enquiry@asia-expeditions.com</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="#" target="_blank" style="font-family: 'Source Sans Pro', Arial, Tahoma, Geneva, sans-serif; color: #1a1a1a; font-size: 17px; line-height: 20px; text-decoration: none;">Unsubscribe</a></span>
                                    </font>
                                    <div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
                                    <table cellpadding="0" cellspacing="0" border="0">
                                       <tr>
                                          <td align="center" valign="top">
                                             <a href="https://www.instagram.com/asiaexpeditions/" target="_blank" style="display: block; max-width: 19px;">
                                                <img src="{{asset('/public/img/soc_1.png')}}" alt="img" width="19" border="0" style="display: block; width: 19px;" />
                                             </a>
                                          </td>
                                          <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                                          <td align="center" valign="top">
                                             <a href="https://www.facebook.com/AsiaExpeditionsDM" target="_blank" style="display: block; max-width: 18px;">
                                                <img src="{{asset('/public/img/soc_2.png')}}" alt="img" width="18" border="0" style="display: block; width: 18px;" />
                                             </a>
                                          </td>
                                          <td width="45" style="width: 45px; max-width: 45px; min-width: 45px;">&nbsp;</td>
                                          <td align="center" valign="top">
                                             <a href="https://twitter.com/AsiaExpeditions" target="_blank" style="display: block; max-width: 21px;">
                                                <img src="{{asset('/public/img/soc_3.png')}}" alt="img" width="21" border="0" style="display: block; width: 21px;" />
                                             </a>
                                          </td>                                    
                                       </tr>
                                    </table>
                                    <div style="height: 35px; line-height: 35px; font-size: 33px;">&nbsp;</div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>  

               </td>
               <td class="mob_pad" width="25" style="width: 25px; max-width: 25px; min-width: 25px;">&nbsp;</td>
            </tr>
         </table>
      </td>
   </tr>
</table>
</body>
</html>