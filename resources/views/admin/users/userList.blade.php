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
          <h1 class="page-header border">Users List <i class="fa fa-angle-double-right"></i> <a href="#" class="btn btn-success btn-sm btn-flat btnAnd" data-toggle="modal" data-target="#exampleModal" data-action="add">Add User</a></h1>
        </div>
        <div class="row">
            <table class="table" id="tableData">
                <thead>
                    <tr> 
                        <th width="15">N#</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Created Date</th>
                        <th>Password</th>
                        <th class="text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td width="15">{{$user->id}}</td>
                      <td>{{$user->first}}</td>
                      <td>{{{ $user->level->rule_name or ''}}}</td>
                      <td>{{$user->phone}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{date('Y-M-d', strtotime($user->date))}}</td>
                      <td>{{$user->password_text}}</td>
                      <td class="text-right">
                        <a href="#" data-toggle="modal" data-target="#exampleModal" data-action="edit" data-id="{{$user->id}}" class="btn btn-info btn-xs btnUpdate">Edit</a>&nbsp;
                        <a href="#" data-name="{{$user->first}}" data-action="{{ $user->status ? 'enable' :'disable' }}" data-id="{{$user->id}}"  data-toggle="modal" data-target=".bd-example-modal-sm" class="btn btn-{{ $user->status ? 'success' :'danger' }} btn-xs btnStatus"> {{ $user->status ? 'Enable' :'Disabled' }}</a>

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
  
<!-- Modal for update and add user -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form  method="POST" enctype="multipart/form-data">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="pull-left"><h5 class="modal-title" id="exampleModalLabel"></h5></div>
        <div class="pull-right">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
      <div class="modal-body">
        <div class="Dataloading" style="display: none;"></div>
        {{csrf_field() }}
        <input type="hidden" name="id" id="id">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group fullname">
                <label class="control-label" for="inputError"><i class="fa fa-user"></i> Full Name</label>
                <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group username">
                <label class="control-label" for="inputError"><i class="fa fa-user"></i> User Name</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="User Name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group password">
                <label class="control-label" for="inputError"><i class="fa fa-lock"></i> Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group repassword">
                <label class="control-label" for="inputError"><i class="fa fa-lock"></i> Confirm Password</label>
                <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Re-Type Password">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group email">
                <label class="control-label" for="inputError"><i class="fa fa-envelope"></i> Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group phone">
                <label class="control-label" for="inputError"><i class="fa fa-user"></i> Phone Number</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="+855 123 456 789">
              </div>
            </div>              
          </div>  
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" name="btn_Save" id="btnSave">Save</button>
      </div>
    </div>
  </div> 
  </form>
</div>
<!-- disable user  -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <form method="POST">
      {{csrf_field() }}
      <div class="modal-content">      
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="clearfix"></div>
          <div class="Dataloading" style="display: none;"></div>
          <div class="col-md-12"></div>
          <div class="clearfix"></div>
          <div id="messageShow"></div>
          <input type="hidden" name="id" id="ectiveId" >
        </div>
        <div class="modal-footer text-center">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-info btn-sm" id="StatusBtn">Yes</button>
        </div>
      </div>
    </form>
  </div>
</div>


@endsection