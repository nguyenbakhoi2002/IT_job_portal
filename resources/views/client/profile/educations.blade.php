
<form action="" method="post">
    @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
    @csrf
    <div class="form-group">
        <div class="d-flex justify-content-between border-bot">
            <div class="font-weight-bold h4" >Học vấn</div>
            <div id="block-edu" style="cursor: pointer;"><i class="fa fa-plus" aria-hidden="true"></i></div>
        </div>
        <div id="educations" class="mt-3" style="display: none">
            <div class="form-group">
                <label for="">Tên trường *</label>
                <input type="text" name="name_education" class="form-control">
                @error('name_education')
                    <small class="text-danger pl-4">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="">Chuyên ngành</label>
                <select name="major_id" class="form-select">
                    <option value="">-- Chọn</option>
                    @foreach($maJor as $mj)
                        <option value="{{$mj->id}}">{{$mj->name}}</option>
                    @endforeach
                </select>
                @error('major_id')
                    <small class="text-danger pl-4">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="">Bắt đầu *</label>
                <input type="date" name="start_date" class="form-control">
                @error('start_date')
                    <small class="text-danger pl-4">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-group mt-3">
                <label for="">Kết thúc</label>
                <input type="date" name="end_date" class="form-control">
                <small class="text-red"><i>Ghi chú: Nếu không nhập kết thúc sẽ là hiện tại đang học ở đây</i></small>
            </div>
            <div class="form-group">
                <label for="">Điểm trung bình</label>
                <input type="number" max="10" name="gpa" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Loại bằng</label>
                <select class="form-select" name="type_degree">
                    @foreach ($degrees as $degree)
                        <option value="{{ $degree->id}}">{{ $degree->name}}</option>
                    @endforeach
                </select>
            </div>
           <div class="form-group mt-3">
                <label for="">Mô tả học vấn *</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
                @error('description')
                    <small class="text-danger pl-4">
                        {{ $message }}
                    </small>
                    <br>
                @enderror
                <small class="text-red"><i>Gợi ý: Mô tả ngành học và kiến thức</i></small>
           </div>
            <div class="d-flex mt-3 flex-row-reverse">
                <div class="hide-button-edu btn btn-warning">Hủy</div>
                <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
            </div>
        </div>
    </div>
</form>
@if(!empty($educations))
    
    <div class="list-educations mt-3">
        @foreach($educations as $edu)
        <div class="edu_div{{$edu->id}}">
            <form id="form-border-edu{{$edu->id}}" class="delEdu d-flex mt-3 border-dotted-bot" action="" method="get">
                <div style="width: 90%;" class="mb-3" id="EditHideEdu{{$edu->id}}">
                    <div class="h5">
                        Tên trường: <span>{{$edu->school_name}}</span>
                    </div>
                    <div class="d-flex">
                        Bắt đầu / Kết thúc: {{date("m-Y", strtotime($edu->start_date))}} / @if($edu->end_date == null) Hiện tại @else {{date("m-Y", strtotime($edu->end_date))}} @endif
                    </div>
                    <div>
                        @if(!empty($edu->major_id))
                            @foreach($maJor as $mjE)
                                @if($edu->major_id == $mjE->id)
                                Chuyên ngành: {{$mjE->name}}
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <div>
                        @if(!empty($edu->type_degree))
                        Loại bằng: {{$edu->type_degree}}
                        @endif
                    </div>
                    <div>
                        @if(!empty($edu->gpa))
                        Điểm trung bình: {{$edu->gpa}}
                        @endif
                    </div>
                    <div>
                        Mô tả: {{$edu->description}}
                    </div>
                </div>
                <div id="btnFormEdu{{$edu->id}}" style="width: 10%;">
                    <button data-id-edu="{{$edu->id}}" class="removeEdu" type="submit" style="float: right;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    <div onclick="EditFormEduEduId({{$edu->id}})" style="float: right;margin-right: 5px; cursor: pointer;"><i class="fas fa-edit"></i></div>
                    <div style="clear: both;"></div>
                </div>
            </form>

            <form action="" method="post">
                @csrf
                <div id="EditFormEdu{{$edu->id}}" class="mt-3 mb-3 border-dotted-bot form" style="display: none;">
                    @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
                    <div class="form-group">
                        <label for="">Tên trường *</label>
                        <input type="text" name="school_name" value="{{$edu->school_name}}" class="form-control">
                        @error('school_name')
                            <small class="text-danger pl-4">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Chuyên ngành</label>
                        <select name="major_id" class="form-select">
                            <option value="">-- Chọn</option>
                            @foreach($maJor as $mj)
                            <option @if(!empty($seeker)) @if($edu->major_id == $mj->id) selected @endif @endif value="{{$mj->id}}">{{$mj->name}}</option>
                            @endforeach
                        </select>
                        @error('major_id')
                            <small class="text-danger pl-4">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Bắt đầu *</label>
                        <input type="date" value="{{date("Y-m-d", strtotime($edu->start_date))}}" name="start_date" class="form-control">
                        @error('start_date')
                            <small class="text-danger pl-4">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Kết thúc</label>
                        <input type="date" @if(!empty($edu->end_date)) value="{{date("Y-m-d", strtotime($edu->end_date))}}" @endif name="end_date" class="form-control">
                        <small class="text-red"><i>Ghi chú: Nếu không nhập kết thúc sẽ là hiện tại đang học ở đây</i></small>
                    </div>
                    <div class="form-group">
                        <label for="">Điểm trung bình</label>
                        <input type="number" max="10" value="{{$edu->gpa}}" name="gpa" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Loại bằng</label>
                        <select class="form-select" name="type_degree">
                            @foreach ($degrees as $degree)
                                <option 
                                @if(!empty($edu->degree_id))
                                @if($edu->degree_id == $degree->id)
                                selected
                                @endif
                                @endif
                                value="{{ $degree->id}}">
                                    {{ $degree->name}}
                                </option>
                            @endforeach
                        </select>
                        
                    </div>
                   <div class="form-group mt-3">
                        <label for="">Mô tả học vấn *</label>
                        <textarea name="description" class="form-control" rows="3">{{$edu->description}}</textarea>
                        @error('description')
                            <small class="text-danger pl-4">
                                {{ $message }}
                            </small>
                            <br>
                        @enderror
                        <small class="text-red"><i>Gợi ý: Mô tả ngành học và kiến thức</i></small>
                   </div>
                    <div class="d-flex mt-3 flex-row-reverse">
                        <div class="hide-button-exp{{$edu->id}} btn btn-warning">Hủy</div>
                        <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
                    </div>
                </div>
            </form>
        </div>

        @endforeach
    </div>
@endif
