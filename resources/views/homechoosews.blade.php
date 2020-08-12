@if(count($ws) > 0)
  @foreach($ws as $wsi)
  <div class="row row-centered col col-centered">
    <div class="card text-center mx-auto bg-light border-primary m-4 w-75" style="background-image:url('/img/bg.jpg')">
      <div class="card-body">
        <h5 class="card-title text-secondary">{{$wsi->wname}}</h5>
        <a href="{{action('HomeController@index',['wsid'=>$wsi->wid,'wsname'=>$wsi->wname, 'default'=>-1])}}" class="btn btn-secondary">Go to this workspace</a>
        <p class="card-text"></p>
      </div>
    </div>
  </div>
  @endforeach
@endif
