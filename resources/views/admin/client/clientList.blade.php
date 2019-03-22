@extends("layouts.backend")
@section('title', config('app.name'))
<?php 
use App\components\Shared; ?>
@section('content')
<div id="wrapper">
    @include('admin.include.menu')
    <script type="text/javascript" src="/backend/lib/js/jquery.dataTables.min.js" ></script>
    <div id="page-wrapper">
        <div class="row">
            @include('admin.include.message')
            <div class="clearfix"></div>
            <h3 class="border">Client List <i class="fa fa-angle-double-right"></i> 
                <a  href="{{route('getClientForm')}}" class="btn btn-success btn-xs btn-flat">Add Client</a>
            </h3>
        </div>
        <div class="row">
            <table class="table" id="tableData">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Member On</th>                        
                        <th>From</th>
                        <th class="text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr class="text-vertical" style="vertical-align: middle;">
                        <td width="20px;">
                            <img style="width: 70%;" src="{{Shared::getInstance()->urlResource($client->picture)}}">
                        </td>
                        <td>{{$client->name}}</td>
                        <td>{{$client->gender}}</td>
                        <td>{{$client->password_text}}</td>             
                        <td>{{$client->email}}</td>                  
                        <td>{{$client->phone}}</td>
                        <td>{{date('Y-M-d', strtotime($client->created_at))}}</td>
                        <td class="text-right">{{ $client->from }}</td>
                        <td class="text-right" style="width:12%;">
                            <a target="_blank" href="{{route('getViewByClientName', ['clientName'=> $client->id])}}" class="btn btn-info btn-xs">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>&nbsp;
                            <a href="{{route('getEditClient', ['url' => $client->id])}}" class="btn btn-info btn-xs"><i class="fa fa-edit (alias)"></i></a>&nbsp;
                            <a href="{{route('getDelete', ['url' => $client->id])}}?action=client" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>                     
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tableData").DataTable();
    });
</script>
@endsection

