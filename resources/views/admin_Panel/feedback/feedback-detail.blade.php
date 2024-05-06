<!-- feedback-detail.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')

@section('title_link', route('feedback.index'))
@section('title', 'Feedback')
@section('action', 'View Feedback')
@section('button')
    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
@endsection
@section("button_link", route('feedback.index'))
    <div class="page-wrapper">
        <div class="content">
            @include('admin_Panel.layout.breadcrumbs')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title text-center border-bottom">
                                User Feedback Details
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Full Name:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $feedbackDetail->fullname }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <strong>Email:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $feedbackDetail->email }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <strong>Subject:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $feedbackDetail->subject }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <strong>Feedback Message:</strong>
                                </div>
                                <div class="col-md-9">
                                    {{ $feedbackDetail->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
