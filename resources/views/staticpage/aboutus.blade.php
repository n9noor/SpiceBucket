@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-page icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                About Us Edit Page
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            <button type="button" onclick="history.back()" title="Back" class="btn-icon btn-shadow me-3 btn btn-dark">
                <i class="fa fa-arrow-left btn-icon-wrapper"></i>Back
            </button>
        </div>
    </div>
</div>

<div class="main-card mb-3 card">
    <div class="card-body">
        <form action="/administrator/edit-static-pages/save-about-us" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="side-image" class="form-label">Side Image</label>
                        <input type="file" class="form-control" name="about[sideimage]" id="side-image" />
                        @if(array_key_exists('sideimage', $about) && !is_null($about['sideimage']))
                        <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $about['sideimage']) : url(env('APP_URL') . '/images/staticImages/' . $about['sideimage'])}}" height="100" width="100" />
                        @endif
                        @error('side-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="about[title]" id="title" value="{{array_key_exists('title', $about) && strlen($about['title']) > 0 ? $about['title'] : ''}}" />
                        @error('title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="about[description]" id="description" class="form-control"> {{array_key_exists('description', $about) && strlen($about['description']) > 0? $about['description'] : '' }}</textarea>
                        @error('description')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <h5>What we provide Column</h5>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="maintitle" class="form-label">Title</label>
                        <input name="about[maintitle]" id="maintitle" class="form-control" value=" {{array_key_exists('maintitle', $about) && strlen($about['maintitle']) > 0 ? $about['maintitle'] : ''}} ">
                        @error('maintitle')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div id="whatweprovidediv">
                    <button type="button" class="pull-right mb-2 mr-2 btn btn-shadow btn-outline-2x btn-outline-alternate" id="add-box-btn"><i class="fa fa-fw fa-plus"></i></button>
                    @if(array_key_exists('boxtitle', $about))
                    @for($i=0; $i<count($about['boxtitle']); $i++) <div class="box-div" id="whatweprovideboxdiv-{{$i+1}}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="position-relative mb-3">
                                    <label for="box-image" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="about[boximage][]" id="box-image-{{$i+1}}" />
                                    @if(array_key_exists('boximage', $about) && array_key_exists($i, $about['boximage']) && strlen($about['boximage'][$i]) > 0)
                                    <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $about['boximage'][$i]) : url(env('APP_URL') . '/images/staticImages/' . $about['boximage'][$i])}}" height="100" width="100" />
                                    @endif
                                    @error('box-image')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative mb-3">
                                    <label for="box-title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="about[boxtitle][]" id="box-title-{{$i+1}}" value="{{array_key_exists('boxtitle', $about) && array_key_exists($i, $about['boxtitle']) && strlen($about['boxtitle'][$i]) > 0 ? $about['boxtitle'][$i] : ''}}" />
                                    @error('box-title')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="position-relative mb-3">
                                    <label for="box-subtitle" class="form-label">Sub Title</label>
                                    <input type="text" name="about[boxsubtitle][]" id="box-subtitle-{{$i}}" class="form-control" value="{{array_key_exists('boxsubtitle', $about) && array_key_exists($i, $about['boxsubtitle']) && strlen($about['boxsubtitle'][$i]) > 0 ? $about['boxsubtitle'][$i] : ''}}">
                                    @error('box-subtitle')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative mt-4">
                                    <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" type="button" id="deleteBox-{{$i+1}}" onclick="deleteAboutBox({{$i+1}})"><i class="fa fa-fw fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                </div>
                @endfor
                @else
                <div class="box-div" id="whatweprovideboxdiv-1">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="position-relative mb-3">
                                <label for="box-image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="about[boximage][]" id="box-image-1" />
                                @error('box-image')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="box-title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="about[boxtitle][]" id="box-title-1" />
                                @error('box-title')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="box-subtitle" class="form-label">Sub Title</label>
                                <input type="text" name="about[boxsubtitle][]" id="box-subtitle-1" class="form-control">
                                @error('box-subtitle')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="position-relative mt-4">
                                <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" type="button" id="deleteBox-1" onclick="deleteAboutBox(1)"><i class="fa fa-fw fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <h5>Our performance column</h5>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="firstimage" class="form-label">1st Image</label>
                    <input type="file" name="about[firstimage]" id="firstimage" class="form-control" value="">
                    @if(array_key_exists('firstimage', $about) && !is_null($about['firstimage']))
                    <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $about['firstimage']) : url(env('APP_URL') . '/images/staticImages/' . $about['firstimage'])}}" height="100" width="100" />
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="optitle" class="form-label">Title</label>
                    <input type="text" name="about[optitle]" id="optitle" class="form-control" value="{{array_key_exists('optitle', $about) && strlen($about['optitle']) > 0 ? $about['optitle'] : ''}}">
                    @error('optitle')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="opsubtitle" class="form-label">Sub Title</label>
                    <input type="text" name="about[opsubtitle]" id="opsubtitle" class="form-control" value="{{array_key_exists('opsubtitle', $about) && strlen($about['opsubtitle']) > 0 ? $about['opsubtitle'] : ''}}">
                    @error('opsubtitle')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="opdescription" class="form-label">Description</label>
                    <input type="text" name="about[opdescription]" id="opdescription" class="form-control" value="{{array_key_exists('opdescription', $about) && strlen($about['opdescription']) > 0 ? $about['opdescription'] : ''}}">
                    @error('opdescription')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <h5>Who we Are coloumn</h5>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="wwatitle" class="form-label">Title</label>
                    <input type="text" name="about[wwatitle]" id="wwatitle" class="form-control" value="{{array_key_exists('wwatitle', $about) && strlen($about['wwatitle']) > 0 ? $about['wwatitle'] : ''}}">
                    @error('wwatitle')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="wwadescription" class="form-label">Description</label>
                    <input type="text" name="about[wwadescription]" id="wwadescription" class="form-control" value="{{array_key_exists('wwadescription', $about) && strlen($about['wwadescription']) > 0 ? $about['wwadescription'] : ''}}">
                    @error('wwadescription')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <h5>Our history column</h5>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="ohtitle" class="form-label">Title</label>
                    <input type="text" name="about[ohtitle]" id="ohtitle" class="form-control" value="{{array_key_exists('ohtitle', $about) && strlen($about['ohtitle']) > 0 ? $about['ohtitle'] : ''}}">
                    @error('ohtitle')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="ohdescription" class="form-label">Description</label>
                    <input type="text" name="about[ohdescription]" id="ohdescription" class="form-control" value="{{array_key_exists('ohdescription', $about) && strlen($about['ohdescription']) > 0 ? $about['ohdescription'] : ''}}">
                    @error('ohdescription')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <h5>Our mission column</h5>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="omtitle" class="form-label">Title</label>
                    <input type="text" name="about[omtitle]" id="wwatitle" class="form-control" value="{{array_key_exists('omtitle', $about) && strlen($about['omtitle']) > 0 ? $about['omtitle'] : ''}}">
                    @error('omtitle')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="position-relative mb-3">
                    <label for="omdescription" class="form-label">Description</label>
                    <input type="text" name="about[omdescription]" id="omdescription" class="form-control" value="{{array_key_exists('omdescription', $about) && strlen($about['omdescription']) > 0 ? $about['omdescription'] : ''}}">
                    @error('omdescription')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <h5>Rating Part</h5>
            <div class="col-md-2">
                <div class="position-relative mb-3">
                    <label for="ratingtext1" class="form-label">Rating Text 1 </label>
                    <input type="text" name="about[ratingtext1]" id="rating1" class="form-control" value="{{array_key_exists('ratingtext1', $about) && strlen($about['ratingtext1']) > 0 ? $about['ratingtext1'] : ''}}">
                    <label for="rating1" class="form-label">Rating Number 1</label>
                    <input type="number" name="about[rating1]" id="rating1" class="form-control" value="{{array_key_exists('rating1', $about) && strlen($about['rating1']) > 0 ? $about['rating1'] : ''}}">
                    @error('rating1')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative mb-3">
                    <label for="ratingtext2" class="form-label">Rating Text 2</label>
                    <input type="text" name="about[ratingtext2]" id="ratingtext2" class="form-control" value="{{array_key_exists('ratingtext2', $about) && strlen($about['ratingtext2']) > 0 ? $about['ratingtext2'] : ''}}">
                    <label for="rating2" class="form-label">Rating Number 2</label>
                    <input type="number" name="about[rating2]" id="rating2" class="form-control" value="{{array_key_exists('rating2', $about) && strlen($about['rating2']) > 0 ? $about['rating2'] : ''}}">
                    @error('rating1')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative mb-3">
                    <label for="ratingtext3" class="form-label">Rating Text 3</label>
                    <input type="text" name="about[ratingtext3]" id="ratingtext3" class="form-control" value="{{array_key_exists('ratingtext3', $about) && strlen($about['ratingtext3']) > 0 ? $about['ratingtext3'] : ''}}">
                    <label for="rating3" class="form-label">Rating Number 3</label>
                    <input type="number" name="about[rating3]" id="rating3" class="form-control" value="{{array_key_exists('rating3', $about) && strlen($about['rating3']) > 0 ? $about['rating3'] : ''}}">
                    @error('rating1')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative mb-3">
                    <label for="ratingtext4" class="form-label">Rating Text 4</label>
                    <input type="text" name="about[ratingtext4]" id="ratingtext4" class="form-control" value="{{array_key_exists('ratingtext4', $about) && strlen($about['ratingtext4']) ? $about['ratingtext4'] : ''}}">
                    <label for="rating4" class="form-label">Rating Number 4</label>
                    <input type="number" name="about[rating4]" id="rating4" class="form-control" value="{{array_key_exists('rating4', $about) && strlen($about['rating4']) ? $about['rating4'] : ''}}">
                    @error('rating1')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="position-relative mb-3">
                    <label for="ratingtext5" class="form-label">Rating Text 5</label>
                    <input type="text" name="about[ratingtext5]" id="ratingtext5" class="form-control" value="{{array_key_exists('ratingtext5', $about) && strlen($about['ratingtext5']) ? $about['ratingtext5'] : ''}}">
                    <label for="rating5" class="form-label">Rating Number 5</label>
                    <input type="number" name="about[rating5]" id="rating5" class="form-control" value="{{array_key_exists('rating5', $about) && strlen($about['rating5']) ? $about['rating5'] : ''}}">
                    @error('rating1')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
    </div>
    <button class="mt-1 btn btn-primary">Save</button>
    </form>
</div>
</div>

@endsection
@push('externalJavascripts')
<script src="{{asset('/backend/js/ckeditor/ckeditor.js')}}"></script>
@endpush

@push('javascripts')
<script>
    CKEDITOR.replace('description');
</script>
<script type="text/javascript" src="{{asset('backend/js/static-page.js')}}"></script>
@endpush