<!-- feedback-detail.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                  Breadcrumbs...
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('feedback.index')}}" class="btn btn-danger btn-rounded">Back</a>
                </div>
            </div>
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
