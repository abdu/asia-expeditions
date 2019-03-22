@extends("layouts.backend")
@section('title')
    {{config('app.name')}}
@endsection
@section('content')
<div id="wrapper">
    @include('admin.include.menu')
    <script  type="text/javascript" src="/backend/lib/js/jquery.dataTables.min.js" ></script>
    <div id="page-wrapper">
        <div class="row">
            <h1 class="page-header border">Email List <i class="fa fa-angle-double-right"></i> <a href="{{route('getEmailtemplate')}}" class="btn btn-success btn-sm btn-flat">Send New Template</a></h1>           
        </div>
        <div class="row">
            <table class="table" id="tableData">
                <thead>
                    <tr>
                        <th width="35">N#</th>
                        <th>Email</th>
                        <th>Country Code</th>
                        <th>City</th>
                        <th>Location</th>
                        <th>Subscribed Date</th>
                        <th class="text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emails as $email)
                    <tr>
                        <td>{{$email->id}}</td>
                        <td>{{$email->email}}</td>
                        <td>{{$email->countryCode}}</td>
                        <td>{{$email->regionName}}</td>
                        <td>{{$email->cityName}}</td>
                        <td>{{date('Y-m-d', strtotime($email->created_at))}}</td>
                        <td class="text-right">
                        @if($email->status == 1)
                            <i style="color:blue;" class="fa fa-check-circle"></i>&nbsp;Subscribed
                        @else 
                            <i style="color:blue;" class="fa fa-check-circle"></i>&nbsp;Unsubscribe
                        @endif                               
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

