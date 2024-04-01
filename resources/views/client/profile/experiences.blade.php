
<form id="create_exp" action="" method="post">
    @csrf
    <div class="form-group">
        <div class="d-flex justify-content-between border-bot">
            <div class="font-weight-bold h4" >Kinh nghiệm làm việc</div>
            <div id="block-kn" style="cursor: pointer;"><i class="fa fa-plus" aria-hidden="true"></i></div>
        </div>
        <div id="experiences" class="mt-3 border-bot form" style="display: none">
            @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
            <div class="form-group">
                <label for="">Tên công ty *</label>
                <input type="text" name="company_name" class="form-control">
                    <small class="val_company_name text-danger pl-4"></small>
            </div>
            <div class="form-group mt-3">
                <label for="">Vị trí *</label>
                <input type="text" name="work_position" class="form-control">
                <small class="val_position text-danger pl-4"></small>
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
                <div class="hide-button-kn btn btn-warning">Hủy</div>
                <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
            </div>
        </div>
    </div>
</form>

@if(!empty($experiences))
<div class="load">
    <div id="exp-full">
        <div id="list-experiences" class="list-experiences mt-3">
            @foreach($experiences as $exp)
            <div class="item_exp exp_div{{$exp->id}}">
                <form id="form-border{{$exp->id}}" class="delExp d-flex mt-3 border-dotted-bot" action="" method="get">
                    @csrf
                    <div style="width: 90%;" class="exp_pro mb-3" id="EditHide{{$exp->id}}">
                        <div class="h5">
                            Tên công ty: <span>{{$exp->company_name}}</span>
                        </div>
                        <div class="d-flex">
                            Bắt đầu / Kết thúc: {{date("m-Y", strtotime($exp->start_date))}} / @if($exp->end_date == null) Hiện tại @else {{date("m-Y", strtotime($exp->end_date))}} @endif
                        </div>
                        <div>
                            Vị trí: {{$exp->work_position}}
                        </div>
                        <div>
                            Mô tả: {{$exp->description}}
                        </div>
                    </div>
                    <div id="btnForm{{$exp->id}}" style="width: 10%;">
                        <button data-id-exp="{{$exp->id}}" class="removeExp" type="submit" style="float: right;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        <div onclick="EditFormId({{$exp->id}})" style="float: right;margin-right: 5px; cursor: pointer;"><i class="fas fa-edit"></i></div>
                        <div style="clear: both;"></div>
                    </div>
                </form>
    
                <form class="update_exp" action="" method="post">
                    @csrf
                    <div id="EditForm{{$exp->id}}" class="mt-3 mb-3 border-dotted-bot form" style="display: none;">
                        @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
                        <div class="form-group">
                            <label for="">Tên công ty *</label>
                            <input type="text" value="{{$exp->company_name}}" name="company_name" class="form-control">
                            <small class="val_company_name text-danger pl-4"></small>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Vị trí *</label>
                            <input type="text" value="{{$exp->work_position}}" name="work_position" class="form-control">
                            <small class="val_position text-danger pl-4"></small>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Bắt đầu *</label>
                            <input type="date" name="start_date" value="{{date("Y-m-d", strtotime($exp->start_date))}}" class="form-control" >
                            <small class="val_start_date text-danger pl-4"></small>
                        </div>
                        <div class="form-group mt-3">
                            <label for="">Kết thúc</label>
                            <input type="date" @if(!empty($exp->end_date)) value="{{date("Y-m-d", strtotime($exp->end_date))}}" @endif name="end_date" class="form-control">
                            <small class="text-red"><i>Ghi chú: Nếu không nhập kết thúc sẽ là hiện tại đang làm việc ở đây</i></small>
                        </div>
                       <div class="form-group mt-3">
                            <label for="">Mô tả *</label>
                            <textarea name="description" class="form-control" rows="3">{{$exp->description}}</textarea>
                            <small class="val_description text-danger pl-4"></small>
                            <small class="text-red"><i>Gợi ý: Mô tả công việc cụ thể, những kết quả và thành tựu đạt được có số liệu dẫn chứng</i></small>
                       </div>
                        <div class="d-flex mt-3 flex-row-reverse">
                            <div class="hide-button-exp{{$exp->id}} btn btn-warning">Hủy</div>
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
