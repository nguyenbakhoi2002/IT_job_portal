
<form id="create_pj" action="" method="post">
    @csrf
    <div class="form-group">
        <div class="d-flex justify-content-between border-bot">
            <div class="font-weight-bold h4" ><i class="fa-solid fa-trophy"></i> Các dự án đã làm</div>
            <div class="d-flex justify-content-between align-items-center"  >
                <div class="modal fade" id="modal-pj" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" 
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
                                Dự án: <br>
        Bạn có thể liệt kê một số dự án nổi bật mà bạn đã tham gia<br>
        - Chỉ nên đề cập đến những chứng chỉ liên quan đến công việc bạn đang ứng tuyển hoặc những chứng chỉ có kĩ năng nổi bật.<br>
        - Hãy điền đầy đủ các thông tin như ngày bắt đầu và ngày hoàn thành.<br>
        - Bạn cũng có thể kể tên các chức năng, các kĩ năng đã sử dụng
                        
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <a class="btn-question" id="btn-modal-pj" data-bs-toggle="modal-pj" href="#exampleModalToggle" role="button"><i class="fa-solid fa-question"></i></a>
                <div id="block-pj" class="btn-themmoi" style=""><i class="fa fa-plus" aria-hidden="true"></i>Thêm mới</div>
            </div>
        </div>
        <div id="projects" class="mt-3 border-bot form" style="display: none">
            @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
            <div class="form-group">
                <label for="">Tên dự án *</label>
                <input type="text" name="name" class="form-control">
                    <small class="val_name text-danger pl-4"></small>
            </div>
            
            <div class="form-group mt-3">
                <label for="">Bắt đầu *</label>
                <input type="date" name="start_date" class="form-control" >
                <small class="val_start_date text-danger pl-4"></small>
            </div>
            <div class="form-group mt-3">
                <label for="">Kết thúc</label>
                <input type="date" name="end_date" class="form-control">
                <small class="text-red"><i>Ghi chú: Nếu không nhập kết thúc sẽ là hiện tại đang làm việc ở đây</i></small>
            </div>
           <div class="form-group mt-3">
                <label for="">Mô tả *</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
                <small class="val_description_exp text-danger pl-4"></small>
                <small class="text-red"><i>Gợi ý: Mô tả công việc cụ thể, những kết quả và thành tựu đạt được có số liệu dẫn chứng</i></small>
           </div>
            <div class="d-flex mt-3 flex-row-reverse">
                <div class="hide-button-pj btn btn-warning">Hủy</div>
                <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
            </div>
        </div>
    </div>
</form>

@if(!empty($projects))
<div class="load">
    <div id="exp-full">
        <div id="list-experiences" class="list-experiences mt-3">
            @foreach($projects as $pj)
            <div class="item_exp exp_div{{$pj->id}}">
                <form id="form-border-pj{{$pj->id}}" class="delExp d-flex mt-3 border-dotted-bot" action="" method="get">
                    @csrf
                    <div style="width: 90%;" class="exp_pro mb-3" id="EditHidePj{{$pj->id}}">
                        <div class="h5">
                            Tên dự án : <span>{{$pj->name}}</span>
                        </div>
                        <div class="d-flex">
                            Bắt đầu: {{date("m-Y", strtotime($pj->start_date))}}  
                        </div>
                        <div class="d-flex">
                            Kết thúc:@if($pj->end_date == null) Hiện tại @else {{date("m-Y", strtotime($pj->end_date))}} @endif
                        </div>
                        <div>
                            Mô tả: {{$pj->description}}    
                        </div>
                    </div>
                    <div id="btnFormPj{{$pj->id}}" style="width: 10%;">
                        <button data-id-exp="{{$pj->id}}" class="removeExp" type="submit" style="float: right;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        <div onclick="EditFormProjectId({{$pj->id}})" style="float: right;margin-right: 5px; cursor: pointer;"><i class="fas fa-edit"></i></div>
                        <div style="clear: both;"></div>
                    </div>
                </form>
    
                <form class="update_exp" action="" method="post">
                    @csrf
                    <div id="EditFormPj{{$pj->id}}" class="mt-3 mb-3 border-dotted-bot form" style="display: none;">
                        @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
                        <div class="form-group">
                            <label for="">Tên dự án *</label>
                            <input type="text" value="{{$pj->name}}" name="company_name" class="form-control">
                            <small class="val_company_name text-danger pl-4"></small>
                        </div>
                        
                        <div class="form-group mt-3">
                            <label for="">Bắt đầu *</label>
                            <input type="date" name="start_date" value="{{date("Y-m-d", strtotime($pj->start_date))}}" class="form-control" >
                            <small class="val_start_date text-danger pl-4"></small>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Kết thúc</label>
                            <input type="date" @if(!empty($pj->end_date)) value="{{date("Y-m-d", strtotime($pj->end_date))}}" @endif name="end_date" class="form-control">
                            <small class="text-red"><i>Ghi chú: Nếu không nhập kết thúc sẽ là hiện tại đang làm việc ở đây</i></small>
                        </div>
                       <div class="form-group mt-3">
                            <label for="">Mô tả *</label>
                            <textarea name="description" class="form-control" rows="3">{{$pj->description}}</textarea>
                            <small class="val_description text-danger pl-4"></small>
                            <small class="text-red"><i>Gợi ý: Mô tả công việc cụ thể, những kết quả và thành tựu đạt được có số liệu dẫn chứng</i></small>
                       </div>
                        <div class="d-flex mt-3 flex-row-reverse">
                            <div class="hide-button-pj{{$pj->id}} btn btn-warning">Hủy</div>
                            <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>

            @endforeach
        </div>
    </div>
</div>
@endif
