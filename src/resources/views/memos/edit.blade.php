@extends('layouts.app')

@section('title', 'メモを編集')

@section('content')
    <h1>メモを編集</h1>

    @if ($errors->any())
        <x-alert type="danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    @endif

    <form method="POST" action="{{ route('memos.update', $memo) }}">
        @csrf
        @method('PUT')

        <p>
            <textarea name="content" placeholder="メモの内容">{{ old('content', $memo->content) }}</textarea>
        </p>

        <button>更新</button>
    </form>

    <p><a href="{{ route('memos.index') }}">← 一覧へ戻る</a></p>
@endsection
