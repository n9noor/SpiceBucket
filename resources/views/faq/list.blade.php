@extends("wms.layout")
@section("content")
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-page icon-gradient bg-sunny-morning"></i>
            </div>
            <div>
                FAQ Add Page
                <div class="page-title-subheading">&nbsp;</div>
            </div>
        </div>
        <div class="page-title-actions">
            @if(session('admin-logged-in') == true)
            <button type="button" onclick="$('#add-faq-id').val(0)" data-bs-toggle="modal" data-bs-target="#add-faq" title="Add FAQ" class="btn-icon btn-shadow me-3 btn btn-dark"><i class="fa fa-plus btn-icon-wrapper"></i> Add FAQ
            </button>
            @endif
        </div>
    </div>
</div>
<div class="main-card mb-3 card">
    <div class="g-0 row pt-3 pb-2 px-3">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Questions</th>
                        <th>Answers</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($faqs as $faq)
                    <tr>
                        <td>
                            @if(session('admin-logged-in') == true)
                            <button type="button" onclick="$('#add-faq-id').val({{$faq->id}});editFaq();" data-bs-toggle="modal" data-bs-target="#add-faq" title="Edit FAQ" class="btn-icon btn-shadow me-3 btn btn-dark"><i class="fa fa-plus btn-icon-wrapper"></i> Edit FAQ
                            </button>
                            @endif
                        </td>
                        <td>{{$faq->question}}</td>
                        <td><textarea style="width:100%; border:none" disabled>{{$faq->answer}}</textarea></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('javascripts')
<script>
    function editFaq() {
		$('#question').val('');
		$('#answer').val('');
        var modalid = $('#add-faq-id').val();
        if (!isNaN(parseInt(modalid)) && parseInt(modalid) > 0) {
            $.ajax({
                type: 'get',
                url: '/administrator/get-faq/' + modalid,
                success: function(result) {
                    if (result.status == true) {
                        $('#question').val(result.faq.question);
                        $('#answer').val(result.faq.answer);
                    } else {

                    }
                }
            });
        }
    }
</script>
<div class="modal" id="add-faq" tabindex="-1" role="dialog" aria-labelledby="add-faq-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-faq-modal-label">FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/administrator/add-faq" action="post">
				<input type="hidden" name="addfaqid" id="add-faq-id" />
                <div class="modal-body">
                    <div class="position-relative mb-3">
                        <label for="question" class="form-label">Question</label>
                        <input required type="text" class="form-control" name="question" id="question" placeholder="Enter Question" />
                    </div>
                    <div class="position-relative mb-3">
                        <label for="answer" class="form-label">Question</label>
                        <textarea required class="form-control" name="answer" id="answer" placeholder="Enter Answer"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="save-faq" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush
