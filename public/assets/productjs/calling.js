var s = window.route.fetchstudents;

function appendtablebody(response){
    var tbody="";
    var srno = 1;
    response.forEach((student)=>{
      
            
            var courses="";
            student.courses.forEach((course)=>{
                courses+=`${course.name}<br/>`;
            })
            let semester = student.semester != null ? student.semester : "";
            var last_call = student.callings.pop();
            let college_name = student.college instanceof Object  ? student.college.college_name : "";
            tbody +=`<tr class='cursor' onclick="changeModelRoute(${student.id})"><td>${srno}</td><td>${student.name}</td>
            <td>${student.phone_no}</td>
                        <td>${college_name}</td><td>${courses}</td><td>${semester}</td>
                        <td>${last_call!=undefined ? last_call.created_at:"No Call Yet"}</td>
                        <td>${last_call!=undefined ? last_call.status:"Still Pending"}</td>
                    </tr>`;   
                    srno ++;  
  
         
    });
    $('#tbody').html(tbody);   
}
function fetchAllStudents()
{
    $.ajax({
        url:window.route.fetchstudents,
        method: "GET"
            
         }).fail((error)=>{
        
        $('#tbody').html(error.statusText);

        }).done((response)=>{
            
            appendtablebody(response);
        })
}
$(document).ready((e)=>{
    
    fetchAllStudents();

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

    $('#myModal').on('hidden.bs.modal', function (e) {
        fetchAllStudents();
      });

});

