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
                        <th>Destination</th>
                        <th>User</th>                        
                        <th class="text-right">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sentEmail as $email)
                        <?php 
                            $pro = \App\Country::find($email->destination_id);
                        ?>
                        <tr>
                            <td>{{$email->id}}</td>
                            <td>{{$email->email}}</td>  
                            <td>{{{ $pro->country_name or ''}}}</td>    
                            <td>{{$email->user->first}}</td>                  
                            <td>{{date('Y-m-d', strtotime($email->created_at))}}</td>
                            
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

