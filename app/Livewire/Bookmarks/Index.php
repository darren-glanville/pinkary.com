<?php

declare(strict_types=1);

namespace App\Livewire\Bookmarks;

use App\Livewire\Concerns\HasLoadMore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

#[On('question.unbookmarked')]
final class Index extends Component
{
    use HasLoadMore;

    /**
     * Render the component.
     */
    public function render(Request $request): View
    {
        $user = type($request->user())->as(User::class);

        return view('livewire.bookmarks.index', [
            'user' => $user,
            'bookmarks' => $user->bookmarks()
                ->with('question')
                ->orderBy('created_at', 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }
}
