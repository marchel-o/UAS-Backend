@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('tickets.store') }}"
        class="flex flex-col max-w-[20rem] border-2 rounded p-4 gap-2"
    >
        <!-- <p class="text-[1.5rem]">Make a ticket</p> -->
        <label for="title">Title</label>
        <input name="title" maxlength=40 class="border rounded p-2 w-full" />
        
        <label for="description">Description</label>
        <textarea name="description" rows=5 class="resize-none border rounded p-2"></textarea>
        
        <label for="priority">Priority</label>
        <select name="priority" class="border rounded px-2 py-1">
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>

        <button type="submit" 
            class="border rounded mt-2 p-2 hover:bg-green-300 transition-colors"
        >
            Submit Ticket
        </button>
    </form>
@endsection