<?php
	
	ini_set('max_execution_time', 68000); 
	@set_time_limit(68000);

	$debugTimeStart = microtime(true); 

	// Connect to localhost on the default port.
	//$connect = new Mongo('mongodb://127.0.0.1:27017/db_ga');
	$connect = new MongoClient('mongodb://localhost:27017/db_ga');

	// Check connection
	if (!$connect) {
	    die("Connection failed: " .$connect->connect_error. "\n");
	}else{
		echo "Connected successfully. \n";

		//Connect to Database. It will be automatically created if not exists
		$db = $connect->db_ga;
		//Check
		if (!$db) {
	        die("Database selection failed :".mysql_error()."\n");   
	    }else{
	    	echo "Database selected. \n";

	    	//Create Collection
			$collection = $db->createCollection("ga_3");
			//Check
			if (!$collection) {
		        die("Collection creation failed :".mysql_error()."\n");   
		    }else{
		    	echo "Collection created. \n";
		    	//Select collection
				$collection = $db->ga_3;
				echo "Collection selected. \n";
		   	}
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
				//MongoDB
				$ids++;
				$document = array( 
								  "_id" => $ids,
 							      "VersionId" => $tmpObject[0], 
							      "SequenceId" =>$tmpObject[1],
							      "PlcNetworkId" => $tmpObject[2],
							      "PlcSubNetworkId" => $tmpObject[3],
							      "WebsiteId" => $tmpObject[4],
							      "PlacementId" => $tmpObject[5],
							      "PageId" => $tmpObject[6],
							      "CmgnNetworkId" => $tmpObject[7],
							      "CmgnSubNetworkId" => $tmpObject[8],
							      "CampaignId" => $tmpObject[9],
							      "MasterCampaignId" => $tmpObject[10],
							      "BannerId" => $tmpObject[11],
							      "BannerNumber" => $tmpObject[12],
							      "PaymentId" => $tmpObject[13],
							      "StateId" => $tmpObject[14],
							      "AreaCodeId" => $tmpObject[15],
							      "IpAddress" => $tmpObject[16],
							      "UserId" => $tmpObject[17],
							      "OsId" => $tmpObject[18],
							      "TagType" => $tmpObject[19],
							      "BrowserId" => $tmpObject[20],
							      "BrowserLanguage" => $tmpObject[21],
							      "TLDId" => $tmpObject[22],
							      "MediaTypeId" => $tmpObject[23],
							      "PlcContentTypeId" => $tmpObject[24],
							      "Reserved2" => $tmpObject[25],
							      "DateEntered" => $tmpObject[26],
							      "Hour" => $tmpObject[27],
							      "Minute" => $tmpObject[28],
							      "Second" => $tmpObject[29],
							      "AdServerIp" => $tmpObject[30],
							      "AdServerFarmId" => $tmpObject[31],
							      "DMAId" => $tmpObject[32],
							      "CountryId" => $tmpObject[33],
							      "ZipCodeId" => $tmpObject[34],
							      "CityId" => $tmpObject[35],
							      "IspId" => $tmpObject[36],
							      "CountTypeId" => $tmpObject[37],
							      "ConnectionTypeId" => $tmpObject[38]
							   );
			
			$collection->insert($document);	
			};
			
			echo "Document inserted successfully. \n";
			@fclose($handle);
			//@chmod('data_ga/ga/20141119/00/'.$file, 0666);
			//@rename('data_ga/ga/20141119/00/'.$file, 'data_ga/ga/20141119/00/'.$file.'.done');
		};
	};
	$debugTimeEnd = microtime(true); 
	echo "\n\n".'runtime: '.($debugTimeEnd-$debugTimeStart).' s';
	echo "\n";

?>