<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <style type="text/css">
        .table {
            border: 2px solid white;
            margin: auto;
            /* widows: ; */
            text-align: center;
            margin-top: 40px;
        }

        .th {
            background-color: purple;
        }

        tr {
            border: 3px solid white;
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

                <table class="table">
                    <tr>
                        <th class="th">Room Title</th>
                        <th class="th">Description</th>
                        <th class="th">Price</th>
                        <th class="th">Wifi</th>
                        <th class="th">Building</th>
                        <th class="th">Room Type</th>
                        <th class="th">Image</th>
                        <th class="th">Delete</th>
                        <th class="th">Update</th>


                    </tr>
                    @foreach ($data as $data)
                        <tr>
                            <td>{{ $data->room_title }}</td>
                            <td>{!! Str::limit($data->description, 150) !!}

                            <td>{{ $data->price }}$</td>
                            <td>{{ $data->building }}</td>
                            <td>{{ $data->room_type }}</td>
                            <td>{{ $data->wifi }}</td>
                            <td>
                                <a href="room/{{ $data->image }}" target="_blank">
                                    <img width="150" height="150" src="room/{{ $data->image }}">
                                </a>
                            </td>
                            <td>
                                <a onclick="return confirm('Are you sure to delete? ');" class="btn btn-danger"
                                    href="{{ url('delete_room', $data->id) }}">Delete</a>
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{ url('update_room', $data->id) }}">Update</a>
                            </td>
                        </tr>
                    @endforeach

                </table>

            </div>
        </div>
    </div>
    @include('admin.footer')
</body>

</html>
