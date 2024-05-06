@extends('admin_Panel.layout.main')
@section('Main-container')

@section('title_link', route('faq.index'))
@section('title', 'FAQ')
@section('action', 'View FAQ')
@section('button')
    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
@endsection
@section("button_link", route('faq.index'))
    <div class="page-wrapper">
        <div class="content">
            @include('admin_Panel.layout.breadcrumbs')

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
