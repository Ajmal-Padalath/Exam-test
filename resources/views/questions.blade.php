<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Questions</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h2>Questions</h2>

    <form >
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <label for="fname">Questions name:</label><br>
        <input type="text" id="q_name" name="q_name" value=""><br><br>

        <label for="lname">Options:</label><br>
        <input type="text" id="options" name="options" value=""><br><br>

        <label for="lname">Answer:</label><br>
        <input type="text" id="answer" name="answer" value=""><br><br>
        <p id="show_message" style="color:Tomato;"></p>

        <input type="button" id="question_submit" value="Submit">
    </form> 

    <script>
        $("#question_submit").click(function(){
            var Qname = $('#q_name').val();
            var option = $('#options').val();
            var answer = $('#answer').val();
            if (!Qname) {
                $('#show_message').html('Please fill Questions name');
            }

            if (!option) {
                $('#show_message').html('Please fill Questions Options');
            }

            if (!answer) {
                $('#show_message').html('Please fill Questions Answer');
            }
            if (Qname && option && answer) {
                $('#question_submit').prop('disabled', true);
                $.ajax({
                    type:"POST",
                    url: "{{url('/add-questions')}}",
                    data: {Qname: Qname, option: option, answer: answer, _token: "{{{csrf_token()}}}"},
                    success: function(data){
                        $('#show_message').html('Question Added Successfully');
                        setTimeout(
                            function(){
                                $('#show_message').html('');
                                $('#q_name').val('');
                                $('#options').val('');
                                $('#answer').val('');
                                $('#question_submit').prop('disabled', false);
                        }, 2000);
                    },
                    error: function(data){
                        $('#show_message').html('Something went wrong, please try again');
                        setTimeout(
                            function(){
                                $('#show_message').html('');
                                $('#q_name').val('');
                                $('#options').val('');
                                $('#answer').val('');
                                $('#question_submit').prop('disabled', false);
                        }, 2000);
                    }
                });
            }
        });
    </script>
</body>
</html>