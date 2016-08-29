@extends('layouts.master')
@section('title', '| Index')
@section('ActiveEvents','active')

@section('content')
<div class="row" id="top_row">
    <div class="col-md-10">
        <h1>All Events</h1>
    </div>
    <div class="col-md-2">
        <a href="{{ route('organiser::events.create') }}" class="btn btn-lg btn-bloack btn-primary btn-h1-spacing">Create Event</a>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Place</th>
                <th>Type</th>
                <th>Status</th>
                <th>Created At</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->date_start->format('M j, Y') }}</td>
                        <td>{{ $event->time }}</td>
                        <td>{{ $event->address->city }}</td>
                        <td>{{ $event->type->name }}</td>
                        <td class="{{ ($event->status->name == 'Pending')?'bg-primary':'' }}">{{ $event->status->name }}</td>
                        <td>{{ $event->created_at->format('M j, Y') }}</td>
                        <td>
                            <a href="{{ route('organiser::events.show', ['id' => $event->id]) }}" class="btn btn-default btn-sm">View</a>
                            <a href="{{ route('organiser::events.edit', ['id' => $event->id]) }}" class="btn btn-default btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center">
            {!! $events->links() !!}
        </div>
    </div>
</div>
@endsection

@section('style')
<style>
#top_row {
    margin-left: 50px;
    margin-right: 50px;
}
.content {
    margin-left: 40px;
    margin-right: 40px;
}
</style>
@endsection

@section('script')
@endsection
