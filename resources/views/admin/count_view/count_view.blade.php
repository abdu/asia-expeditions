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
          <h1 class="page-header border">View List</h1>
        </div>
        <div class="row">
            <table class="table" id="tableData">
                <thead>
                    <tr>       
                    	<th>User Name</th>          
                        <th>Tours Name</th>
                        <th>Viewer</th>
                     
                   
                    </tr>
                </thead>
                <tbody>
                    @foreach($views as $view)
                    <tr>
                      <td >{{$view->fullname}}</td>
                      <td>{{$view->tour_name}}</td>
                      <td>{{ $view->total }}</td>
        
               
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