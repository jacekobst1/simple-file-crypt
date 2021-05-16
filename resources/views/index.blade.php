@extends('layouts.main')
@section('content')
    <div class="row mt-5">

        <div class="col-5">
            <h1 class="mb-4">File encryption</h1>
            <hr />
            {!! Form::open(['url' => '/encrypt', 'files' => true]) !!}

                <div class="py-2"></div>
                {!! Form::label('file', 'File to encrypt:') !!}
                {!! Form::file('file') !!}
                <div class="py-2"></div>
                {!! Form::label('password', 'Password to encrypt file:') !!}
                {!! Form::text('password') !!}
                <div class="py-2"></div>
                <hr />
                {!! Form::submit('Encrypt and download') !!}

            {!! Form::close() !!}
        </div>

        <div class="col-5 offset-2">
            <h1 class="mb-4">File decryption</h1>
            <hr />
            {!! Form::open(['url' => '/decrypt', 'files' => true]) !!}

            <div class="py-2"></div>
            {!! Form::label('file', 'File to decrypt:') !!}
            {!! Form::file('file') !!}
            <div class="py-2"></div>
            {!! Form::label('password', 'Password of encrypted file:') !!}
            {!! Form::text('password') !!}
            <div class="py-2"></div>
            <hr />
            {!! Form::submit('Decrypt and download') !!}

            {!! Form::close() !!}
        </div>

    </div>
@endsection
