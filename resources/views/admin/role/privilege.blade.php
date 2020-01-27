@extends('admin.layouts.app')

@section('pagetitle')
    <title>Role</title>
@endsection

@section('content')
        <!-- BEGIN : Main Content-->
        <div class="main-content">
          <div class="content-wrapper"><!-- DOM - jQuery events table -->
          <section id="browse-table">
  <div class="row">
    <div class="col-12">
      @if(Session::has('message'))
      <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ ucfirst(Session::get('message')) }}</p>
      @endif
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Role Privilege</h4>
        </div>
        <div class="card-content ">
        {{ Form::model('Role_privilege', ['url' => ['admin/role/privilegesave'], 'method' => 'patch']) }}
          <div class="card-body card-dashboard table-responsive">
            <div class="form-group row">
              <label class="col-md-3 label-control" for="role_id">@lang('Role'): </label>
              <div class="col-md-9">
              {{ Form::select('role_id', App\Role::pluck('role','_id'), $role_id ?? null, array('id'=>'role_id','class' => 'form-control')) }}
              </div>
            </div>    
            
            <table class="table">
              <thead>
                <tr>
                  <th>Page</th>
                  <th>Browse</th>
                  <th>Edit</th>
                  <th>Add</th>
                  <th>Delete</th>
                  </tr>
              </thead>
              @foreach($item->pages as $key=>$val)
              <tr>
                <td>{{ $key }}</td>
                <td>{{ Form::checkbox($key.'[browse]',1, null, array('id'=>str_replace('/','_',$key).'_browse','class'=>'privchk form-control form-control-sm')) }}
                <td>{{ Form::checkbox($key.'[add]',1, null, array('id'=>str_replace('/','_',$key).'_edit','class'=>'privchk form-control form-control-sm')) }}
                <td>{{ Form::checkbox($key.'[edit]',1, null, array('id'=>str_replace('/','_',$key).'_add','class'=>'privchk form-control form-control-sm')) }}
                <td>{{ Form::checkbox($key.'[delete]',1, null, array('id'=>str_replace('/','_',$key).'_delete','class'=>'privchk form-control form-control-sm')) }}
              </tr>
              @endforeach
            </table>

            <div class="form-actions">
                <a class="pull-right" href="{{ url('/role') }}"><button type="button" class="btn btn-raised btn-warning mr-1">
                  <i class="ft-x"></i> Cancel
                </button></a>
                <button type="submit" class="pull-left btn btn-raised btn-primary">
                  <i class="fa fa-check-square-o"></i> Save
                </button>
              </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
        </section>
          </div>
        </div>
@endsection
@section('pagecss')
@endsection
@section('pagejs')
<script>
  $(document).ready(function() {
    $( "#role_id" ).change();  
  });
  $( "#role_id" ).change(function() {
    var opt = $("option:selected", this);
    var val = this.value;
    // load privilege for that role
    $.ajax({
      url: "{{ url('admin/role/privilegejson') }}"+'/'+val,
      type: 'GET',
      success: function(data) {
        // uncheck all/reset
        $(".privchk").prop("checked",false);
        // check based on data
        pages = data.pages;
        $.each(pages,function(item) {
          $("#"+item.replace('/','_')+"_browse").prop("checked",pages[item].browse);
          $("#"+item.replace('/','_')+"_edit").prop("checked",pages[item].edit);
          $("#"+item.replace('/','_')+"_add").prop("checked",pages[item].add);
          $("#"+item.replace('/','_')+"_delete").prop("checked",pages[item].delete);
        });
      }
    });
  });
</script>
@endsection
