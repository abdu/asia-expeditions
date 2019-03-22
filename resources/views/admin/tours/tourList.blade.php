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
                <!-- <a style="line-height: 1.6;" href="{{route('tourForm')}}" class="btn btn-success btn-xs btn-flat">Create New Tour</a> -->
            </h3>
       
            <form action="" method="get">
                <div class="col-sm-2">
                    <label class="location">
                        <select class="form-control input-sm locationchange" name="loc" onchange="submit()">
                            @foreach(\App\Country::getCountryTour() as $loc)
                            <option value="{{$loc->id}}" {{$conId == $loc->id ? 'selected':''}}>{{$loc->country_name}}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </form>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Tour Name</th>
                        <th width="120px">Category</th>
                        <th>Province</th>                                             
                        <th class="text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tours as $tour)        
                    <tr>
                        <td width="10px;">                      
                            <img style="width:60%; border: solid #dddddddb 1px;border-radius: 3px" src="{{Shared::getInstance()->urlResource($tour->tour_photo, $tour->user_id)}}">
                        </td>
                        <td>{{str_limit($tour->tour_name,40)}}</td>
                        <td>
                        @if($tour->category)
                            @foreach($tour->category as $key => $val)
                                {{ $val->name }},
                            @endforeach
                        @endif
                        </td>
                        <td>{{{ $tour->province->province_name or ''}}}</td>                               
                        <td class="text-right" style="width:12%;">
                            <a target="_blank" href="{{route('tourDetails',['tourId'=>$tour->slug])}}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>&nbsp;
                           <!--  <a href="{{route('getEdit', ['tourId' => $tour->id])}}" class="btn btn-info btn-xs"><i class="fa fa-edit (alias)"></i></a>&nbsp; -->
                            <a href="{{route('getDelete',['delid' => $tour->id])}}?action=tour" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
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

