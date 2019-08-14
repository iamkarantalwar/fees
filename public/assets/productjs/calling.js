var s = window.route.fetchstudents;

function appendtablebody(response){
    var tbody="";
    var srno = 1;
    response.forEach((student)=>{
            
            var courses="";
            student.courses.forEach((course)=>{
                courses+=`${course.name}<br/>`;
            })

            var last_call = student.callings.pop();
           
            tbody +=`<tr class='cursor' onclick="changeModelRoute(${student.id})"><td>${srno}</td><td>${student.name}</td><td>${student.phone_no}</td>
                        <td>${student.college}</td><td>${courses}</td><td>${student.semester}</td>
                        <td>${last_call!=undefined ? last_call.created_at:"No Call Yet"}</td>
                        <td>${last_call!=undefined ? last_call.status:"Still Pending"}</td>
                    </tr>`;   
                    srno ++;  
  
         
    });
    $('#tbody').html(tbody);   
}

$(document).ready((e)=>{
    
    $.ajax({
        url:window.route.fetchstudents,
        method: "GET"
            
         }).fail((error)=>{
        
        $('#tbody').html(error.statusText);

        }).done((response)=>{
            
            appendtablebody(response);
        })

    $('#searchstudents').click(function(e){

        e.preventDefault();
        $.ajax({
                  url:window.route.filterstudents,
                  method:"GET",
                  data:$('form').serialize(),
            }).done(function(response){

                appendtablebody(response);

            });
    });

    

});

