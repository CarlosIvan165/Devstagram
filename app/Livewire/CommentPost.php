<?php

namespace App\Livewire;

use Livewire\Component;

class CommentPost extends Component
{
    public $post;
    public $isComment;
    public $comments;

    public function mount($post){
        $this->comments = $post->comentarios->count();
    }



    public function render()
    {
        return view('livewire.comment-post');
    }
}
