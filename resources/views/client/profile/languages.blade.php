{{-- @dd($skillActive) --}}
<form id="create_lg" action="{{route('updateCv.createLanguage')}}" method="post" enctype="multipart/form-data">
    @if(!empty($seeker)) <input type="hidden" name="seeker_profile_id" value="{{$seeker->id}}"> @endif
    {{-- @if(!empty($list_language)) <input type="hidden" name="id" value="{{$seeker->id}}"> @endif --}}
    @csrf
    <div class="form-group">
        <div class="d-flex justify-content-between border-bot">
            <div class="font-weight-bold h4" ><i class="fa-solid fa-language"></i></i> Ngôn ngữ</div>
            <div class="d-flex justify-content-between align-items-center"  >
                <div class="modal fade" id="modal-lg" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" 
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
                                                                Ngôn ngữ: bạn nên lựa chọn các ngôn ngữ mà bạn có thể sử dụng, hoặc nổi bật
                                        
                                                          </div>
                                                          
                                                        </div>
                                                      </div>
                                                      </div>
                                                      <a class="btn-question" id="btn-modal-lg" data-bs-toggle="modal-lg" href="#exampleModalToggle" role="button"><i class="fa-solid fa-question"></i></a>
            {{-- <div id="block-sk" style="cursor: pointer; margin-left:12px"><i class="fas fa-edit"></i></div> --}}
                <div id="block-lg" class="btn-themmoi" style=""><i class="fa fa-plus" aria-hidden="true"></i>Thêm mới</div>
                
            </div>
        </div>
        <div id="languages" class="mt-3" style="display: none">
            <div class="form-group">
                <label for="">Ngoại ngữ *</label>
                <select name="language_id" class="form-select">
                    <option value="">-- Chọn</option>
                    @foreach($languages as $language)
                        <option value="{{$language->id}}">{{$language->name}}</option>
                    @endforeach
                </select>
                <small class="val_language_id text-danger pl-4"></small>
            </div>
            <div class="form-group mt-3">
                <label>Trình độ ngoại ngữ </label>
                <select class="form-select" name="level">
                    <option value="">-- Chọn</option>
                    @foreach (config('custom.language_level') as $value)
                        <option value="{{ $value['id']}}" {{ old('language_level') == $value['id'] ? 'selected' : '' }}>{{ $value['name']}}</option>
                    @endforeach
                </select>
                <small class="val_language_level text-danger pl-4"></small>
            </div>
            
            
            
           <div class="form-group mt-3">
                <label for="certificate">Chứng chỉ (nếu không có ghi "không có") *</label>
                <input name="certificate" class="form-control" rows="3"></input>
                <small class="val_language_cer text-danger pl-4"></small><br>
                <small class="text-red"><i>Gợi ý: chứng chỉ ngoại ngữ của bạn VD:tiếng anh của bạn(ielts, toeic hay A0, A1, ...)</i></small>
           </div>
            <div class="d-flex mt-3 flex-row-reverse">
                <div class="hide-button-lg btn btn-warning">Hủy</div>
                <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
            </div>
        </div>
    </div>
</form>
@if(!empty($list_language))
    
    <div class="list-educations mt-3">
        @foreach($list_language as $language)
        <div class="lg_div{{$language->id}}">
            <form id="form-border-lg{{$language->id}}" class="delLg d-flex mt-3 border-dotted-bot" action="" method="get">
                <div style="width: 90%;" class="mb-3" id="EditHideLg{{$language->id}}">
                    <div class="h5">
                        Ngôn ngữ: <span>{{$language->language->name}}</span>
                    </div>
                    <div class="d-flex">
                        Trình độ : 
                        @foreach(config('custom.language_level') as $value)
                            @if($value['id'] == $language->level)
                                {{ $value['name'] }}
                            @endif
                        @endforeach
                    </div>
                    <div>
                        chứng chỉ: {{$language->certificate}}
                    </div>
                </div>
                <div id="btnFormLg{{$language->id}}" style="width: 10%;">
                    <button data-id-edu="{{$language->id}}" class="removeEdu" type="submit" style="float: right;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    <div onclick="EditFormLanguageId({{$language->id}})" style="float: right;margin-right: 5px; cursor: pointer;"><i class="fas fa-edit"></i></div>
                    <div style="clear: both;"></div>
                </div>
            </form>

            <form class="update_lg" action="{{route('updateCv.updateLanguage', $language->id)}}" method="post">
                @csrf
                <div id="EditFormLg{{$language->id}}" class="mt-3 mb-3 border-dotted-bot form" style="display: none;">
                    @if(!empty($seeker)) <input type="hidden" name="seeker_profile_id" value="{{$seeker->id}}"> @endif
                    <div class="form-group">
                        <label for="">Ngôn ngữ: *</label>
                        <select class="chosen-select" name="language_id">
                            @foreach ($languages as $value)
                                <option value="{{ $value['id']}}" 
                                {{ old('language_id') ? (old('language_id') == $value['id'] ? 'selected' : '') : ($language->language->id == $value['id'] ? 'selected' : '') }}
                                {{-- {{ old('language_level') == $value['id'] ? 'selected' : '' }} --}}
                                >{{ $value['name']}}</option>
                            @endforeach
                        </select>
                        <small class="val_language_id text-danger pl-4"></small>

                    </div>
                    <div class="form-group mt-3">
                        <label>Trình độ ngoại ngữ </label>
                        <select class="chosen-select" name="level">
                            @foreach (config('custom.language_level') as $value)
                                <option value="{{ $value['id']}}" 
                                {{ old('level') ? (old('level') == $value['id'] ? 'selected' : '') : ($language->level == $value['id'] ? 'selected' : '') }}
                                {{-- {{ old('language_level') == $value['id'] ? 'selected' : '' }} --}}
                                >{{ $value['name']}}</option>
                            @endforeach
                        </select>
                        <small class="val_language_level text-danger pl-4"></small>

                    </div>
                    
                   <div class="form-group mt-3">
                        <label for="">Chứng chỉ *</label>
                        <input type="text" name="certificate" class="form-control" rows="3" value="{{$language->certificate}}">
                        <small class="val_language_cer text-danger pl-4"></small><br>

                        <small class="text-red"><i>Gợi ý: chứng chỉ ngoại ngữ</i></small>
                   </div>
                    <div class="d-flex mt-3 flex-row-reverse">
                        <div class="hide-button-lg{{$language->id}} btn btn-warning">Hủy</div>
                        <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Lưu</button>
                    </div>
                </div>
            </form>
        </div>

        @endforeach
    </div>
@endif


