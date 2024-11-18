<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style type="text/css">
        .table {
            border: 2px solid white;
            margin: auto;
            text-align: center;
            margin-top: 40px;
        }

        .th {
            background-color: purple;
        }

        tr {
            border: 3px solid white;
        }

        .no-reservation {
            text-align: center;
            color: red;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    @include('admin.header')
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                @if ($data->isEmpty())
                    <div class="no-reservation">No reservations found.</div>
                @else
                    <table class="table">
                        <tr>
                            <th class="th">Room ID</th>
                            <th class="th">Customer Name</th>
                            <th class="th">Email</th>
                            <th class="th">Phone</th>
                            <th class="th">List</th>
                            <th class="th">Start Date</th>
                            <th class="th">End Date</th>
                            <th class="th">Status</th>
                            <th class="th">Room Title</th>
                            <th class="th">Delete</th>
                            <th class="th">Actions</th>
                        </tr>

                        @foreach ($data as $data)
                            <tr>
                                <td>{{ $data->room_id }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ implode(', ', $data->guest_list_emails) }}</td>
                                <td>{{ $data->start_date }}</td>
                                <td>{{ $data->end_date }}</td>
                                <td>
                                    @if ($data->status == 'approved')
                                        <span style="color: skyblue;">Approved</span>
                                    @elseif ($data->status == 'rejected')
                                        <span style="color: red;">Rejected</span>
                                    @elseif ($data->status == 'waiting')
                                        <span style="color: yellow;">Waiting</span>
                                    @endif
                                </td>
                                <td>{{ $data->room->room_title }}</td>
                                <td>
                                    <a onclick="return confirm('Are you sure to delete this reservation?')"
                                        class="btn btn-danger" href="{{ url('delete_booking', $data->id) }}">Delete</a>
                                </td>
                                <td>
                                    @if ($data->status == 'approved')
                                        <span>You have approved this reservation.</span>
                                    @elseif ($data->status == 'rejected')
                                        <span>You have rejected this reservation.</span>
                                    @else
                                        <span style="padding-bottom: 10px;">
                                            <a class="btn btn-success"
                                                href="{{ url('approve_book', $data->id) }}">Confirm</a>
                                        </span>
                                        <a class="btn btn-warning"
                                            href="{{ url('reject_book', $data->id) }}">Reject</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>
        </div>
    </div>
    <!-- Sidebar Navigation end-->
    @include('admin.footer')
</body>

</html>
