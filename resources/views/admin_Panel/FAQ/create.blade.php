@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                  Breadcrumbs...
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-danger btn-rounded" href="{{ route('faq.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
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
                    {!! Form::open(['route' => 'faq.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{ Form::label('subject', 'FAQ Subject') }} <span class="text-danger">*</span>
                                    {{ Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Enter FAQ Subject']) }}
                                    @error('subject')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{ Form::label('faq_question', 'FAQ Questions?') }} <span class="text-danger">*</span>
                                    {{ Form::text('faq_question', null, ['class' => 'form-control', 'placeholder' => 'Enter FAQ Question']) }}
                                    @error('faq_question')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{ Form::label('faq_answer', 'FAQ Answer') }} <span class="text-danger">*</span>
                                    {{ Form::textarea('faq_answer', null, ['class' => 'form-control editor', 'placeholder' => 'Enter FAQ Answer', 'rows' => 5]) }}
                                    @error('faq_answer')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            {{ Form::submit('Create FAQ',['class' => 'btn btn-primary btn-lg']) }}
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