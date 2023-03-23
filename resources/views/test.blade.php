<!DOCTYPE html>
<html>
<head>
    <title>Laravel form with Multiple Images upload using Dropzone</title>
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
</head>
<body>
<div class="container">

    <h3>Laravel Multiple Images Upload Using Dropzone</h3>
    <form method="post" action="{{url('applicant/submit')}}" enctype="multipart/form-data" id="package_form">
    @csrf

    <!-- Name Field -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control">
        </div>

        <!-- Description Field -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="description" class="form-control">
        </div>

        <!-- Dropzone Field -->
        <div class="dropzone form-group" id="myAwesomeDropzone">
            <input type="hidden" name="images" value="images" id="images">
            <div class="dz-default dz-message">
            <span><i class="fa fa-cloud-upload"></i>
                <br>Drop files here to upload
            </span>
            </div>
        </div>

        <input type="submit" id="form_submit_button">

    </form>
</div>

<script>
    // polyfill for serialize object function.
    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
</script>

<script type="text/javascript">
    var $form = $('#package_form');
    $method = $form.attr('method');
    $url = $form.attr('action');

    // Disable AutoDiscover
    Dropzone.autoDiscover = false;

    // Set Dropzone Options
    Dropzone.options.myAwesomeDropzone = {
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 20,
        maxFiles: 20,
        addRemoveLinks: true,
        acceptedFiles: ".jpg, .jpeg, .png",
        maxFilesize: 2, // 2MB
        dictDefaultMessage: "Drop your files here!",
    };

    // Initialize Dropzone
    var myDropzone = new Dropzone("#myAwesomeDropzone", {url: $url, method: $method});

    // Initialize Submit Button
    var submitButton = document.querySelector("#form_submit_button");

    // Submit Button Event on click
    submitButton.addEventListener("click", function(e) {
        e.preventDefault();
        myDropzone.processQueue();


    });

    // on sending via dropzone append token and form values (using serializeObject jquery Plugin)
    myDropzone.on("sendingmultiple", function(file, xhr, formData) {
        var formValues = $('#package_form').serializeObject();
        $.each(formValues, function(key, value){
            formData.append(key, value);
        });
    });

    // on success redirect
    myDropzone.on("successmultiple", function(){
        // redirect to products page after success.
      //  window.location="{{URL::to('/products')}}";
    });

    // on error show errors
    myDropzone.on("errormultiple", function(file, errorMessage, xhr){
        var arr = [];
        $.each(errorMessage, function(key, value) {
            console.log(value);
            arr += value + "\n";
        });
        // show error message
        console.log(arr);
    });
</script>
</body>
</html>
