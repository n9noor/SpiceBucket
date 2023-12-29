@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-page icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Header Edit Page
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
        <form action="/administrator/edit-static-pages/save-header" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="row">
                <h5>Top Bar</h5>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="first-coloumn-title" class="form-label">1st Column Title</label>
                        <input type="text" class="form-control" name="header[firstcoloumntitle]" id="first-coloumn-title" value="{{array_key_exists('firstcoloumntitle', $header) && strlen($header['firstcoloumntitle']) > 0 ? $header['firstcoloumntitle'] : ''}}"/>
                        @error('first-coloumn-title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="first-coloumn-title-url" class="form-label">URL</label>
                        <input type="text" class="form-control" name="header[firstcoloumntitleurl]" id="first-coloumn-title-url"  value="{{array_key_exists('firstcoloumntitleurl', $header) && strlen($header['firstcoloumntitleurl']) > 0 ? $header['firstcoloumntitleurl'] : ''}}"/>
                        @error('first-coloumn-title-url')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <input type="text" class="form-control" name="header[firstcoloumntitlesecondpart]" id="first-coloumn-title-second-part" value="{{array_key_exists('firstcoloumntitlesecondpart', $header) && strlen($header['firstcoloumntitlesecondpart']) > 0 ? $header['firstcoloumntitlesecondpart'] : ''}}"/>
                        @error('first-coloumn-title-second-part')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <input type="text" class="form-control" name="header[firstcoloumntitlesecondparturl]" id="first-coloumn-title-second-part-url"  value="{{array_key_exists('firstcoloumntitlesecondparturl', $header) && strlen($header['firstcoloumntitlesecondparturl']) > 0 ? $header['firstcoloumntitlesecondparturl'] : ''}}"/>
                        @error('first-coloumn-title-second-part-url')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="position-relative mb-3">
                        <label for="second-coloumn-title" class="form-label">2nd Column Content</label>
                        <textarea style="height: 100px;" class="form-control" name="header[secondcoloumntitle]" id="second-coloumn-title">{{array_key_exists('secondcoloumntitle', $header) && strlen($header['secondcoloumntitle']) > 0 ? $header['secondcoloumntitle'] : ''}}</textarea>
                        @error('second-coloumn-title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="third-coloumn-title" class="form-label">3rd Column Title</label>
                        <input type="text" class="form-control" name="header[thirdcoloumntitle]" id="third-coloumn-title" value="{{array_key_exists('thirdcoloumntitle', $header) && strlen($header['thirdcoloumntitle']) > 0 ? $header['thirdcoloumntitle'] :  ''}}"/>
                        @error('third-coloumn-title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="customer-support-number" class="form-label">Customer Support Number: </label>
                        <input type="text" class="form-control" name="header[customersupportnumber]" id="customer-support-number" value="{{array_key_exists('customersupportnumber', $header) && strlen($header['customersupportnumber']) > 0 ? $header['customersupportnumber'] : ''}}"/>
                        @error('customer-support-number')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <h5>Logo Part</h5>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="logo-image" class="form-label">Logo Image</label>
                        <input type="file" class="form-control" name="header[logoimage]" id="logo-image"/>
                        @if(array_key_exists('logoimage', $header) && !is_null($header['logoimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $header['logoimage']) : url(env('APP_URL') . '/images/staticImages/' . $header['logoimage'])}}" height="100" width="100" />
                        @endif
                        @error('logo-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="support-number" class="form-label">Support Number</label>
                        <input type="text" class="form-control" name="header[supportnumber]" id="support-number" value="{{array_key_exists('supportnumber', $header) && strlen($header['supportnumber']) > 0 ? $header['supportnumber'] : ''}}"/>
                        @error('support-number')
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