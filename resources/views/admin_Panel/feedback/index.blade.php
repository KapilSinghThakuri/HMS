<!-- index.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                  Breadcrumbs...
                </div>
                <div class="col-sm-6 text-right">
                    <a href="#" class="btn btn-danger btn-rounded">Back</a>
                </div>
            </div>

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
