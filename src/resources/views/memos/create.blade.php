@extends('layouts.app')

@section('title', 'メモを書く')

@section('content')
    <h1>メモを書く</h1>

    @if ($errors->any())
        <x-alert type="danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    <form method="POST" action="{{ route('memos.store') }}">
        @csrf

        <p>
            <textarea name="content" placeholder="メモの内容">{{ old('content') }}</textarea>
        </p>

        <button>保存</button>
    </form>

    <p><a href="{{ route('memos.index') }}">← 一覧へ戻る</a></p>
@endsection
