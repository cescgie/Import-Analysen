<?php
	
	ini_set('max_execution_time', 68000); 
	@set_time_limit(68000);

	$debugTimeStart = microtime(true); 

	//Conncet to MySQL
	$connect  = mysqli_connect('localhost', 'root', 'password', 'myDB');
	// Check connection
	if (!$connect) {
	    die("Connection failed: " . mysqli_connect_error()."\n");
	}else{
		echo "Connection to database succesfully. \n";

		$sql = "CREATE TABLE IF NOT EXISTS gl (
			  id bigint(20) NOT NULL auto_increment,
			  VersionId tinyint(4) NOT NULL,	  
			  SequenceId bigint(11) NOT NULL,		  
			  PlcNetworkId mediumint(6) NOT NULL,
			  PlcSubNetworkId smallint(4) NOT NULL,
			  WebsiteId bigint(11) NOT NULL,
			  PlacementId bigint(11) NOT NULL,
			  PageId smallint(4) NOT NULL,
			  CmgnNetworkId smallint(4) NOT NULL,
			  CmgnSubNetworkId smallint(4) NOT NULL,
			  CampaignId bigint(11) NOT NULL,
			  MasterCampaignId bigint(11) NOT NULL,
			  BannerId mediumint(4) NOT NULL,
			  BannerNumber smallint(4) NOT NULL,
			  PaymentId tinyint(4) NOT NULL,
			  StateId smallint(4) NOT NULL,
			  AreaCodeId smallint(4) NOT NULL,
			  IpAddress BINARY(16) NOT NULL,
			  UserId char(16) NOT NULL,
			  OsId tinyint(4) NOT NULL,
			  TagType tinyint(4) NOT NULL,
			  BrowserId tinyint(4) NOT NULL,
			  BrowserLanguage tinyint(4) NOT NULL,
			  TLDId smallint(4) NOT NULL,
			  MediaTypeId tinyint(4) NOT NULL,
			  PlcContentTypeId tinyint(4) NOT NULL,
			  Reserved2 smallint(4) NOT NULL,
			  DateEntered int(4) NOT NULL,	
			  Hour tinyint(4) NOT NULL,
			  Minute tinyint(4) NOT NULL,	
			  Second tinyint(4) NOT NULL, 
			  AdServerIp tinyint(4) NOT NULL,
			  AdServerFarmId tinyint(4) NOT NULL,
			  DMAId tinyint(4) NOT NULL,
			  CountryId smallint(4) NOT NULL,
			  ZipCodeId int(4) NOT NULL,
			  CityId int(4) NOT NULL,
			  IspId smallint(4) NOT NULL,
			  CountTypeId tinyint(4) NOT NULL,
			  ConnectionTypeId tinyint(4) NOT NULL,
			  PRIMARY KEY  (id)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ";

		if($connect->query($sql) === FALSE) {
		    echo "Error creating table: " . $connect->error. "\n";
		}else{			
		    echo "Table created successfully. \n";
		}
	}

	$dataTypesSize = array(
						'tinyint'=> array('code'=>'C', 'size'=>''),
						'smallint'=> array( 'code'=>'n', 'size'=>''),
						'int'=> array('code'=>'N', 'size'=>''),
						'unsignedint'=> array('code'=>'N', 'size'=>''),
						'char(16)'=> array('code'=>'a16', 'size'=>''),
						'char(32)'=> array('code'=>'a32', 'size'=>''),
						'char(50)'=> array('code'=>'a50', 'size'=>''),
						'char(150)'=> array('code'=>'a150', 'size'=>''),
						'char(200)'=> array('code'=>'a200', 'size'=>''),
						'char(1000)'=> array('code'=>'a1000', 'size'=>''),
						'varchar(1000)'=> array('code'=>'a999', 'size'=>''),
				);
		
	$codeGA = array(
				array('name'=>'VersionId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>'0'),
				array('name'=>'SequenceId', 'type'=>'unsignedint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'PlcNetworkId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'PlcSubNetworkId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'WebsiteId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'PlacementId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'PageId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CmgnNetworkId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CmgnSubNetworkId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CampaignId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'MasterCampaignId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'BannerId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'BannerNumber', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'PaymentId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'StateId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'AreaCodeId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'IpAddress', 'type'=>'unsignedint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'UserId', 'type'=>'char(16)', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'OsId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'TagType', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'BrowserId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'BrowserLanguage', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'TLDId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'MediaTypeId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'PlcContentTypeId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'Reserved2', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'DateEntered', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'Hour', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'Minute', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'Second', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'AdServerIp', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'AdServerFarmId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'DMAId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CountryId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'ZipCodeId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CityId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'IspId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CountTypeId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'ConnectionTypeId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>'')
			);
	$code = $codeGA;
	//$code = $codeBPC;
	
	/*
		sizes of datatypes	
	*/	
	foreach($dataTypesSize AS $k=>$v) {
		$dataTypesSize[$k]['size'] = strlen(pack($dataTypesSize[$k]['code'], ''));	
		
	};
	$rowPointer = 0;
	foreach($code AS $k=>$v) {
		$code[$k]['size'] = $dataTypesSize[$code[$k]['type']]['size'];
		$code[$k]['code'] =	$dataTypesSize[$code[$k]['type']]['code'];	
		$code[$k]['accumulatedPointer'] = $rowPointer;
		$rowPointer += $code[$k]['size'];			
	};
	

	/*
		size/length row
	*/
	$rowLength = count($code);
	$rowSize = 0;
	foreach($code AS $k=>$v) {
		$rowSize += $code[$k]['size'];
	};
	
	
	/*
		errorcode
	*/
	$errorcode = array('-2', '-3', '-4', '-6', '-7', '-10', '-23', '-26', '-98');


	$handlefolder = opendir ('data_gl/');
	while ($file = readdir ($handlefolder)) {		
		if (substr($file, -4) == '.bin') {
			echo 'data_gl/'.$file."\n";
			$handle = fopen('data_gl/'.$file, 'rb');
			while ($contents = fread($handle, $rowSize)) {
				$tmpObject = array();
				for ($i=0; $i<$rowLength; $i++) {
					
					$data = unpack($code[$i]['code'], substr($contents, $code[$i]['accumulatedPointer'], $code[$i]['size']));			
					$data = $data[1];
					
					if ($code[$i]['name'] == 'IpAddress') {
						$data = (255 & ($data >> 24)).'.'.(255 & ($data >> 16)).'.'.(255 & $data>>8).'.'.(255 & $data);				
					} elseif ($code[$i]['name'] == 'UserId') {
						$user = '';
						for ($ii=0; $ii<strlen($data); $ii++) {
							$userTmp = ord($data[$ii]);
							$user = $user.dechex ((15 & ($userTmp >> 4))).dechex (15 & $userTmp);
						};
						$data = $user;		
						
					} elseif ($data < 0) {				// AND $code[$i]['type'] == 'unsignedint'
						if (!in_array($data, $errorcode))
							$data = substr(bcsub($data*-1, 4294967296), 1);			
					};
					$tmpObject[$i] = $data;			
					
				};	
			
			//MySQL
			$sqli = 'INSERT INTO gl ( 
				VersionID, SequenceId, PlcNetworkId, PlcSubNetworkId, WebsiteId, 
				PlacementId, PageId, CmgnNetworkId, CmgnSubNetworkId, CampaignId, 
				MasterCampaignId, BannerId, BannerNumber, PaymentId, StateId, 
				AreaCodeId, IpAddress, UserId, OsId, TagType,
				BrowserId, BrowserLanguage, TLDId, MediaTypeId, PlcContentTypeId,
				Reserved2, DateEntered, Hour, Minute, Second, 
				AdServerIp, AdServerFarmId, DMAId, CountryId, ZipCodeId, 
				CityId, IspId, CountTypeId, ConnectionTypeId) 
				VALUES ( 
				"'.$tmpObject[0].'", "'.$tmpObject[1].'", "'.$tmpObject[2].'", "'.$tmpObject[3].'",
				"'.$tmpObject[4].'", 
				"'.$tmpObject[5].'", "'.$tmpObject[6].'","'.$tmpObject[7].'","'.$tmpObject[8].'",
				 "'.$tmpObject[9].'",
				"'.$tmpObject[10].'", "'.$tmpObject[11].'", "'.$tmpObject[12].'", "'.$tmpObject[13].'", "'.$tmpObject[14].'", 
				"'.$tmpObject[15].'", "'.$tmpObject[16].'", "'.$tmpObject[17].'", "'.$tmpObject[18].'", "'.$tmpObject[19].'", 
				"'.$tmpObject[20].'", "'.$tmpObject[21].'", "'.$tmpObject[22].'", "'.$tmpObject[23].'", "'.$tmpObject[24].'","'.$tmpObject[25].'",
				"'.$tmpObject[26].'", "'.$tmpObject[27].'", "'.$tmpObject[28].'", "'.$tmpObject[29].'", 
				"'.$tmpObject[30].'", "'.$tmpObject[31].'", "'.$tmpObject[32].'", "'.$tmpObject[33].'", "'.$tmpObject[34].'", 
				"'.$tmpObject[35].'", "'.$tmpObject[36].'", "'.$tmpObject[37].'", "'.$tmpObject[38].'")';
				
			$insert = $connect->query($sqli);
			};
			if($insert === FALSE) {
			    echo "Insert Error: " . $connect->error. "\n";
			}else{			
			    echo "Document inserted successfully. \n";
			}
			
			@fclose($handle);
			//@chmod('data_ga/ga/20141119/00/'.$file, 0666);
			//@rename('data_ga/ga/20141119/00/'.$file, 'data_ga/ga/20141119/00/'.$file.'.done');
		};
	};
	$debugTimeEnd = microtime(true); 
	echo "\n\n".'runtime: '.($debugTimeEnd-$debugTimeStart).' s';
	echo "\n";

?>