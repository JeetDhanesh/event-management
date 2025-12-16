<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { padding: 8px 15px; text-decoration: none; color: white; border-radius: 4px; border: none; cursor: pointer; }
        .btn-create { background: green; }
        .btn-logout { background: red; }
        .btn-edit { background: orange; font-size: 0.9em; }
        .btn-delete { background: darkred; font-size: 0.9em; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Welcome, {{ auth()->user()->name }}!</h1>
        
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-logout">Logout</button>
        </form>
    </div>

    <h2>My Managed Events</h2>
    <a href="{{ route('events.create') }}" class="btn btn-create">+ Create New Event</a>
    <a href="{{ route('events.index') }}" style="margin-left: 10px;">View All Public Events</a>

    @if($myEvents->isEmpty())
        <p>You haven't created any events yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Event Title</th>
                    <th>Date</th>
                    <th>Ticket Price</th>
                    <th>Sold / Capacity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($myEvents as $event)
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->start_time->format('d M Y') }}</td>
                        <td>${{ $event->price }}</td>
                        <td>0 / {{ $event->capacity }}</td> <td>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-edit">Edit</a>
                            
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</body>
</html> 