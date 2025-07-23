@extends('layouts.app')

@section('content')
    <div>
        <a href="/tasks" id="back">
            Back &rarr;
        </a>
        <h1 class="uppercase" id="title">
            edit task
        </h1>
    </div>
    <div>
        <form action="/tasks/{{ $task->id }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <input type="text" name="title" value="{{ $task->title }}">
                <label for="complete">
                    Completed:
                    <input type="checkbox" name="complete" {{ $task->is_completed ? 'checked' : ' ' }}><br><br>
                </label>
                <button type="submit">
                    Update
                </button>
            </div>
        </form>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <li type="none">
                    {{ $error }}
                </li>
            @endforeach
        @endif
    </div>
@endsection
