@if(!empty($data))
<div class="card mb-3">
  <div class="card-header">
    <i class="fa fa-table"></i> User Information</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Position</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Position</th>
        </tr>
        </tfoot>
        <tbody>
        <!-- One user#####################################################################################-->
        @foreach($data as $d)
        <tr>
          <td>{{$d->name}}</td>
          <td>{{$d->email}}</td>
          @if($d->adminflag === 1)
            <td>admin</td>
          @else
            <td>normal</td>
          @endif

        </tr>
        @endforeach
        <!-- One user end##################################################################################-->

        </tbody>
      </table>
    </div>
  </div>
</div>
@endif