var s = window.route.fetchstudents;
alert("helolo0w orl");
function appendtablebody(response){
    var tbody="";
    var srno = 1;
    response.forEach((student)=>{
            
            var courses="";
            student.courses.forEach((course)=>{
                courses+=`${course.name}<br/>`;
            })
            let installment_no = student.fees.length == 1 ? "Registration Only": student.fees.length;
            var last_fees = student.fees.pop();
        
        
                    tbody +=`<tr class='cursor' onclick="changeModelRoute(${student.id})"><td>${srno}</td><td>${student.name}</td><td>${student.phoneno}</td>
                    <td>${student.college.college_name}</td><td>${courses}</td><td>${student.semester}</td>
                    // <td>${last_fees.payable_amount}</td>
                    <td>${last_fees.pending_amount}</td>
                    <td>${installment_no}</td>
                </tr>`;           
                    srno ++;  
            
         
    });
    console.log(tbody);
    $('#tbody').html(tbody);   
}

$(document).ready((e)=>{
   
    $.ajax({
        url:window.route.fetchstudents,
        method: "GET"
            
         }).fail((error)=>{
        
        $('#tbody').html(error.statusText);

        }).done((response)=>{
            
            console.log(response);
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

