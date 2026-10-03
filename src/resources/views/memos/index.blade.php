@extends('layouts.app')

@section('title', 'メモ一覧')

@section('content')
    <h1>メモ一覧</h1>

    @if (session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    <p><a href="{{ route('memos.create') }}">＋ 新しいメモ</a></p>

    <form method="GET" action="{{ route('memos.index') }}">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="メモ内容を検索">
        <button>検索</button>
    </form>

    @forelse ($memos as $memo)
        <div style="border: 1px solid #ccc; padding: 8px; margin-bottom: 8px;">
            @if ($memo->is_pinned)
                <strong>📌 ピン留め中</strong><br>
            @endif
            <p>{{ $memo->content }}</p>

            <a href="{{ route('memos.show', $memo) }}">詳細</a>
            ・
            <a href="{{ route('memos.edit', $memo) }}">編集</a>
            ・
            <form action="{{ route('memos.pin', $memo) }}" method="POST" style="display:inline">
                @csrf
                @method('PATCH')
                <button type="submit">{{ $memo->is_pinned ? 'ピン留め解除' : 'ピン留めする' }}</button>
            </form>
            <form action="{{ route('memos.destroy', $memo) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </div>
    @empty
        <p>メモがありません</p>
    @endforelse
@endsection
