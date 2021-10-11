<div>
    <h1 class="text-3xl">Comments</h1>
    
    <div>
        @if (session()->has('message'))
            <div class="p-3 my-4 text-green-800 bg-green-300 rounded shadow-sm">
                {{ session('message') }}
            </div>
        @endif
    </div>

    {{-- {{ $photo }} --}}

    @if ($photo)
        <img src="{{ $photo->temporaryUrl() }}" class="mt-4">
        <div wire:loading wire:target="addComment">Uploading...</div>
    @endif

   
    <input type="file" wire:model="photo" class="my-4" name="photo" id="upload{{ $iteration }}">
    @error('photo') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
    
    <form class="flex mt-4" wire:submit.prevent="addComment">
        {{-- <input type="text" class="w-full p-2 my-2 mr-2 border rounded shadow" placeholder="What's in your mind." wire:model.debounce.500ms="newComment"> --}}
        {{-- <input type="text" class="w-full p-2 my-2 mr-2 border rounded shadow" placeholder="What's in your mind." wire:model.lazy="newComment"> --}}
        <input type="text" class="w-full p-2 my-2 mr-2 border rounded shadow" placeholder="What's in your mind." wire:model.debounce.500ms="newComment">
        <div class="py-2">
            {{-- <button type="submit" class="w-20 p-2 text-white bg-blue-500 rounded shadow" wire:click="addComment">Add</button> --}}
            <button type="submit" class="w-20 p-2 text-white bg-blue-500 rounded shadow">Add</button>
        </div>
    </form>
    
    @error('newComment') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

    {{-- <p>{{ $newComment }}</p> --}}

    {{-- @foreach($comments as $comment)
    <div class="p-3 my-2 border rounded shadow">
        <div class="flex justify-between my-2">
            <div class="flex">
                <p class="text-lg font-bold">{{ $comment['creator'] }}</p>
                <p class="py-1 mx-3 text-xs font-semibold text-gray-500">{{ $comment['created_at'] }}
                </p>
            </div>
            <i class="text-red-200 cursor-pointer fas fa-times hover:text-red-600"></i>
        </div>
        <p class="text-gray-800">{{ $comment['body'] }}</p>
    </div>
    @endforeach --}}

    @foreach($comments as $comment)
    <div class="p-3 my-4 border rounded shadow">
        <div class="flex justify-between my-2">
            <div class="flex">
                <p class="text-lg font-bold">{{ $comment->creator->fullname }}</p>
                <p class="py-1 mx-3 text-xs font-semibold text-gray-500">{{ $comment->created_at->diffForHumans() }}
                </p>
            </div>
            <i class="text-red-200 cursor-pointer fas fa-times hover:text-red-600" wire:click="remove({{$comment->id}})"></i>
        </div>
        <p class="text-gray-800">{{ $comment->body}}</p>
    </div>
    @endforeach

    {{ $comments->links() }}

</div>

