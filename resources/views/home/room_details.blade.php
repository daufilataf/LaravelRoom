<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style type="text/css">
        label {
            display: inline-block;
            width: 200px;
        }

        input {
            width: 100%;
        }
    </style>
</head>
<!-- body -->

<body class="main-layout">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        @include('home.header')
    </header>
    <!-- end header inner -->
    <!-- end header -->
    <!-- banner -->

    <div class="our_room">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Our Room</h2>
                        <p>Lorem Ipsum available, but the majority have suffered </p>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-8">
                    <div id="serv_hover" class="room">
                        <div style="padding: 20px" class="room_img">
                            <img style="height: 300px; width:800px" src="/room/{{ $room->image }}" alt="#" />
                        </div>
                        <div class="bed_room">
                            <h2>{{ $room->room_title }}</h2>
                            <p style="padding: 12px">{{ $room->description }}</p>

                            <h4 style="padding: 12px">Building : {{ $room->building }}</h4>
                            <h4 style="padding: 12px">Room Type : {{ $room->room_type }}</h4>

                            <h4 style="padding: 12px">Free Wifi : {{ $room->wifi }}</h4>

                            <h4 style="padding: 12px">Price : {{ $room->price }}</h4>

                            <h4 style="padding: 12px">Size : {{ $room->size }}</h4>


                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h1 style="font-size: 40px">Book Room</h1>

                    <div>
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-bs-dismiss="alert">X</button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>

                    @if (Auth::id())
                        <!-- Show form when the user is authenticated -->
                        <form action="{{ url('add_booking', $room->id) }}" method="Post">
                            @csrf
                            <div>
                                <label>Name*</label>
                                <input required type="text" name="name" value="{{ Auth::user()->name }}">
                            </div>
                            <div>
                                <label>Email*</label>
                                <input required type="email" name="email" value="{{ Auth::user()->email }}">
                            </div>
                            <div>
                                <label>Phone*</label>
                                <input required type="number" name="phone" value="{{ Auth::user()->phone }}">
                            </div>
                            <div>
                                <label>Start Date and Time*</label>
                                <input required type="datetime-local" name="startDate" id="startDate">
                            </div>
                            <div>
                                <label>End Date and Time*</label>
                                <input required type="datetime-local" name="endDate" id="endDate">
                            </div>
                            <div class="form-group">
                                <label for="size">Number of Guests:</label>
                                <input type="number" id="size" name="size" class="form-control" required
                                    min="1">
                            </div>

                            <div class="form-group">
                                <label for="guest">Guest Emails (comma-separated):</label>
                                <input type="text" id="guest" name="guest" class="form-control" required
                                    placeholder="email1@example.com, email2@example.com">
                            </div>
                            <div style="padding-top: 20px">
                                <input type="submit" class="btn btn-primary" value="Book Room">
                            </div>
                        </form>
                    @else
                        <!-- Show message and blur form when the user is not authenticated -->
                        <div style="position: relative; opacity: 0.5; pointer-events: none;">
                            <form>
                                <div>
                                    <label>Name</label>
                                    <input type="text" disabled>
                                </div>
                                <div>
                                    <label>Email</label>
                                    <input type="email" disabled>
                                </div>
                                <div>
                                    <label>Phone</label>
                                    <input type="number" disabled>
                                </div>
                                <div>
                                    <label>Start Date</label>
                                    <input type="date" disabled>
                                </div>
                                <div>
                                    <label>End Date</label>
                                    <input type="date" disabled>
                                </div>
                                <div>
                                    <label>Guest Emails</label>
                                    <textarea rows="3" placeholder="Enter guest emails separated by commas" disabled></textarea>
                                </div>
                            </form>
                        </div>
                        <div style="margin-top: 20px; color: red; font-weight: bold;">
                            For reservation, you need to log in or register.
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>


    @include('home.footer')

    <script type="text/javascript">
        $(function() {
            var dtToday = new Date();

            var year = dtToday.getFullYear();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var hours = dtToday.getHours();
            var minutes = dtToday.getMinutes();

            if (month < 10) month = '0' + month.toString();
            if (day < 10) day = '0' + day.toString();
            if (hours < 10) hours = '0' + hours.toString();
            if (minutes < 10) minutes = '0' + minutes.toString();

            var maxDate = `${year}-${month}-${day}T${hours}:${minutes}`;
            $('#startDate').attr('min', maxDate);
            $('#endDate').attr('min', maxDate);

            // Update the minimum date of the end date based on the start date selection
            $('#startDate').on('change', function() {
                var startDate = $(this).val();
                $('#endDate').attr('min', startDate);
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>
