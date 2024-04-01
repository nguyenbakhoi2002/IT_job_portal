{{-- @dd($skillActive) --}}
<form id="formSkill" action="" method="post" enctype="multipart/form-data">
    @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
    @if(!empty($list_skill)) <input type="hidden" name="id" value="{{$seeker->id}}"> @endif
    @csrf
    <div class="form-group">
        <div class="d-flex justify-content-between border-bot">
            <div class="font-weight-bold h4" >Kỹ năng</div>
            <div id="block-sk" style="cursor: pointer;"><i class="fas fa-edit"></i></div>
        </div>
        <div id="skills" class="mt-3" >
            <div class="form-group col-lg-12 col-md-12">
                <select data-placeholder="Chọn ... " class="chosen-select" name="skill_id[]" multiple>
                    @foreach($skills as $sk)
                        <option 
                        @if(in_array($sk->id, $skillActive))
                        selected
                        @endif
                        value="{{$sk->id}}">
                        {{$sk->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex mt-3 flex-row-reverse">
                <div class="hide-button-sk btn btn-warning">Hủy</div>
                <a class="btn btn-danger" href="" style="margin-right: 5px;">Xóa tất cả</a>
                <button type="submit" id="saveSkill" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
            </div>
        </div>
    </div>
</form>

