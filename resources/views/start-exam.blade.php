<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exam</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h2>Exam</h2>

    @if(count($questions) > 0)
        <form id="exam-form">
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <label for="fname">Your name:</label><br>
            <input type="text" id="cand_name" name="cand_name" value=""><br><br>

            <label for="lname">email:</label><br>
            <input type="mail" id="email" name="email" value=""><br><br>

            @foreach ($questions as $quest)
                <p>*{{$quest->q_name}} ?</p>
                <?php $options = explode(',', $quest->options) ?>
                @foreach ($options as $key => $opt)
                    <input type="radio" id="opt_{{$quest->id}}" name="opt_{{$quest->id}}" value="{{$opt}}"  @if($key == 0) checked @endif>
                    <label for="html">{{$opt}}</label><br>
                @endforeach
            @endforeach
            
            
            <br>
            <p id="exam_show_message" style="color:Tomato;"></p>
            <br>
            <input type="button" id="exam_submit" value="Submit">
        </form> 
    @else
        <p>Questions are empty, Please add Questions</p>
    @endif

    <script>
        $("#email").blur(function(){
            var email = $('#email').val();
            $.ajax({
                    type:"POST",
                    url: "{{url('/check-email')}}",
                    data: {email: email, _token: "{{{csrf_token()}}}"},
                    success: function(data){
                        if (data.status == 1) {
                            $('#exam_show_message').html(data.message);
                            $('#exam_submit').prop('disabled', true);
                            // setTimeout(
                            //     function(){
                            //         $('#exam_show_message').html('');
                            //         $('#exam_submit').prop('disabled', false);
                            //     }, 2000);
                        }  else {
                            $('#exam_submit').prop('disabled', false);
                            $('#exam_show_message').html('');
                        }
                    },
                    error: function(data){
                        $('#exam_show_message').html('Something went wrong, please try again');
                       
                    }
                });
        });

        $("#exam_submit").click(function(){
            var name = $('#cand_name').val();
            var email = $('#email').val();
            if (!name) {
                $('#exam_show_message').html('Please fill Your name');
            }
            if (!email) {
                $('#exam_show_message').html('Please fill Your email');
            }
            if (name && email) {
                $('#exam_submit').prop('disabled', true);
                var form     = $('#exam-form');
                var url      = "{{url('/submit-answer')}}";
                var formData = new FormData(form[0]);
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response.status == 1){
                            $('#exam_show_message').html(response.message);
                            setTimeout(
                                function(){
                                    $('#exam_show_message').html('');
                                    $('#exam_submit').prop('disabled', false);
                            }, 2000);
                        }else{
                            $('#exam_show_message').html(response.message);
                            setTimeout(
                                function(){
                                    $('#exam_show_message').html('');
                                    $('#exam_submit').prop('disabled', false);
                            }, 2000);
                        }
                    },
                });
            }
        });


       
    </script>
</body>
</html>