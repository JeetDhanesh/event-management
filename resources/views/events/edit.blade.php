<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <style>
        body { font-family: sans-serif; padding: 20px; max-width: 600px; margin: auto; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 20px; padding: 10px; background: orange; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h1>Edit Event: {{ $event->title }}</h1>

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT') <label>Event Title</label>
        <input type="text" name="title" value="{{ $event->title }}" required>

        <label>Category</label>
        <select name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label>Date & Time</label>
        <input type="datetime-local" name="start_time" value="{{ $event->start_time->format('Y-m-d\TH:i') }}" required>

        <label>Location</label>
        <input type="text" name="location" value="{{ $event->location }}" required>

        <label>Price</label>
        <input type="number" step="0.01" name="price" value="{{ $event->price }}" required>

        <label>Capacity</label>
        <input type="number" name="capacity" value="{{ $event->capacity }}" required>

        <label>Description</label>
        <textarea name="description" rows="5" required>{{ $event->description }}</textarea>

        <button type="submit">Update Event</button>
        <a href="{{ route('dashboard') }}" style="margin-left: 10px;">Cancel</a>
    </form>

</body>
</html>