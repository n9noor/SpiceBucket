@extends("layout")
@section("content")

<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="/" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> FAQ
            </div>
        </div>
    </div>
    <div class="container">
        <section class="mt-60 mb-60">
            <div class="ck-content">
                <div>
                    <div class="faqs-list">
                        <h4>Frequenty Asked Questions</h4>
                        <div id="faq-accordion-0" class="accordion">
                            @foreach($faqs as $faq)
                            <div class="card">
                                <div id="heading-faq-0-{{$faq->id}}" class="card-header">
                                    <h2 class="mb-0"  ><button type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-0-{{$faq->id}}"  aria-expanded="false" aria-controls="collapse-faq-0-{{$faq->id}}" class="btn-link btn-block text-left collapsed">{{$faq->question}}</button></h2>
                                </div>
                                <div id="collapse-faq-0-{{$faq->id}}" aria-labelledby="heading-faq-0-{{$faq->id}}" data-parent="#faq-accordion-0" class="collapse">
                                    <div class="card-body">{{$faq->answer}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>


@endsection