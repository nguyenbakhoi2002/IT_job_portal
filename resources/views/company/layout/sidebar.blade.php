<div class="user-sidebar">
    <div class="sidebar-inner">
      <ul class="navigation">
        @foreach (config('route.company.sidebar') as $key => $value )
            <li class=""><a href=""> <i class="{{$value['icon']}}"></i>{{$value['title']}}</a></li>
        @endforeach
      </ul>
    </div>
  </div>