<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Comment;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Comments extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $photo;
    public $iteration;

    // public $comments = [
    //     [
    //         'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ut amet maxime veritatis tenetur voluptates unde. Totam tempora accusantium laboriosam veniam',
    //         'created_at' => '3 min ago',
    //         'creator' => 'Samit'
    //     ]
    // ];

    // public $comments;

    public $newComment;

    protected $rules = [
        'newComment' => 'required|min:5|max:128',
        // 'photo' => 'image|max:1024',
    ];

    protected $messages = [
        'newComment.required' => 'The :attribute cannot be empty.',
        'newComment.min' => 'The :attribute must longer than :min character',
        'newComment.max' => 'The :attribute must less than :max character',
        // 'photo.image' => 'The :attribute must be image only',
        // 'photo.max' => 'The :attribute must less than :max bytes size',
    ];

    // public function mount($initialComments)
    public function mount()
    {
        // $this->newComment = 'I am from mounted function';
        // dd($initialComments);
        // $this->newComment = $initialComments;

        // $initialComments = Comment::all();
        // $initialComments = Comment::latest()->get();
        // $initialComments = Comment::latest()->paginate(10);
        // $this->comments = $initialComments;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    

    public function addComment(){

        // $this->comments[] = [
        //     'body' => 'New comment form here',
        //     'created_at' => '1 min ago',
        //     'creator' => 'Wichai'
        // ];

        // array_unshift($this->comments,
        // [
        //     'body' => 'New comment form here',
        //     'created_at' => '1 min ago',
        //     'creator' => 'Wichai'
        // ]);

        // if($this->newComment == ""){
        //     return;
        // }

        $this->validate();
        

        $createdComment = Comment::create([
            'body'=>$this->newComment, 'user_id'=> 5
        ]);
        
        if($this->photo){
            $this->photo->store('photos');
            // $name = md5($this->photo . microtime()).'.'.$this->photo->extension();
            // $this->photo->storeAs('photos',$name);
            // $this->photo->store('images/comments','public');
        }
        // array_unshift($this->comments,
        // [
        //     'body' =>  $this->newComment,
        //     'created_at' => Carbon::now()->diffForHumans(),
        //     // 'created_at' => Carbon::createFromFormat('Y-m-d H:i:s','2021-09-10 02:00:00')->diffForHumans(),
        //     'creator' => 'Wichai'
        // ]);

        // $this->comments->push($createdComment);
        // $this->comments->prepend($createdComment);

        $this->newComment = "";
        $this->photo = null;
        $this->iteration++;

        session()->flash('message', 'Comment successfully added.');

    }

    public function remove($commentId){
        // dd($commentId);
        $comment = Comment::find($commentId);
        // dd($comment);
        $comment->delete();
        // $this->comments = $this->comments->where('id','!=',$commentId);
        // $this->comments = $this->comments->except($commentId);

        session()->flash('message', 'Comment successfully deleted.');
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::latest()->paginate(5)
        ]);
    }
}
