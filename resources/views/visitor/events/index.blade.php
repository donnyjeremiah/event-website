@extends('layouts.master')
@section('title', '| Index')
@section('ActiveEvents','active')

@section('content')
<div class="row" id="top_row">
    <div class="col-md-10">
        <h1>All Events</h1>
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
                        <td>{{ $event->city }}</td>
                        <td>{{ $event->type->name }}</td>
                        <td>{{ $event->created_at->format('M j, Y') }}</td>
                        <td>
                            <a href="{{ route('visitor::events.show', ['id' => $event->id]) }}" class="btn btn-default btn-sm">View</a>
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
