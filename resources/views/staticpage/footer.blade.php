@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-page icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                Fotter Edit Page
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
        <form action="/administrator/edit-static-pages/save-footer" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="row">
                <h5>Subscribe Part</h5>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="subscribe-image" class="form-label">Subscribe Image</label>
                        <input type="file" class="form-control" name="footer[subscribeimage]" id="subscribe-image" />
                        @if(array_key_exists('subscribeimage', $footerData) && !is_null($footerData['subscribeimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['subscribeimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['subscribeimage'])}}" height="100" width="100" />
                        @endif
                        @error('subscribe-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="subscribe-image-title" class="form-label">Subscribe Image Title</label>
                        <input type="text" class="form-control" name="footer[subscribeimagetitle]" value="{{array_key_exists('subscribeimagetitle', $footerData) && strlen($footerData['subscribeimagetitle']) > 0 ? $footerData['subscribeimagetitle'] :  '' }}" id="subscribe-image-title" />
                        @error('subscribe-image-title')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="subscribe-image-subtitle" class="form-label">Subscribe Image Sub Title</label>
                        <input type="text" class="form-control" name="footer[subscribeimagesubtitle]" id="subscribe-image-subtitle" value="{{array_key_exists('subscribeimagesubtitle', $footerData) && strlen($footerData['subscribeimagesubtitle']) > 0 ? $footerData['subscribeimagesubtitle'] : ''}}" />
                        @error('subscribe-image-subtitle')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <h5>Properties Titles</h5>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="title1" class="form-label">Title 1</label>
                        <input type="text" class="form-control" name="footer[title1]" id="title1" value="{{array_key_exists('title1', $footerData) && strlen($footerData['title1']) > 0 ? $footerData['title1'] : ''}}" />
                        @error('title1')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="title2" class="form-label">Title 2</label>
                        <input type="text" class="form-control" name="footer[title2]" id="title2" value="{{array_key_exists('title2', $footerData) && strlen($footerData['title2']) > 0 ? $footerData['title2'] : ''}}" />
                        @error('title2')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="title3" class="form-label">Title 3</label>
                        <input type="text" class="form-control" name="footer[title3]" id="title3" value="{{array_key_exists('title3', $footerData) && strlen($footerData['title3']) > 0 ? $footerData['title3'] : ''}}" />
                        @error('title3')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="title4" class="form-label">Title 4</label>
                        <input type="text" class="form-control" name="footer[title4]" id="title4" value="{{array_key_exists('title4', $footerData) && strlen($footerData['title4']) > 0 ? $footerData['title4'] : ''}}" />
                        @error('title4')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="position-relative mb-3">
                        <label for="title5" class="form-label">Title 5</label>
                        <input type="text" class="form-control" name="footer[title5]" id="title5" value="{{array_key_exists('title5', $footerData) && strlen($footerData['title5']) > 0 ? $footerData['title5'] : ''}}" />
                        @error('title5')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <h5>Logo Part</h5>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="logo-image" class="form-label">Logo Image</label>
                        <input type="file" class="form-control" name="footer[logoimage]" id="logo-image" />
                        @if(array_key_exists('logoimage', $footerData) && !is_null($footerData['logoimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['logoimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['logoimage'])}}" height="100" width="100" />
                        @endif
                        @error('logo-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="google-review-image" class="form-label">Google Review Image</label>
                        <input type="file" class="form-control" name="footer[googlereviewimage]" id="google-review-image" />
                        @if(array_key_exists('googlereviewimage', $footerData) && !is_null($footerData['googlereviewimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['googlereviewimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['googlereviewimage'])}}" height="100" width="100" />
                        @endif
                        @error('google-review-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <h5>Follow Us Links</h5>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="fb-image" class="form-label">Facebook</label>
                        <input type="file" class="form-control" name="footer[fbimage]" id="fb-image" />
                        @if(array_key_exists('fbimage', $footerData) && !is_null($footerData['fbimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['fbimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['fbimage'])}}" height="100" width="100" />
                        @endif
                        @error('fb-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="fb-url" class="form-label">Facebook URL</label>
                        <input type="text" class="form-control" name="footer[fburl]" id="fb-url" value="{{array_key_exists('fburl', $footerData) && strlen($footerData['fburl']) > 0 ? $footerData['fburl'] : ''}}" />
                        @error('fb-url')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="twitter-image" class="form-label">Twiiter</label>
                        <input type="file" class="form-control" name="footer[twitterimage]" id="twitter-image" />
                        @if(array_key_exists('twitterimage', $footerData) && !is_null($footerData['twitterimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['twitterimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['twitterimage'])}}" height="100" width="100" />
                        @endif
                        @error('twitter-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="twitter-url" class="form-label">Twitter URL</label>
                        <input type="text" class="form-control" name="footer[twitterurl]" id="twitter-url" value="{{array_key_exists('twitterurl', $footerData) && strlen($footerData['twitterurl']) > 0 ? $footerData['twitterurl'] : ''}}" />
                        @error('twitter-url')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="instagram-image" class="form-label">Instagram</label>
                        <input type="file" class="form-control" name="footer[instagramimage]" id="instagram-image" />
                        @if(array_key_exists('instagramimage', $footerData) && !is_null($footerData['instagramimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['instagramimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['instagramimage'])}}" height="100" width="100" />
                        @endif
                        @error('instagram-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="instagram-url" class="form-label">Instagram URL</label>
                        <input type="text" class="form-control" name="footer[instagramurl]" id="instagram-url" value="{{array_key_exists('instagramurl', $footerData) && strlen($footerData['instagramurl']) > 0 ? $footerData['instagramurl'] : ''}}" />
                        @error('instagram-url')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="linkedin-image" class="form-label">Linkedin</label>
                        <input type="file" class="form-control" name="footer[linkedinimage]" id="linkedin-image" />
                        @if(array_key_exists('linkedinimage', $footerData) && !is_null($footerData['linkedinimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['linkedinimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['linkedinimage'])}}" height="100" width="100" />
                        @endif
                        @error('linkedin-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="linkedin-url" class="form-label">Linkedin URL</label>
                        <input type="text" class="form-control" name="footer[linkedinurl]" id="linkedin-url" value="{{array_key_exists('linkedinurl', $footerData) && strlen($footerData['linkedinurl']) > 0 ? $footerData['linkedinurl'] : ''}}" />
                        @error('linkedin-url')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="pintrest-image" class="form-label">Pintrest</label>
                        <input type="file" class="form-control" name="footer[pintrestimage]" id="pintrest-image" />
                        @if(array_key_exists('pintrestimage', $footerData) && !is_null($footerData['pintrestimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['pintrestimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['pintrestimage'])}}" height="100" width="100" />
                        @endif
                        @error('pintrest-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="pintrest-url" class="form-label">Pintrest URL</label>
                        <input type="text" class="form-control" name="footer[pintresturl]" id="pintrest-url" value="{{array_key_exists('pintresturl', $footerData) && strlen($footerData['pintresturl']) > 0 ? $footerData['pintresturl'] : ''}}" />
                        @error('pintrest-url')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="youtube-image" class="form-label">Youtube</label>
                        <input type="file" class="form-control" name="footer[youtubeimage]" id="youtube-image" />
                        @if(array_key_exists('youtubeimage', $footerData) && !is_null($footerData['youtubeimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['youtubeimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['youtubeimage'])}}" height="100" width="100" />
                        @endif
                        @error('youtube-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="youtube-url" class="form-label">Youtube URL</label>
                        <input type="text" class="form-control" name="footer[youtubeurl]" id="youtube-url" value="{{array_key_exists('youtubeurl', $footerData) && strlen($footerData['youtubeurl']) > 0 ? $footerData['youtubeurl'] : ''}}" />
                        @error('youtube-url')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <h5>Column 1</h5>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="footer-title1" class="form-label">Footer Title 1</label>
                        <input type="text" class="form-control" name="footer[footertitle1]" id="footer-title1" value="{{array_key_exists('footertitle1', $footerData) && strlen($footerData['footertitle1']) > 0 ? $footerData['footertitle1'] : ''}}" />
                        @error('footer-title1')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <button type="button" class="pull-right mb-2 mr-2 btn btn-shadow btn-outline-2x btn-outline-alternate" id="first-add-btn"><i class="fa fa-fw fa-plus"></i></button>
                </div>
                <div>@if(array_key_exists('firstsubtitle', $footerData))
                    @for($i=0; $i<count($footerData['firstsubtitle']); $i++)
                    <div class="first-title-div" id="first-div-1">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="first-subtitle-1" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" name="footer[firstsubtitle][]" id="first-subtitle-1" value="{{array_key_exists('firstsubtitle', $footerData) && strlen($footerData['firstsubtitle'][$i]) > 0 ? $footerData['firstsubtitle'][$i] : ''}}" />
                                    @error('first-subtitle-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative mt-2">
                                    <label for="first-subtitle-url-1" class="first-form-label">Subtitle URL</label>
                                    <input type="text" class="form-control" name="footer[firstsubtitleurl][]" id="first-subtitle-url-1" value="{{array_key_exists('firstsubtitleurl', $footerData) && strlen($footerData['firstsubtitleurl'][$i]) > 0 ? $footerData['firstsubtitleurl'][$i] : ''}}" />
                                    @error('first-subtitle-url-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative mt-4">
                                    <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteFirstDiv(1)" id="delete-first-div-1" type="button"><i class="fa fa-fw fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                    @else
                    <div class="first-title-div" id="first-div-1">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="first-subtitle-1" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" name="footer[firstsubtitle][]" id="first-subtitle-1" />
                                    @error('first-subtitle-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative mt-2">
                                    <label for="first-subtitle-url-1" class="first-form-label">Subtitle URL</label>
                                    <input type="text" class="form-control" name="footer[firstsubtitleurl][]" id="first-subtitle-url-1"  />
                                    @error('first-subtitle-url-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative mt-4">
                                    <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteFirstDiv(1)" id="delete-first-div-1" type="button"><i class="fa fa-fw fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <h5>Column 2</h5>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="footer-title2" class="form-label">Footer Title 2</label>
                        <input type="text" class="form-control" name="footer[footertitle2]" id="footer-title2" value="{{array_key_exists('footertitle2', $footerData) && strlen($footerData['footertitle2']) > 0 ? $footerData['footertitle2'] : ''}}" />
                        @error('footer-title2')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <button type="button" class="pull-right mb-2 mr-2 btn btn-shadow btn-outline-2x btn-outline-alternate" id="second-add-btn"><i class="fa fa-fw fa-plus"></i></button>
                </div>
                <div>@if(array_key_exists('secondsubtitle', $footerData))
                      @for($i=0; $i<count($footerData['secondsubtitle']); $i++)
                    <div class="second-title-div" id="second-div-1">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="second-subtitle-1" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" name="footer[secondsubtitle][]" id="second-subtitle-1" value="{{array_key_exists('secondsubtitle', $footerData) && strlen($footerData['secondsubtitle'][$i]) > 0 ? $footerData['secondsubtitle'][$i] : ''}}"  />
                                    @error('second-subtitle-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="second-subtitle-url-1" class="form-label">Subtitle URL</label>
                                    <input type="text" class="form-control" name="footer[secondsubtitleurl][]" id="second-subtitle-url-1" value="{{array_key_exists('secondsubtitleurl', $footerData) && strlen($footerData['secondsubtitleurl'][$i]) > 0 ? $footerData['secondsubtitleurl'][$i] : ''}}"  />
                                    @error('second-subtitle-url-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative mt-4">
                                    <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteSecondDiv(1)" id="delete-second-div-1" type="button"><i class="fa fa-fw fa-trash"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endfor
                    @else
                    <div class="second-title-div" id="second-div-1">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="second-subtitle-1" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" name="footer[secondsubtitle][]" id="second-subtitle-1" />
                                    @error('second-subtitle-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="second-subtitle-url-1" class="form-label">Subtitle URL</label>
                                    <input type="text" class="form-control" name="footer[secondsubtitleurl][]" id="second-subtitle-url-1"  />
                                    @error('second-subtitle-url-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative mt-4">
                                    <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteSecondDiv(1)" id="delete-second-div-1" type="button"><i class="fa fa-fw fa-trash"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endif
                </div>
                <h5>Column 3</h5>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="footer-title3" class="form-label">Footer Title 3</label>
                        <input type="text" class="form-control" name="footer[footertitle3]" id="footertitle3" value="{{array_key_exists('footertitle3', $footerData) && strlen($footerData['footertitle3']) > 0 ? $footerData['footertitle3'] : ''}}" />
                        @error('footer-title3')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <button type="button" class="pull-right mb-2 mr-2 btn btn-shadow btn-outline-2x btn-outline-alternate" id="third-add-btn"><i class="fa fa-fw fa-plus"></i></button>
                </div>
                <div>@if(array_key_exists('thirdsubtitle', $footerData))
                      @for($i=0; $i<count($footerData['thirdsubtitle']); $i++)
                    <div class="third-title-div" id="third-div-1">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="third-subtitle-1" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" name="footer[thirdsubtitle][]" id="third-subtitle-1"  value="{{array_key_exists('thirdsubtitle', $footerData) && strlen($footerData['thirdsubtitle'][$i]) > 0 ? $footerData['thirdsubtitle'][$i] : ''}}" />
                                    @error('third-subtitle-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="third-subtitle-url-1" class="form-label">Subtitle URL</label>
                                    <input type="text" class="form-control" name="footer[thirdsubtitleurl][]" id="third-subtitle-url-1"value="{{array_key_exists('thirdsubtitleurl', $footerData) && strlen($footerData['thirdsubtitleurl'][$i]) > 0 ? $footerData['thirdsubtitleurl'][$i] : ''}}"  />
                                    @error('third-subtitle-url-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative mt-4">
                                    <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" type="button" onclick="deleteThirdDiv(1)" id="delete-third-div-1"><i class="fa fa-fw fa-trash"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endfor
                    @else
                    <div class="third-title-div" id="third-div-1">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="third-subtitle-1" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" name="footer[thirdsubtitle][]" id="third-subtitle-1"/>
                                    @error('third-subtitle-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="third-subtitle-url-1" class="form-label">Subtitle URL</label>
                                    <input type="text" class="form-control" name="footer[thirdsubtitleurl][]" id="third-subtitle-url-1" />
                                    @error('third-subtitle-url-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative mt-4">
                                    <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" type="button" onclick="deleteThirdDiv(1)" id="delete-third-div-1"><i class="fa fa-fw fa-trash"></i></button>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endif
                </div>
                <h5>Column 4</h5>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="footer-title4" class="form-label">Footer Title 4</label>
                        <input type="text" class="form-control" name="footer[footertitle4]" id="footer-title4" value="{{array_key_exists('footertitle4', $footerData) && strlen($footerData['footertitle4']) > 0 ? $footerData['footertitle4'] : ''}}" />
                        @error('footer-title4')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <button type="button" class="pull-right mb-2 mr-2 btn btn-shadow btn-outline-2x btn-outline-alternate" id="fourth-add-btn"><i class="fa fa-fw fa-plus"></i></button>
                </div>
                <div>
                @if(array_key_exists('fourthsubtitle', $footerData))
                    @for($i=0; $i<count($footerData['fourthsubtitle']); $i++)
                    <div class="fourth-title-div" id="fourth-div-1">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="fourth-subtitle-1" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" name="footer[fourthsubtitle][]" id="fourth-subtitle-1" value="{{array_key_exists('fourthsubtitle', $footerData) && strlen($footerData['fourthsubtitle'][$i]) > 0 ? $footerData['fourthsubtitle'][$i] : ''}}" />
                                    @error('fourth-subtitle-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative mt-2">
                                    <label for="fourth-subtitle-url-1" class="fourth-form-label">Subtitle URL</label>
                                    <input type="text" class="form-control" name="footer[fourthsubtitleurl][]" id="fourth-subtitle-url-1" value="{{array_key_exists('fourthsubtitleurl', $footerData) && strlen($footerData['fourthsubtitleurl'][$i]) > 0 ? $footerData['fourthsubtitleurl'][$i] : ''}}" />
                                    @error('fourth-subtitle-url-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative mt-4">
                                    <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteFourthDiv(1)" id="delete-fourth-div-1" type="button"><i class="fa fa-fw fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                    @else
                    <div class="fourth-title-div" id="fourth-div-1">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="position-relative mb-3">
                                    <label for="fourth-subtitle-1" class="form-label">Subtitle</label>
                                    <input type="text" class="form-control" name="footer[fourthsubtitle][]" id="fourth-subtitle-1"/>
                                    @error('fourth-subtitle-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="position-relative mt-2">
                                    <label for="fourth-subtitle-url-1" class="fourth-form-label">Subtitle URL</label>
                                    <input type="text" class="form-control" name="footer[fourthsubtitleurl][]" id="fourth-subtitle-url-1" />
                                    @error('fourth-subtitle-url-1')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="position-relative mt-4">
                                    <button class="pull-right btn btn-shadow btn-outline-2x btn-outline-danger" onclick="deleteFourthDiv(1)" id="delete-fourth-div-1" type="button"><i class="fa fa-fw fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="play-store-image" class="form-label">Play Store image</label>
                        <input type="file" class="form-control" name="footer[playstoreimage]" id="play-store-image" />
                        @if(array_key_exists('playstoreimage', $footerData) && !is_null($footerData['playstoreimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['playstoreimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['playstoreimage'])}}" height="100" width="100" />
                        @endif
                        @error('play-store-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="play-store-image-url" class="form-label">Play Store URL</label>
                        <input type="text" class="form-control" name="footer[playstoreimageurl]" id="play-store-image-url" value="{{array_key_exists('playstoreimageurl', $footerData) && strlen($footerData['playstoreimageurl']) > 0 ? $footerData['playstoreimageurl'] : ''}}" />
                        @error('play-store-image-url')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="app-store-image" class="form-label">App Store image</label>
                        <input type="file" class="form-control" name="footer[appstoreimage]" id="app-store-image" />
                        @if(array_key_exists('appstoreimage', $footerData) && !is_null($footerData['appstoreimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['appstoreimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['appstoreimage'])}}" height="100" width="100" />
                        @endif
                        @error('app-store-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="app-store-image-url" class="form-label">App Store URL</label>
                        <input type="text" class="form-control" name="footer[appstoreimageurl]" id="app-store-image-url" value="{{array_key_exists('appstoreimageurl', $footerData) && strlen($footerData['appstoreimageurl']) > 0 ? $footerData['appstoreimageurl'] : ''}}" />
                        @error('app-store-image-url')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="position-relative mb-3">
                        <label for="secure-payment-image" class="form-label">Secure payment image</label>
                        <input type="file" class="form-control" name="footer[securepaymentimage]" id="secure-payment-image" />
                        @if(array_key_exists('securepaymentimage', $footerData) && !is_null($footerData['securepaymentimage']))
                            <img src="{{env('APP_ENV') == 'production' ? url(env('APP_URL') . '/public/images/staticImages/' . $footerData['securepaymentimage']) : url(env('APP_URL') . '/images/staticImages/' . $footerData['securepaymentimage'])}}" height="100" width="100" />
                        @endif
                        @error('secure-payment-image')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="copyright" class="form-label">Copyright</label>
                        <input type="text" class="form-control" name="footer[copyright]" id="copyright" value="{{array_key_exists('copyright', $footerData) && strlen($footerData['copyright']) > 0 ? $footerData['copyright'] : ''}}" />
                        @error('copyright')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="supportnumber" class="form-label">Support Number</label>
                        <input type="text" class="form-control" name="footer[supportnumber]" id="supportnumber" value="{{array_key_exists('supportnumber', $footerData) && strlen($footerData['supportnumber']) > 0 ? $footerData['supportnumber'] : ''}}" />
                        @error('supportnumber')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="whatsappnumber" class="form-label">Whatsapp Number</label>
                        <input type="text" class="form-control" name="footer[whatsappnumber]" id="whatsappnumber" value="{{array_key_exists('whatsappnumber', $footerData) && strlen($footerData['whatsappnumber']) > 0 ? $footerData['whatsappnumber'] : ''}}" />
                        @error('whatsappnumber')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="position-relative mb-3">
                        <label for="email" class="form-label">Support Email</label>
                        <input type="text" class="form-control" name="footer[email]" id="email" value="{{array_key_exists('email', $footerData) && strlen($footerData['email']) > 0 ? $footerData['email'] : ''}}" />
                        @error('email')
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
@push('javascripts')

<script type="text/javascript" src="{{asset('backend/js/static-page.js')}}"></script>
@endpush