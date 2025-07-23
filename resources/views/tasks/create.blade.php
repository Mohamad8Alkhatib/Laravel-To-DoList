@extends('layouts.app')

@section('content')
    <h1 class="uppercase" id="title">
        new task
    </h1>
    <div>
        <form action="/tasks" method="POST">
            @csrf
            <div>
                <input type="text" name="title" placeholder="Task title...">
                <label for="complete">
                    Completed:
                    <input type="checkbox" name="complete"><br><br>
                </label>
                <button type="submit">
                    Add
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
