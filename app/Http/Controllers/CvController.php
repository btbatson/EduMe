<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Education;
use App\Model\Experience;
use App\Model\User;
use App\Model\Skill;
use App\Model\Interest;
use App\Model\Project;
use Auth;

class CvController extends Controller
{
    public function index($username)
    {
    	if(is_numeric($username))
        {
            $user = User::find($username);
        }
        else
        {
            $user = User::where('username', $username)->first();
        }

        if(!$user)
        {
            abort(404);
        }

    	$educations = $user->educations()->orderBy('start_date', 'ASC')->get();

    	$experiences = $user->experiences()->orderBy('start_date', 'ASC')->get();

        $skills = $user->skills()->get();

        $interests = $user->interests()->get();

        $projects = $user->projects()->get();

        return view('cv.index')
                ->with('user', $user)
        		->with('educations', $educations)
                ->with('experiences', $experiences)
                ->with('skills', $skills)
                ->with('interests', $interests)
        		->with('projects', $projects);
    }

    public function getEducation()
    {
        return view('cv.education');
    }
    public function postEducation(Request $request)
    {
        $this->validate($request, [
            'school_name' => 'required|max:200',
            'start_date' => 'required|date',
            'description' => 'required'
        ]);
        $education = new Education;
        $education->school_name = $request->input('school_name');
        $education->start_date = $request->input('start_date');
        if((bool)$request->input('end_date'))
        {
        	$education->end_date = $request->input('end_date');
        }
        
        $education->description = $request->input('description');

        $education->save();

        Auth::user()->educations()->save($education);
        
        return redirect()->route('profile.cv', ['username' => Auth::user()->username ? Auth::user()->username : Auth::user()->id])->with('info', 'Education has been added');
    }

    public function getExperience()
    {
    	return view('cv.experience');
    }

    public function postExperience(Request $request)
    {
    	$this->validate($request, [
            'company_name' => 'required|max:200',
            'title' => 'required|max:200',
            'start_date' => 'required|date',
            'description' => 'required'
        ]);

        $experience = new Experience;
        $experience->company_name = $request->input('company_name');
        $experience->title = $request->input('title');
        $experience->start_date = $request->input('start_date');
        if((bool)$request->input('end_date'))
        {
        	$experience->end_date = $request->input('end_date');
        }
        
        $experience->description = $request->input('description');

        $experience->save();

        Auth::user()->experiences()->save($experience);
        
        return redirect()->route('profile.cv', ['username' => Auth::user()->username ? Auth::user()->username : Auth::user()->id])->with('info', 'Experience has been added');
    }

    public function getSkill()
    {
        return view('cv.skill');
    }
    public function postSkill(Request $request)
    {
        $this->validate($request, [
            'skill' => 'required|max:200',
        ]);

        $skill = Skill::where('skill', $request->input('skill'))->first();
        if (!$skill) {
            $skill = new Skill;
            $skill->skill = $request->input('skill');
            $skill->save();
        }

        if(Auth::user()->hasSkill($skill))
        {
            return redirect()->route('profile.cv', ['username' => Auth::user()->username ? Auth::user()->username : Auth::user()->id]);
        }
        
        Auth::user()->skills()->save($skill);

        return redirect()->route('profile.cv', ['username' => Auth::user()->username ? Auth::user()->username : Auth::user()->id])->with('info', 'Skill has been added');
    }

    public function getInterest()
    {
        return view('cv.interest');
    }

    public function postInterest(Request $request)
    {
        $this->validate($request, [
            'interest' => 'required|max:200',
        ]);

        $interest = Interest::where('interest', $request->input('interest'))->first();
        if (!$interest) {
            $interest = new Interest;
            $interest->interest = $request->input('interest');
            $interest->save();
        }

        if(Auth::user()->hasInterest($interest))
        {
            return redirect()->route('profile.cv', ['username' => Auth::user()->username ? Auth::user()->username : Auth::user()->id]);
        }
        
        Auth::user()->interests()->save($interest);

        return redirect()->route('profile.cv', ['username' => Auth::user()->username ? Auth::user()->username : Auth::user()->id])->with('info', 'Interest has been added');
    }

    public function getProject()
    {
        return view('cv.project');
    }

    public function postProject(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:200',
            'description' => 'required',
            'url' => 'url',
        ]);

        $project = new Project;
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        if($request->has('url'))
        {
            $project->url = $request->input('url');
        }
        
        $project->user()->associate(Auth::user());
        $project->save();

        return redirect()->route('profile.cv', ['username' => Auth::user()->username ? Auth::user()->username : Auth::user()->id])->with('info', 'Project has been added');
    }
}
