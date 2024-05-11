@extends('admin_Panel.layout.main')
@section('Main-container')

@section('title_link', route('websiteinfo.index'))
@section('title', 'Website Info')
@section('button')
    <i class="fa fa-plus"></i> Add Info
@endsection
@section("button_link", route('websiteinfo.create'))

    <div class="page-wrapper">
        <div class="content">
            @include('admin_Panel.layout.breadcrumbs')
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover custom-table mb-0 datatable departmentTable">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Label</th>
                                    <th>Value</th>
                                    <th>Icon</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siteinfos as $siteinfo)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siteinfo->label }}</td>
                                    <td>{{ $siteinfo->value }}</td>
                                    <td>{!! $siteinfo->icon ?? '-' !!}</td>
                                    <td>
                                        <a href="{{ route('websiteinfo.edit',['websiteinfo' => $siteinfo->id])}}" style="font-size: 20px;" title="Click For Edit"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                        <a href="#" data-id="{{ $siteinfo->id }}" data-toggle="modal" data-target="#delete_info_{{ $siteinfo->id }}" style="font-size: 25px; color: red;" title="Click For Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <div id="delete_info_{{ $siteinfo->id }}" class="modal fade delete-modal" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
                                                <h3>Are you sure want to delete this Page Content?</h3>
                                                <div class="m-t-20 d-flex justify-content-center"> <a href="#" class="btn btn-white mr-2" data-dismiss="modal">Close</a>
                                                    <form action="{{ route('websiteinfo.destroy',['websiteinfo' => $siteinfo->id])}}" method="POST">
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
