<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signal Light</title>
    <link rel="stylesheet" href='{{ asset("css\bootstrap.min.css")}}'>
    <link rel="stylesheet" href='{{ asset("css\style.css")}}'>
</head>

<body>
    <div class="container">
        <form id="signalForm">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <label for="form-group ">A</label>
                    <div class="light red"></div>
                    <input type="text" name="red" id="red" class="seq-input"><br>
                    <span id="red_error" class="text-danger err_show"></span>
                </div>
                <div class="col-md-2">
                    <label for="form-group ">B</label>
                    <div class="light yellow"></div>
                    <input type="text" name="yellow" id="yellow" class="seq-input"><br>
                    <span id="yellow_error" class="text-danger err_show"></span>
                </div>
                <div class="col-md-2">
                    <label for="form-group ">C</label>
                    <div class="light green"></div>
                    <input type="text" name="green" id="green" class="seq-input"><br>
                    <span id="green_error" class="text-danger err_show"></span>
                </div>
                <div class="col-md-2">
                    <label for="form-group ">D</label>
                    <div class="light orange"></div>
                    <input type="text" name="orange" id="orange" class="seq-input"><br>
                    <span id="orange_error" class="text-danger err_show"></span>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <label for="form-group ">Green Interval</label>
                    <input type="number" name="green_interval" id="green_interval" class="seq-input">
                    <span id="green_interval_error" class="text-danger err_show"></span>
                </div>

                <div class="col-md-12">
                    <label for="form-group ">Yellow Interval</label>
                    <input type="number" name="yellow_interval" id="yellow_interval" class="seq-input">
                    <span id="yellow_interval_error" class="text-danger err_show"></span>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-md-2 btnDiv">
            <button type="submit" class="btn btn-primary submitBtn">Start</button>
            <button type="cancel" id="stop" class="btn btn-danger">Stop</button>
        </div>
    </div>
    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset("script/jquery.min.js")}}"></script>

    <script>
        $(document).ready(function() {
            $('#signalForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                console.log("formData", formData);

                $.ajax({
                    type: 'POST',
                    url: '/store-data',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        console.log(data.message);
                        updateColorSequence();
                    },

                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '_error').text(value[0]);
                            console.log('v', value);
                        });
                    }
                });

                $('#stop').click(function() {
                    $('.color-sequence').remove();
                });

                function updateColorSequence() {
                    $.ajax({
                        url: '/show-sequence',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var sequenceData = response.sequence;
                            console.log(sequenceData);
                            var green_interval = response.record.green_interval * 1000;
                            var yellow_interval = response.record.yellow_interval * 1000;
                            console.log("gg", green_interval);
                            console.log("yy", yellow_interval);

                            function displayColor(colors) {
                                $('.color-sequence').remove();
                                var colorSequenceDiv = $('<div class="color-sequence"></div>');
                                console.log("yoooo", colors);

                                if (Array.isArray(colors)) {
                                    colors.foreach(function(color) {
                                        var colorElement = $('<div class="light ' + color + '"></div>');
                                        colorSequenceDiv.append(colorElement);
                                    });

                                } else {
                                    var colorElement = $('<div class="light ' + colors + '"></div>');
                                    colorSequenceDiv.append(colorElement);
                                }

                                $('body').append(colorSequenceDiv);
                            }

                            function loopThroughSequence(sequence, index) {
                                if (index < sequence.length) {
                                    var colors = sequence[index];
                                    var colorMap = {
                                        'A': 'red',
                                        'B': 'yellow',
                                        'C': 'green',
                                        'D': 'orange',
                                    }

                                    var color = colorMap[colors];
                                    displayColor(color);
                                    var g_interval = (color === 'green') ? green_interval : yellow_interval;
                                    var y_interval = (color === 'yellow') ? green_interval : yellow_interval;
                                    setTimeout(function() {
                                        loopThroughSequence(sequence, index + 1);
                                    }, g_interval);


                                    setTimeout(function() {
                                        loopThroughSequence(sequence, index + 1);
                                    }, y_interval);

                                }
                            }
                            loopThroughSequence(sequenceData, 0);
                        },  
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });

                }
            });
        });
    </script>
</body>
</html>