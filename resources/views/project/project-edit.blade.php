@extends('layouts.admin')

@section('content')

@include('includes.tinyeditor')

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{clean( trans('mjacksi-backend.edit_project') , array('Attr.EnableID' => true))}}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{clean( trans('mjacksi-backend.edit_project') , array('Attr.EnableID' => true))}}</h6>
        </div>
        <div class="card-body">

                <a href="{{route('project.index') . '?language=' . request()->input('language')}}" class="btn btn-primary btn-back">{{clean( trans('mjacksi-backend.back_projectpage') , array('Attr.EnableID' => true))}}</a>

                @if ($message = Session::get('project_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif


                @include('includes.form-errors')

                <div class="row">

                	<div class="col-md-12">

                		<form action="{{route('project.update', $project_en->id)}}" method="POST" enctype="multipart/form-data">
					        @csrf
					        @method('PUT')
                            <input type="hidden" name="project_en" value="{{$project_en->id}}">
                            <input type="hidden" name="project_ar" value="{{$project_ar->id}}">

					        <div class="row">

                                 <div class="col-xs-12 col-sm-12 col-md-12">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.title') , array('Attr.EnableID' => true))}} English</strong>
                                                <input type="text" name="title_en" class="form-control" placeholder="" value="{{$project_en->title}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.title') , array('Attr.EnableID' => true))}} Arabic</strong>
                                                <input type="text" name="title_ar" class="form-control" placeholder="" value="{{$project_ar->title}}">
                                            </div>
                                        </div>

                                    </div>
                                     <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <strong>{{clean( trans('mjacksi-backend.link') , array('Attr.EnableID' => true))}}</strong>
                                             <div class="slug-container"><span>{{URL::to('/')}}/{{clean( trans('mjacksi-backend.project') , array('Attr.EnableID' => true))}}/</span><input type="text" name="slug" class="form-control" placeholder="" value="{{$project_en->slug}}"></div>
                                         </div>
                                     </div>
                                     </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <img class="img-fluid pb-4" width="100" height="100" src="{{$project_en->photo ? '/public/images/media/' . $project_en->photo->file : '/public/img/200x200.png'}}">
                                                <p><strong>{{clean( trans('mjacksi-backend.photo') , array('Attr.EnableID' => true))}}</strong></p>
                                                <input type="file"  name="photo_id" class="form-control-file"  id="photo_id">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.photo') , array('Attr.EnableID' => true))}} <span>{{clean( trans('mjacksi-backend.upload_image') , array('Attr.EnableID' => true))}} <a target="_blank" href="{{route('media.create')}}"> {{clean( trans('mjacksi-backend.here') , array('Attr.EnableID' => true))}} </a> {{clean( trans('mjacksi-backend.then_copy_url') , array('Attr.EnableID' => true))}} <a target="_blank" href="{{route('media.index')}}"> {{clean( trans('mjacksi-backend.here') , array('Attr.EnableID' => true))}} </a></span></strong>
                                                <input type="text" name="image_featured2" class="form-control" placeholder="" value="{{$project_en->image_featured2}}">
                                            </div>
                                        </div>
                                    </div>




                                         <div class="form-group">

                                             @if(!empty($project_en->img_gal1))

                                                 @php       $images    = explode('|',$project_en->img_gal1);          @endphp
                                              @foreach($images as $image)
                                             <img class="img-fluid pb-4" width="100" height="100" src="{{'/public/images/media/' . @\App\Models\Photo::where('id',$image)->first()->file}}">
                                              @endforeach
                                             @endif
                                             <p><strong>{{clean( trans('mjacksi-backend.photos') , array('Attr.EnableID' => true))}}</strong></p>
                                             <input type="file"  name="photos[]" multiple class="form-control-file"  id="photos">
                                         </div>



                                     <div class="row">
                                         <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{clean( trans('mjacksi-backend.categories') , array('Attr.EnableID' => true))}} English</strong>
                                        <select name="project_category_id_en" id="project_category_id" class="form-control">
                                            @foreach($categories_en as $category)
                                                <option @if($project_en->project_category_id == $category->id) { selected="selected" } @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <strong>{{clean( trans('mjacksi-backend.categories') , array('Attr.EnableID' => true))}} Arabic</strong>
                                                 <select name="project_category_id_ar" id="project_category_id_ar" class="form-control">
                                                     @foreach($categories_ar as $category)
                                                         <option @if($project_en->project_category_id == $category->id) { selected="selected" } @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                         </div>
                                     </div>

                                    <div class="form-group">
                                        <strong>{{clean( trans('mjacksi-backend.body') , array('Attr.EnableID' => true))}} English</strong>
                                        <textarea name="body_en" class="form-control" id="body" rows="25">{{clean( $project_en->body , array('Attr.EnableID' => true))}}</textarea>
                                    </div>

                                     <div class="form-group">
                                         <strong>{{clean( trans('mjacksi-backend.body') , array('Attr.EnableID' => true))}} Arabic</strong>
                                         <textarea name="body_ar" class="form-control" id="body" rows="25">{{clean( $project_ar->body , array('Attr.EnableID' => true))}}</textarea>
                                     </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.duration_project') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="date" class="form-control" placeholder="" value="{{$project_en->date}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.client') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="client" class="form-control" placeholder="" value="{{$project_en->client}}">
                                            </div>
                                        </div>
                                    </div>


                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.button_text') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="button_text" class="form-control" placeholder="" value="{{$project_en->button_text}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.button_link') , array('Attr.EnableID' => true))}}</strong>
                                                <input type="text" name="button_link" class="form-control" placeholder="" value="{{$project_en->button_link}}">
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <strong>{{clean( trans('mjacksi-backend.meta_title') , array('Attr.EnableID' => true))}} English</strong>
                                                <input type="text" name="meta_title_en" class="form-control" placeholder="" value="{{$project_en->meta_title}}">
                                            </div>
                                        </div>

                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <strong>{{clean( trans('mjacksi-backend.meta_title') , array('Attr.EnableID' => true))}} Arabic</strong>
                                                 <input type="text" name="meta_title_ar"  class="form-control" placeholder="" value="{{$project_ar->meta_title}}">
                                             </div>
                                         </div>

                                    </div>

                                     <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <strong>{{clean( trans('mjacksi-backend.ios_link') , array('Attr.EnableID' => true))}}</strong>
                                             <input type="text" name="ios_link" class="form-control" value="{{$project_en->ios_link}}" placeholder="">
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <strong>{{clean( trans('mjacksi-backend.android_link') , array('Attr.EnableID' => true))}}</strong>
                                             <input type="text" name="android_link" class="form-control" value="{{$project_en->android_link}}" placeholder="">
                                         </div>
                                     </div>
                                     </div>



                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <strong>{{clean( trans('mjacksi-backend.meta_description') , array('Attr.EnableID' => true))}} English</strong>
                                        <input type="text" name="meta_description_en" class="form-control" placeholder="" value="{{$project_en->meta_description}}">
                                    </div>
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong>{{clean( trans('mjacksi-backend.meta_description') , array('Attr.EnableID' => true))}} Arabic </strong>
                                            <input type="text" name="meta_description_ar" class="form-control" placeholder="" value="{{$project_ar->meta_description}}">
                                        </div>
                                    </div>
                                </div>



					            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
					                <button type="submit" class="btn btn-primary">{{clean( trans('mjacksi-backend.update') , array('Attr.EnableID' => true))}}</button>
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

