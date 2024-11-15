<!DOCTYPE html>
<html>

<head>
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
                    <h1 style="font-size: 30px;font-weight: bold;">ADD ROOM</h1>
                    <form action="{{ url('add_room') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="form_design">
                            <label>Room Title</label>
                            <input type="text" name="title" placeholder="Room Name">
                        </div>
                        <div class="form_design">
                            <label>Room Description</label>
                            <textarea name="description"></textarea>
                        </div>
                        <div class="form_design">
                            <label>Price</label>
                            <input type="number" name="price" placeholder="Price">
                        </div>

                        <div class="form_design">
                            <label>Size</label>
                            <input type="number" name="size" placeholder="Size">
                        </div>

                        {{-- THEN ADD FROM DATABASE --}}
                        <div class="form_design">
                            <label>Building</label>
                            <select name="building">
                                <option selected value="caspian">Caspian</option>
                                <option value="ada">ADA</option>
                                <option value="sabah">Sabah</option>
                            </select>
                        </div>
                        <div class="form_design">
                            <label>Room Type</label>
                            <select name="type">
                                <option selected value="regular">Regular</option>
                                <option value="premium">Premium</option>
                                <option value="deluxe">Deluxe</option>
                            </select>
                        </div>

                        <div class="form_design">
                            <label>Free Wifi</label>
                            <select name="wifi">
                                <option selected value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <div class="form_design">
                            <label>Upload Image</label>
                            <input type="file" name="image">
                        </div>

                        <div class="form_design">
                            <input class="btn btn-primary" type="submit" value="Add Room">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('admin.footer')
</body>

</html>
