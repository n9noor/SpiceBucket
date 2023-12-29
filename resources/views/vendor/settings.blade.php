@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-user icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Settings: {{$vendor->store_name}}
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
        <form action="/sellers/update-setting" method="post" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label class="form-label">Slider Images</label>
                        @php $counter = count($sliderImages); @endphp
                        @foreach($sliderImages as $image)
                        <div class="row">
                            <div class="col-md-8 mb-2">
                                <input name="sliderimage[]" type="file" class="form-control mb-1">
                                <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $image['image']) : url('/images/vendors/' . $image['image']) }}" class="img-thumbnail" />
                            </div>
                            <div class="col-md-3 mb-2">
                                <select name="slidercategory[]" class="form-control mb-1">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                    <option {{$image['category'] == $category->id ? "selected='selected'" : ""}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 mb-2">
                                <button type="button" onclick="deleteSliderImage('{{$image['image']}}')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-8">
                                <input name="sliderimage[]" type="file" class="form-control mb-1">
                            </div>
                            <div class="col-md-3">
                                <select name="slidercategory[]" class="form-control mb-1">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" id="add-vendor-slider-image-btn" onclick="addSliderImage()" class="btn btn-danger"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        @error('sliderimage')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
				<div class="col-md-1">&nbsp;</div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="position-relative mb-3">
                                @php $vendor_offer_image_1 = is_null($vendor->vendor_offer_image_1) ? array('image' => '', 'category' => '') : json_decode($vendor->vendor_offer_image_1, true); @endphp
                                <label for="vendor_offer_image_1" class="form-label">Offer Image 1</label>
                                <input name="vendor_offer_image_1" id="vendor_offer_image_1" type="file" class="form-control mt-1">
                                <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_1['image']) : url('/images/vendors/' . $vendor_offer_image_1['image']) }}" class="img-thumbnail" />
                                @error('image')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="vendor_offer_category_1" class="form-control mb-1 mt-4">
                                <option value=""></option>
                                @foreach($categories as $category)
                                <option {{$vendor_offer_image_1['category'] == $category->id ? "selected='selected'" : ""}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <div class="position-relative mb-3">
                                @php $vendor_offer_image_2 = is_null($vendor->vendor_offer_image_2) ? array('image' => '', 'category' => '') : json_decode($vendor->vendor_offer_image_2, true); @endphp
                                <label for="vendor_offer_image_2" class="form-label">Offer Image 2</label>
                                <input name="vendor_offer_image_2" id="vendor_offer_image_2" type="file" class="form-control mt-1">
                                <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_2['image']) : url('/images/vendors/' . $vendor_offer_image_2['image']) }}" class="img-thumbnail m-2" />
                                @error('image')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="vendor_offer_category_2" class="form-control mb-1 mt-4">
                                <option value=""></option>
                                @foreach($categories as $category)
                                <option {{$vendor_offer_image_2['category'] == $category->id ? "selected='selected'" : ""}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <div class="position-relative mb-3">
                                @php $vendor_offer_image_3 = is_null($vendor->vendor_offer_image_3) ? array('image' => '', 'category' => '') : json_decode($vendor->vendor_offer_image_3, true); @endphp
                                <label for="vendor_offer_image_3" class="form-label">Offer Image 3</label>
                                <input name="vendor_offer_image_3" id="vendor_offer_image_3" type="file" class="form-control  mt-1">
                                <img src="{{ env('APP_ENV') == 'production' ? url('/public/images/vendors/' . $vendor_offer_image_3['image']) : url('/images/vendors/' . $vendor_offer_image_3['image']) }}" class="img-thumbnail m-2" />
                                @error('image')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="vendor_offer_category_3" class="form-control mb-1 mt-4">
                                <option value=""></option>
                                @foreach($categories as $category)
                                <option {{$vendor_offer_image_3['category'] == $category->id ? "selected='selected'" : ""}} value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @foreach($types as $type)
                <div class="col-md-3">
                    <div class="position-relative mb-3 document-style">
                        <label for="document-{{str_replace(' ', '-', strtolower($type->type))}}" class="form-label">{{$type->type}}</label>
                        <input name="document[{{str_replace(' ', '_', strtolower($type->type))}}]" id="document-{{str_replace(' ', '-', strtolower($type->type))}}" type="file" class="form-control">
                        @if(array_key_exists(str_replace(' ', '_', strtolower($type->type)), $documents))
                        @if(substr($documents[str_replace(' ', '_', strtolower($type->type))], -4) == ".pdf")
                        <a class="m-2" target="_blank" href="{{env('APP_ENV') == 'production' ? url('/public/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))]) : url('/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])}}"><img src="{{asset('/images/pdficon.png')}}" class="mx-5 my-3 img-thumbnail" width="200" height="200" /></a>
                        @else
                        <a class="m-2" target="_blank" href="{{env('APP_ENV') == 'production' ? url('/public/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))]) : url('/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])}}"><img src="{{env('APP_ENV') == 'production' ? asset('/public/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))]) : asset('/backend/vendor-document/' . $vendor->gst . '/' . $documents[str_replace(' ', '_', strtolower($type->type))])}}" class="mx-5 my-3 img-thumbnail" width="200" height="200" /></a>
                        @endif
                        @endif
                        @error("document[{{str_replace(' ', '_', strtolower($type->type))}}]")
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                @endforeach
                @error("document")
                <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <button class="mt-1 btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
@push('javascripts')
<script type="text/javascript" src="{{asset('backend/js/vendor-function.js')}}"></script>
<script>
    function addSliderImage() {
        var count = $('#add-vendor-slider-image-btn').parent().parent().parent().find('.row').length;
        var html = '<div class="row">' +
            '<div class="col-md-8">' +
            '<input name="sliderimage[]" type="file" class="form-control mb-1">' +
            '</div>' +
            '<div class="col-md-3">' +
            '<select name="slidercategory[]" class="form-control mb-1"><option value=""></option>';
        @foreach($categories as $category)
        html += '<option value="{{$category->id}}">{{$category->name}}</option>';
        @endforeach
        html += '</select>' +
            '</div>' +
            '<div class="col-md-1">' +
            '<button type="button" id="add-vendor-slider-image-btn" onclick="$(this).parent().parent().remove();" class="btn btn-danger"><i class="fa fa-trash"></i></button>' +
            '</div>' +
            '</div>';
        $('#add-vendor-slider-image-btn').parent().parent().parent().find('label').after(html);
    }
</script>
@endpush