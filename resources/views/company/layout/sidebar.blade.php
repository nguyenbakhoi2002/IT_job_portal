
<div class="user-sidebar">
    <div class="sidebar-inner">
      <ul class="navigation">
        @foreach (config('route.company.sidebar') as $key => $value )
        @if ($key=='post')
            <li class="{{isset($activeRoute) ? ($key==$activeRoute ? 'active' : '') : ''}}"><a href="#" class="parent-link"> <i class="{{$value['icon']}}"></i>Các bài đăng</a>
              <ul class="navigation-pr" style="margin-left: 20px">
                <li class=""><a href="{{route('company.post.index')}}"> <i class="{{$value['icon']}}"></i>Đang hoạt động</a></li>
                <li class=""><a href="{{route('company.postCreated')}}"> <i class="{{$value['icon']}}"></i>Chưa xét duyệt</a></li>
                <li class=""><a href="{{route('company.postExpired')}}"> <i class="{{$value['icon']}}"></i>Đã hết hạn</a></li>
              </ul>
            </li>
            @else
              <li class="{{isset($activeRoute) ? ($key==$activeRoute ? 'active' : '') : ''}}"><a href="{{route($value['route'])}}"> <i class="{{$value['icon']}}"></i>{{$value['title']}}</a></li>
            @endif
            
        @endforeach
        
      </ul>
    </div>
  </div>
  