

@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{clean( trans('mjacksi-backend.create_project') , array('Attr.EnableID' => true))}}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('mjacksi-backend.create_project') , array('Attr.EnableID' => true))}}</h6>
        </div>
        <div class="card-body">



                <div class="row">
                    <div class="col-lg-6">
                        <a href="{{route('project.index') . '?language=' . request()->input('language')}}" class="btn btn-primary btn-back">{{clean( trans('mjacksi-backend.back_projectpage') , array('Attr.EnableID' => true))}}</a>
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


                @include('includes.form-errors')

                <div class="row">
                    <div class="col-md-12">

                        <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">



                                    <input type="hidden" name="language_id" value="{{$lang_id}}">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <strong>{{clean( trans('mjacksi-backend.title') , array('Attr.EnableID' => true))}} English</strong>
                                                <input type="text" name="title_en" class="form-control" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.title') , array('Attr.EnableID' => true))}} Arabic</strong>
                                                <input type="text" name="title_ar" class="form-control" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.link') , array('Attr.EnableID' => true))}}</strong>
                                                <div class="slug-container"><span>{{URL::to('/')}}/{{clean( trans('mjacksi-backend.project') , array('Attr.EnableID' => true))}}/</span><input type="text" name="slug" class="form-control" placeholder=""></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.order') , array('Attr.EnableID' => true))}}</strong>
                                               <input type="number" name="project_order" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.photo') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="file"  name="photo_id" class="form-control-file"  id="photo_id">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.photo') , array('Attr.EnableID' => true))}} <span>{{clean( trans('mjacksi-backend.upload_image') , array('Attr.EnableID' => true))}} <a target="_blank" href="{{route('media.create')}}"> {{clean( trans('mjacksi-backend.here') , array('Attr.EnableID' => true))}} </a> {{clean( trans('mjacksi-backend.then_copy_url') , array('Attr.EnableID' => true))}} <a target="_blank" href="{{route('media.index')}}"> {{clean( trans('mjacksi-backend.here') , array('Attr.EnableID' => true))}} </a></span></strong>
                                                <input type="text" name="image_featured2" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <strong>{{clean( trans('mjacksi-backend.photos') , array('Attr.EnableID' => true))}}</strong>
                                        <input type="file"  multiple name="photos[]" class="form-control-file"  id="photo_id">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{clean( trans('mjacksi-backend.categories') , array('Attr.EnableID' => true))}} English</strong>
                                        <select required name="project_category_id_en" id="project_category_id" class="form-control">
                                            <option>{{clean( trans('mjacksi-backend.choose_category') , array('Attr.EnableID' => true))}}</option>
                                            @foreach($categories_en as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        </div>
                                        <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{clean( trans('mjacksi-backend.categories') , array('Attr.EnableID' => true))}} Arabic</strong>
                                        <select required name="project_category_id_ar" id="project_category_id" class="form-control">
                                            <option>{{clean( trans('mjacksi-backend.choose_category') , array('Attr.EnableID' => true))}}</option>
                                            @foreach($categories_ar as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <strong>{{clean( trans('mjacksi-backend.body') , array('Attr.EnableID' => true))}} English</strong>
                                        <textarea name="body_en" class="form-control" id="body" rows="5"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <strong>{{clean( trans('mjacksi-backend.body') , array('Attr.EnableID' => true))}} Arabic</strong>
                                        <textarea name="body_ar" class="form-control" id="body" rows="5"></textarea>
                                    </div>
                                <!----
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.photo') , array('Attr.EnableID' => true))}} 1</strong>
                                                <input type="text" name="img_gal1" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.photo') , array('Attr.EnableID' => true))}} 2</strong>
                                                <input type="text" name="img_gal2" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.photo') , array('Attr.EnableID' => true))}} 3 </strong>
                                                <input type="text" name="img_gal3" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.photo') , array('Attr.EnableID' => true))}}4 </strong>
                                                <input type="text" name="img_gal4" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>--->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.duration_project') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="date" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.client') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="client" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.button_text') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="button_text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.button_link') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="button_link" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.ios_link') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="ios_link" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.android_link') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="android_link" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.meta_title') , array('Attr.EnableID' => true))}} English</strong>
                                                <input type="text" name="meta_title_en" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <strong>{{clean( trans('mjacksi-backend.meta_title'), array('Attr.EnableID' => true))}} Arabic</strong>
                                                 <input type="text" name="meta_title_ar" class="form-control" placeholder="">
                                             </div>
                                         </div>
                                     </div>
                                         <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.meta_description') , array('Attr.EnableID' => true))}} English</strong>
                                                <input type="text" name="meta_description_en" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.meta_description') , array('Attr.EnableID' => true))}} Arabic</strong>
                                                <input type="text" name="meta_description_ar" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">{{clean( trans('mjacksi-backend.create') , array('Attr.EnableID' => true))}}</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection

