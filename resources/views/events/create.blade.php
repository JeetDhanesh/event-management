<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        body { font-family: sans-serif; padding: 20px; max-width: 600px; margin: auto; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px 20px; background: blue; color: white; border: none; cursor: pointer; }
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>

    <h1>Create New Event</h1>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <label>Event Title</label>
        <input type="text" name="title" required>
        @error('title') <div class="error">{{ $message }}</div> @enderror

        <label>Category</label>
        <select name="category_id" required>
            <option value="">Select a Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id') <div class="error">{{ $message }}</div> @enderror

        <label>Date & Time</label>
        <input type="datetime-local" name="start_time" required>
        @error('start_time') <div class="error">{{ $message }}</div> @enderror

        <label>Location</label>
        <input type="text" name="location" required>

        <label>Ticket Price ($)</label>
        <input type="number" step="0.01" name="price" required>

        <label>Total Seats</label>
        <input type="number" name="capacity" required>

        <label>Description</label>
        <textarea name="description" rows="5" required></textarea>

        <button type="submit">Create Event</button>
    </form>

</body>
</html>