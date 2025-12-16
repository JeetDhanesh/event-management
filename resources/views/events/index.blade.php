<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; background: blue; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>

    <h1>Upcoming Events</h1>

    @auth
        <a href="{{ route('events.create') }}" class="btn" style="background: green;">+ Create New Event</a>
        <a href="{{ route('dashboard') }}" class="btn" style="background: gray;">Dashboard</a>
    @endauth

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Price</th>
                <th>Organizer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->category->name }}</td> <td>{{ $event->start_time->format('d M Y, h:i A') }}</td>
                    <td>${{ $event->price }}</td>
                    <td>{{ $event->user->name }}</td>
                    <td>
                        <a href="#" class="btn">View Details</a> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>