<!-- @format -->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
		<link rel="stylesheet" href="{{asset('css/profile_new.css')}}">
		<title>Profile-{{$seeker_profile->name}}</title>
        <style>
            
  /* tự thêm  */
            .wrapper{
                max-width: 1000px;
                margin: auto;
                border: 1px solid #333;
            }
            .description-content ul {
                padding: 0 20px;
            }
            .img-container{
                width: 100px;
                height: 100px;
                border-radius: 50%;
                padding: 0px;
                margin-left: 30px;
            }
            .tag-content{
                padding: 0 10px;
            }
            .tag-content ul li i{
                margin-right: 8px;
            }
            .text-objective{
                padding: 0px 40px
            }
            .progress-title{
                font-size: 16px;
            }
            .level{
                margin-top: 4px;
                font-size: 12px;
            }
            .img-container {
                width: 200px;
                height: 200px;
            }
            .img, .avatar {
                width: 200px;
                height: 200px;
            }
            header{
                height: 200px;
            }
        </style>
	</head>

	<body>
        <div class="wrapper">
            <header>
                <div class="img-container">
                    <img src="{{asset('uploads/images/candidate/'. $seeker_profile->image)}}" alt="" class="img avatar" />
                </div>
                <div class="title-container">
                    <h1>{{$seeker_profile->name}}</h1>
                    <h2>{{$seeker_profile->title}}</h2>
                </div>
            </header>
    
            <div class="container">
                <div class="sider">
                    <div class="sider-content">
                        <h1 class="tag-fill">Thông tin cơ bản</h1>
                        <div class="tag-content">
                            <ul>
                                <li><i class="fa-solid fa-calendar-days"></i>{{$seeker_profile->date_of_birth?$seeker_profile->date_of_birth:''}}</li>
                                <li><i class="fa-regular fa-user"></i>{{$seeker_profile->gender?$seeker_profile->gender:''}}</li>
                                @if ($seeker_profile->candidate->job_search_function == 0)
                                    <li><i class="fa-solid fa-phone"></i><span style="color:red">Thông tin bị ẩn</span></li>
                                    <li><i class="fa-regular fa-envelope"></i><span style="color:red">Thông tin bị ẩn</span></li>
                                    <li><i class="fa-solid fa-location-dot"></i><span style="color:red">Thông tin bị ẩn</span></li>
                                    <li><i class="fa-solid fa-link"></i><span style="color:red">Thông tin bị ẩn</span></li>   
                                @else
                                    <li><i class="fa-solid fa-phone"></i>{{$seeker_profile->phone?$seeker_profile->phone:''}}</li>
                                    <li><i class="fa-regular fa-envelope"></i>{{$seeker_profile->mail?$seeker_profile->email:''}}</li>
                                    <li><i class="fa-solid fa-location-dot"></i>{{$seeker_profile->address?$seeker_profile->address:''}}</li>
                                    <li><i class="fa-solid fa-link"></i>{{$seeker_profile->link?$seeker_profile->link:''}}</li>
                                @endif
                                
                            </ul>
                        </div>
                    </div>
                    @if (count($seeker_profile->skills)>0)
                    <div class="sider-content">
                        <h1 class="tag-fill">Skill</h1>
                        @foreach($seeker_profile->skills as $skill)
                            <div class="tag-content progress-container">
                                <p class="progress-title">{{$skill->name}}</p>
                                {{-- <div class="progress-wrap">
                                    <div class="progress" style="width: 80%"></div>
                                </div> --}}
                            </div>
                        @endforeach
                    </div>
                    @endif
                    @if (count($seeker_profile->languages)>0)
                    <div class="sider-content">
                        <h1 class="tag-fill">Language</h1>
                        @foreach($seeker_profile->languages as $language)
                            <div class="tag-content progress-container">
                                <p class="progress-title">{{$language->name}}</p>
                                @if ($language->pivot->level==1)
                                    <p class="progress-title level">Sơ cấp</p>
                                @elseif($language->pivot->level==2)
                                    <p class="progress-title level">Trung cấp</p>
                                @elseif($language->pivot->level==3)
                                    <p class="progress-title level">Cao cấp</p>
                                @else
                                    <p class="progress-title level">Bản ngữ</p>
                                @endif
                                <p class="progress-title level">Chứng chỉ: {{$language->pivot->certificate}}</p>
                                
                            </div>
                        @endforeach
                    </div>
                    @endif
                   
                    
                </div>
                <div class="content">
                    <div>
                        <h1 class="tag">Mục tiêu nghề nghiệp</h1>
                        <p class="text-content text-objective">
                            {{$seeker_profile->objective}}
                        </p>
                    </div>
                    @if (count($seeker_profile->educations) > 0)
                    <div class="description-content">
                        <h1 class="tag">Học vấn</h1>
                        <ul>
                            @if ($seeker_profile->candidate->job_search_function == 0)
                                <span style="color:red">Thông tin bị ẩn</span>
                            @else
                                @foreach ($seeker_profile->educations as $education)
                                <li>
                                    <div class="tabbar-title">
                                        <p class="text-content" style="font-size: 20px">{{$education->school_name}}</p>
                                        
                                        <p class="text-date">{{\Carbon\Carbon::parse($education->start_date)->format('d/m/Y')}} - {{$education->end_date?\Carbon\Carbon::parse($education->end_date)->format('d/m/Y'):'Hiện tại'}}</p>
                                    </div>
                                    <h3 style="font-size: 18px">{{$education->major->name}}</h3>
                                    <p class="text-content" style="font-size: 18px">
                                        {{$education->description}}
                                    </p>
                                    
                                </li>
                                @endforeach
                            @endif
                           
                        </ul>
                    </div>
                    @endif
                    @if (count($seeker_profile->experiences) > 0)
                    <div class="description-content">
                        <h1 class="tag">Kinh nghiệm làm việc</h1>
                        <ul>
                            @if ($seeker_profile->candidate->job_search_function == 0)
                                <span style="color:red">Thông tin bị ẩn</span>        
                            @else
                                @foreach ($seeker_profile->experiences as $experience)
                                <li>
                                    <div class="tabbar-title">
                                        <p class="text-content" style="font-size: 20px">{{$experience->company_name}}</p>
                                        <p class="text-date">{{\Carbon\Carbon::parse($experience->start_date)->format('d/m/Y')}} - {{$experience->end_date?\Carbon\Carbon::parse($experience->end_date)->format('d/m/Y'):'Hiện tại'}}</p>
                                    </div>
                                    <h3 style="font-size: 18px">{{$experience->work_position}}</h3>
                                    <p class="text-content" style="font-size: 18px">
                                        {{$experience->description}}
                                    </p>
                                    
                                </li>
                                @endforeach
                            @endif
                        </ul>

                        
                    </div>
                    @endif
                    @if (count($seeker_profile->projects) > 0)
                    <div class="description-content">
                        <h1 class="tag">Dự án cá nhân</h1>
                        <ul>
                            @if ($seeker_profile->candidate->job_search_function == 0)
                                <span style="color:red">Thông tin bị ẩn</span>        
                            @else
                                @foreach ($seeker_profile->projects as $project)
                                <li>
                                    <div class="tabbar-title">
                                        <p class="text-content" style="font-size: 20px">{{$project->name}}</p>
                                        <p class="text-date">{{\Carbon\Carbon::parse($project->start_date)->format('d/m/Y')}} - {{$project->end_date?\Carbon\Carbon::parse($project->end_date)->format('d/m/Y'):'Hiện tại'}}</p>
                                    </div>
                                    {{-- <h3 style="font-size: 18px">{{$education->major->name}}</h3> --}}
                                    <p class="text-content" style="font-size: 18px">
                                        {{$project->description}}
                                    </p>
                                    
                                </li>
                                @endforeach
                            @endif
                            
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
	</body>
</html>
