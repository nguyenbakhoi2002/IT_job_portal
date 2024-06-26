@extends('admin.layout.app')
@section('title')
    Admin-Trash
@endsection

@section('content')
<section class="content">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="card">
            {{-- <a href="" class="dark"><i class="fa-solid fa-arrow-left"> Quay lại</i></a> --}}

            <div class="card-header">
              <h3 class="card-title"><a href="{{route('admin.admin.index')}}" class="" style="margin-right:10px"><i class="fa-solid fa-arrow-left"></i></i></a>   {{$title}}</h3>
              <form action="" class="form-inline float-right mr-3">
                <div class="form-group">
                    <input class="form-control" name="key" id="key" placeholder="Nhập tên kỹ năng ....">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>Email</th>
                  <th>Thông tin tài khoản</th>
                  <th>Loại tài khoản</th>
                  <th>Lựa chọn</th>
                  {{-- <th><a href="{{route('admin.admin.create')}}"><i class="fa fa-plus"></i></a></th> --}}
                </tr>
                </thead>
                <tbody>
                    @forelse($admins as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->email}}</td>
                      <td>
                        <div>Tên: {{$item->name}}</div>
                        <div>Số điện thoại: {{$item->phone}}</div>
                        <div>Địa chỉ: {{$item->address}}</div>
                      </td>
                      <td>
                        @if ($item->type == 1)
                            Admin
                        @else
                            Nhân viên
                        @endif
                      </td>
                        <td class="project-actions xoa text-right d-flex align-items-center">
                            <a href="{{route('admin.admin.restore', $item->id)}}" class="btn btn-success">Khôi phục</a>
                            <a href="{{route('admin.admin.forceDelete', $item->id)}}" onclick="return confirm('Bạn có chắn chắn muốn xóa')" class="btn btn-danger mx-3">Xóa</a>
                            
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4">Thùng rác trống</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
              <div>
                {{ $admins->links() }}
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
@endsection
@section('script')
@parent
{{-- <script src="{{asset('js/admin/candidate.js')}}"></script> --}}
@endsection