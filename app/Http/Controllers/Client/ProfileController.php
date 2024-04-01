<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Skill;
use App\Models\SeekerProfile;
use App\Models\Education;
use App\Models\SeekerSkill;
use App\Models\Experience;
use App\Models\Degree;


class ProfileController extends Controller
{
    public function index(){
        $maJor = Major::all();
        $skills = Skill::all();
        $degrees = Degree::all();
        
        $seeker = SeekerProfile::where('id', 1)->first();
        if (!empty($seeker)) {
            $experiences = Experience::where('seeker_profile_id', $seeker->id)->get();
            $educations = Education::where('seeker_profile_id', $seeker->id)->get();
            $list_skill = SeekerSkill::where('seeker_profile_id', $seeker->id)->get();
            // $certificates= Certificate::where('seeker_id', $seeker->id)->get();

            //active skills
            $skillActive = $list_skill->pluck('skill_id')->toArray();
        }
        return view('client.profile.add', 
        ['maJor'=>$maJor, 'seeker'=>$seeker, 'skills'=>$skills,
         'experiences'=>$experiences, 'educations'=>$educations, 'skillActive'=>$skillActive,
         'degrees'=>$degrees   ]);
    }
    public function createProfile(){
        return 'khôi';
    }
}
