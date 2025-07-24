@extends('layouts.app')

@section('content')
    <h1 id="title">
        <b>To-Do List</b>
    </h1>
    <form action="/tasks" method="GET" id="title">
        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
        <button type="submit">
            search
        </button>
    </form>
    <form action="/tasks" method="GET" id="completed">
        <select name="filter" onchange="this.form.submit()" style="width: 125px">
            <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>
                All
            </option>
            <option value="completed" {{ $filter === 'completed' ? 'selected' : '' }}>
                Completed
            </option>
            <option value="incompleted" {{ $filter === 'incompleted' ? 'selected' : '' }}>
                Incompleted
            </option>
        </select>
    </form>
    <a href="tasks/create" style="position:relative; bottom:40px">
        Add a new task &rarr;
    </a>
    @foreach ($tasks as $task)
        <div>
            <div>
                <a href="/tasks/{{ $task->id }}/edit" id="button">
                    Edit &rarr;
                </a>
                <form action="/tasks/{{ $task->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="deleteButton">Delete</button>
                </form>
            </div>
            <h3>
                <div style="position: absolute" class="{{ $task->is_completed ? 'completed' : ' ' }}">
                    {{ $task->title }}
                </div>
                <div id="completed">
                    @if ($task->is_completed)
                        Completed:✅
                    @else
                        Completed:❌
                    @endif
                </div>
            </h3>
            <hr>
        </div>
    @endforeach
    {{ $tasks->appends([
        'filter' => request('filter'),
        'search' => request('search')
    ])->links() }}
@endsection
