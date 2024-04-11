{{-- @dd($skillActive) --}}
<form id="formSkill" action="" method="post" enctype="multipart/form-data">
    @if(!empty($seeker)) <input type="hidden" name="seeker_id" value="{{$seeker->id}}"> @endif
    @if(!empty($list_skill)) <input type="hidden" name="id" value="{{$seeker->id}}"> @endif
    @csrf
    <div class="form-group">
        <div class="d-flex justify-content-between border-bot">
            <div class="font-weight-bold h4" ><i class="fa-solid fa-pen"></i> Kỹ năng</div>
            <div class="d-flex justify-content-between align-items-center"  >
                <div class="modal fade" id="modal-sk" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" 
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
                                                                Skill: bạn nên lựa chọn tất cả kĩ năng của bạn
                                        
                                                          </div>
                                                          
                                                        </div>
                                                      </div>
                                                      </div>
                                                      <a class="btn-question" id="btn-modal-sk" data-bs-toggle="modal-sk" href="#exampleModalToggle" role="button"><i class="fa-solid fa-question"></i></a>
            <div id="block-sk" style="cursor: pointer; margin-left:12px"><i class="fas fa-edit"></i></div>
                
            </div>
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

