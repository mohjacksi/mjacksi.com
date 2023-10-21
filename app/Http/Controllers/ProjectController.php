<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ProjectRequest; 
use App\Http\Requests\ProjectEditRequest; 
use App\Models\Photo;
use App\Models\Setting;
use App\Models\Menu;
use App\Models\HeaderFooterSetting; 
use DB;
use View;
use Illuminate\Support\Facades\Auth;
use App\Models\Language;

class ProjectController extends Controller
{
    //


    public function index(Request $request)
    {
        $langs = Language::all();
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;

        //return $lang;

        $data['projects'] = Project::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);

        $data['lang_id'] = $lang_id;

        return view('project.project-index', $data, compact('langs'));

    }

    public function create(Request $request)
    {
        $langs = Language::all();
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $lang_ar=Language::where('code','ar')->first()->id;
        $lang_en=Language::where('code','en')->first()->id;
        $categories_ar = DB::select('select * from project_categories where language_id='.$lang_ar);
        $categories_en = DB::select('select * from project_categories where language_id='.$lang_en);
        return view('project.project-create', compact('categories_ar','categories_en', 'langs', 'lang_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {


        $input = $request->all();

        $user = Auth::user();
        if ($file = $request->file('photo_id')) {
            
            $name = time() . $file->getClientOriginalName();

            $file->move('images/media/', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }
        $input['language_id']=Language::where('code','en')->first()->id;
        $input['title']=$input['title_en'];
        $input['body']=$input['body_en'];
        $input['project_category_id']=$input['project_category_id_en'];
        $input['meta_title']=$input['meta_title_en'];
        $input['meta_description']=$input['meta_description_en'];

        $user->projects()->create($input);
        $input['language_id']=Language::where('code','ar')->first()->id;
        $input['title']=$input['title_ar'];
        $input['body']=$input['body_ar'];
        $input['project_category_id']=$input['project_category_id_ar'];
        $input['meta_title']=$input['meta_title_ar'];
        $input['meta_description']=$input['meta_description_ar'];
        $user->projects()->create($input);

        return back()->with('project_success','Project created successfully!');
    }



    public function edit(Request $request,$id)
    {

        $lang_en = Language::where('code', 'en')->first();
        $lang_ar = Language::where('code', 'ar')->first();

        $project=Project::findOrFail($id);

        if ($project->language_id == $lang_en->id){

         $project_en=$project;

         $project_ar=Project::where('language_id',$lang_ar->id)->where('slug',$project->slug)->first();

        }else{
            $project_ar=$project;
            $project_en=Project::where('language_id',$lang_en->id)->where('slug',$project->slug)->first();

        }

        $categories_ar = DB::select('select * from project_categories where language_id='.$lang_ar->id);
        $categories_en = DB::select('select * from project_categories where language_id='.$lang_en->id);
        if ($project_ar==null){

            $project_ar=$project_en;
        }elseif ($project_en==null){

            $project_en=$project_ar;
        }
        return view('project.project-edit', compact('project_ar','project_en', 'categories_ar','categories_en'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectEditRequest $request, Project $project)
    {
        
        $input = $request->all();
        

        if ($file = $request->file('photo_id')) {
            
            $name = time() . $file->getClientOriginalName();

            $file->move('images/media/', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
        }


        $project->update($input);

        return back()->with('project_success','Project updated successfully!');
    }

    public function delete_project(Request $request, Project $project) {


        if(isset($request->delete_all) && !empty($request->checkbox_array)) {
            $projects = Project::findOrFail($request->checkbox_array);
            foreach ($projects as $project) {
                $pro=Project::where('slug',$project->slug)->delete();
                $project->delete();
            }
            return back()->with('projects_success','Project/s deleted successfully!');
        } else {
            return back();
        }

        $projects = Project::findOrFail($request->checkbox_array);
        foreach ($projects as $project) {
            $pro=Project::where('slug',$project->slug)->delete();
            $project->delete();
        }

        return back();
        //return 'works';
    }

    // Show a project by slug
    public function show_slug($slug = 'home')
    {

        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }
        $data['currentLang'] = $currentLang;
        $lang_id = $currentLang->id;
        $langs = Language::all();

        $data['headerfooter'] = HeaderFooterSetting::find($lang_id);
        $data['setting'] = Setting::find($lang_id);
        $data['menus'] = Menu::where('language_id', $lang_id)->get();


        $project = Project::whereSlug($slug)->where('language_id', $lang_id)->first();

        if(!empty($project)) {
            return View::make('project', $data, compact('langs'))->with('project', $project);
            //return $project;
        } else {
            abort(404);
        }

    }


}
