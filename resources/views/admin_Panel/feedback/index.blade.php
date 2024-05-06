<!-- index.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')

@section('title_link', route('feedback.index'))
@section('title', 'Feedback')
@section('button')
    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
@endsection
@section("button_link", route('admin.dashboard'))
    <div class="page-wrapper">
        <div class="content">
            @include('admin_Panel.layout.breadcrumbs')

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover custom-table mb-0 datatable departmentTable">
                            <thead>
                                <tr>
                                    <th>SNo</th>
                                    <th>Fullname</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Feedback Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userfeedbacks as $userfeedback)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('feedback.show',['feedback'=>$userfeedback->id])}}">
                                            {{ $userfeedback->fullname }}
                                        </a>
                                    </td>
                                    <td>{{ $userfeedback->email }}</td>
                                    <td>{{ $userfeedback->subject }}</td>
                                    <td>{!! Str::limit($userfeedback->message, 40, '...') !!}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $userfeedbacks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
