<!DOCTYPE html>
<html>

<head>

    <base href="/public">
    @include('admin.css')

    <style type="text/css">
        label {
            display: inline-block;
            width: 200px;
        }

        .form_design {
            padding-top: 30px;
        }

        .create_room {
            padding-top: 40px;
        }
    </style>
</head>

<body>
    @include('admin.header')
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')

    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <div class="create_room">
                    <h1 style="font-size: 30px;font-weight: bold;">UPDATE ROOM</h1>
                    <form action="{{ url('edit_room', $data->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="form_design">
                            <label>Room Title</label>
                            <input type="text" name="title" placeholder="Room Name"
                                value="{{ $data->room_title }}">
                        </div>
                        <div class="form_design">
                            <label>Room Description</label>
                            <textarea name="description">
                                {{ $data->description }}
                            </textarea>
                        </div>
                        <div class="form_design">
                            <label>Price</label>
                            <input type="number" name="price" placeholder="Price" value="{{ $data->price }}">
                        </div>

                        <div class="form_design">
                            <label>Size</label>
                            <input type="number" name="size" placeholder="Size" value="{{ $data->size }}">
                        </div>
                        {{-- THEN ADD FROM DATABASE --}}
                        <div class="form_design">
                            <label>Building</label>
                            <select name="building">
                                <option selected value="{{ $data->building }}">{{ $data->building }}</option>
                                <option value="caspian">Caspian</option>
                                <option value="ada">ADA</option>
                                <option value="sabah">Sabah</option>
                            </select>
                        </div>
                        <div class="form_design">
                            <label>Room Type</label>
                            <select name="type">
                                <option selected value="{{ $data->room_type }}">{{ $data->room_type }}</option>

                                <option value="regular">Regular</option>
                                <option value="premium">Premium</option>
                                <option value="deluxe">Deluxe</option>
                            </select>
                        </div>

                        <div class="form_design">
                            <label>Free Wifi</label>
                            <select name="wifi">
                                <option selected value="{{ $data->wifi }}">{{ $data->wifi }}</option>

                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>


                        <div class="form_design" style="padding-left: 0.1%">
                            <label>Current Image</label>
                            <a href="/room/{{ $data->image }}" target="_blank"><img width="100"
                                    src="/room/{{ $data->image }}" </div></a>

                        </div>
                        <div class="form_design">
                            <label>Upload Image</label>
                            <input type="file" name="image">
                        </div>

                        <div class="form_design">
                            <input class="btn btn-primary" type="submit" value="Update Room">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.footer')
</body>

</html>
