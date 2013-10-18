<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class update extends MY_Controller {
	
	function __construct() {
	
		parent::__construct();
		
    }
	
	public function index(){
		$thoiGianHienTai 	=	strtotime("+5 day", time());
		echo 'update: '.date('Y-m-d',$thoiGianHienTai);		
		$sql = "Select dates from CoursesDates where dates like '".date('Y-m-d',$thoiGianHienTai)."T%'";
		$temp = $this->db->query($sql);
		$dates = $temp->row()->dates;
		$date = explode("T", $dates); 		
		$query = "Select * from CourseAreas";
		$CourseAreas = $this->db->query($query);
		if(date('Y-m-d',$thoiGianHienTai) != $date[0]){
			foreach($CourseAreas->result() as $Area){
				$this->update(date('Y-m-d',$thoiGianHienTai),$Area->CountryID,$Area->RegionID,$Area->AreaID);
			}	
			echo '<br> update thanh cong ';
		}else{
			echo '<br> Ban da update ngay nay roi';
		}
#		$this->getAreas();
    }
	
	private function update($fin_date, $country_id, $region_id, $area_id){
		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
		$response = $client->CourseAvailList(
			array(
				"Hdr"=>array(
					"ResellerId"=>"WPA",
					"PartnerId"=>"",
					"SourceCd"=>"A",
					"Lang"=>"en",
					"UserIp"=>"66.147.244.227",
					"UserSessionId"=>"",
					"AccessKey"=>"",
					"Agent"=>"",
					"gsSource"=>"",
					"gsDebug"=>true
				),
				"Req"=>array(
					"CountryId"=>$country_id,
					"RegionId"=>$region_id,
					"Area"=>$area_id,
					"PlayBegDate"=>$fin_date."T00:00:00",
					"PlayEndDate"=>$fin_date."T00:00:00",
					"Time"=>700,
					"Players"=>1,
					"MaxDistance"=>"",
					"FeaturedOnly"=>false,
					"ShowAllTimes"=>true,
					"ShowIfNoTimes"=>true,
					"BarterOnly"=>false,
					"ChargingOnly"=>false,
					"SpecialsOnly"=>false,
					"RegularRateOnly"=>false,
					"ProfileId"=>""
				)
			)
		);
		$RetCd=$response->CourseAvailListResult->RetCd;
		
		
		
		if($RetCd==0){
			if(count($response->CourseAvailListResult->Courses->alCourse)==1){						
				$row=$response->CourseAvailListResult->Courses->alCourse;
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
				$sql = "Select id from CourseAvailList where id = ".$row->id;
				$temp = $this->db->query($sql);
				$id = $temp->row()->id;
				if($id == $row->id){
				
				}else{
					$this->db->insert('CourseAvailList', $data);
				}
				if($row->Dates->alDate->dt!=''||$row->Dates->alDate->dt!=null){
					foreach($row->Dates  as $dates){
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
						}
					}
				}				
			}else{
				foreach($response->CourseAvailListResult->Courses->alCourse as $row){
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
					$sql = "Select id from CourseAvailList where id = ".$row->id;
					$temp = $this->db->query($sql);
					$id = $temp->row()->id;
					if($id == $row->id){
					
					}else{
						$this->db->insert('CourseAvailList', $data);
					}				
					if($row->Dates->alDate->dt!=''||$row->Dates->alDate->dt!=null){
						foreach($row->Dates  as $dates){
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
							}
						}
					}						
				}
			}
		}														
#		echo '<pre>'; print_r($response); echo '</pre>';
	}
	
	private function getAreas(){
		$myDate	=	date('Y-m-d',strtotime("+0 day", time()));		
		$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
		$response = $client->Areas(
			array(
				"Hdr"=>array(
					"ResellerId"=>"WPA",
					"PartnerId"=>"",
					"SourceCd"=>"A",
					"Lang"=>"en",
					"UserIp"=>"66.147.244.227",
					"UserSessionId"=>"",
					"AccessKey"=>"",
					"Agent"=>"",
					"gsSource"=>"",
					"gsDebug"=>true
				),
				"Req"=>array(
					"CountryId"=>"",
					"RegionId"=>""
				)
			)
		);
		
		if($response->AreasResult->RetCd==0){
			foreach($response->AreasResult->Countries->Country as $Country){				
				if(count($Country->Regions->Region)==1){
					if(count($Country->Regions->Region->Areas->Area)==1){
						if($Country->Regions->Region->Areas->Area->id != null || $Country->Regions->Region->Areas->Area->id != ''){							
							$dataCourseAreas = array(
								'CountryID' => $Country->id,
								'CountryNM' => $Country->nm,	
								'RegionID' => $Country->Regions->Region->id,
								'RegionNM' => $Country->Regions->Region->nm,
								'AreaID' => $Country->Regions->Region->Areas->Area->id,
								'AreaNM' => $Country->Regions->Region->Areas->Area->nm
							);
							$this->db->insert('CourseAreas', $dataCourseAreas);
							//echo '<pre>'; print_r(); echo '</pre>';
						}
					}else{
						foreach($Country->Regions->Region->Areas->Area as $Area){
							if($Area->id != null||$Area->id != ''){
								$dataCourseAreas = array(
									'CountryID' => $Country->id,
									'CountryNM' => $Country->nm,	
									'RegionID' => $Country->Regions->Region->id,
									'RegionNM' => $Country->Regions->Region->nm,
									'AreaID' => $Area->id,
									'AreaNM' => $Area->nm,
								);
								$this->db->insert('CourseAreas', $dataCourseAreas);
							}
						}
					}
				}else{
					foreach($Country->Regions->Region as $Region){
						if(count($Region->Areas->Area)==1){
							if($Region->Areas->Area->id != null || $Region->Areas->Area->id != ''){
								$dataCourseAreas = array(
									'CountryID' => $Country->id,
									'CountryNM' => $Country->nm,	
									'RegionID' => $Region->id,
									'RegionNM' => $Region->nm,
									'AreaID' => $Region->Areas->Area->id,
									'AreaNM' => $Region->Areas->Area->nm,
								);
								$this->db->insert('CourseAreas', $dataCourseAreas);
							}
						}else{
							foreach($Region->Areas->Area as $Area){
								if($Area->id != null || $Area->id != ''){
									$dataCourseAreas = array(
										'CountryID' => $Country->id,
										'CountryNM' => $Country->nm,	
										'RegionID' => $Region->id,
										'RegionNM' => $Region->nm,
										'AreaID' => $Area->id,
										'AreaNM' => $Area->nm,
									);
									$this->db->insert('CourseAreas', $dataCourseAreas);
								}
							}
						}
					}
				}
			}
		}
#		echo "<pre>"; print_r($response); echo "</pre>";
	}

}