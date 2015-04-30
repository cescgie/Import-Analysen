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

		$sql = "CREATE TABLE IF NOT EXISTS cf (
			  id bigint(20) NOT NULL auto_increment,
			  VersionId tinyint(4) NOT NULL,	  
			  SequenceId bigint(11) NOT NULL,		  
			  PlcNetworkId smallint(6) NOT NULL,
			  PlcSubNetworkId tinyint(4) NOT NULL,
			  WebsiteId int(4) NOT NULL,
			  PlacementId int(4) NOT NULL,
			  PageId int(4) NOT NULL,
			  CmgnNetworkId smallint(6) NOT NULL,
			  CmgnSubNetworkId tinyint(4) NOT NULL,
			  CampaignId int(4) NOT NULL,
			  MasterCampaignId int(4) NOT NULL,
			  BannerId smallint(4) NOT NULL,
			  BannerNumber int(4) NOT NULL,
			  PaymentId int(4) NOT NULL,
			  StateId smallint(4) NOT NULL,
			  CountTypeId smallint(4) NOT NULL,
			  IpAddress BINARY(16) NOT NULL,
			  UserId char(16) NOT NULL,
			  OsId tinyint(4) NOT NULL,
			  TagType tinyint(4) NOT NULL,
			  BrowserId smallint(4) NOT NULL,
			  BrowserLanguage tinyint(4) NOT NULL,
			  IpRangeId int(4) NOT NULL,
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
			  ConnectionTypeId smallint(4) NOT NULL,
			  RecordSize smallint(4) NOT NULL,
			  sizeStringBuffer smallint(4) NOT NULL,
			  Referer varchar(1024) NOT NULL,
			  QueryString varchar(1024) NOT NULL,
			  LinkUrl varchar(1024) NOT NULL,
			  UserAgent varchar(924) NOT NULL,
			  PRIMARY KEY  (id)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ";

		if($connect->query($sql) === FALSE) {
		    echo "Error creating table: " . $connect->error. "\n";
		}else{			
		    echo "Table created successfully. \n";
		}
	}
	/*		
		## sizes of datatypes and its value in pack
		# tinyint : 1B : c
		# smallint : 2B : s
		# int : 4B : l
		# smallint big endian : s>
		# int big endian : l>
		# unsignedint big endian : L>
		# unsignedint : 4B : L
		# char(16) : 16B : A16
	
	*/
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
						'varchar(1024)'=> array('code'=>'a1023', 'size'=>''),
						'varchar(924)'=> array('code'=>'a923', 'size'=>''),
						'varchar(101)'=> array('code'=>'a100', 'size'=>''),
						'varchar(100)'=> array('code'=>'a99', 'size'=>''),
						'varchar(297)'=> array('code'=>'a296', 'size'=>'')						
				);
		
			
		
	$codeCF = array(
				array('name'=>'VersionId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>'0'),
				array('name'=>'SequenceId', 'type'=>'unsignedint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),				
				array('name'=>'PlcNetworkId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'PlcSubNetworkId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'WebsiteId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'PlacementId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''), //5
				array('name'=>'PageId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CmgnNetworkId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CmgnSubNetworkId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CampaignId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'MasterCampaignId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''), // 10
				array('name'=>'BannerId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'BannerNumber', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),				
				array('name'=>'PaymentId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'StateId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CountTypeId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''), //15
				array('name'=>'IpAddress', 'type'=>'unsignedint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'UserId', 'type'=>'char(16)', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'OsId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'BrowserId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'BrowserLanguage', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''), // 20
				array('name'=>'TagType', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'IpRangeId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'DateEntered', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'Hour', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'Minute', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''), //25
				array('name'=>'Second', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'AdServerIp', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'AdServerFarmId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'DMAId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CountryId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''), // 30
				array('name'=>'ZipCodeId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CityId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'IspId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CountTypeId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'RecordSize', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''), // 35
				array('name'=>'sizeStringBuffer', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
		//		array('name'=>'Referer', 'type'=>'varchar(297)', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
		//		array('name'=>'QueryString', 'type'=>'varchar(297)', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
		//		array('name'=>'LinkUrl', 'type'=>'varchar(297)', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
		//		array('name'=>'UserAgent', 'type'=>'varchar(297)', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),// 40		
				
			);
	$code = $codeCF;
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


	$handlefolder = opendir ('data_cf');
	while ($file = readdir ($handlefolder)) {		
		if (substr($file, -4) == '.bin') {
			echo 'data_cf/'.$file."\n";
			$handle = fopen('data_cf/'.$file, 'rb');
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
					
					if ($i == 36) {
						$contents = fread($handle, $tmpObject[36]);
						$data = unpack('a'.$tmpObject[36], $contents);						
						$data = explode("\0", $data[1]);
						$tmpObject[37] = $data[0];			
						$tmpObject[38] = $data[1];			
						$tmpObject[39] = $data[2];			
						$tmpObject[40] = $data[3];			
						
					};
					
				};							

		    $sqli = 'INSERT INTO cf 
				(VersionID, SequenceId, PlcNetworkId, PlcSubNetworkId,
				WebsiteId, PlacementId, PageId, CmgnNetworkId, 
				CmgnSubNetworkId, CampaignId, MasterCampaignId, BannerId, 
				BannerNumber, PaymentId, StateId, CountTypeId, 
				IpAddress, UserId, OsId, BrowserId, 
				BrowserLanguage, TagType, IpRangeId, DateEntered, 
				Hour, Minute, Second, AdServerIp, 
				AdServerFarmId, DMAId, CountryId, ZipCodeId, 
				CityId, IspId, ConnectionTypeId, RecordSize, 
				sizeStringBuffer, Referer, QueryString, LinkUrl, 
				UserAgent)  
				VALUES ( 
				"'.$tmpObject[0].'", "'.$tmpObject[1].'", "'.$tmpObject[2].'", "'.$tmpObject[3].'", 
				"'.$tmpObject[4].'", "'.$tmpObject[5].'", "'.$tmpObject[6].'", "'.$tmpObject[7].'", 
				"'.$tmpObject[8].'", "'.$tmpObject[9].'", "'.$tmpObject[10].'", "'.$tmpObject[11].'", 
				"'.$tmpObject[12].'", "'.$tmpObject[13].'", "'.$tmpObject[14].'", "'.$tmpObject[15].'", 
				"'.$tmpObject[16].'", "'.$tmpObject[17].'", "'.$tmpObject[18].'", "'.$tmpObject[19].'", 
				"'.$tmpObject[20].'", "'.$tmpObject[21].'", "'.$tmpObject[22].'", "'.$tmpObject[23].'", 
				"'.$tmpObject[24].'", "'.$tmpObject[25].'", "'.$tmpObject[26].'", "'.$tmpObject[27].'", 
				"'.$tmpObject[28].'", "'.$tmpObject[29].'", "'.$tmpObject[30].'", "'.$tmpObject[31].'", 
				"'.$tmpObject[32].'", "'.$tmpObject[33].'", "'.$tmpObject[34].'", "'.$tmpObject[35].'", 
				"'.$tmpObject[36].'", "'.$tmpObject[37].'", "'.$tmpObject[38].'", "'.$tmpObject[39].'", 
				"'.$tmpObject[40].'")';
				
			//echo $tmpObject[39];
			$insert = $connect->query($sqli);
			};
			if($insert === FALSE) {
			    echo "Insert Error: " . $connect->error. "\n";
			}else{			
			    echo "Document inserted successfully. \n";
			}
			@fclose($handle);
			//@chmod('data/cf/'.$file, 0666);
			//@rename('data/cf/'.$file, 'data/cf/'.$file.'.done');
		};
	};
	$debugTimeEnd = microtime(true); 
	echo "\n\n".'runtime: '.($debugTimeEnd-$debugTimeStart).' s';
	echo "\n";
?>