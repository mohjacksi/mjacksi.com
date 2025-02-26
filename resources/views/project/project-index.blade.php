@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{clean( trans('mjacksi-backend.section_projects') , array('Attr.EnableID' => true))}}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('mjacksi-backend.section_projects') , array('Attr.EnableID' => true))}}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <div class="row">
                    <div class="col-lg-6">
                        <a href="{{route('home-setting.edit') . '?language=' . request()->input('language')}}" class="btn btn-primary btn-back">{{clean( trans('mjacksi-backend.back_homepage') , array('Attr.EnableID' => true))}}</a>
                        <a href="{{route('portfolio-setting.edit') . '?language=' . request()->input('language')}}" class="btn btn-primary btn-back">{{clean( trans('mjacksi-backend.back_projectpage') , array('Attr.EnableID' => true))}}</a>
                        <a href="{{route('project.create') . '?language=' . request()->input('language')}}" class="btn btn-primary btn-back">{{clean( trans('mjacksi-backend.create') , array('Attr.EnableID' => true))}}</a>
                    </div>

                    <div class="col-lg-6 text-right">
                        @if (!empty($langs))
                            <select name="language" class="form-control language-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                                <option value="" selected disabled>{{clean( trans('mjacksi-backend.select_language') , array('Attr.EnableID' => true))}}</option>
                                @foreach ($langs as $lang)
                                    <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>

                @if ($message = Session::get('project_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif



                <form action="{{route('delete.project')}}" method="POST" class="form-inline">
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <select name="delete_select" id="" class="form-control">
                        <option value=""></option>
                        <option value="delete">{{clean( trans('mjacksi-backend.delete') , array('Attr.EnableID' => true))}}</option>
                    </select>
                </div>
               <div class="form-group">
                        <select name="checkbox_array_duplicate" id=""  class="form-control">
                            <option value=""></option>
                            <option value="duplicate">{{clean( trans('mjacksi-backend.Duplicate') , array('Attr.EnableID' => true))}}</option>
                        </select>
                </div>

                <div class="form-group">
                    <input type="submit" name="delete_all" class="btn btn-primary">
                </div>



                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="options"></th>
                            <th scope="col">{{clean( trans('mjacksi-backend.photo') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('mjacksi-backend.owner') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('mjacksi-backend.title') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('mjacksi-backend.category') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('mjacksi-backend.body') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('mjacksi-backend.order') , array('Attr.EnableID' => true))}}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><input type="checkbox" id="options1"></th>
                            <th scope="col">{{clean( trans('mjacksi-backend.photo') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('mjacksi-backend.owner') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('mjacksi-backend.title') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('mjacksi-backend.category') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('mjacksi-backend.body') , array('Attr.EnableID' => true))}}</th>
                            <th scope="col">{{clean( trans('mjacksi-backend.order') , array('Attr.EnableID' => true))}}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if($projects)
                            @foreach($projects as $project)
                                <tr>
                                    <td><input class="checkboxes" type="checkbox" name="checkbox_array[]" value="{{$project->id}}"></td>
                                    <td data-label="Photo"><img height="50" src="{{$project->photo ? '/public/images/media/' . $project->photo->file : '/public/img/200x200.png'}}" alt=""><p class="mb-0 mt-2"><a href="{{ route('project.edit', $project->id) . '?language=' . request()->input('language')}}">{{clean( trans('mjacksi-backend.edit') , array('Attr.EnableID' => true))}}</a></p></td>
                                    <td data-label="OWNER">{{$project->user->name}}</td>
                                    <td data-label="TITLE">{{$project->title}}</td>
                                    <td data-label="Category">{{$project->project_category ? $project->project_category->name : 'Uncategorized'}}</td>
                                    <td class="body-project">{!!$project->body!!}</td>
                                    <td class="body-project">{{$project->project_order}}</td>
                                </tr>
                             @endforeach
                        @endif



                    </tbody>
                </table>
                    @if($projects)
                        {{$projects->links()}}
                    @endif

                </form>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@stop

