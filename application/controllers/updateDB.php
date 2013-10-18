<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class updateDB extends MY_Controller {

	function __construct() {
	
		parent::__construct();
		
    }
	
	public function index(){
		$this->update();
    }
	
	private function updateDB($arr){
		//echo "Kakaka ta dang trong ham updateDB <Br>";
									
			if(count($arr->CourseAvailListResult->Courses->alCourse)==1){
				# Insert database
				//echo "<pre>"; print_r($arr); echo "</pre>";
				$RetCd=$arr->CourseAvailListResult->RetCd;
				
					if($RetCd==0)
					{
						$row=$arr->CourseAvailListResult->Courses->alCourse;
						# insert table CourseAvailList
							$data = array(
								'xx' => null,
								'id' => $row->id,
								'xid' => $row->xid,
								'onReg' => $row->onReg,
								'rtType' => $row->rtType,
								'nm' => $row->nm,
								'cty' => $row->cty,
								'st' => $row->st,
								'cou' => $row->cou,
								'sCou' => $row->sCou,
								'sReg' => $row->sReg,
								'sAr' => $row->sAr,
								'lat' => $row->lat,
								'lon' => $row->lon,
								'advDays' => $row->advDays,
								'insideDays' => $row->insideDays,
								'isGsw' => $row->isGsw,
								'fPrc' => $row->fPrc,
								'tPrc' => $row->tPrc,
								'curr' => $row->curr,
								'rating' => $row->rating,
								'ratingCnt' => $row->ratingCnt,
								'maxRewPts' => $row->maxRewPts,
								'dist' => $row->dist,
								'promo' => $row->promo,
								'img' => $row->img
							);		

							$this->db->insert('CourseAvailList', $data);
							
#							echo 	"----".$row->id."<br>";			
							if($row->Dates->alDate->dt!=''||$row->Dates->alDate->dt!=null){
								foreach($row->Dates  as $dates){						
									# insert table CoursesDates
									$dataDate = array(
										'id' => null,
										'dates' => $row->Dates->alDate->dt,
										'course_id' => $row->id,
									);
									$this->db->insert('CoursesDates', $dataDate);
									
									$sql = "Select * from CoursesDates where dates='".$row->Dates->alDate->dt."' and course_id=".$row->id;
									$temp = $this->db->query($sql);
									$rows = $temp->row()->id;
									
									foreach($row->Dates->alDate->Times->alTime as $time){
										# insert table CoursesDates
										
										$dataTime = array(
											'id' => null,
											'dates_id' => $rows,
											'tm' => $time->tm,
											'allow' => $time->allow,
											'ppPrice' => $time->ppPrice,
											'ppRegPrice' => $time->ppRegPrice,
											'curr' => $time->curr,
											'ppTxnFee' => $time->ppTxnFee,
											'ppCharge' => $time->ppCharge,
											'chrgCurr' => $time->chrgCurr,
											'ppNonRef' => $time->ppNonRef,
											'ppNetRt' => $time->ppNetRt,
											'ppRewPts' => $time->ppRewPts,
											'inc' => $time->inc,
											'info' => $time->info,
											'flags' => $time->flags
										);
										$this->db->insert('CoursesTimes', $dataTime);	
										//echo "<pre> ##################### Da import database ##################### ";
										//print_r($row->Dates->alDate->dt);
										//echo "</pre>";
									}
								}
							}
					}
			}else{
				# Insert database
				
				$RetCd=$arr->CourseAvailListResult->RetCd;
				
					if($RetCd==0)
					{
						$course_arr=$arr->CourseAvailListResult->Courses->alCourse;
						foreach($course_arr as $row)
						{
							# insert table CourseAvailList
							$data = array(
								'xx' => null,
								'id' => $row->id,
								'xid' => $row->xid,
								'onReg' => $row->onReg,
								'rtType' => $row->rtType,
								'nm' => $row->nm,
								'cty' => $row->cty,
								'st' => $row->st,
								'cou' => $row->cou,
								'sCou' => $row->sCou,
								'sReg' => $row->sReg,
								'sAr' => $row->sAr,
								'lat' => $row->lat,
								'lon' => $row->lon,
								'advDays' => $row->advDays,
								'insideDays' => $row->insideDays,
								'isGsw' => $row->isGsw,
								'fPrc' => $row->fPrc,
								'tPrc' => $row->tPrc,
								'curr' => $row->curr,
								'rating' => $row->rating,
								'ratingCnt' => $row->ratingCnt,
								'maxRewPts' => $row->maxRewPts,
								'dist' => $row->dist,
								'promo' => $row->promo,
								'img' => $row->img
							);		
							$this->db->insert('CourseAvailList', $data);
#							echo 	"----".$row->id."<br>";			
							if($row->Dates->alDate->dt!=''||$row->Dates->alDate->dt!=null){
								foreach($row->Dates  as $dates){						
									# insert table CoursesDates
									$dataDate = array(
										'id' => null,
										'dates' => $row->Dates->alDate->dt,
										'course_id' => $row->id,
									);
									$this->db->insert('CoursesDates', $dataDate);
									
									$sql = "Select * from CoursesDates where dates='".$row->Dates->alDate->dt."' and course_id=".$row->id;
									$temp = $this->db->query($sql);
									$rows = $temp->row()->id;
									
									foreach($row->Dates->alDate->Times->alTime as $time){
										# insert table CoursesDates
										
										$dataTime = array(
											'id' => null,
											'dates_id' => $rows,
											'tm' => $time->tm,
											'allow' => $time->allow,
											'ppPrice' => $time->ppPrice,
											'ppRegPrice' => $time->ppRegPrice,
											'curr' => $time->curr,
											'ppTxnFee' => $time->ppTxnFee,
											'ppCharge' => $time->ppCharge,
											'chrgCurr' => $time->chrgCurr,
											'ppNonRef' => $time->ppNonRef,
											'ppNetRt' => $time->ppNetRt,
											'ppRewPts' => $time->ppRewPts,
											'inc' => $time->inc,
											'info' => $time->info,
											'flags' => $time->flags
										);
										$this->db->insert('CoursesTimes', $dataTime);	
										//echo "<pre> ##################### Da import database ##################### ";
										//print_r($row->Dates->alDate->dt);
										//echo "</pre>";
									}
								}
							}
						} # End foreach
					}	
			}
		}
	
	private function getCourseAvailList($fin_date, $country_id, $region_id, $area_id){
		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
		$response = $client->CourseAvailList(array("Hdr"=>array("ResellerId"=>"WPA",
																"PartnerId"=>"",
																"SourceCd"=>"A",
																"Lang"=>"en",
																"UserIp"=>"66.147.244.227",
																"UserSessionId"=>"",
																"AccessKey"=>"",
																"Agent"=>"",
																"gsSource"=>"",
																"gsDebug"=>true),
												"Req"=>array("CountryId"=>$country_id,
																"RegionId"=>$region_id,
																"Area"=>$area_id,
																"PlayBegDate"=>$fin_date."T00:00:00",
																"PlayEndDate"=>$fin_date."T00:00:00",
																"Time"=>600,
																"Players"=>1,
																"MaxDistance"=>"",
																"FeaturedOnly"=>false,
																"ShowAllTimes"=>true,
																"ShowIfNoTimes"=>true,
																"BarterOnly"=>false,
																"ChargingOnly"=>false,
																"SpecialsOnly"=>false,
																"RegularRateOnly"=>false,
																"ProfileId"=>"")));	
		//$response = $fin_date." - ".$country_id." - ".$region_id." - ".$area_id."<br>";
		//Echo "Cai nay la id ne: ".$country_id."<br>";
		//echo "<pre>"; print_r($response); echo "</pre>";
		//return $response;
		
		$this->updateDB($response);
	}
	
	private function getAre(){
		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
		$response = $client->Areas(array("Hdr"=>array("ResellerId"=>"WPA",
											"PartnerId"=>"",
											"SourceCd"=>"A",
											"Lang"=>"en",
											"UserIp"=>"66.147.244.227",
											"UserSessionId"=>"",
											"AccessKey"=>"",
											"Agent"=>"",
											"gsSource"=>"",
											"gsDebug"=>true),
							"Req"=>array("CountryId"=>"",
											"RegionId"=>"")));
		//echo "<pre>"; print_r($response); echo "</pre>";
		return $response;
		# Lay ngay cuoi cua thang
		//echo cal_days_in_month(CAL_GREGORIAN, 2, 2013); 
		//$now = getdate();
		//$currentDate = $now["mday"]+1 . "." . $now["mon"] . "." . $now["year"];
		//echo "<br>".$currentDate;
	}
	
	private function update(){
		$sql = "SELECT * FROM  `CoursesDates` ORDER BY  `CoursesDates`.`dates` DESC LIMIT 0 , 1";
		$result = $this->db->query($sql);
		$arr = $result->result();
		$now = getdate();
		# Ngay hien tai
		$thoiGianHienTai 	=	strtotime("+0 day", time());
		$ngayHienTai		=	date('d',$thoiGianHienTai);
		
		# Ngay cuoi cung		
		$ngayCuoiCung 		=  cal_days_in_month(CAL_GREGORIAN, $now["mon"], $now["year"]);
		//echo "<pre>"; print_r($arr[0]->dates); echo "</pre>";	
		//echo "Begin update date: ".date('Y-m-d',$thoiGianHienTai)."<br>";
		$are = $this->getAre();
		//echo "<pre>"; print_r($are); echo "</pre>";
		#for($i=$ngayHienTai;$i<=$ngayCuoiCung;$i++){
		
		for($i=0;$i<1;$i++){
			$this->importDB(date('Y-m-d',$thoiGianHienTai),$are);
		}
		//echo "End update date: ".$now["year"]."-".$now["mon"]."-".$ngayCuoiCung."<br>";
		echo "End update date: ".date('Y-m-d',$thoiGianHienTai)."<br>";
	}
	
	private function importDB($myDate, $myAre){
		#echo $myDate."<br>";		
		if($myAre->AreasResult->RetCd==0){
		//echo "<pre>"; print_r($myAre->AreasResult->Countries->Country); echo "</pre>";		
			foreach($myAre->AreasResult->Countries->Country as $row1){
				echo $row1->id."<br>";
			#	echo "<pre>"; print_r(count($row1->Regions->Region)); echo "</pre>";
				if(count($row1->Regions->Region)==1){
				#	echo "- ".$row1->Regions->Region->id;
				#	echo "<pre>"; print_r($row1->Regions->Region); echo "</pre>";
					if(count($row1->Regions->Region->Areas->Area)==1){
					#	echo "<pre>"; print_r($row1->Regions->Region); echo "</pre>";
				#		echo "- ".$row1->Regions->Region->Areas->Area->id."<br>";
						if($row1->Regions->Region->Areas->Area->id!=null||$row1->Regions->Region->Areas->Area->id!=''){
							$this->getCourseAvailList($myDate, $row1->id,$row1->Regions->Region->id,$row1->Regions->Region->Areas->Area->id );
						}
					}else{
					#	echo "<pre>"; print_r($row1->Regions->Region); echo "</pre>";
						foreach($row1->Regions->Region->Areas->Area as $row4){
				#			echo "- ".$row4->id."<br>";
							if($row4->id!=null||$row4->id!=''){
								$this->getCourseAvailList($myDate, $row1->id,$row1->Regions->Region->id,$row4->id );
							}
						}
					}
				}else{
					foreach($row1->Regions->Region as $row2){
				#		echo "- ".$row2->id."<br>";			
					#	echo "<pre>"; print_r($row2->Areas->Area); echo "</pre>";
						if(count($row2->Areas->Area)==1){
						#	echo "### ".$row2->Areas->Area->id."<br>";
						#echo "<pre>"; print_r($row2->Areas->Area); echo "</pre>";
							if($row2->Areas->Area->id!=null||$row2->Areas->Area->id!=''){							
								$this->getCourseAvailList($myDate, $row1->id,$row2->id,$row2->Areas->Area->id);
							}
						}else{
							foreach($row2->Areas->Area as $row3){
				#				echo "### ".$row3->id."<br>";								
								if($row3->id!=null||$row3->id!=''){
									$this->getCourseAvailList($myDate, $row1->id,$row2->id,$row3->id );
								}
							}
						}
					}
				}							
			}
		}		
		//echo "<pre>"; print_r($myAre->AreasResult->Countries->Country); echo "</pre>";
	}
		
}