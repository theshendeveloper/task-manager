@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">Update Task</div>
                            <div class="col-auto">
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('tasks.update',  $task->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" type="text" name="task_name" value="{{ $task->task_name }}" required>
                            </div>

                            {{-- <div class="form-group">
                                <label>Assigned To</label>
                                <select class="form-control" name="user_id">
                                    <option value="">-</option>
                                    @foreach( $users as $user )
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="form-group">
                                <label>Project</label>
                                <select class="form-control" name="project_id">
                                    <option value="">-</option>
                                    @foreach( $projects as $project )
                                        <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[name="user_id"]').val({{ $task->user_id }});
            $('[name="project_id"]').val({{ $task->project_id }});
            $('form.delete').on('submit', function(){
                if( !confirm("Do you really want to detele this task?") )
                    return false;
            });
        });
    </script>
@endsection