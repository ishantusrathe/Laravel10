@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               @if(Session::has('error_message'))
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error ! </strong> {{ Session::get('error_message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
          <!-- form start -->
               @if(Session::has('success_message'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !</strong> {{ Session::get('success_message') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
              <form method="post" action="{{url('admin/update-details')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control"
                    id="exampleInputEmail1" placeholder="Enter email"
                    value="{{ Auth::guard('admin')->user()->email }}"
                    readonly
                    style="background-color:#666"
                    >
                  </div>
                  <div class="form-group">
                    <label for="current_pwd">Name</label>
                    <input type="text" class="form-control" id="admin_name"
                    name="admin_name" placeholder="Name"
                    value="{{ Auth::guard('admin')->user()->name }}">

                   <div class="form-group">
                    <label for="new_pwd">Mobile</label>
                    <input type="text" class="form-control" id="admin_mobile"
                    name="admin_mobile" placeholder="Mobile"
                    value="{{ Auth::guard('admin')->user()->mobile }}">
                  </div>

                   <div class="form-group">
                    <label for="new_pwd">Image</label>
                    <input type="file" class="form-control" id="admin_image"
                    name="admin_image" placeholder="Mobile">
                    @if (!@empty(Auth::guard('admin')->user()->image))
                        <a target="_blank" href="{{ url('admin/image/photos/'.Auth::guard('admin')->user()->image)}}">VieW Photo</a>
                        <input type="hidden" value="{{ Auth::guard('admin')->user()->image }}" name="current_image">

                    @endif
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->






          </div>
          <!--/.col (left) -->
          <!-- right column -->

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
