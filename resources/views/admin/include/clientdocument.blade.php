<?php 
use App\components\Shared;
    $clientId = isset($client->id) ? $client->id : \Auth::user()->id;
    $projectTag = \App\User::getAllProject($clientId);
?>
<script  type="text/javascript" src="/backend/lib/js/jquery.dataTables.min.js" ></script>
<table class="table" id="tableData">
    <thead>
        <tr>
            <th width="30px">Project</th>
            <th>Client Name</th>
            <th width="100px">Start Date</th>
            <th width="100px">End Date</th>
            <th width="10px;">No.Pax</th>
            <th class="text-right">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projectTag as $key => $pro)
        <tr>           
            <td>{{$pro->project_number}}</td>
            <td>{{$pro->project_client}}</td>
            <td>{{date('d-M-Y', strtotime($pro->project_start))}}</td>
            <td>{{date('d-M-Y', strtotime($pro->project_end))}}</td>
            <td class="text-center">{{$pro->project_pax}}</td>                              
            <td class="text-right">
                <a target="_blank" href="{{Shared::getInstance()->urlPdf($pro->project_number, $pro->booking_status )}}" title="Booking Status" class="btn btn-success btn-xs" {{$pro->booking_status ==''? 'disabled="disabled"': ''}}><i class="fa fa-file-text"></i></a>                
                <a target="_blank" href="{{Shared::getInstance()->urlPdf($pro->project_number,$pro->final_program)}}" title="Final Program" class="btn btn-danger btn-xs" {{$pro->final_program ==''? 'disabled="disabled"': ''}}><i class="fa fa-file-powerpoint-o"></i></a>
                <a target="_blank" href="{{Shared::getInstance()->urlPdf($pro->project_number,$pro->general_info)}}" title="General Info" class="btn btn-success   btn-xs" {{$pro->general_info ==''? 'disabled="disabled"': ''}}><i class="fa fa-floppy-o"></i></a>
                <a target="_blank" href="{{Shared::getInstance()->urlPdf($pro->project_number, $pro->client_program)}}" title="Initial Program" class="btn btn-info btn-xs" {{$pro->client_program ==''? 'disabled="disabled"': ''}}><i class="fa fa-sticky-note-o"></i></a>
                <a target="_blank" href="{{Shared::getInstance()->urlPdf($pro->project_number, $pro->client_manifast)}}" title="Manifast" class="btn btn-warning btn-xs" {{$pro->client_manifast ==''? 'disabled="disabled"': ''}}><i class="fa fa-paste (alias)"></i></a>
                <span target="_blank" href="javascript:void(0)" title="Invoice" class="btn btn-primary btn-xs item-pdf" {{$pro->client_invoice ==''? 'disabled="disabled"': ''}}><i class="fa fa-floppy-o"></i>
                    @if($pro->client_invoice)
                        <ul  class="list-unstyled item-show">
                        <?php 
                        $getClientInvoice = explode('|', rtrim($pro->client_invoice, 1));
                        ?> 
                        @foreach($getClientInvoice as $invoice)
                            <li style="padding: 8px 2px;"><a target="_blank" href="{{Shared::getInstance()->urlPdf($pro->project_number, $invoice)}}">{{$invoice}}</a></li>
                        @endforeach
                        </ul>
                    @endif
                </span>           

                <span target="_blank" href="javascript:void(0)" title="Service Vouchers" class="btn btn-danger btn-xs item-pdf" {{$pro->service_vouchers ==''? 'disabled="disabled"': ''}}><i class="fa fa-file-o"></i>
                @if($pro->service_vouchers)
                    <ul  class="list-unstyled item-show">
                    <?php 
                    $getService_vouchers = explode('|', rtrim($pro->service_vouchers, 1));
                    ?> 
                    @foreach($getService_vouchers as $voucher)
                        <li style="padding: 8px 2px;"><a target="_blank" href="{{Shared::getInstance()->urlPdf($pro->project_number, $voucher)}}">{{$voucher}}</a></li>
                    @endforeach
                    </ul>
                @endif
                </span>

                <span href="javascript:void(0)" title="E-Tickets" class="btn btn-primary btn-xs item-pdf" {{$pro->etickets ==''? 'disabled="disabled"': ''}}><i class="fa fa-file-text-o"></i>
                    @if($pro->etickets)
                    <ul  class="list-unstyled item-show">
                    <?php 
                    $getTicket = explode('|', rtrim($pro->etickets, 1));
                    ?> 
                    @foreach($getTicket as $eticket)
                        <li style="padding: 8px 2px;"><a target="_blank" href="{{Shared::getInstance()->urlPdf($pro->project_number, $eticket)}}">{{$eticket}}</a></li>
                    @endforeach
                    </ul>
                    @endif
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tableData").DataTable();
    });
</script>