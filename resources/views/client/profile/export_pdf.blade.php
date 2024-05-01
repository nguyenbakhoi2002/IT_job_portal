<!-- @format -->

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
		{{-- <link rel="stylesheet" href="{{asset('css/profile_new.css')}}"> --}}
		<title>My Profile</title>
        <style>
            
            body{
              margin: 0;
              background-color: #f9f9f9;
            }
            
            *{
              /* font-family: Arial, Helvetica, sans-serif; */
              font-family: DejaVu Sans !important;
              margin: 0;
            }
            header {
              padding: 20px 0;
              background-color: #16a085;
              display: flex;
            }
            .text-content{
              padding: 0 20px;
              margin-bottom: 20px;
              text-align: justify;
            }
            .img-container {
              background-color: white;
              padding: 4px;
              padding-left: 20px;
              display: flex;
              justify-content: center;
              align-items: center;
              border-top-right-radius: 100px;
              border-bottom-right-radius: 100px;
            }
            .title-container{
              padding: 0 20px;
              display: flex;
              justify-content: center;
              flex-direction: column;
            }
            .title-container h1, .title-container h2{
              color: white;
              font-size: 28px;
              text-transform: uppercase;
              font-weight: 600;
            }
            .title-container h2{
              font-size: 18px;
              color: #fafafa;
              margin-top: 10px;
            }
            .img, .avatar{
              width: 100px;
              height: 100px;
              object-fit: cover;
              border-radius: 100px;
            }
            .container{
              padding: 20px;
              background-color: #e9e9e9;
              display: flex;
            }
            .sider, .content{
              background-color: white;
                padding: 20px 0;
                width: 100%;
            }
            .sider {
              width: calc(40% - 20px);
              margin-right: 20px;
            }
            .content {
              flex-grow: 1;
            }
            .tag-fill{
              background-color: #16a085;
              padding: 8px 20px;
              color: white;
              font-size: 18px;
              display: inline-block;
              border-top-right-radius: 100px;
              border-bottom-right-radius: 100px;
            }
            .tag-content {
              padding-left: 20px;
              margin-top: 16px;
              margin-bottom: 24px;
            }
            .tag-content ul {
              margin: 0;
              padding: 0;
            }
            .tag-content ul li {
              list-style-type: none;
              padding: 8px 0
            }
            
            .progress-container {
              width: 80%;
            }
            
            .progress-title{
              text-transform: uppercase;
              font-size: 0.8rem;
              margin: 0;
              padding: 0;
            }
            
            .progress-wrap{
              width: 100%;
              height: 10px;
              background-color: #e0e0e0;
              margin-top: 8px;
              margin-bottom: 16px;
            }
            
            .progress{
              width: 50%;
              height: 10px;
              background-color: #16a085;
            }
            
            .tag{
              font-size: 18px;
              color: #212121;
              padding: 10px 20px;
              border-left: 18px solid #16a085;
              margin-bottom: 20px;
            }
            
            .tabbar-title{
              display: flex;
              justify-content: space-between;
              
            }
            
            .tabbar-title .text-content {
              font-weight: 600;
              color: #16a085;
            }
            
            .content ul {
              padding: 0;
            }
            
            .content ul li {
              list-style-type: none;
            }
            
            .text-date {
              padding: 0 20px;
              color: #16a085;
              font-style: italic;
            }
            
            .description-content h3{
              padding: 0 20px;
              margin-bottom: 8px;
            }
            
            .description-content ul {
              padding-left: 40px ;
            }
            
            .description-content ul li{
              text-align: justify;
              list-style-type: none
            }
            
            .description-content ul li ul li{
              text-align: justify;
              list-style-type: square;
              margin-bottom: 16px;
            }
  /* tự thêm  */
            /* .wrapper{
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
            } */
        </style>
	</head>

	<body>
        <div class="wrapper">
            <header>
                <div class="img-container">
                    <img src="{{$image}}" alt="" class="img avatar" />
                </div>
                <div class="title-container">
                    <h1 id="name_seeker">{{$seeker_profile->name}}</h1>
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
                                <li><i class="fa-solid fa-phone"></i>{{$seeker_profile->phone?$seeker_profile->phone:''}}</li>
                                <li><i class="fa-regular fa-envelope"></i>{{$seeker_profile->mail?$seeker_profile->email:''}}</li>
                                <li><i class="fa-solid fa-location-dot"></i>{{$seeker_profile->address?$seeker_profile->address:''}}</li>
                                <li><i class="fa-solid fa-link"></i>{{$seeker_profile->link?$seeker_profile->link:''}}</li>
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
                            @foreach ($seeker_profile->educations as $education)
                            <li>
                                <div class="tabbar-title">
                                    <p class="text-content" style="font-size: 20px">{{$education->school_name}}</p>
                                    <p class="text-date">{{\Carbon\Carbon::parse($education->start_date)->format('d/m/Y')}} - {{$education->end_date?\Carbon\Carbon::parse($education->end_date):'Hiện tại'}}</p>
                                </div>
                                <h3 style="font-size: 18px">{{$education->major->name}}</h3>
                                <p class="text-content" style="font-size: 18px">
                                    {{$education->description}}
                                </p>
                                
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (count($seeker_profile->experiences) > 0)
                    <div class="description-content">
                        <h1 class="tag">Kinh nghiệm làm việc</h1>
                        <ul>
                            @foreach ($seeker_profile->experiences as $experience)
                            <li>
                                <div class="tabbar-title">
                                    <p class="text-content" style="font-size: 20px">{{$experience->company_name}}</p>
                                    <p class="text-date">{{\Carbon\Carbon::parse($experience->start_date)->format('d/m/Y')}} - {{$experience->end_date?\Carbon\Carbon::parse($experience->end_date):'Hiện tại'}}</p>
                                </div>
                                <h3 style="font-size: 18px">{{$experience->work_position}}</h3>
                                <p class="text-content" style="font-size: 18px">
                                    {{$experience->description}}
                                </p>
                                
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (count($seeker_profile->projects) > 0)
                    <div class="description-content">
                        <h1 class="tag">Dự án cá nhân</h1>
                        <ul>
                            @foreach ($seeker_profile->projects as $project)
                            <li>
                                <div class="tabbar-title">
                                    <p class="text-content" style="font-size: 20px">{{$project->name}}</p>
                                    <p class="text-date">{{\Carbon\Carbon::parse($project->start_date)->format('d/m/Y')}} - {{$project->end_date?\Carbon\Carbon::parse($project->end_date):'Hiện tại'}}</p>
                                </div>
                                {{-- <h3 style="font-size: 18px">{{$education->major->name}}</h3> --}}
                                <p class="text-content" style="font-size: 18px">
                                    {{$project->description}}
                                </p>
                                
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
	</body>
</html>
