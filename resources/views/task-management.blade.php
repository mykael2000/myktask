@extends('layouts.user_type.auth')

@section('content')

<div>
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@error('task_name')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Tasks</h5>
                        </div>
                        <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">+&nbsp; Create Task</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Description
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Deadline
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Importance
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)

                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $task->task_id }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $task->task_name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $task->task_description }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $task->task_deadline }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $task->importance }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $task->status }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $task->created_at }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3" data-bs-toggle="modal" data-bs-target="#detailsModal_{{ $task->id }}" data-bs-original-title="Edit task">
                                            <i class="fas fa-edit text-primary"></i>
                                        </a>
                                        <span>
                                            <a href="" class="mx-3" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $task->id }}">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </a>

                                        </span>
                                    </td>
                                </tr>
                                                                <!-- Second Modal for Task Details -->
                                <div class="modal fade" id="detailsModal_{{ $task->id }}" tabindex="-1" aria-labelledby="detailsModalLabel_{{ $task->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailsModalLabel_{{ $task->id }}">Edit Task</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="tasks/update/{{ $task->id }}" method="POST">
                                    <div class="modal-body">

                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                                            <input type="hidden" value="{{ $task->client_id }}" name="client_id">
                                            <input type="hidden" value="{{ $task->task_id }}" name="task_id">
                                        <div class="mb-3">
                                            <label for="task-name" class="col-form-label">Task Name:</label>
                                            <input type="text" name="task_name" value="{{ $task->task_name }}" class="form-control" id="task-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="message-text" class="col-form-label">Task Description:</label>
                                            <textarea name="task_description" class="form-control" id="message-text">{{ $task->task_description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="task-deadline" class="col-form-label">Task Dealine:</label>
                                            <input name="task_deadline" value="{{ $task->task_deadline }}" type="datetime-local" class="form-control" id="task-daedline">
                                        </div>
                                        <div class="mb-3">
                                            <label for="task-importance" class="col-form-label">Task Importance:</label>
                                            <select name="importance" class="form-control" id="task-importance">
                                                <option value="{{ $task->importance }}">level {{ $task->importance }}</option>
                                                <option value="1">level 1</option>
                                                <option value="2">level 2</option>
                                                <option value="3">level 3</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="task-status" class="col-form-label">Task Status:</label>
                                            <select name="status" class="form-control" id="task-status">
                                                <option value="{{ $task->status }}">{{ $task->status }}</option>
                                                <option value="completed">Completed</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    </form>
                                        </div>
                                    </div>
                                </div>


                                                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal_{{ $task->id }}" tabindex="-1" aria-labelledby="deleteModalLabel_{{ $task->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel_{{ $task->id }}">Delete Task</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="tasks/delete/{{ $task->id }}" method="POST">
                                    <div class="modal-body">

                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                                            <input type="hidden" value="{{ $task->client_id }}" name="client_id">
                                            <input type="hidden" value="{{ $task->task_id }}" name="task_id">
                                            <div class="mb-3">
                                                <p>Are you sure you want to Delete {{ $task->task_name }}???</p>
                                            </div>

                                         @csrf
                                            @method('DELETE')

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Click ok to complete deletion')">Delete</button>
                                    </div>
                                    </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create New task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/tasks/store" method="POST">
      <div class="modal-body">

             @csrf
             <input type="hidden" value="{{ auth()->user()->id }}" name="client_id">
             <input type="hidden" value="task_{{ rand(10000, 99999)}}" name="task_id">
          <div class="mb-3">
            <label for="task-name" class="col-form-label">Task Name:</label>
            <input type="text" name="task_name" class="form-control" id="task-name">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Task Description:</label>
            <textarea name="task_description" class="form-control" id="message-text"></textarea>
          </div>
          <div class="mb-3">
            <label for="task-deadline" class="col-form-label">Task Dealine:</label>
            <input name="task_deadline" type="datetime-local" class="form-control" id="task-daedline">
          </div>
          <div class="mb-3">
            <label for="task-importance" class="col-form-label">Task Importance:</label>
            <select name="importance" class="form-control" id="task-importance">
                <option value="">--select--</option>
                <option value="1">level 1</option>
                <option value="2">level 2</option>
                <option value="3">level 3</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="task-status" class="col-form-label">Task Status:</label>
            <select name="status" class="form-control" id="task-status">
                <option value="">--select--</option>
                <option value="completed">Completed</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="draft">Draft</option>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
      </form>
    </div>
  </div>
</div>




@endsection
