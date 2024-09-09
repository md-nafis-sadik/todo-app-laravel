<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard - Todo App') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg mb-4">Todo List</h3>

                    <!-- Show existing Todos -->
                    <ul>
                        @if (session('todos'))
                            @foreach (session('todos') as $key => $todo)
                                <li class="mb-2">
                                    {{ $todo }}
                                    <form action="{{ route('todos.delete', $key) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500">Delete</button>
                                    </form>
                                    <button class="text-blue-500 ml-2" onclick="editTodo('{{ $todo }}', '{{ $key }}')">Edit</button>
                                </li>
                            @endforeach
                        @else
                            <p>No Todos available</p>
                        @endif
                    </ul>

                    <!-- Add Todo Form -->
                    <form action="{{ route('todos.add') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="text" name="todo" id="todo-input" class="rounded-md border-gray-300" placeholder="Enter Todo" required>
                        <input type="hidden" id="todo-id" name="todo_id">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-md">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        function editTodo(todo, id) {
            document.getElementById('todo-input').value = todo;
            document.getElementById('todo-id').value = id;
        }
    </script>

</x-app-layout>
