<!-- create.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')
@inject('module_helper','App\Helpers\ModuleHelper')
@inject('page_helper','App\Helpers\PageHelper')
@inject('menu_helper','App\Helpers\MenuHelper')

@section('title_link', route('menu.index'))
@section('title', 'Menu')
@section('action', 'Create Menu')
@section('button')
    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
@endsection
@section("button_link", route('menu.index'))

    <div class="page-wrapper">
        <div class="content">

            @include('admin_Panel.layout.breadcrumbs')

            <div class="row">
                <div class="col-lg-12">
                    <style type="text/css">
                        .form-group label {
                            color: black;
                        }
                    </style>
                    {!! Form::open(['route' => 'menu.store', 'method' => 'POST']) !!}

                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('menu_name', 'Menu Name(English)') }} <span class="text-danger">*</span>
                                    {{ Form::text('menu_name[en]', null, ['class' => 'form-control', 'placeholder' => 'Enter Menu Name In English']) }}
                                    @error('menu_name.en')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('menu_name', 'Menu Name(Nepali)') }} <span class="text-danger">*</span>
                                    {{ Form::text('menu_name[np]', null, ['class' => 'form-control', 'placeholder' => 'Enter Menu Name In Nepali']) }}
                                    @error('menu_name.np')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('menu_type_id', 'Choose Menu Type') }} <span class="text-danger">*</span>
                                    {!! Form::select('menu_type_id', config('menu_type.menu-types'), null, ['class'=>'form-select form-control','placeholder' => 'Select Menu Type', 'id' => 'menu_type_select']) !!}
                                    @error('menu_type_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 model-div" style="display: none;">
                                <div class="form-group">
                                    {{ Form::label('model_id', 'Choose Model') }} <span class="text-danger">*</span>
                                    {!! Form::select('model_id', $module_helper->dropdown(), null, ['class'=>'form-select form-control','placeholder' => 'Select Model']) !!}
                                    @error('model_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 page-div" style="display: none;">
                                <div class="form-group">
                                    {{ Form::label('page_id', 'Choose Page') }} <span class="text-danger">*</span>
                                    {!! Form::select('page_id', $page_helper->engPageTitledropdown(), null, ['class'=>'form-select form-control','placeholder' => 'Select Page']) !!}
                                    @error('page_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-6 external-link-div" style="display: none;">
                                <div class="form-group">
                                    {{ Form::label('external_link', 'External Link') }} <span class="text-danger">*</span>
                                    {{ Form::text('external_link', null, ['class' => 'form-control', 'placeholder' => 'URL']) }}
                                    @error('external_link')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('parent_id', 'Choose Parent ') }}
                                    <span class="text-primary">[</span>
                                        <strong class="text-danger">Note : </strong><span class="text-primary">Select a parent menu if this is a child menu.]</span>
                                    {!! Form::select('parent_id', $menu_helper->engMenudropdown(), null, ['class'=>'form-select form-control','placeholder' => 'Select Parent']) !!}
                                    @error('parent_id')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('display_order', 'Display Order') }} <span class="text-danger">*</span>
                                    {{ Form::text('display_order', null, ['class' => 'form-control', 'placeholder' => 'Enter Display Order']) }}
                                    @error('display_order')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('status', 'Status') }} <span class="text-danger">*</span>
                                    <div>
                                        {{ Form::radio('status', 1, true) }} Active
                                    </div>
                                    <div>
                                        {{ Form::radio('status', 0, false) }} Inactive
                                    </div>
                                    @error('status')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            {{ Form::submit('Create Menu',['class' => 'btn btn-primary btn-lg']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection