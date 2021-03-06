<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\User\UserCreateRequest as CreateRequest;
use App\Http\Requests\Admin\User\UserUpdateRequest as UpdateRequest;

use App\User;
use App\Role;
use App\School;
use App\Promotion;
use App\Gallery;
use App\Picture;

use App\Services\UploadManager;
use Illuminate\Http\Request;

use App\DataTables\UsersDataTable as DataTable;
use App\DataTables\UsersTeacherDataTable as TeacherDataTable;
use App\DataTables\UsersStudentDataTable as StudentDataTable;
use App\DataTables\UsersAdminDataTable as AdminDataTable;

class UserController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(new User);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DataTable $dataTable)
    {
        return parent::renderIndex($dataTable);
    }

    public function indexTeacher(TeacherDataTable $dataTable)
    {
        return parent::renderIndex($dataTable);
    }
    public function indexStudent(StudentDataTable $dataTable)
    {
        return parent::renderIndex($dataTable);
    }
    public function indexAdmin(AdminDataTable $dataTable)
    {
        return parent::renderIndex($dataTable);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::getRolesList();

        return parent::renderCreate(new CreateRequest, compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = User::setPassword($request->all());

        $entry = $this->model->create($data);
        $entry->roles()->sync($request->roles);

        if (!isset($request->medias)) {
            $request->medias = [];
        }
        $entry->medias()->sync($request->medias);

        return parent::redirectStore($entry);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::getRolesList();
        $entry = $this->model->with('roles')->findOrFail($id);
        $entry['roles'] = $entry->getUserRolesLists();
        $schools = $entry->schools->map(function($school){
            return $school->title;
        });
        $promotions = $entry->promotions->map(function($promotion){
            return $promotion->title;
        });
        array_forget($entry, 'password');
        // $tags = $entry->pictures;
        $galleries = Gallery::where('created_by', $entry->id)->where('published', true)->pluck('id')->toArray();
        $uploaded_pictures = Picture::whereIn('gallery_id', $galleries)->get();

        return parent::renderEdit(new UpdateRequest, compact('entry', 'roles', 'schools', 'promotions', 'uploaded_pictures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $entry = $this->model->findOrFail($id);

        $data = User::setPassword($request->all());

        if (empty($data['password'])) {
            array_forget($data, 'password');
        }

        $entry->update($data);
        $roles = $entry->roles()->sync($request->roles);

        if (!empty($roles['attached']) || !empty($roles['detached'])) {
            $entry->touch();
        }

        if (!isset($request->medias)) {
            $request->medias = [];
        }
        $entry->medias()->sync($request->medias);

        ///Update promotions
        foreach($entry->promotions as $index => $promotion){
          if($promotion->title !== $request["promotion_" . $index]){
            $new_promotion = Promotion::where('school_id',$promotion->school->id)->whereTranslation('title',$request["promotion_" . $index])->first();
            if(!$new_promotion){
              $new_promotion = new Promotion;
              $new_promotion->school_id = $promotion->school->id;
              $new_promotion->title = $request["promotion_" . $index];
              // $new_promotion->slug = $request["promotion_" . $index];
              $new_promotion->save();
          }
          $entry->promotions()->detach(Promotion::find($promotion->id));
          $entry->promotions()->attach($new_promotion);
          $entry->save();
          }
        }


        return parent::redirectUpdate($entry);
    }

    public function frontLogout(){
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/login');
    }
}
