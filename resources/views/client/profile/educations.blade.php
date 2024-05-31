
<form id="create_edu" action="{{route('updateCv.createEducation')}}" method="post">
    @if(!empty($seeker)) <input type="hidden" name="seeker_profile_id" value="{{$seeker->id}}"> @endif
    @csrf
    <div class="form-group">
        <div class="d-flex justify-content-between border-bot">
            <div class="font-weight-bold h4" ><i class="fa-solid fa-graduation-cap"></i> Học vấn</div>
            <div class="d-flex justify-content-between align-items-center"  >
                <div class="modal fade" id="modal-edu" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" 
                    style="left: 50%;
                    transform: translateX(-50%);"
                >
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel"><i class="fa-solid fa-lightbulb"></i> Để CV không chỉ Hay mà còn Đẹp trong mắt Nhà tuyển dụng</h5>

                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Học vấn: <br>
    - Hãy nêu ra những bậc học đạt được như cao đẳng, đại học, thạc sĩ,... <br>
    - Bạn cũng có thể kể thêm những khóa học ngắn hạn, khóa đào tạo chuyên nghiệp (có phí) mà bạn đã từng được học. <br>
    - Lưu ý chọn lọc những khóa học liên quan đến công việc mà bạn ứng tuyển thôi nhé
                        
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <a class="btn-question" id="btn-modal-edu" data-bs-toggle="modal-edu" href="#exampleModalToggle" role="button"><i class="fa-solid fa-question"></i></a>
                <div id="block-edu" class="btn-themmoi" style=""><i class="fa fa-plus" aria-hidden="true"></i>Thêm mới</div>
            </div>
        </div>
        <div id="educations" class="mt-3" style="display: none">
            <div class="form-group">
                <label for="">Tên trường *</label>
                <input type="text" name="school_name" class="form-control">
                <small class="val_school_name text-danger pl-4"></small>
            </div>
            <div class="form-group">
                <label for="">Loại bằng</label>
                <select class="form-select" name="degree_id">
                    <option value="">-- Chọn</option>
                    @foreach ($degrees as $degree)
                        <option value="{{ $degree->id}}">{{ $degree->name}}</option>
                    @endforeach
                </select>
                <small class="val_degree_id text-danger pl-4"></small>
            </div>
            <div class="form-group mt-3">
                <label for="">Chuyên ngành</label>
                <select name="major_id" class="form-select">
                    <option value="">-- Chọn</option>
                    @foreach($maJor as $mj)
                        <option value="{{$mj->id}}">{{$mj->name}}</option>
                    @endforeach
                </select>
                <small class="val_major_id text-danger pl-4"></small>
            </div>
            <div class="form-group mt-3">
                <label for="">Bắt đầu *</label>
                <input type="date" name="start_date" class="form-control">
                <small class="val_start_date_edu text-danger pl-4"></small>
            </div>
            <div class="form-group mt-3">
                <label for="">Kết thúc</label>
                <input type="date" name="end_date" class="form-control">
                <small class="val_end_date_edu text-danger pl-4"></small><br>
                <small class="text-red"><i>Ghi chú: Nếu không nhập kết thúc sẽ là hiện tại đang học ở đây</i></small>
            </div>
           
            
           <div class="form-group mt-3">
                <label for="">Mô tả học vấn *</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
                <small class="val_description_edu text-danger pl-4"></small><br>
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
            <form id="form-border-edu{{$edu->id}}" class="delEdu d-flex mt-3 border-dotted-bot" action="{{route('updateCv.deleteEducation',$edu->id)}}" method="get">
                @csrf
                <div style="width: 90%;" class="mb-3" id="EditHideEdu{{$edu->id}}">
                    <div class="h5">
                        Tên trường: <span>{{$edu->school_name}}</span>
                    </div>
                    <div class="h6">
                        Chuyên ngành: <span>{{$edu->major->name}}</span>
                    </div>
                    <div class="h6">
                        Bằng: <span>{{$edu->degree->name}}</span>
                    </div>
                    <div class="d-flex">
                        Từ {{date("m-Y", strtotime($edu->start_date))}} đến @if($edu->end_date == null) Hiện tại @else {{date("m-Y", strtotime($edu->end_date))}} @endif
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

            <form class="update_edu" action="{{route('updateCv.updateEducation', $edu->id)}}" method="post">
                @csrf
                <div id="EditFormEdu{{$edu->id}}" class="mt-3 mb-3 border-dotted-bot form" style="display: none;">
                    @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
                    <div class="form-group">
                        <label for="">Tên trường *</label>
                        <input type="text" name="school_name" value="{{$edu->school_name}}" class="form-control">
                        <small class="val_school_name text-danger pl-4"></small>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Chuyên ngành</label>
                        <select name="major_id" class="form-select">
                            <option value="">-- Chọn</option>
                            @foreach($maJor as $mj)
                            <option @if(!empty($seeker)) @if($edu->major_id == $mj->id) selected @endif @endif value="{{$mj->id}}">{{$mj->name}}</option>
                            @endforeach
                        </select>
                        <small class="val_major_id text-danger pl-4"></small>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Bắt đầu *</label>
                        <input type="date" value="{{date("Y-m-d", strtotime($edu->start_date))}}" name="start_date" class="form-control">
                        <small class="val_start_date_edu text-danger pl-4"></small>
                    </div>
                    <div class="form-group mt-3">
                        <label for="">Kết thúc</label>
                        <input type="date" @if(!empty($edu->end_date)) value="{{date("Y-m-d", strtotime($edu->end_date))}}" @endif name="end_date" class="form-control">
                        <small class="val_end_date_edu text-danger pl-4"></small><br>
                        <small class="text-red"><i>Ghi chú: Nếu không nhập kết thúc sẽ là hiện tại đang học ở đây</i></small>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="">Loại bằng</label>
                        <select class="form-select" name="degree_id">
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
                        <small class="val_degree_id text-danger pl-4"></small>
                    </div>
                   <div class="form-group mt-3">
                        <label for="">Mô tả học vấn *</label>
                        <textarea name="description" class="form-control" rows="3">{{$edu->description}}</textarea>
                        <small class="val_description_edu text-danger pl-4"></small>  
                        <small class="text-red"><i>Gợi ý: Mô tả ngành học và kiến thức</i></small>
                   </div>
                    <div class="d-flex mt-3 flex-row-reverse">
                        <div class="hide-button-edu{{$edu->id}} btn btn-warning">Hủy</div>
                        <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
                    </div>
                </div>
            </form>
        </div>

        @endforeach
    </div>
@endif
