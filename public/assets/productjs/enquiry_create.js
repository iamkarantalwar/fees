$(document).ready(function(){
    $('#course').on('change',function(){
            var id = $(this).val().pop();
            $.ajax({
                'url':'{{ route("api.course.getcourse") }}',
                'method':'GET',
                'data':{
                   
                    "course_id":id,
                },
                success:function(res){
                    console.log(res);
                },
                error:function(){
                    console.log("course not found");
                }
            });
    });
});
  
