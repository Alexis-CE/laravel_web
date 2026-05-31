<?php
namespace App\Livewire;
use App\Models\Comment as CommentModel;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Comment extends Component
{
    public Model $commentable;
    public bool $showForm = false;
    public string $content = '';

    public function add()
    {
        $this->validate([
            'content' => 'required|string|max:255',
        ]);

        $this->commentable->comments()->create([
            'content' => $this->content,
            'user_id' => auth()->id(),
        ]);

        $this->reset('content', 'showForm');
    }

    public function delete(int $commentId)
    {
        $comment = CommentModel::findOrFail($commentId);

        if (auth()->id() !== $comment->user_id && !auth()->user()->is_admin) {
            abort(403);
        }

        $comment->hearts()->delete();
        $comment->delete();
    }

    public function toggle()
    {
        $this->showForm = !$this->showForm;
    }

    public function render()
    {
        return view('livewire.comment', [
            'comments' => $this->commentable->comments()->with('user')->get(),
        ]);
    }
}
