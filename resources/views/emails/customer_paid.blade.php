<html>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="/img/AE-Logo.ico">
    <title> Invoice: {{ $invoice }} </title>
<style type="text/css">
    body{
        font-family: "Open Sans",Arial,sans-serif;
    }
    @media print
    {    
        #goto_count, #btn-print
        {
            display: none !important;
        }
    }
</style>
<?php
  use App\components\Shared;
  use App\User;
  $aproved = \App\Invoice::where('invoice_number', $invoice )->first();
?>
</head>
    <body>
    <div align="center">
        <div style="max-width: 878px; min-width: 500px; border: 2px solid #e3e3e3; border-radius:5px; margin-top: 20px">   
          <div  style="background-color: #fbfcfd;  text-align: left;">
            <div>       
              <center>
                  <img src="https://asia-expeditions.com/img/{{ config('app.logo') }}" />
              </center>         
            </div> 
               <div style="margin: 30px;">
                    @if(isset(User::getUser()->last_name))
                      <table>
                            <tr>
                                <td style="width: 450px; text-align: left; vertical-align: top;"><b>Invoice To:</b><address style="font-style: normal; font-size: 12px;">
                            <b style="text-transform: capitalize;">{{ User::getUser()->first_name }}  {{ User::getUser()->middle_name }} 
                                {{ User::getUser()->last_name }}</b><br>
                                {{ User::getUser()->address_street }} <br> 
                                {{ User::getUser()->town_city }}, 
                                {{ User::getUser()->country_state }}<br>
                            Tel: {{ User::getUser()->phone_number }}<br>
                            Email: {{ User::getUser()->email }}<br>
                                </address>
                                </td>
                                <td style="width: 450px; text-align: right; vertical-align: top;"><b>Pay To:</b>
                                  <address style="font-style: normal; font-size: 12px;">
                                    Asia Expeditions Co., Ltd <br>
                                    Tel: +855 (23) 432 007<br>
                                    Hotline: +855 (12) 732 236<br>
                                    Email : inquiry [at] asia-expeditions.com<br>
                                    Website: www.asia-expeditions.com
                                </address></td>
                            </tr>  
                        </table>
                    @endif
                    <center>
                        <div><font color="#486b9c"><b>INVOICE  #{{ $invoice }}</b></font></div>
                        <small>
                        <?php
                            $inv = \App\Invoice::where('invoice_number', $invoice)->first();
                            echo date('d/m/Y',strtotime($inv['created_at']));
                        ?>
                        </small>
                    </center>
                  <table style="width: 100%; text-align: left;" cellpadding="8" class="table">
                      <thead>
                          <th>Picture</th>
                          <th>Description</th>
                          <th>Amount</th>
                      </thead>  
                      <tbody> 
                        @foreach(\App\ItemOrder::where('invoice_number', $invoice)->get()  as $item)
                        <?php
                        $tour = \App\ProgramTour::where('tour_id', $item['item_id'])->first();
                        ?>
                         <tr>
                            <td style="width: 10%;"><img style="width: 100%;"  src="{{ Shared::getInstance()->urlResource($tour['tour_picture']) }}"></td>
                            <td style="vertical-align: top;"><small>{{ $tour['tour_name'] }} <b>X {{ $item['item_qty'] }}</b></small></td>                           
                            <td style="vertical-align: top;">${{ number_format($item['price'] * $item['item_qty'], 2) }}</td>
                        </tr>                   
                        @endforeach                            
                      </tbody>        
                  </table>
                  <hr>
                  <div style="text-align: right;">
                      <p><b>Sub Amount: ${{ number_format($aproved['amount'],2) }}</b></p>
                      <p><b>Total Amount: ${{ number_format($aproved['amount'],2) }}</b></p>
                  </div>                
              </div>
          </div>  
          <div style="text-align: left; padding: 21px;">
            <small><address ><strong><em><u>Terms & Conditions </u>:</em></strong><br/>
                Any information passed through the customer's browser
                can potentially be modified by the customer, or even by third parties to
                fraudulently alter the transaction data. Therefore all transactional
                information should <strong>not</strong> be passed through the browser in
                a way that could potentially be modified (e.g. hidden form fields).
                Transaction data should only be accepted once from a browser at the
                point of input, and then kept in a way that does not allow others
                to modify it (e.g. database, server session, etc.). Any transaction
                information displayed to a customer, such as amount, should be passed
                only as display information and the actual transactional data should be
                retrieved from the secure source last thing at the point of processing
            the transaction.</address>
            </small>
          </div>
            
      </div>   
  </div>
  
  </body>
</html> 
