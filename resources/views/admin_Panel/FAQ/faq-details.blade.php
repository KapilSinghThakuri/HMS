@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                  Breadcrumbs...
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-danger btn-rounded" href="{{ route('faq.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $faq->subject }}</h5>
                            <h5 class="card-subtitle mb-2 text-muted">Question:</h5>
                            <p class="card-text">{{ $faq->faq_question }}</p>
                            <h5 class="card-subtitle mb-2 text-muted">Answer:</h5>
                            <p class="card-text">{!! $faq->faq_answer !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
