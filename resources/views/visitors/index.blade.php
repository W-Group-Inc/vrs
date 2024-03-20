<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Visitor Registration System')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('/images/visitor.png') }}">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body class="bg-vrs"> 
    <div class="wrapper animated fadeInLeft" align="center">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form id="wizard" action="{{url('new_visitor')}}" method="POST" autocomplete="off">
                    @csrf
                        <h1>Welcome</h1>
                        <section class="first-step">
                            <h1 class="mt-welcome">Welcome to</h1>
                            <h1 class="company">{{$building->name}}</h1>
                            <div class="row">
                                <p class="description">Visiting an office today? <br> Register here with a few easy steps</p>
                            </div>
                        </section>
                        <h1>Profile</h1>
                        <section class="second-step">
                            <h4>Visitor Details</h4>
                            <h1 class="h1-title">Scan ID</h1>
                            <p class="p-desc">and press the camera button to take your ID</p>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div id="my_scan" required></div>
                                    <br/>
                                    <input type="hidden" name="scan_id" id="scan_id" class="image_scan" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" id="retake_scan_button" class="btn btn-danger btn-cam" onclick="retake_scan()">
                                    <i class="fa fa-camera" >&nbsp;Retake</i> 
                                </button>
                                <button type="button" class="btn btn-success btn-cam" onclick="take_scan()">
                                    <i class="fa fa-camera"></i> 
                                </button>
                            </div>
                        </section>
                        <h1>Warning</h1>
                        <section class="third-step">
                        <h4>Visitor Details</h4>
                            <h1 class="h1-title">Image</h1>
                            <p class="p-desc">Looking good, press the camera button to take your Image</p>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div id="my_image" required></div>
                                    <br/>
                                    <input type="hidden" name="image" class="image" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" id="retake_image_button" class="btn btn-danger btn-cam" onclick="retake_image()">
                                    <i class="fa fa-camera">&nbsp;Retake</i> 
                                </button>
                                <button type="button" class="btn btn-success btn-cam" onclick="take_image()">
                                    <i class="fa fa-camera"></i> 
                                </button>
                            </div>
                        </section>

                        <h1>Finish</h1>
                        <section class="last_step">
                        <h4>Visitor Details</h4>
                            <h1 class="h1-title">Information</h1>
                            <p class="p-desc">Please fill up the information below</p>
                            <!-- <h2>Terms and Conditions</h2>
                            <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label> -->
                            <div class="col-lg-12">
                                <div class="form-group form-media">
                                    <label class="label_home">Name</label>
                                    <input id="name" name="name" type="text" class="form-control form-input" placeholder="Enter Name">
                                </div>
                                <p class="p-tenant">Who are you visiting?</p>
                                <div class="form-group">
                                    <label class="label_home">Tenant Name</label>
                                    <input type="text" id="tenant_name" name="tenant_name" placeholder="Enter Tenant"
                                    data-provide="typeahead"
                                    data-source='{{ json_encode($tenants,TRUE)}}'
                                    class="form-control form-input typeahead_1" />
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')


    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script src="{{ asset('js/pace.min.js') }}"></script>

    <!-- Typehead -->
    <script src="{{ asset('js/plugins/typehead/bootstrap3-typeahead.min.js') }}"></script>

    <!-- Steps -->
    <script src="{{ asset('js/jquery.steps.min.js') }}"></script>

    <!-- Jquery Validate -->
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

    <!-- Webcam -->
    <script src="{{ asset('js/webcam.min.js') }}"></script>
     

    <script>
        var app ={!! json_encode($tenants) !!};
        $(document).ready(function(){
            $('.typeahead_1').typeahead({
                source: app
            });

            var formWizard = $('#wizard');

            // Form validation with jQuery
            formWizard.validate({
                rules: {
                    scan_id: "required",
                    image: "required",
                    name: "required",
                    tenant_name: "required"
                },
                messages: {
                    scan_id: "Please",
                    image: "Please",
                    name: "Please enter your name",
                    tenant_name: "Please enter tenant name"
                }
            });

            $("#wizard").steps({
                bodyTag: "section",
                transitionEffect: "fade",
                enableAllSteps: true,
                transitionEffectSpeed: 300,
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    if (currentIndex > newIndex)
                    {
                        return true;
                    }
                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    // form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    updateButtonState(currentIndex);

                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }

                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    var scanId = $("#scan_id").val();
                    var image = $(".image").val();

                    if (!scanId || !image) {
                        alert("Please capture both the scan ID and image.");
                        return false; // Prevent form submission
                    }

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            });


            updateButtonState(0);

            function updateButtonState(currentIndex) {
                var currentSectionClass = $("#wizard .body").eq(currentIndex).attr("class");
                var otherButtons = $(".actions ul li");

                if (currentIndex === 0 && currentSectionClass.includes("first-step")) {
                    // Add a class to the "Next" button in the first-step Section and change text
                    otherButtons.addClass("custom-background-class").find("a").text("Register Now");
                } else if (currentSectionClass.includes("last_step")) {
                    otherButtons.addClass("custom-background-class").find("a[href='#finish']").text("Confirm Registration");
                } else {
                    otherButtons.addClass("custom-background-class").find("a").text("Next");
                }
            }

            Webcam.set({
                width: 420,
                height: 340,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            
            Webcam.attach( '#my_scan' );
            Webcam.attach( '#my_image' );
        });


        // Function to enable/disable the retake button
        function toggleRetakeButton(buttonId, enable) {
            $("#" + buttonId).prop("disabled", !enable);
        }

        // Scan ID
        function take_scan() {
            Webcam.snap(function(data_uri) {
                $(".image_scan").val(data_uri);
                document.getElementById('my_scan').innerHTML = '<img src="' + data_uri + '"/>';
                $(".image_scan").prop("required", true);

                toggleRetakeButton("retake_scan_button", true);
            });
        }

        function retake_scan() {
            $(".image_scan").val('');
            document.getElementById('my_scan').innerHTML = 'Capture a new image';
            Webcam.attach('#my_scan');

            toggleRetakeButton("retake_scan_button", false);
        }

        // Image
        function take_image() {
            Webcam.snap(function(data_uri) {
                $(".image").val(data_uri);
                document.getElementById('my_image').innerHTML = '<img src="' + data_uri + '"/>';
                $(".image").prop("required", true);

                toggleRetakeButton("retake_image_button", true);
            });
        }

        function retake_image() {
            $(".image").val('');
            document.getElementById('my_image').innerHTML = 'Capture a new image';
            Webcam.attach('#my_image');

            toggleRetakeButton("retake_image_button", false);
        }

    </script>

</body>

</html>
