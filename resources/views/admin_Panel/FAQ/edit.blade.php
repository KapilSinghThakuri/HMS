@extends('admin_Panel.layout.main')
@section('Main-container')

@section('title_link', route('faq.index'))
@section('title', 'FAQ')
@section('action', 'Edit FAQ')
@section('button')
    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
@endsection
@section("button_link", route('faq.index'))
    <div class="page-wrapper">
        <div class="content">
            @include('admin_Panel.layout.breadcrumbs')
            <div class="row">
                <div class="col-lg-12">

                    {!! Form::open(['route' => ['faq.update', $faq->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{ Form::label('subject', 'FAQ Subject') }} <span class="text-danger">*</span>
                                    {{ Form::text('subject', $faq->subject, ['class' => 'form-control', 'placeholder' => 'Enter FAQ Subject']) }}
                                    @error('subject')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{ Form::label('faq_question', 'FAQ Questions?') }} <span class="text-danger">*</span>
                                    {{ Form::text('faq_question', $faq->faq_question, ['class' => 'form-control', 'placeholder' => 'Enter FAQ Question']) }}
                                    @error('faq_question')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    {{ Form::label('faq_answer', 'FAQ Answer') }} <span class="text-danger">*</span>
                                    {{ Form::textarea('faq_answer', $faq->faq_answer, ['class' => 'form-control editor', 'placeholder' => 'Enter FAQ Answer', 'rows' => 5]) }}
                                    @error('faq_answer')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <style type="text/css">
                                .ck.ck-editor__main div {
                                    height: 200px;
                                }
                                .form-group label {
                                    color: black;
                                }
                            </style>
                        </div>
                        <div class="text-center">
                            {{ Form::submit('Update FAQ',['class' => 'btn btn-primary btn-lg']) }}
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