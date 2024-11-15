<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
</head>

<body>
    @include('admin.header')
    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <center>

                    <h1 style="font-size:40px; font-weight:bolder;color:white;">Gallery</h1>

                    <div class="row">
                        @foreach ($gallery as $galleryItem)
                            <div class="col-md-4">
                                <img style="height: 200px !important; width: 300px !important;"
                                    src="/gallery/{{ $galleryItem->image }}">
                                <a class="btn btn-danger" href="{{ url('delete_gallery', $galleryItem->id) }}">Delete
                                    Image</a>
                            </div>
                        @endforeach
                    </div>

                    <form action="{{ url('upload_gallery') }}" method="Post" enctype="multipart/form-data">

                        @csrf
                        <div style="padding: 30px;">
                            <label style="color: white; font-weight: bold;">Upload Image</label>
                            <input type="file" name="image" required>

                            <input class="btn btn-primary" type="submit" value="Add Image">
                        </div>

                </center>
                </form>
            </div>
        </div>
    </div>
    <!-- Sidebar Navigation end-->
    @include('admin.footer')
</body>

</html>
