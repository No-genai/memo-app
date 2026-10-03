@extends('layouts.app')

@section('title', 'メモ詳細')

@section('content')
    <h1>メモ詳細</h1>

    @if ($memo->is_pinned)
        <p><strong>📌 ピン留め中</strong></p>
    @endif

    <p>{{ $memo->content }}</p>

    <p><a href="{{ route('memos.edit', $memo) }}">編集</a></p>
    <p><a href="{{ route('memos.index') }}">← 一覧へ戻る</a></p>
@endsection
