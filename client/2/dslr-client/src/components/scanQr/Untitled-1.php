<?php 
	include "../template_top.php"; 
	authen("admin queue doctor drug nurse reception");

	if (!isset($_POST['patient_id']))
	{
		echo "<script>";
	    echo "location.replace('home');";
	    echo "</script>";
	}
	//session_start();
	$_SESSION["EditedPatientId"] = $_POST["patient_id"];
	$page = $_POST['page'];
?>
<script type="text/javascript">
    var pathname = window.location.pathname;
</script>
<style type="text/css">
	#mylabel{
		text-align:right;
	}
	.btn-action {
		width: 150px;
	}
	.hr-action {
		width: 145px;
	}
	.icon-add-patient {
		color: #555555;
	}

	/* modal */
	.modal-header {
		padding-bottom: 5px;
	}
	.modal-footer {
	    	padding: 0;
		} 
	.modal-footer .btn-group button {
		height:40px;
		border-top-left-radius : 0;
		border-top-right-radius : 0;
		border: none;
		border-right: 1px solid #ddd;
	}
	.modal-footer .btn-group:last-child > button {
		border-right: 0;
	}
	/* end modal */

	.tittle{
		margin-top: -115px;
		margin-left: -80px;
		color:white;
	}
	detail {
		font-weight: normal;
	}
</style>

<div class = "container main-content">
	<div class="jumbotron">
		<div class="panel-body">
			<div class = "col-md-12 tittle">
				<h3>Queue</h3>
			</div>
			<div class="row">
				<div class = "col-md-12 text-right">
					<script type="text/javascript">
						if(pathname.match('drug') != null || pathname.match('doctor') != null) {
							document.write("<a href='patient?back=1&page=<?=$page?>' role='button' class=' btn btn-warning'>Back</a>");
						} else {
							document.write("<a href='home?back=1&page=<?=$page?>' role='button' class=' btn btn-warning'>Back</a>");
						}
					</script>
				</div>
			</div>
			<div class = "col-md-10 col-md-offset-1">
				<div class="panel panel-info">
					<div class="panel-body">
						<div class="great">General Information</div>
						<?php
							include "../conf.php";
							$patient_id = $_POST["patient_id"];

							$sql = "SELECT * FROM patient WHERE id = $patient_id";
							$result = $conn->query($sql);
							$row = $result->fetch_assoc();

							$title = $row["title"];
							$firstname = $row["firstname"];
$middle_name= $row["middle_name"];
$email = $row["email"];
							$lastname = $row["lastname"];
							$name = $title.$firstname." $middle_name ".$lastname;
							$identification_number = $row["identification_number"] != "" ? $row["identification_number"] : "-";
							$address = $row["address"] != "" ? $row["address"] : "-";
							$province = $row["province"] != "" ? $row["province"] : "-";
                            $emergency_contact = $row["emergency_contact"] != "" ? $row["emergency_contact"] : "-";
                            $emergency_relationship = $row["emergency_relationship"];
							$passport_id = $row["passport_id"] != "" ? $row["passport_id"] : "-";
							$nationality = $row["nationality"];
							$allergy = $row["allergy"];
							$privilege = $row["privilege"];
							$emergency_name = $row["emergency_name"];
							$comorbid_disease = $row["comorbid_disease"] != "" ? $row["comorbid_disease"] : "-";
							$patient_create_at = $row["create_at"];
							
							$social_insurance = $row["social_insurance"];
							if ($social_insurance == true) {
								$social_insurance = 'Yes';
							} else {
								$social_insurance = 'No';
							}
							$organization = $row["organization"];

							function month($m){
								$thai_months = [
									'', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 
									'เมษายน', 'พฤษภาคม', 'มิถุนายน', 
									'กรกฎาคม', 'สิงหาคม', 'กันยายน', 
									'ตุลาคม', 'พฤศจิกายน','ธันวาคม'];
								return $thai_months[$m];
							}

							//function to change heent_text... to show only
							function _text($status, $text)
							{
								if($status == 0)
									$text = "Not select";
								else if($status == 1)
									$text = "Normal";
								else
									$text = "Abnormal(".$text.")";
								return $text;
							}
							//end function

							$birth_date = $row["birthdate"];
							$birth_day = (int)substr($birth_date, 8, 2);
							$birth_month = month((int)substr($birth_date, 5, 2));
							$birth_year = substr($birth_date, 0, 4);
							$birthdate = $birth_day." ".$birth_month." ".$birth_year;
							$age = date("Y")-$birth_year;

							$tmp_gender = $row["gender"];
							if(strcmp($tmp_gender, "m") == 0){
								$gender = "Male";
							}
							else{
								$gender = "Female";
							}
							$cn = $row["cn"];
							$type = $row["type"];
							$telephone_number = $row["tel"] != "" ? $row["tel"] : "-";
						?>
						<div class = "row">
							<div class = "col-md-4 col-md-offset-4">
							<div class="panel panel-info">
								<div class="panel-body">
									<center><i class="fa fa-user fa-5x" style = "color:#0E5589"></i></center>
								</div>
							</div>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Name : </label>
							</div>
							<div class = "col-md-6">
								<?=$name?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Age : </label>
							</div>
							<div class = "col-md-6">
								<?=$age?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Gender : </label>
							</div>
							<div class = "col-md-6">
								<?=$gender?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>CN (เลขผู้ป่วยคลินิคเก่า) : </label>
							</div>
							<div class = "col-md-6">
								<?=$cn?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Type (ประเภทผู้ป่วย) : </label>
							</div>
							<div class = "col-md-6">
								<?=$type?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Allergy : </label>
							</div>
							<div class = "col-md-6">
								<?=$allergy?>
							</div>
						</div>	
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Comorbid disease : </label>
							</div>
							<div class = "col-md-6">
								<?=$comorbid_disease?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Social security insurance : </label>
							</div>
							<div class = "col-md-6">
								<?=$social_insurance?>
							</div>
						</div>
						<?php 
							if($social_insurance == "Yes") {
								echo '<div class = "row"><div class = "col-md-6" id = "mylabel"><label>สถานที่ประกอบการ : </label></div><div class = "col-md-6">'.$organization.'</div></div>';
							}
						?>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Nationality : </label>
							</div>
							<div class = "col-md-6">
								<?=$nationality?>
							</div>
						</div>	
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Passport ID : </label>
							</div>
							<div class = "col-md-6">
								<?=$passport_id?>
							</div>
						</div>	
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Identification number : </label>
							</div>
							<div class = "col-md-6">
								<?=$identification_number?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Birthdate : </label>
							</div>
							<div class = "col-md-6">
								<?=$birthdate?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Telephone number : </label>
							</div>
							<div class = "col-md-6">
								<?=$telephone_number?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Province : </label>
							</div>
							<div class = "col-md-6">
								<?=$province?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Address : </label>
							</div>
							<div class = "col-md-6">
								<?=$address?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Amergency contact : </label>
							</div>
							<div class = "col-md-6">
								<?=$emergency_contact?>
							</div>
						</div>
                        <div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Amergency name : </label>
							</div>
							<div class = "col-md-6">
								<?=$emergency_name?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Privilege : </label>
							</div>
							<div class = "col-md-6">
								<?=$privilege?>
							</div>
						</div>
<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Email : </label>
							</div>
							<div class = "col-md-6">
								<?=$email?>
							</div>
						</div>
						<div class = "row">
							<div class = "col-md-6" id = "mylabel">
								<label>Create at : </label>
							</div>
							<div class = "col-md-6">
								<?=$patient_create_at?>
							</div>
						</div>
                        <br>
                        <div class = "row">
<div class="col-md-6">
						<form id="invoice_form" action="../docs/patient_doc" method="POST" role="form" target="_blank">
						
							
						
							<input type="hidden" name="patient_name" class="form-control" value="<?= $name ?>">
                            <input type="hidden" name="birthdate" class="form-control" value="<?= $birthdate ?>">
                            <input type="hidden" name="address" class="form-control" value="<?= $address ?>">
                            <input type="hidden" name="telephone_number" class="form-control" value="<?= $telephone_number ?>">
							<button type="submit" class=" btn btn-primary btn-block"><span class="fa fa-file-text-o"></span> พิมพ์ข้อมูลคนไข้</button>
						</form>
					</div>
                    <div class="col-md-6">
						<form id="invoice_form" action="../docs/social_doc" method="POST" role="form" target="_blank">
							<div id="invoice-field-selected"></div>
							<div id="invoice-field-container"></div>
							<div id="invoice-drug_info-container"></div>
							<div id="invoice-drug_inject_info-container"></div>
							<div id="invoice-cme-container" class="d-none"></div>
							<input type="hidden" name="diductable">
							<input type="hidden" name="discount">
							<input type="hidden" name="diduct_select_post" value="both">
							<input type="hidden" name="discount_select_post" value="both">
							<input type="hidden" name="treatment_record_id" value="<?php echo $treatment_record_id; ?>">
							<input type="hidden" class="form-control" name="total_price" value="<?php echo $price; ?>">
							<input type="hidden" class="form-control" name="medicine_price" value="<?php echo $price; ?>">
							<input type="hidden" class="form-control" name="inject_price" value="0">
							<input type="hidden" name="patient_name" class="form-control" value="<?= $patient_name ?>">
							<input type="hidden" name="diagnosis" class="form-control">
							<input type="hidden" name="ic_name" class="form-control">
							<input type="hidden" name="ic_address" class="form-control">
							<input type="hidden" name="ic_tex_id" class="form-control">
                                                        <input type="hidden" name="yr_name" class="form-control">
                                                        <input type="hidden" name="birthdate" class="form-control" value="<?= $birthdate ?>">
							<button type="submit" class=" btn btn-primary btn-block"><span class="fa fa-file-text-o"></span> พิมพ์ข้อมูลประกันสังคม</button>
						</form>
					</div>
                    </div>
					</div>
				</div>
			</div>
		</div>

		<section id="cd-timeline" class="cd-container" style="margin-top: 0px;">
		<?php
		//variable for treatment history
			// $sql = "SELECT * FROM treatment_record WHERE patient_id = $patient_id ORDER BY date_time DESC";

			$sql = "SELECT 
				treatment_record.id,
				treatment_record.temperature,
				treatment_record.pressure_1,
				treatment_record.pressure_2,
				treatment_record.weight,
				treatment_record.height,
				treatment_record.respiratory,
				treatment_record.heart,
				treatment_record.pain_score,
				treatment_record.chief_complaint,
				treatment_record.present_illness,
				treatment_record.diagnosis,
				treatment_record.icd_code_map,
				treatment_record.medication,
				treatment_record.procedures,
				treatment_record.general_appearance,
				treatment_record.heent_status,
				treatment_record.heent_text,
				treatment_record.cvs_status,
				treatment_record.cvs_text,
				treatment_record.chest_status,
				treatment_record.chest_text,
				treatment_record.abdomen_status,
				treatment_record.abdomen_text,
				treatment_record.neurological_status,
				treatment_record.neurological_text,
				treatment_record.image,
				treatment_record.price,
				treatment_record.date_time,
				treatment_record.current_modify,
				treatment_record.patient_id,
				treatment_record.get_certificate,
				treatment_record.get_receipt,
				appointment.patient_code,
				appointment.create_at,
				appointment.date,
				appointment.time_start,
				appointment.note,
				appointment.time_end,
				appointment.doctor_id
				FROM treatment_record
				LEFT JOIN appointment
				ON treatment_record.id = appointment.treatment_record_id
				WHERE treatment_record.patient_id = $patient_id
				ORDER BY date_time DESC";

			$result = $conn->query($sql);
			$num_rows = $result->num_rows;
			$count = 0;

			while($row = $result->fetch_assoc())
			{
				$treatment_record_id 	= $row["id"];
				$temperature 			= $row["temperature"];
		    	$pressure1 				= $row["pressure_1"];
		    	$pressure2	 			= $row["pressure_2"];
		    	$pressure 				= $pressure1.'/'.$pressure2;
		    	$weight 				= $row["weight"];
		    	$height 				= $row["height"];
		    	$respiratory 			= $row["respiratory"];
		        $heart 					= $row["heart"];
				$pain_score 			= $row["pain_score"];
				$chief_complaint 		= $row["chief_complaint"]; 
				$present_illness 		= $row["present_illness"];
				$diagnosis 				= $row["diagnosis"];

				$icd_code_map 			= $row["icd_code_map"];
				$sql = "SELECT * FROM icd_code_map WHERE id = $icd_code_map";
				$answer = $conn->query($sql);
				$line = $answer->fetch_assoc();
				$icd_code = $line["icd_code"];
				$meaning = $line["meaning"];

				$medication 			= $row["medication"];
				$procedures 			= $row["procedures"];
				$general_appearance 	= $row["general_appearance"];

				$heent_status 			= $row["heent_status"];
				$heent_text 			= $row["heent_text"];
				$heent_text				= _text($heent_status, $heent_text);

				$cvs_status 			= $row["cvs_status"];
				$cvs_text 				= $row["cvs_text"];
				$cvs_text				= _text($cvs_status, $cvs_text);

				$chest_status 			= $row["chest_status"];
				$chest_text 			= $row["chest_text"];
				$chest_text				= _text($chest_status, $chest_text);

				$abdomen_status 		= $row["abdomen_status"];
				$abdomen_text 			= $row["abdomen_text"];
				$abdomen_text			= _text($abdomen_status, $abdomen_text);

				$neurological_status 	= $row["neurological_status"];
				$neurological_text 		= $row["neurological_text"];
				$neurological_text		= _text($neurological_status, $neurological_text);

				$image 					= $row["image"];
				$price 					= $row["price"];
				$date_time 				= $row["date_time"];
				$current_modify 		= $row["current_modify"];
				$patient_id 			= $row["patient_id"];

				$appointment_create_at				= $row["create_at"]; 
				$appointment_patient_code			= $row["patient_code"]; 
				$appointment_date 					= $row["date"];
				$appointment_time_start 			= $row["time_start"];
				$appointment_note 					= $row["note"];
				$appointment_time_end 				= $row["time_end"];
				$appointment_doctor_id 				= $row["doctor_id"];
				$appointment_time 					= $appointment_time_start ." น. ถึง ".$appointment_time_end." น.";
				if ($appointment_create_at != NULL)
				{
					$sql_users = "SELECT * FROM users WHERE id=$appointment_doctor_id";
					$result_users = $conn->query($sql_users);
					$row_users = $result_users->fetch_assoc();
					$title = "นพ. ";
					$doctor_first_name = $row_users["firstName"];
					$doctor_last_name = $row_users["lastName"];
					$appointment_doctor_name = $title.$doctor_first_name." ".$doctor_last_name;
				}
				else
				{
					$appointment_doctor_name = "";
				}

				$sql = "SELECT * FROM patient where id = $patient_id";
				$answer = $conn->query($sql);
				$line = $answer->fetch_assoc();

				$firstname = $line["firstname"];
				$lastname = $line["lastname"];
				$comorbid_disease = $line["comorbid_disease"];
				$allergy = $line["allergy"];

				$fullDetail = true;
				if ($chief_complaint == 'ซื้อยา' || $chief_complaint == 'ซื้อยา พบหมอ') 
				{
					$fullDetail = false;
				}

				if($count == 0)
					$title = "การรักษาครั้งล่าสุด";
				else 			
					$title = "การรักษาครั้งที่ ".$num_rows;

				//$title = $title." &nbsp;&nbsp;(".$date_time.")";

				$count++;
				$num_rows--;
		?>

				<div class="cd-timeline-block">
					<div class="cd-timeline-img cd-picture">
						<center><h3 style="color:white; margin-top:8px"><?=$num_rows+1?></h3></center>
					</div> <!-- cd-timeline-img -->

					<div class="cd-timeline-content" onclick = "toggle_detail('<?=$count?>')" style = "cursor:pointer;">
						<!--<h2><?=$title?></h2>-->
						<b>อาการสำคัญ : </b><?=$chief_complaint?><br>
						<span <?php echo $fullDetail ? "" : "style='display:none'" ?>>
						<b>ประวัติปัจจุบัน : </b><?=$present_illness?><br>
						</span>
						<div class = "detail<?=$count?>" style = "display : none" >
							<table class="table table-striped table-hover" <?php echo $fullDetail ? "" : "style='display:none'" ?>>
								<thead>
									<tr>
										<!-- Body Temperature -->
										<th>BT<detail> (°C)</detail></th>
										<!-- Blood pressure -->
										<th>BP<detail> (mmHg)</detail></th>
										<!-- Heart rate -->
										<th>HR<detail> (per min)</detail></th>
										<!-- Respiratory rate -->
										<th>RR<detail> (per min)</detail></th>
										<!-- Weight -->
										<th>BW<detail> (kg)</detail></th>
										<!-- Height -->
										<th>Ht<detail> (cm)</detail></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><?=$temperature?></td>
								        <td><?=$pressure?></td>
								        <td><?=$heart?></td>
								        <td><?=$respiratory?></td>
								        <td><?=$height?></td>
								        <td><?=$weight?></td>
									</tr>
								</tbody>
							</table>
							<table class="table table-hover">
								<tbody>
									<?php if ($fullDetail) { ?>
										<tr>
											<th>Chief Complaint</th>
									        <td><?=$chief_complaint?></td>
										</tr>
										<tr>
											<th>Present illness</th>
									        <td><?=$present_illness?></td>
										</tr>
										<tr>
											<th>Pass history / Comorbid disease</th>
									        <td><?=$comorbid_disease?></td>
										</tr>
										<tr>
											<th>ICD code map</th>
									        <td><?=$icd_code?> <?=$meaning?></td>
										</tr>
										<!-- <tr>
											<th>Allergy</th>
									        <td><?=$allergy?></td>
										</tr> -->
										<tr>
											<th>General appearance</th>
									        <td><?=$general_appearance?></td>
										</tr>
										<tr>
											<th>HEENT</th>
									        <td><?=$heent_text?></td>
										</tr>
										<tr>
											<th>CVS.</th>
									        <td><?=$cvs_text?></td>
										</tr>
										<tr>
											<th>Chest</th>
									        <td><?=$chest_text?></td>
										</tr>
										<tr>
											<th>Abdomen</th>
									        <td><?=$abdomen_text?></td>
										</tr>
										<tr>
											<th>Neurological examination</th>
									        <td><?=$neurological_text?></td>
										</tr>
										<tr>
											<th>Pain score</th>
									        <td><?=$pain_score?></td>
										</tr>
										<tr>
											<th>Impression / Diagnosis</th>
									        <td><?=$diagnosis?></td>
										</tr>
										<tr>
											<th>Medication</th>
									        <td><?=$medication?></td>
										</tr>
										<tr>
											<th>Procedure</th>
									        <td><?=$procedures?></td>
										</tr>
										<?php if ($appointment_create_at != NULL) { ?>
											<tr>
												<th>Appointment</th>
										        <td>
										        	วันนัด: <?=$appointment_date?><br>
													เวลา: <?=$appointment_time?><br>			
													รายละเอียด:<?=$appointment_note?> 				
										        </td>
											</tr>
										<?php } ?>
										<?php if ($image != "") { ?>
											<tr>
												<th>Image</th>
										        <td>
										        	<img src="../asset/img/treatment_pic/<?=$image?>" class="img-thumbnail img-responsive" id="img-record">
										        </td>
											</tr>
										<?php } ?>
									<?php } ?>
									<?php
							        	$sql = "SELECT * FROM dispensation WHERE treatment_record_id = $treatment_record_id";
						      			$result_dispensation = $conn->query($sql);
						      			$count_dispensation = $result_dispensation->num_rows;
						      			$i = 0;
							    		
							    		while($row_dispensation = $result_dispensation->fetch_assoc())
							    		{
							    			$i++;
							    			$amount 				= $row_dispensation["amount"];
							    			$use_position 			= $row_dispensation["use_position"];
							    			$eatperday_time 		= $row_dispensation["eatperday_time"];
							    			$every_hour 			= $row_dispensation["every_hour"];
							    			$eat_time_meal 			= $row_dispensation["eat_time_meal"];
							    			$eat_time_morning 		= $row_dispensation["eat_time_morning"];
							    			$eat_time_noon 			= $row_dispensation["eat_time_noon"];
							    			$eat_time_evening 		= $row_dispensation["eat_time_evening"];
							    			$eat_time_before_sleep 	= $row_dispensation["eat_time_before_sleep"];
							    			$drug_id 				= $row_dispensation["drug_id"];

							    			$sql = "SELECT * FROM drug WHERE id = $drug_id";
							    			$answer = $conn->query($sql);
							    			$line = $answer->fetch_assoc();
							    			$generic_eng 	= $line["generic_eng"];
							    			$generic_thai 	= $line["generic_thai"];
							    			$trade_name 	= $line["trade_name"];
							    			$symptom_time 	= $line["symptom_time"];
							    			$eat_style 		= $line["eat_style"];
							    			$note 			= $line["note"];
							    	?>
											<tr>
												<th>Drug #<?=$i?></th>
										        <td><?=$generic_eng?>(<?=$trade_name?>) : <?=$amount?></td>
											</tr>
									<?php
										}
									?>
									<tr>
									</tr>
								</tbody>
							</table>
							<b>Price : </b><?=$price?> บาท<br>
						</div>
						<!--<button type="button" class="btn btn-default " style="float: right;" onclick = "toggle_detail('<?=$count?>')">ลายเอียดเพิ่มเติม</button>-->
						<div class="row">
							<div class="col-md-12">
								<span class="cd-date"><b>create : </b><?=$date_time?></span><span class="cd-date" style="padding-left: 20px;"><b>modify : </b><?=$current_modify?></span>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<form action="delete_treatment_record_process" method="POST" role="form">
								<input type="hidden" name="patient_id" value="<?=$patient_id?>">
								<input type="hidden" name="treatment_record_id" value="<?=$treatment_record_id?>">
								<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete?');" style="float: right; margin: 0 0 0 10px;">Delete</button>
							</form>
							<form action="remed" method="POST" role="form" <?= $count_dispensation == 0 ? "style='display:none'" : "" ?>>
								<input type="hidden" name="patient_id" value="<?=$patient_id?>">
								<input type="hidden" name="treatment_record_id" value="<?=$treatment_record_id?>">
								<button type="submit" class="btn btn-sm btn-info " style="float: right; margin: 0 0 0 10px;">Remed</button>
							</form>
							<form action="../docs/appointment" target="_blank" method="POST" role="form" <?= $appointment_create_at == NULL ? "style='display:none'" : "" ?>>
								<input type="hidden" name="id" class="form-control" value="<?=$id?>">
								<input type="hidden" name="code" class="form-control" value="<?=$appointment_patient_code?>">
								<input type="hidden" name="patient_name" class="form-control" value="<?=$name?>">
								<input type="hidden" name="doctor_name" class="form-control" value="<?=$appointment_doctor_name?>">
								<input type="hidden" name="appointment_date" class="form-control" value="<?=$appointment_date?>">
								<input type="hidden" name="time" class="form-control" value="<?=$appointment_time?>">
								<input type="hidden" name="note" class="form-control" value="<?=$appointment_note?>">
								<input type="hidden" name="create_at" class="form-control" value="<?=$patient_create_at?>">
								<button type="submit" class="btn btn-sm btn-success" style="float: right;">Print Appointment</button>
							</form>
						</div>
					</div> <!-- cd-timeline-content -->
				</div> <!-- cd-timeline-block -->
		<?php
			}
		?>
		</section> <!-- cd-timeline -->

	</div>
</div>

<!-- modal -->
<?php
	$sql = "SELECT id, chief_complaint, present_illness, DATE_FORMAT( date_time,  '%d-%m-%Y' ) FROM treatment_record WHERE patient_id = $patient_id ORDER BY date_time DESC";
	$result = $conn->query($sql);
	$count = $result->num_rows;

	while($row = $result->fetch_assoc())
	{
		//from_unixtime(mytimestamp, '%Y %D %M %h:%i:%s')
		$date = $row["DATE_FORMAT( date_time,  '%d-%m-%Y' )"];
		$chief_complaint = $row["chief_complaint"];
		$present_illness = $row["present_illness"];
		$treatment_record_id = $row["id"];
?>
<div class="modal fade" id="<?=$treatment_record_id?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<form action="charge" method="POST" role="form">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h2 class="modal-title text-center" id="lineModalLabel">Drug</h2>
			</div>
			<div class="modal-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>main symptom</th>
							<th>current history</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?=$chief_complaint?></td>
							<td><?=$present_illness?></td>
						</tr>
					</tbody>
				</table>

				<input type="hidden" value=<?=$patient_id?> name="patient_id">

              	<!-- drug checkbox -->
          		<div class="row">
          			<div class="col-md-12">
				    	<h4>Drug List</h4>
				    	<div class="funkyradio">
				    		<?php
								$sql = "SELECT drug_id, amount FROM dispensation WHERE treatment_record_id = $treatment_record_id";
								$dispensation_result = $conn->query($sql);

								while($row = $dispensation_result->fetch_assoc())
								{
									$drug_id = $row["drug_id"];
									$amount = $row["amount"];
									$sql = "SELECT generic_eng, price FROM drug WHERE id = $drug_id";
									
									$drug_result = $conn->query($sql);
									$row = $drug_result->fetch_assoc();
									$drug_name = $row["generic_eng"];
									$drug_price_per_unit = $row["price"];
									$drug_price = $drug_price_per_unit * $amount;
									//debug
									// echo "debug: ".$drug_name." ".$amount."*".$drug_price_per_unit." =".$drug_price;
							?>
						        <div class="funkyradio-info">
						            <input type="checkbox" name="drug_price[]" id="<?=$drug_id?><?=$treatment_record_id?>" value=<?=$drug_price?> checked/>
						            <label for="<?=$drug_id?><?=$treatment_record_id?>">
						            	<?=$drug_name?>
						            	<h6 class="text-right" style="padding-right: 10px; margin-top: -25px;"><?=$amount?> unit(s)</h6>
						            </label>
						        </div>
						    <?php } ?>
					    </div>
					</div>
				</div>
				<!-- end drug checkbox -->

			</div>
			<div class="modal-footer">
				<div class="btn-group btn-group-justified" role="group" aria-label="group button">
					<div class="btn-group" role="group">
						<button type="button submit" class="btn btn-success btn-hover-green" role="button" name="insert_queue">Submit</button>
					</div>
					<div class="btn-group" role="group">
						<button type="button" class="btn btn-danger" data-dismiss="modal"  role="button">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</form>

  </div>
</div>
<?php
		$count--;
	}
?>
<!-- end modal -->

<?php include "../template_btm.php"; ?>

<script type="text/javascript">
function toggle_detail(num){
	var detail_count = 'div.detail'.concat(num);
	$(detail_count).slideToggle(500);
}
</script>

