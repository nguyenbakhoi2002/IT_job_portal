@extends('admin.layout.app')
@section('title')
    {{ __('Major') }}
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
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>
              <form action="" class="form-inline float-right mr-3">
                <div class="form-group">
                    <input class="form-control" name="key" id="key" placeholder="Nhập tên chuyên ngành ....">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            </div>
            <a href="{{route('admin.major.trash')}}" class="btn btn-primary mt-4 mx-4" style="width: 150px">thùng rác <i class="fa fa-trash"></i></a>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                <tr>
                  <th>STT</th>
                  <th>{{__('Tên kỹ năng')}}</th>
                  <th>{{__('Mô tả')}}</th>
                  <th><a href="{{route('admin.major.create')}}"><i class="fa fa-plus"></i></a></th>
                </tr>
                </thead>
                <tbody>
                    @forelse($majors as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td class="project-actions xoa text-right d-flex align-items-center">
                            <a class="btn btn-info mr-3" href="{{route('admin.major.edit', $item)}}">
                              <i class="fa fa-edit"></i>
                            </a>

                            <form action="{{route('admin.major.destroy', $item)}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </form>
                            {{-- <button data-id="{{$item->id}}" class="btn btn-danger btn-delete"><i class="fa fa-trash"></i></button> --}}
                        </td>
                    </tr>
                    @empty
                      <tr>
                        <td colspan="4">Chưa có chuyên ngành nào</td>
                      </tr>
                    @endforelse
                </tbody>
              </table>
              <div>
                {{ $majors->appends(request()->all())->links() }}
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