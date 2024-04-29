@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                  Breadcrumbs...
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-danger btn-rounded" href="{{ route('page.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <style type="text/css">
                        .ck.ck-editor__main div {
                            height: 200px;
                        }
                        .form-group label {
                            color: black;
                        }
                    </style>
                    {!! Form::open(['route' => ['page.update', $page->slug], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        {{ Form::hidden('_method', 'PUT') }}
                        {{ Form::token() }}
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('title', 'Page Title (English)') }} <span class="text-danger">*</span>
                                    {{ Form::text('title[en]', $page['title']['en'], ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('title', 'Page Title (Nepali)') }} <span class="text-danger">*</span>
                                    {{ Form::text('title[np]', $page['title']['np'], ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('image', 'Page Image') }}
                                    {{ Form::file('image', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{ Form::label('content', 'Page Content (English)') }} <span class="text-danger">*</span>
                                    {{ Form::textarea('content[en]', $page['content']['en'], ['class' => 'form-control editor', 'placeholder' => 'Enter Content in English', 'rows' => 5]) }}
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{ Form::label('content', 'Page Content (Nepali)') }} <span class="text-danger">*</span>
                                    {{ Form::textarea('content[np]', $page['content']['np'], ['class' => 'form-control editor', 'placeholder' => 'Enter Content in Nepali', 'rows' => 5]) }}
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            {{ Form::submit('Update Page',['class' => 'btn btn-primary btn-lg']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        document.querySelectorAll('.editor').forEach(editorElement => {
            ClassicEditor
                .create(editorElement)
                .then(editor => {
                    console.log('Editor initialized:', editor);
                })
                .catch(error => {
                    console.error('Error initializing CKEditor:', error);
                });
        });
</script>
@endsection