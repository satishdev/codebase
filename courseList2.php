
<?php
    ini_set('display_errors', true); 
    ini_set("soap.wsdl_cache_enabled", "0"); 
    error_reporting(E_ALL); 
    /*$client = new SoapClient('https://devxml.golfswitch.com/golfservice.asmx?WSDL&op=CourseList', array(    'trace' => true,  'exceptions' => true, 
                                                                                                                'connection_timeout'=>9999, 
                                                                                                                'features' => SOAP_SINGLE_ELEMENT_ARRAYS, 
                                                                                                                'soap_version' => SOAP_1_1, 'encoding' => 'ISO-8859-1', 
                                                                                                            )); 
   echo "<pre>";
	
	
	$search_results_xml = $client->CourseList(14002);
	  print_r($search_results_xml); 
    //var_dump($client->__getTypes()); */

	$client = new soapclient('https://devxml.golfswitch.com/golfservice.asmx?WSDL'); 
    echo "<pre>";
	//var_dump($client->__getFunctions());
	
	/*$Hdr = array('ResellerId'=>'WPA','PartnerId'=>'','SourceCd'=>'A','Lang'=>'en','UserIp'=>'66.147.244.227','UserSessionId'=>'','AccessKey'=>'','Agent'=>'','gsSource'=>'','gsDebug'=>'true');

	$Hdrarr = array('Hdr'=>$Hdr);
	
	$Req = array('CountryId'=>'USA','RegionId'=>'AZ');
	$Reqarr = array('Req'=>$Req);
    $Areas = array($Hdrarr,$Reqarr);
	//$response = $client->__soapCall("Areas", $Areas);
	$response = $client->Areas($Hdrarr,$Reqarr);*/
//Areas
/*	$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
  $response = $client->Areas(array("Hdr"=>array("ResellerId"=>"WPA","PartnerId"=>"","SourceCd"=>"A",
"Lang"=>"en","UserIp"=>"66.147.244.227","UserSessionId"=>"","AccessKey"=>"","Agent"=>"","gsSource"=>"","gsDebug"=>true)
,"Req"=>array("CountryId"=>"USA","RegionId"=>"AZ")));
$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
  $response = $client->CourseList(array("Hdr"=>array("ResellerId"=>"WPA","PartnerId"=>"","SourceCd"=>"A",
"Lang"=>"en","UserIp"=>"66.147.244.227","UserSessionId"=>"","AccessKey"=>"","Agent"=>"","gsSource"=>"","gsDebug"=>true)
,"Req"=>array("CountryId"=>"USA","RegionId"=>"AZ","Area"=>"","Latitude"=>"","Longitude"=>"","PostalCode"=>"",
 "MaxDistance"=>"","MaxDistanceType"=>"","ShowAllStatus"=>"active","ShowDisConnected"=>"","FeaturedOnly"=>"","Sort"=>"")));
 $client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");
  $response = $client->CourseAvail(array("Hdr"=>array("ResellerId"=>"WPA","PartnerId"=>"","SourceCd"=>"A",
"Lang"=>"en","UserIp"=>"66.147.244.227","UserSessionId"=>"","AccessKey"=>"","Agent"=>"","gsSource"=>"","gsDebug"=>true)
,"Req"=>array("CourseAvailRequest"=>array("CourseId"=>"18482","PlayBegDate"=>"2012-06-29T00:00:00","PlayEndDate"=>"2012-06-29T00:00:00","Time"=>"1400","Players"=>"4","AltRateType"=>"",
 "PromoCode"=>"","ShowAllTimes"=>true,"BarterOnly"=>false,"ChargingOnly"=>false,"SpecialsOnly"=>false,"RegularRateOnly"=>false,"ProfileId"=>""))));
print_r($response);
*/

echo "<pre>";
//CourseList$stock = new SoapVar("<BookGolf><Hdr><ResellerId>WPA</ResellerId><PartnerId>string</PartnerId><SourceCd>A</SourceCd><Lang>66.147.244.227</Lang><UserIp>string</UserIp><UserSessionId>string</UserSessionId><AccessKey>string</AccessKey><gsSource>string</gsSource><gsDebug>true</gsDebug></Hdr><Req><BookGolfItems><BookGolfItem><CourseId>14002</CourseId><PlayDate>2012-06-29T00:00:00</PlayDate><PlayTime>1400</PlayTime><NumPlayers>1</NumPlayers><AltRateType></AltRateType><PromoCode></PromoCode><PpPrice>19.5000</PpPrice><Curr>USD</Curr><PpTxnFee>1.50</PpTxnFee><PpCharge>4.5000</PpCharge><ChrgCurr>USD</ChrgCurr><PpNonRef>1.50</PpNonRef><PpNetRt>65.0000</PpNetRt><TotPrice></TotPrice><TotTxnFee></TotTxnFee><TotCharge></TotCharge><TotNonRef></TotNonRef><TotNetRt></TotNetRt><Flags></Flags><PackageId></PackageId><BookNotes></BookNotes><IgnorePricing>true</IgnorePricing><Players><Player><ProfileId>1</ProfileId><FirstName>Shabber</FirstName><LastName>Saheb</LastName><Email>shabber641@gmail.com</Email><Phone></Phone><Address1></Address1><City></City><State></State><Country></Country><PostalCode></PostalCode><MemberNo></MemberNo><Handicap></Handicap><RewardsPgmId></RewardsPgmId><RewardsId></RewardsId></Player></Players><Payments><Payment><PayType>CC</PayType><CcType>AX</CcType><PayNumber>20120629000</PayNumber><CcExpMo>05</CcExpMo><CcExpYr>2010</CcExpYr><CcCVV>2134</CcCVV><CcName>BShabberSaheb</CcName><CcAddress1>wittgensteinlaan167</CcAddress1><CcCity>Amsterdam</CcCity><CcState></CcState><CcCountry>Netherlands</CcCountry><CcPostalCode>1062kd</CcPostalCode><CcEmail>shabber641@gmail.com</CcEmail><CcPhone></CcPhone><PayAmount>25</PayAmount><PayCurr>EUR</PayCurr></Payment></Payments></BookGolfItem></BookGolfItems></Req></BookGolf>", XSD_STRING);
$var = "<BookGolf><Hdr><ResellerId>WPA</ResellerId><PartnerId>string</PartnerId><SourceCd>A</SourceCd><Lang>66.147.244.227</Lang><UserIp>string</UserIp><UserSessionId>string</UserSessionId><AccessKey>string</AccessKey><gsSource>string</gsSource><gsDebug>true</gsDebug></Hdr><Req><BookGolfItems><BookGolfItem><CourseId>14002</CourseId><PlayDate>2012-06-29T00:00:00</PlayDate><PlayTime>1400</PlayTime><NumPlayers>1</NumPlayers><AltRateType></AltRateType><PromoCode></PromoCode><PpPrice>19.5000</PpPrice><Curr>USD</Curr><PpTxnFee>1.50</PpTxnFee><PpCharge>4.5000</PpCharge><ChrgCurr>USD</ChrgCurr><PpNonRef>1.50</PpNonRef><PpNetRt>65.0000</PpNetRt><TotPrice></TotPrice><TotTxnFee></TotTxnFee><TotCharge></TotCharge><TotNonRef></TotNonRef><TotNetRt></TotNetRt><Flags></Flags><PackageId></PackageId><BookNotes></BookNotes><IgnorePricing>true</IgnorePricing><Players><Player><ProfileId>1</ProfileId><FirstName>Shabber</FirstName><LastName>Saheb</LastName><Email>shabber641@gmail.com</Email><Phone></Phone><Address1></Address1><City></City><State></State><Country></Country><PostalCode></PostalCode><MemberNo></MemberNo><Handicap></Handicap><RewardsPgmId></RewardsPgmId><RewardsId></RewardsId></Player></Players><Payments><Payment><PayType>CC</PayType><CcType>AX</CcType><PayNumber>20120629000</PayNumber><CcExpMo>05</CcExpMo><CcExpYr>2010</CcExpYr><CcCVV>2134</CcCVV><CcName>BShabberSaheb</CcName><CcAddress1>wittgensteinlaan167</CcAddress1><CcCity>Amsterdam</CcCity><CcState></CcState><CcCountry>Netherlands</CcCountry><CcPostalCode>1062kd</CcPostalCode><CcEmail>shabber641@gmail.com</CcEmail><CcPhone></CcPhone><PayAmount>25</PayAmount><PayCurr>EUR</PayCurr></Payment></Payments></BookGolfItem></BookGolfItems></Req></BookGolf>";

$client = new SoapClient("https://devxml.golfswitch.com/golfservice.asmx?WSDL");

 $response = $client->CourseList(array("Hdr"=>array("ResellerId"=>"WPA",
														"PartnerId"=>"",
														"SourceCd"=>"A","Lang"=>"en",
														"UserIp"=>"66.147.244.227",
														"UserSessionId"=>"",
														"AccessKey"=>"",
														"Agent"=>"",
														"gsSource"=>"",
														"gsDebug"=>true),
										"Req"=>array("CountryId"=>"NAF",
													 "RegionId"=>"TU",
													 "Area"=>"Hammamet",
													 "Latitude"=>"",
													 "Longitude"=>"",
													 "PostalCode"=>"",
													 "MaxDistance"=>"",
													 "MaxDistanceType"=>"",
													 "ShowAllStatus"=>"active",
													 "ShowDisConnected"=>"",
													 "FeaturedOnly"=>"",
													 "Sort"=>"")));

 print_r($response); 
/*
hhkh
*/



?>
 
