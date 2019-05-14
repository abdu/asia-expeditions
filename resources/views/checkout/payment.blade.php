<?php

    

    if (!Auth::check()) {

        echo ("<script>location.href='https://asia-expeditions.com/checkout'</script>");

    }

?>



@extends('layouts.app')

@section('title')

    Payment Page

@endsection

<?php

use App\components\Shared;

use App\User;


?>



@section('content')

@include('include.menu')

@if($carts)
<br>
    <table width='100%' border='2' cellpadding='2' bgcolor='#0074C4'>
        <tr>
            <td bgcolor='#CED7EF' width='90%'><center><h2 class='co'><small>Process checkout Please click button Pay Now</small></h2></td></center>
        </tr>
    </table>
    <div class="spacing"></div>
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <table class="table">
                <thead>
                    <th>Photo</th>
                    <th>Description</th>
                    <th class="text-right">Unit Price</th>
                </thead>
                <tbody>
                    <?php  $getTotal = 0;?>
                    @foreach($carts as $cart)
                        <tr>
                            <td width="100">
                                <img width="100" height="65" class="lazy" data-src="{{Shared::getInstance()->urlResource($cart['item']['tour_photo'], $cart['item']['user_id'])}}">
                            </td>
                            <td>
                                <div style="font-weight: 700;font-size: 14px;}">
                                    {{ str_limit($cart['item']['tour_name'], 120) }}
                                </div>
                                <div><small>{{ str_limit($cart['item']['tour_name'], 70) }}</small></div>
                            </td>
                            <td><?php $price = $cart['item']['tour_price'] * $cart['qty'];?></td>
                            <td class="text-right"><b>${{ number_format($price, 2) }}</b></td>
                        </tr>
                        <?php $getTotal = $getTotal + $price;?>
                    @endforeach
                </tbody>
            </table>
        <form action="{{ route('linkPayment') }}" method="post" accept-charset="UTF-8">
            {{ csrf_field() }}
            <input type="hidden" name="Title" value = "PHP VPC 3 Party Transacion">

            <!-- get user input -->

            <table class="hide" width="80%" align="center" border="0" cellpadding='8' cellspacing='0'>



                <tr class="shade hide">

                    <td align="right"><strong><em>Virtual Payment Client URL:&nbsp;</em></strong></td>

                    <td><input  name="virtualPaymentClientURL" size="65" value="https://migs.mastercard.com.au/vpcpay" maxlength="250"/></td>

                </tr>

                <tr><td colspan="2">&nbsp;<hr width="75%">&nbsp;</td></tr>

                <tr class="title hide">

                    <td colspan="2" height="25"><p><strong>&nbsp;Basic 3-Party Transaction Fields</strong></p></td>

                </tr>

                <tr class="hide">

                    <td align="right"><strong><em> VPC Version: </em></strong></td>

                    <td><input name="vpc_Version" value="1" size="20" maxlength="8"/></td>

                </tr>

                <tr class="shade hide">

                    <td align="right"><strong><em>Command Type: </em></strong></td>

                    <td><input name="vpc_Command" value="pay" size="20" maxlength="16"/></td>

                </tr>

                <tr class="hide">

                    <td align="right"><strong><em>Merchant AccessCode: </em></strong></td>

                    <td><input name="vpc_AccessCode" value="D103A32C" size="20" maxlength="8"/></td>

                </tr>

                <tr class="shade hide">

                    <td align="right">

                        <strong><em>Merchant Transaction Reference: </em></strong>

                    </td>

                    <td>

                        <input name="vpc_MerchTxnRef" value="{{ User::getLastId() }}" size="20" maxlength="40"/>

                    </td>

                </tr>

                <tr class="hide">

                    <td align="right"><strong><em>MerchantID: </em></strong></td>

                    <td><input name="vpc_Merchant" value="ASIAEXP" size="20" maxlength="16"/></td>

                </tr>

                <tr class="shade hide">

                    <td align="right"><strong><em>Transaction OrderInfo: </em></strong></td>

                    <td><input name="vpc_OrderInfo" value="{{ $userId }}" size="20" maxlength="34"/></td>

                </tr>

                <tr>

                    <td></td>

                    <td align="right"><strong><em>Purchase Amount: </em></strong></td>

                    <td><input class="hide" name="vpc_Amount" value="{{ $getTotal }}00" maxlength="10"/> </td>

                </tr>

                <tr class="shade hide">

                    <td align="right"><strong><em>Receipt ReturnURL: </em></strong></td>

                    <td><input name="vpc_ReturnURL" size="65" value="{{url('return_data')}}" maxlength="250"/></td>

                </tr>

                <tr class="hide">

                    <td align="right"><strong><em>Payment Server Display Language Locale: </em></strong></td>

                    <td><select name="vpc_Locale"><option SELECTED>en_AU</option><option>en_AU</option></select></td>

                </tr>

                <tr class="shade hide">

                    <td align="right"><strong><em>Currency: </em></strong></td>

                    <td><select name="vpc_Currency"><option SELECTED>USD</option></select></td>

                </tr>

                <tr>    

                    <td colspan="2">&nbsp;</td></tr>

                <tr>

                    <td>&nbsp;</td>

                    <td></td>

                </tr>

                <tr><td colspan="2">&nbsp;<hr width="75%">&nbsp;</td></tr>

                <tr>

                    <td colspan="2">

                    </td>

                </tr>

                <tr>

                    <td width="40%">&nbsp;</td>

                    <td width="60%">&nbsp;</td>

                </tr>

            </table>

            <hr>

            <div class="col-md-12">

                <div class="text-right">

                    <h3><b> Purchase Amount :  ${{ number_format($getTotal,2) }} </b></h3>

                </div>

                

                <br><br>

                <div class="text-right w3-margin-top">

                    <input type="submit" class="btn btn-primary" NAME="SubButL" value="Pay Now!">

                </div>

                <div class="spacing"></div>               

                <div class="text-left">

                    <p>Secure Payments with : 

                    <img src="/img/paywith.png" style="height: 35px;"></p>

                </div>

                <div class="row">

                   {!!config('app.payment')!!}

                </div>

            </div>

            </form>

        </div>

    </div>

@endif

@endsection

