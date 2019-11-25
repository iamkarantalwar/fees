<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>FormWizard_v2</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="colorlib.com">
     
		<!-- LINEARICONS -->
		<link rel="stylesheet" href="{{ asset('registration/fonts/linearicons/style.css') }}">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="{{ asset('registration/fonts/material-design-iconic-font/css/material-design-iconic-font.css') }}">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="{{ asset('registration/vendor/date-picker/css/datepicker.min.css') }}">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="{{ asset('registration/css/style.css') }}">
	</head>
	<body>
		<div class="wrapper">
			<div class="inner">
				{{-- <div class="image-holder">
					<img src="{{ asset('registration/images/form-wizard.jpg') }}" alt="">
					<h3>Your reservation</h3>
				</div> --}}
            	<div id="wizard" style="height: auto;
				min-height: 100vh;width:auto;">
            		<!-- SECTION 1 -->
	                <h4>Student Details</h4>
					<section>
						<div class="modal-body">
                        <div class="form-row">
                           <div class="form-group">
                              <label>
                              Student Name
                              </label>
                              <input style="width: 460px;" required type="text" name="name" value="{{ !empty($enquiry) ? $enquiry->name :'' }}" id="" class="form-control">
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group">
                              <label>
                              Student Gender
                              </label>
                              <input type="radio" name="gender" required value="male" id="" class="">Male
                              <input type="radio" name="gender" required value="female" id="" class="">Female
                           </div>
                        </div>
                        <div class="form-row">
                           <div class="form-group">
                              <label>
                              Student Father Name
                              </label>
                              <input style="width: 460px;" type="text" required name="fname" id="" class="form-control">
                           </div>
                        </div>
					 </div>
					 <div class="form-row">
							<div class="form-group">
							   <label>
							   Student Email
							   </label>
							   <input style="width: 460px;" required value="{{ !empty($enquiry) ? $enquiry->email :'' }}" type="email" name="email" id="" class="form-control">
							</div>
						 </div>
						 <div class="form-row">
							<div class="form-group">
							   <label>
							   Student Phone Number
							   </label>
							   <input style="width: 460px;" required type="text" name="phoneno" value="{{ !empty($enquiry) ? $enquiry->phone_no :'' }}" id="" class="form-control">
							</div>
						 </div>
						 <div class="form-row">
							<div class="form-group">
							   <label>
							   Student Address
							   </label>
							   <textarea id="address" required style="width: 460px;" class="form-control" name="address"></textarea>
							</div>
						 </div>
						 <div class="form-row">
							<div class="form-group">
							   <label>
							   Alternative Phone Number
							   </label>
							   <input style="width: 460px;" required type="text" name="alternate_phone" id="" class="form-control">
							</div>
						 </div>
						 <div class="form-row">
							<div class="select-control">
							   <label>
							   Relationship Type
							   </label>
							   <select style="width: 460px;" required name="relation_type" class="form-control">
								  <option value="">Select Realtionship Type</option>
								  <option value="FATHER">FATHER</option>
								  <option value="MOTHER">MOTHER</option>
								  <option value="SISTER">SISTER</option>
								  <option value="BROTHER">BROTHER</option>
								  <option value="GUARDIAN">GUARDIAN</option>
							   </select>
							</div>
						 </div>
						 <button class="forward" style="width: 195px; margin-top: 44px;">Add College Details
								<i class="zmdi zmdi-long-arrow-right"></i>
							</button>
					</section>

					<!-- SECTION 2 -->
	                <h4>College Information</h4>
	                <section>
							<div class="form-row">
									<div class="form-group">
									   <label>College Name</label>
									   <select id="college" class="ui search dropdown col-md-12" style="width: 460px;" name="college">
										  @if(count($colleges)>0)
										  @if (!empty($enquiry))
										  <option value="">No College</option>
										  @foreach($colleges as $college) 
										  @if($college->id == $enquiry->college->id)                                
										  <option selected value="{{ $college->id }}">{{ $college->college_name }}</option>
										  @else
										  <option value="{{ $college->id }}">{{ $college->college_name }}</option>
										  @endif
										  @endforeach                                  
										  @else
										  <option value="">No College</option>
										  @foreach($colleges as $college)  
										  <option value="{{ $college->id }}">{{ $college->college_name }}</option>
										  @endforeach                                  
										  @endif     
										  @else
										  @endif
									   </select>
									</div>
								 </div>
								 <div class="form-row">
									<div class="">
									   <div class="form-group">
										  <label>Degree</label>
										  <select class="ui search dropdown col-md-12" style="width: 460px;" name="degree" placeholder="Enter The Degree Name" id="degree">
											 @if(count($degrees)>0)
											 @if (!empty($enquiry))
											 @foreach($degrees as $degree)
											 @if ($degree->id == $enquiry->degree->id)
											 <option selected value="{{ $degree->id }}">{{ $degree->name }}</option>
											 @else
											 <option value="{{ $degree->id }}">{{ $degree->name }}</option>
											 @endif
											 @endforeach
											 @else
											 @foreach($degrees as $degree)
											 <option value="{{ $degree->id }}">{{ $degree->name }}</option>
											 @endforeach
											 @endif
											 @endif
										  </select>
									   </div>
									</div>
								 </div>
								 <div class="form-row">
									<div class="form-group">
									   <label>
									   Student Stream
									   </label>
									   <input style="width: 460px;" type="text" name="" id="" class="form-control">
									</div>
								 </div>
								 <div class="form-row">
									<div class="select" style="width: 460px;">
									   <label>
									   Student Semester
									   </label>
									 
									   <select class="form-control" name="semester" placeholder="Enter the semester" id="semester">
										  @if(!empty($enquiry))
										  <option value="{{ $enquiry->semester }}" selected readonly>{{ $enquiry->semester }}</option>
										  @endif
										  <option value="1st">1st</option>
										  <option value="2nd">2nd</option>
										  <option value="3rd">3rd</option>
										  <?php 
											 for($i=4;$i<=8;$i++)
											 {
											   echo "<option value='".$i.'th'."'>".$i."th"."</option>";
											 }
											 ?>
									   </select>
									</div>
								 </div>
								 <div class="form-row">
									<div class="form-group">
									   <label>
									   Others
									   </label>
									   <input style="width: 460px;" type="text" name="other" id="" class="form-control">
									</div>
								 </div>
								 <button class="forward" style="width: 195px; margin-top: 44px;">Add Course Details
										<i class="zmdi zmdi-long-arrow-right"></i>
									</button>
                	
	                </section>
					<h4>Course Information</h4>
					<section>
							<div class="form-row">
									<div class="form-group">
									   <label>
									   Course Name
									   </label>
									   <select style="min-width: 460px;height:40px;" required name="course" id="course" class="form-control">
										  @if(count($courses)>0)
										  @if(!empty($enquiry))
										  @foreach($courses as $course)
										  @if($course->id == $enquiry->courses[0]->id)
										  <option selected value="{{ $course->id }}">{{ $course->name }} - {{ $course->duration->name }}</option>
										  @else
										  <option value="{{ $course->id }}">{{ $course->name }} - {{ $course->duration->name }}</option>
										  @endif
										  @endforeach
										  @else 
										  <option value="">Select The Course</option>
										  @foreach($courses as $course)
										  <option value="{{ $course->id }}">{{ $course->name }} - {{ $course->duration->name }}</option>
										  @endforeach
										  @endif
										  @endif
									   </select>
									</div>
								 </div>
								 <div class="form-row">
									<div class="form-group">
									   <label>
									   Course Duration
									   </label>
									   <select style="min-width: 460px;height:40px;" name="" id="duration" class="form-control">
									   </select>
									</div>
								 </div>
								 <div class="form-row">
									<div class="form-group">
									   <label>Training Type</label>
									   <input type="text" class="form-control" style="min-width: 460px;" required name="training_type" required placeholder="Enter the training type" value="">
									</div>
								 </div>
					</section>

	                <!-- SECTION 3 -->
	                <h4>Fees Information</h4>
	                <section>
						
						
							<div class="form-row">
									<div class="form-group">
									   <label>Total Fees</label>
									   <input type="text" style="width: 460px;" class="form-control" readonly id="total_fees" name="total_fees" required placeholder="Enter the semester" value="{{ !empty($enquiry) ? $enquiry->courses[0]->fees : '0.00'}}">
									</div>
								 </div>
								 <div class="form-row">
									<div class="form-group">
									 
									   <div class="form-group">
										  <label>Discount</label>
										  <input type="text" style="width: 460px;" class="form-control" required id="discount" name="discount" required placeholder="Enter the discount" value="0.00">
									   </div>
									</div>
								 </div>
								 <div class="form-row">
									<div class="col-md-6 pr-1">
									   <div class="form-group">
										  <label>Registration Amount</label>
										  <input type="text" style="width: 460px;" class="form-control" required id="registration_amount" name="registration_amount" required placeholder="Enter the Amount" value="0.00">
									   </div>
									</div>
								
								 </div>
								 <div class="form-row">
										<div class="col-md-6 pl-1">
												<div class="form-group">
												   <label>Reciept Number</label>
												   <input type="text" style="width: 460px;" class="form-control" required id="recipt_num" name="reciept_no" required placeholder="Enter The Recipt Number" >
												</div>
											 </div>
								 </div>
								 <div class="form-row">
									<div class="form-group">
									   <label>
									   Installments
									   </label>
									   <select style="width: 460px;" name="installments" id="installment" class="form-control">
										  <option value="1">1</option>
										  <option value="2">2</option>
										  <option value="3">3</option>
										  <option value="4">4</option>
										  <option value="5">5</option>
									   </select>
									</div>
								 </div>
	                    <button class="forward" style="width: 195px; margin-top: 44px;">Installment Detials
							<i class="zmdi zmdi-long-arrow-right"></i>
						</button>
	                </section>

	                <!-- SECTION 4 -->
	                <h4>Confirmation</h4>
	                <section class="section-style">
							<div class="form-row">
								
							</div>
                		<div class="pay-wrapper">
                			<div class="bill">
									<h4>Payment Details</h4>
								<div class="installment-details">

								</div>
	                		
	            				<div class="bill-cell" style="margin-bottom: 13px">
	                				
		            				<div class="bill-item service">
		            					<div class="bill-unit">
		            						Total Fees :
		            					</div>
		            					<span class="price" id="total_val"></span>
		            				</div>
	                			</div>
	                			<div class="bill-cell">
									
	                				<div class="bill-item vat">
		            					<div class="bill-unit">
		            						Registration :
		            					</div>
		            					<span class="price" id="registration_val"></span>
									</div>
									<div class="bill-item vat">
											<div class="bill-unit">
												Discount :
											</div>
											<span class="price" id="discount_val"></span>
										</div>
		            				<div class="bill-item total-price">
											<div class="bill-unit">
												Pending Fees :
											</div>
											<span class="price" id="pending_val"></span>
										</div>
		            			
									
	                				</div>
	            			</div>
	            			<button style="width: 195px; margin-top: 45px;">Confirmation
								<i class="zmdi zmdi-long-arrow-right"></i>
							</button>
                		</div>
	                </section>
            	</div>
			</div>
		</div>

		<script src="{{ asset('registration/js/jquery-3.3.1.min.js') }}"></script>

		<!-- JQUERY STEP -->
		<script src="{{ asset('registration/js/jquery.steps.js') }}"></script>

		<!-- DATE-PICKER -->
		<script src="{{ asset('registration/vendor/date-picker/js/datepicker.js') }}"></script>
		<script src="{{ asset('registration/vendor/date-picker/js/datepicker.en.js') }}"></script>

		<script src="{{ asset('registration/js/main.js') }}"></script>
		<script>
			$(document).ready(function(){
				
				$("#installment").on('change',function(){
					let total_fees = parseFloat($("#total_fees").val());
					let discount = parseFloat($("#discount").val());
					let registration_amount = parseFloat($("#registration_amount").val());
					let due_amount = total_fees-discount-registration_amount;
					let noOfInstallments = $(this).val();
					let body = "";
					let installment = Math.round(due_amount/noOfInstallments);
					$("#pending_val").html("₹"+due_amount);
					$("#registration_val").html("₹"+registration_amount);
					$("#total_val").html("₹"+total_fees);
					$("#discount_val").html("₹"+discount);
					for(let i=0;i<noOfInstallments;i++){

						body+= `	<div class="bill-cell">
	                				<div class="bill-item">
		            					<div class="bill-unit">
		            						Installment ${i+1} :  
		            					</div>
		            					<span class="price">${"₹"+installment}</span>
		            				</div>
		            			
	                			</div>`; 
					}
					$('.installment-details').html("");
					$('.installment-details').append(body);

				})
				$('#course').on('change',function(){
   
   let duration= $(this).find("option:selected").text().split("-")[1];
  
   var id = $(this).val();
   $.ajax({
	   'url':'{{ route("api.course.getcourse") }}',
	   'method':'GET',
	   'data':{
		  
		   "course_id":id,
	   },
	   success:function(res){
	 console.log(res);
		 
	  var select = "<option selected='selected' value='"+res.duration_id+"'>"+duration+"</option>";
		 $("#duration").html(select);
		 $('#total_fees').val(parseFloat(res["fees"]));
		 $('#course_fees').val(parseFloat(res["fees"]));
		 $('#fees').val(parseFloat(res["fees"]));
	   },
	   error:function(){
		   console.log("course not found");
	   }
   });


	$.ajax({
	   'url':'{{ route("api.course.getcontext") }}',
	   'method':'GET',
	   'data':{
		  
		   "course_id":$(this).val(),
	   },
	   success:function(res)
	   {
		 console.log(res);
		 var options="";
		 var selected="";
		 $('#contexts').val(null).trigger('change');
	   
		 var i;
		 for(i=0;i<res.length;i++)
		 {
		   
			 options += `<option value='${res[i]['id']}' selected>${res[i]['context']}</option>`;

		 }
		
		 $('#contexts').html(options);
  
	   },
	   error:function(){
		   console.log("course not found");
	   }
   });
});
			})
				
				</script>
<!-- Template created and distributed by Colorlib -->
</body>
</html>

