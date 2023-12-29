@extends("wms.layout")
@section("content")

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-page icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Contact Us Edit Page
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
        <form action="/administrator/edit-static-pages/save-contact" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf
           <!-- madhav <div class="row">
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="google-map-link" class="form-label">Google Map Link</label>
                        <input type="text" class="form-control" name="contact[googlemaplink]" id="google-map-link" value="{{array_key_exists('googlemaplink', $contact) && strlen($contact['googlemaplink']) > 0 ? $contact['googlemaplink'] : ''}}" />
                        @error('google-map-link')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div> -->
            <h4>Office Addresses</h4>
            <div>
                <button type="button" class="pull-right mb-2 mr-2 btn btn-shadow btn-outline-2x btn-outline-alternate" id="office-add-btn"><i class="fa fa-fw fa-plus"></i></button>
                @if(array_key_exists('officename', $contact))
                    @for($i=0; $i<count($contact['officename']); $i++)
                <div id="officediv-{{$i+1}}" class="officeaddressdiv">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="officename" class="form-label">Office Name</label>
                                <input type="text" class="form-control" name="contact[officename][]" id="officename-{{$i+1}}" value="{{array_key_exists('officename', $contact) && strlen($contact['officename'][$i]) > 0 ? $contact['officename'][$i] : ''}}" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="officeaddress" class="form-label">Office Address</label>
                                <input type="text" class="form-control" name="contact[officeaddress][]" id="officeaddress-{{$i+1}}" value="{{array_key_exists('officeaddress', $contact) && strlen($contact['officeaddress'][$i]) > 0 ? $contact['officeaddress'][$i] : ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="officephone" class="form-label">Office Phone</label>
                                <input type="text" class="form-control" name="contact[officephone][]" id="officephone-{{$i+1}}" value="{{array_key_exists('officephone', $contact) && strlen($contact['officephone'][$i]) > 0 ? $contact['officephone'][$i] : ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="officeemail" class="form-label">Office Email</label>
                                <input type="email" class="form-control" name="contact[officeemail][]" id="officeemail-{{$i+1}}" value="{{array_key_exists('officeemail', $contact) && strlen($contact['officeemail'][$i]) > 0 ? $contact['officeemail'][$i] : ''}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="officemapurl" class="form-label">Office Map URL</label>
                                <input type="text" class="form-control" name="contact[officemapurl][]" id="officemapurl-{{$i+1}}" value="{{array_key_exists('officemapurl', $contact) && strlen($contact['officemapurl'][$i]) > 0 ? $contact['officemapurl'][$i] : ''}}">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="position-relative mt-4">
                                <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteOfficeDiv({{$i+1}})" id="delete-fourth-div-{{$i+1}}" type="button"><i class="fa fa-fw fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
                @else
                <div id="officediv-1" class="officeaddressdiv">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="officename" class="form-label">Office Name</label>
                                <input type="text" class="form-control" name="contact[officename][]" id="officename-1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="officeaddress" class="form-label">Office Address</label>
                                <input type="text" class="form-control" name="contact[officeaddress][]" id="officeaddress-1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="officephone" class="form-label">Office Phone</label>
                                <input type="text" class="form-control" name="contact[officephone][]" id="officephone-1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="officeemail" class="form-label">Office Email</label>
                                <input type="email" class="form-control" name="contact[officeemail][]" id="officeemail-1">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="position-relative mb-3">
                                <label for="officemapurl" class="form-label">Office Map URL</label>
                                <input type="text" class="form-control" name="contact[officemapurl][]" id="officemapurl-1">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="position-relative mt-4">
                                <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteOfficeDiv(1)" id="delete-fourth-div-1" type="button"><i class="fa fa-fw fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
            <button class="mt-1 btn btn-primary">Save</button>
        </form>
    </div>
</div>

@endsection
@push('javascripts')

<script type="text/javascript" src="{{asset('backend/js/static-page.js')}}"></script>
@endpush