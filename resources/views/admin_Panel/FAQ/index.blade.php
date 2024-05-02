@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                  Breadcrumbs...
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('faq.create')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add FAQ</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover custom-table mb-0 datatable departmentTable">
                            <thead>
                                <tr>
                                    <th>SNo</th>
                                    <th>Subject</th>
                                    <th>Questions</th>
                                    <th>Answers</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($faqs as $faq)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('faq.show',['faq'=> $faq->id])}}">
                                            {{ $faq->subject }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('faq.show',['faq'=> $faq->id])}}">
                                            {{ $faq->faq_question }}
                                        </a>
                                    </td>
                                    <td>{!! Str::limit($faq->faq_answer, 40, '...') !!}</td>
                                    <td>
                                        <a href="{{ route('faq.edit',['faq'=> $faq->id])}}" style="font-size: 20px;" title="Click For Edit"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                        <a href="#" data-id="{{ $faq->id }}" data-toggle="modal" data-target="#delete_faq_{{ $faq->id }}" style="font-size: 25px; color: red;" title="Click For Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <div id="delete_faq_{{ $faq->id }}" class="modal fade delete-modal" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
                                                <h3>Are you sure want to delete this FAQ?</h3>
                                                <div class="m-t-20 d-flex justify-content-center"> <a href="#" class="btn btn-white mr-2" data-dismiss="modal">Close</a>
                                                    <form action="{{ route('faq.destroy',['faq'=> $faq->id])}}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
