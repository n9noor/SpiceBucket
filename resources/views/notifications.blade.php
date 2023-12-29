@extends("layout")
@section("content")
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Notifications
            </div>
        </div>
    </div>
    <div class="container">
        <div class="mb-10 mt-10">
            <div class="row">
                <div class="col-lg-12 m-auto">
                    <div class="mb-10">
                        <h1 class="heading-2 mb-10">Your Notifications</h1>
                        <h6 class="text-body">There are <span class="text-brand">{{count($notifications)}}</span> notifications in this list</h6>
                    </div>
                    @if(count($notifications) > 0)
                    <div class="table-responsive shopping-summery">
                        <table class="table table-wishlist">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col" class="pl-30 start">Sl.no</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Notification</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($notifications as $key=>$notification)
                                <tr class="pt-30" id="wishlist-row-{{$notification->id}}">
                                    <td class="image product-thumbnail pt-10 pl-30">
                                        {{$key+1}}
                                    </td>
                                    <td class="product-des product-name" style="width:35%;">
                                        {{$notification->subject}}
                                    </td>
                                    <td class="price" data-title="Price">
                                        {{$notification->message}}
                                    </td>
                                    <td class="detail-info" data-title="Stock">
                                        {{$notification->created_at}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <img src="{{ URL::to('/') }}/images/coming-soon.png" alt="coming soon" class="image">
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection