@extends("layout")
@section("content")
<main id="static-page-{{$page->id}}" class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> {{ ucwords($page->title) }}
            </div>
        </div>
    </div>
    <div class="page-content pt-50">
        <div class="container">
            <div class="row mb-30">
                {!! $page->description !!}
            </div>
        </div>
    </div>
</main>
@endsection

@push('javascripts')
<script>

</script>
@endpush