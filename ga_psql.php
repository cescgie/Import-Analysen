<?php
	
	ini_set('max_execution_time', 68000); 
	@set_time_limit(68000);

	$debugTimeStart = microtime(true); 

	//Conncet to pgsql
	$connect = pg_connect("host=localhost dbname=testdb user=postgres password=password");
	// Check connection
	if (!$connect) {
	    die("Connection failed: \n");
	}else{
		echo "Connection to database succesfully. \n";

		$sql =<<<EOF
		      CREATE TABLE IF NOT EXISTS ga (
			  ID SERIAL PRIMARY KEY,
			  VersionId int NOT NULL,	  
			  SequenceId bigint NOT NULL,		  
			  PlcNetworkId int NOT NULL,
			  PlcSubNetworkId int NOT NULL,
			  WebsiteId bigint NOT NULL,
			  PlacementId bigint NOT NULL,
			  PageId bigint NOT NULL,		  
			  CmgnNetworkId bigint NOT NULL,
			  CmgnSubNetworkId bigint NOT NULL,
			  CampaignId bigint NOT NULL,
			  MasterCampaignId bigint NOT NULL,
			  BannerId bigint NOT NULL,
			  BannerNumber bigint NOT NULL,
			  PaymentId int NOT NULL,
			  StateId smallint NOT NULL,
			  AreaCodeId smallint NOT NULL,
			  IpAddress TEXT  NOT NULL,
			  UserId  TEXT NOT NULL,
			  OsId int NOT NULL,
			  TagType int NOT NULL,
			  BrowserId int NOT NULL,
			  BrowserLanguage int NOT NULL,
			  TLDId smallint NOT NULL,
			  MediaTypeId int NOT NULL,
			  PlcContentTypeId int NOT NULL,
			  Reserved2 smallint NOT NULL,
			  DateEntered int NOT NULL,	
			  Hour int NOT NULL,
			  Minute int NOT NULL,	
			  Second int NOT NULL, 
			  AdServerIp int NOT NULL,
			  AdServerFarmId int NOT NULL,
			  DMAId int NOT NULL,
			  CountryId smallint NOT NULL,
			  ZipCodeId int NOT NULL,
			  CityId int NOT NULL,
			  IspId smallint NOT NULL,
			  CountTypeId int NOT NULL,
			  ConnectionTypeId int NOT NULL
		);
EOF;
		$ret = pg_query($connect, $sql);
	   if(!$ret){
	      echo pg_last_error($connect);
	   } else {
	      echo "Table created successfully\n";
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


	$handlefolder = opendir ('data_ga/test/');
	while ($file = readdir ($handlefolder)) {		
		if (substr($file, -4) == '.bin') {
			echo 'data_ga/test/'.$file."\n";
			$handle = fopen('data_ga/test/'.$file, 'rb');
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
			
			$sql = 'INSERT INTO ga ( VersionID, SequenceId, PlcNetworkId, PlcSubNetworkId, WebsiteId, PlacementId, PageId, CmgnNetworkId, CmgnSubNetworkId, CampaignId, MasterCampaignId, BannerId, BannerNumber, 
				PaymentId,StateId, AreaCodeId,IpAddress, UserId, OsId, TagType,BrowserId, BrowserLanguage, TLDId, MediaTypeId, PlcContentTypeId, Reserved2, DateEntered, Hour, Minute, Second, AdServerIp, AdServerFarmId, 
				DMAId, CountryId, ZipCodeId, CityId, IspId, CountTypeId, ConnectionTypeId) 
				VALUES ( '.$tmpObject[0].','.$tmpObject[1].','.$tmpObject[2].','.$tmpObject[3].','.$tmpObject[4].',
					'.$tmpObject[5].','.$tmpObject[6].','.$tmpObject[7].','.$tmpObject[8].','.$tmpObject[9].',
					'.$tmpObject[10].','.$tmpObject[11].','.$tmpObject[12].','.$tmpObject[13].','.$tmpObject[14].',
					'.$tmpObject[15].',16,17,'.$tmpObject[18].','.$tmpObject[19].',
					'.$tmpObject[20].','.$tmpObject[21].','.$tmpObject[22].','.$tmpObject[23].','.$tmpObject[24].',
					'.$tmpObject[25].','.$tmpObject[26].','.$tmpObject[27].','.$tmpObject[28].','.$tmpObject[29].',
					'.$tmpObject[30].','.$tmpObject[31].','.$tmpObject[32].','.$tmpObject[33].','.$tmpObject[34].',
					'.$tmpObject[35].','.$tmpObject[36].','.$tmpObject[37].','.$tmpObject[38].')';
		   
		   	$ret = pg_query($connect, $sql);
			   
			};
			if(!$ret){
			      echo pg_last_error($connect);
			   } else {
			      echo "Records created successfully.\n";
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