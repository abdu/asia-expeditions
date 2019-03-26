@extends("layouts.backend")
@section('title', config('app.name'))
<?php 
use App\components\Shared; ?>
@section('content')
<div id="wrapper">
    @include('admin.include.menu')
    <script  type="text/javascript" src="/backend/lib/js/jquery.dataTables.min.js" ></script>
    <div id="page-wrapper">
        <div class="row">
            @include('admin.include.message')
            <h3 class="border">Tours List <i class="fa fa-angle-double-right"></i> 
                <a style="line-height: 1.6;" href="{{route('filmForm')}}" class="btn btn-success btn-xs btn-flat">Add Film</a></h3>
            <form action="" method="get">
                <div class="col-sm-2">
                    <label class="location">
                        <select class="form-control input-sm locationchange" name="loc" onchange="submit()">
                            @foreach(\App\Country::where(["web"=>1, 'country_status'=>1])->get() as $loc)
                            <option value="{{$loc->id}}" {{$conId == $loc->id ? 'selected':''}}  >{{$loc->country_name}}</option>
                            @endforeach
                        </select>
                    </label>
            
                    </label>
                </div>
            </form> 
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>User</th>
                        <th>Counry</th>
                        <th>Province</th>                                        
                        <th class="text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $film)        
                    <tr>
                        <td>{{str_limit($film->title,40)}}</td>

                        <td>{{$film->user->fullname}}</td>
                        <td>{{{$film->country->country_name or ''}}}</td>
                        <td>{{{ $film->province->province_name or ''}}}</td>                               
                        <td class="text-right" style="width:12%;">
                            <a href="{{route('filmForm', ['eid' => $film->id, 'action'=> 'update'])}}" class="btn btn-info btn-xs"><i class="fa fa-edit (alias)"></i></a>&nbsp;
                            <a href="{{route('getDelete',['delid' => $film->id])}}?action=film" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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
     $(".datatable").DataTable();
     
     $("#2").attr({"selected": true});
  });
</script>

@endsection

