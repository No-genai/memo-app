<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        // ピン留めしたメモを先頭、それ以外は新しい順
        $memos = Memo::query()
            ->when($q, fn ($query) => $query->where('content', 'like', "%{$q}%"))
            ->orderByDesc('is_pinned')
            ->latest()
            ->get();

        return view('memos.index', compact('memos'));
    }

    public function show(Memo $memo)
    {
        return view('memos.show', compact('memo'));
    }

    public function create()
    {
        return view('memos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|max:1000',
        ]);

        Memo::create($validated);

        return redirect()->route('memos.index')
            ->with('success', 'メモを保存しました');
    }

    public function edit(Memo $memo)
    {
        return view('memos.edit', compact('memo'));
    }

    public function update(Request $request, Memo $memo)
    {
        $validated = $request->validate([
            'content' => 'required|max:1000',
        ]);

        $memo->update($validated);

        return redirect()->route('memos.index')
            ->with('success', 'メモを更新しました');
    }

    public function destroy(Memo $memo)
    {
        $memo->delete();

        return redirect()->route('memos.index')
            ->with('success', 'メモを削除しました');
    }

    public function pin(Memo $memo)
    {
        // ピン留め状態を反転させるだけ
        $memo->update(['is_pinned' => ! $memo->is_pinned]);

        return redirect()->route('memos.index');
    }
}
