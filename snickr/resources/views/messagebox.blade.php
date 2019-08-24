@if($message <> NULL)
  @foreach($message as $m)
  <a class="list-group-item list-group-item-action" href="#">
    <div class="media">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/45x45" alt="">
      <div class="media-body">
        <strong>{{$m->name}}</strong> {{$m->mtimedate}}
        <!--strong>David Miller Website</strong-->.
        <div class="text-muted smaller">{{$m->content}}</div>
      </div>
    </div>
  </a>
  @endforeach
@endif