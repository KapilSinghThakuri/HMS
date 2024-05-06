<!-- index.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')

@section('button')
    <i class="fa fa-plus"></i> Add Menu
@endsection
@section("button_link", route('menu.create'))


    <div class="page-wrapper">
        <div class="content">

            @include('admin_Panel.layout.breadcrumbs')

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover menu_table">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Display Order</th>
                                    <th>Menu Name</th>
                                    <th>Menu Parent</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $menu->display_order }}</td>
                                    <td>{{ $menu->menu_name['en'] }}</td>
                                    <td>{{ $menu->parent_id ?? '-' }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('menu.StatusUpdate',['menuId'=> $menu->id])}}">
                                            @csrf
                                            @method('PATCH')
                                             <input type="hidden" name="status" value="0">
                                            <div class="status_toggle_switch">
                                                <input type="checkbox" name="status" class="status_toggle_input" id="toggle_{{ $menu->id }}"
                                                   onchange="this.form.submit()"  value = "1" {{ $menu->status ? 'checked' : '' }}>
                                                <label class="status_toggle_label" for="toggle_{{ $menu->id }}"></label>
                                            </div>
                                        </form>
                                    </td>

                                    <td>
                                        <a href="{{ route('menu.edit',['menu'=> $menu->id])}}" style="font-size: 20px;" title="Click For Edit"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                        <a href="#" data-id="{{ $menu->id }}" data-toggle="modal" data-target="#delete_menu_{{ $menu->id }}" style="font-size: 25px; color: red;" title="Click For Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                    <div id="delete_menu_{{ $menu->id }}" class="modal fade delete-modal" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
                                                    <h3>Are you sure want to delete this Menu?</h3>
                                                    <div class="m-t-20 d-flex justify-content-center"> <a href="#" class="btn btn-white mr-2" data-dismiss="modal">Cancel</a>
                                                        <form action="{{ route('menu.destroy',['menu'=>$menu->id ])}}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
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
