<form action="" method="post">
    @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
    @csrf
    <div class="form-group">
        <div class="d-flex justify-content-between border-bot">
            <div class="font-weight-bold h4" >Chứng chỉ</div>
            <div class="d-flex justify-content-between align-items-center"  >
                <div class="modal fade" id="modal-cer" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" 
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
                                Chứng chỉ khác: <br>
        Bạn có thể chọn hiển thị hoặc không hiển thị mục này trên CV<br>
        - Chỉ nên đề cập đến những chứng chỉ liên quan đến công việc bạn đang ứng tuyển hoặc những chứng chỉ có kĩ năng nổi bật.<br>
        - Hãy điền đầy đủ các thông tin như ngày hoàn thành, tổ chức cấp.<br>
        - Bạn cũng có thể kể tên các hội thảo, hội nghị có uy tín mà bạn đã từng được tham dự
                        
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <a class="btn-question" id="btn-modal-cer" data-bs-toggle="modal-cer" href="#exampleModalToggle" role="button"><i class="fa-solid fa-question"></i></a>
                <div id="block-cer" class="btn-themmoi" style=""><i class="fa fa-plus" aria-hidden="true"></i>Thêm mới</div>
            </div>
        </div>
        <div id="certificates" class="mt-3" style="display: none">
            <div class="form-group">
                <label for="">Tên chứng chỉ *</label>
                <input type="text" name="name" class="form-control">
                @error('name')
                    <small class="text-danger pl-4">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Thời gian *</label>
                <input type="text" name="time" class="form-control">
                @error('time')
                    <small class="text-danger pl-4">
                        {{ $message }}
                    </small>
                @enderror
            </div>
            <div class="d-flex mt-3 flex-row-reverse">
                <div class="hide-button-cer btn btn-warning">Hủy</div>
                <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
            </div>
        </div>
    </div>
</form>

@if(!empty($certificates))
        
<div class="list-certificates mt-3">
    @foreach($certificates as $cer)
    <div class="cer_div{{$cer->id}}">
        <form id="form-border-cer{{$cer->id}}" class="delCer d-flex mt-3 border-dotted-bot" action="{{route('deleteCertificate', ['id' => $cer->id])}}" method="get">
            <div style="width: 90%;" class="mb-3" id="EditHideCer{{$cer->id}}">
                <div class="h5">
                    Chứng chỉ: <span>{{$cer->name}}</span>
                </div>
                <div>
                    Thời gian: <span>{{$cer->time}}</span>
                </div>
            </div>
            <div id="btnFormCer{{$cer->id}}" style="width: 10%;">
                <button data-id-cer="{{$cer->id}}" class="removeCer" type="submit" style="float: right;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                <div onclick="EditFormCerId({{$cer->id}})" style="float: right;margin-right: 5px; cursor: pointer;"><i class="fas fa-edit"></i></div>
                <div style="clear: both;"></div>
            </div>
        </form>
    
        <form action="{{route('updateCertificate', ['id' => $cer->id])}}" method="post">
            @csrf
            <div id="EditFormCer{{$cer->id}}" class="mt-3 mb-3 border-dotted-bot form" style="display: none;">
                @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
                <div class="form-group">
                    <label for="">Tên chứng chỉ *</label>
                    <input type="text" name="name" value="{{$cer->name}}" class="form-control">
                    @error('name')
                        <small class="text-danger pl-4">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Thời gian*</label>
                    <input type="text" name="time" value="{{$cer->time}}" class="form-control">
                    @error('time')
                        <small class="text-danger pl-4">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="d-flex mt-3 flex-row-reverse">
                    <div class="hide-button-cer{{$cer->id}} btn btn-warning">Hủy</div>
                    <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
                </div>
            </div>
        </form>
    </div>

    @endforeach
</div>
@endif