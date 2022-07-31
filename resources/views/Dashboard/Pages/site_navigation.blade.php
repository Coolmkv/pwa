@extends('layouts.dashboardLayout')
@section('title', 'Navigation')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Navigation</h4>

    <!-- Basic Layout -->
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Add Navigation</h5>
            {{-- <small class="text-muted float-end">Default label</small> --}}
          </div>
          <div class="alert-success card-body">
            <form method="POST" action="{{route("addNaviagtion")}}" id="navigation">
                @csrf
                <input type="hidden" name="id" value="">
                <input type="hidden" name="action" value="insert">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-3">
                        <label class="form-label" for="title">Menu Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Home" required>
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label class="form-label" for="url_link">Title Link</label>
                        <input type="text" name="url" class="form-control" id="url_link" placeholder="Url of Title" required>
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label class="form-label" for="url_target">Link Target Window</label>
                        <div class="input-group input-group-merge">
                            <select class="form-control" name="url_target" id="url_target">
                                <option value="">Select</option>
                                <option value="_blank">Open In New Window</option>
                                <option value="_self" selected>Open In Same Window</option>
                                <option value="_parent">Open In Parent Frame</option>
                                <option value="_top">Open In Full body Of Window</option>
                            </select> 
                        </div> 
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label class="form-label" for="nav_type">Nav Type</label>
                        <select class="form-control" name="nav_type" id="nav_type" required>
                            <option value="">Select</option>
                            <option value="top">Top</option>
                            <option value="footer">Footer</option>
                            <option value="mobile">Mobile</option>
                        </select> 
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label class="form-label" for="basic-default-phone">View In List</label>
                        <select class="form-control" name="view_in_list" id="type" required>
                            <option value="">Select</option>
                            <option value="yes">View</option>
                            <option value="no">Hide</option>
                        </select> 
                      </div>
                      <div class="col-md-4 col-sm-12 mb-3">
                        <label class="form-label" for="position">Position</label>
                        <input type="number" class="form-control" id="position" placeholder="Position" >
                      </div>
                      <div class="col-md-12 col-sm-12 mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                      </div>
                </div>
              
             
              
            </form>
          </div>
        </div>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Nav Data</h5>
            </div>
            <div class="alert-info card-body">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Url</th>
                            <th>Target</th>
                            <th>Nav Type</th>
                            <th>Position</th>
                            <th>View In List</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
      </div>       
    </div>
  </div>
@endsection

@section("script")
<script type="text/javascript">
    $(function () {
      
      var table = $('.data-table').DataTable({
          processing: true, 
          serverSide: true,
          ajax: {
            url:"{{ route('navDataTable') }}",
            type: 'POST',
            data:{
              '_token':'{{ csrf_token() }}'
            }
          },
          columns: [
              {data: '{{ \App\Models\NavMenu::ID }}', name: '{{ \App\Models\NavMenu::ID }}'},
              {data: '{{ \App\Models\NavMenu::TITLE }}', name: '{{ \App\Models\NavMenu::TITLE }}'},
              {data: '{{ \App\Models\NavMenu::URL }}', name: '{{ \App\Models\NavMenu::URL }}'},
              {data: '{{ \App\Models\NavMenu::URL_TARGET }}', name: '{{ \App\Models\NavMenu::URL_TARGET }}'},
              {data: '{{ \App\Models\NavMenu::NAV_TYPE }}', name: '{{ \App\Models\NavMenu::NAV_TYPE }}'},
              {data: '{{ \App\Models\NavMenu::POSITION }}', name: '{{ \App\Models\NavMenu::POSITION }}'},
              {data: '{{ \App\Models\NavMenu::VIEW_IN_LIST }}', name: '{{ \App\Models\NavMenu::VIEW_IN_LIST }}'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>
  @include("Dashboard.include.dataTablesScript")
@endsection