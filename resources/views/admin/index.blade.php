@extends("layouts.backend")
@section('title')
    {{config('app.name')}}
@endsection
@section('content')
<div id="wrapper">
    @include('admin.include.menu')
    <div id="page-wrapper">
        <div class="row">            
            @if(Auth::user()->user_type == 1)
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header border">Dashboard</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-envelope fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{\App\EmailSubscriber::all()->count()}}</div>
                                    <div>Email Subscribed</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('emailList')}}">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{\App\User::all()->count()}}</div>
                                    <div>All User</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('getUser')}}">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>   
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-firefox fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{\App\Tour::where(['tour_status'=>1, 'web'=>1])->count()}}</div>
                                    <div>Program Itineraries</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('tourList')}}">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div> 
                         <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-eye fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{\DB::table('tbl_countview as v')    
                                    ->groupBy('v.ip')                                
                                    ->get()->count()}}
                                    </div>
                                    <div>Viewer Website</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('getviewer')}}">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>               
            </div>

            @else 
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header border">Your Travel Documents </h1>
                </div>
            </div>
            
                @include('admin.include.clientdocument')
            
            @endif
        </div>       
    </div>
</div>
@endsection

