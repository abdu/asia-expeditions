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
                <a style="line-height: 1.6;" href="{{route('SlideForm')}}" class="btn btn-success btn-xs btn-flat">Add Slide</a></h3>
           
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th></th>
                        <th width="120px">User</th>
                        <th>Location</th>                                             
                        <th class="text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slides as $sl)        
                    <tr>
                        <td width="10px;">
                            <img style="width:60%; border: solid #dddddddb 1px;border-radius: 3px" src="{{Shared::getInstance()->urlResource($sl->photo, $sl->user_id)}}">
                        </td>
                        <td>{{$sl->title}}</td>
                        <td>
                            {{{$sl->user->fullname or ''}}}
                        </td>
                        <td>{{{ $sl->country->country_name or 'Home Page'}}}</td>                               
                        <td class="text-right" style="width:12%;">
                            <a href="{{route('SlideForm', ['eid' => $sl->id, 'action'=> 'update'])}}" class="btn btn-info btn-xs"><i class="fa fa-edit (alias)"></i></a>&nbsp;
                            <a href="{{route('getDelete',['delid' => $sl->id])}}?action=tour" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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
  });
</script>

@endsection

