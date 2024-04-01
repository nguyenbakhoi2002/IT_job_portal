<form action="" method="post">
    @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
    @csrf
    <div class="form-group">
        <div class="d-flex justify-content-between border-bot">
            <div class="font-weight-bold h4" >Chứng chỉ</div>
            <div id="block-cer" style="cursor: pointer;"><i class="fa fa-plus" aria-hidden="true"></i></div>
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