<?php
	
	ini_set('max_execution_time', 68000); 
	@set_time_limit(68000);

	/*
		CREATE TABLE IF NOT EXISTS `kv` (
		  `id` bigint(20) NOT NULL auto_increment,
		  `VersionId` tinyint(4) NOT NULL,
		  `RecordSize` smallint(4) NOT NULL,		  
		  `SequenceId` bigint(11) NOT NULL,		  
		  `PlcNetworkId` mediumint(6) NOT NULL,
		  `PlcSubNetworkId` smallint(4) NOT NULL,
		  `WebsiteId` bigint(11) NOT NULL,
		  `PlacementId` bigint(11) NOT NULL,		  
		  `CmgnNetworkId` mediumint(6) NOT NULL,
		  `CmgnSubNetworkId` smallint(4) NOT NULL,
		  `CampaignId` bigint(11) NOT NULL,
		  `ExtensionType` smallint(4) NOT NULL,
		  `PhraseId` bigint(11) NOT NULL,
		  `NoKeywordEntries` smallint(4) NOT NULL,		 
		  PRIMARY KEY  (`id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1
	
	
	*/
	
	
	$debugTimeStart = microtime(true); 
		
	//Conncet to MySQL
	$connect  = mysqli_connect('localhost', 'root', 'password', 'myDB');
	// Check connection
	if (!$connect) {
	    die("Connection failed: " . mysqli_connect_error()."\n");
	}else{
		echo "Connection to database succesfully. \n";

		$sql = "CREATE TABLE IF NOT EXISTS kv (
			  id bigint(20) NOT NULL auto_increment,
			  VersionId tinyint(4) NOT NULL,
			  RecordSize smallint(6) NOT NULL,	  
			  SequenceId bigint(11) NOT NULL,		  
			  PlcNetworkId smallint(6) NOT NULL,
			  PlcSubNetworkId tinyint(4) NOT NULL,
			  WebsiteId int(4) NOT NULL,
			  PlacementId int(4) NOT NULL,
			  CmgnNetworkId smallint(6) NOT NULL,
			  CmgnSubNetworkId tinyint(4) NOT NULL,
			  CampaignId int(4) NOT NULL,
			  ExtensionType tinyint(4) NOT NULL,
			  PhraseId int(4) NOT NULL,
			  NoKeywordEntries smallint(4) NOT NULL,
			  KeyId1 int(4) NOT NULL,
			  ExpressionId1 int(4) NOT NULL,
			  ValueString1 char(49) NOT NULL,
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
						'char(49)'=> array('code'=>'a49', 'size'=>''),
						'char(50)'=> array('code'=>'a50', 'size'=>''),
						'char(150)'=> array('code'=>'a150', 'size'=>''),
						'char(200)'=> array('code'=>'a200', 'size'=>''),
						'char(1000)'=> array('code'=>'a1000', 'size'=>''),
						'varchar(1000)'=> array('code'=>'a999', 'size'=>''),
				);
	
	$codeKV2 = array(
				array('name'=>'VersionId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>'0'),
				array('name'=>'RecordSize', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'SequenceId', 'type'=>'unsignedint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'PlcNetworkId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'PlcSubNetworkId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'WebsiteId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''), // 5
				array('name'=>'PlacementId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CmgnNetworkId', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CmgnSubNetworkId', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'CampaignId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'ExtensionType', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''), //10
				array('name'=>'PhraseId', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'NoKeywordEntries', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''), //12
				
			);
	
	$codeKV2V2 = array(
				array('name'=>'KeyId1', 'type'=>'int', 'size'=>'', 'code'=>''),
				array('name'=>'ExpressionId1', 'type'=>'int', 'size'=>'', 'code'=>''),
				array('name'=>'ValueString1', 'type'=>'char(49)', 'size'=>'', 'code'=>'')	
			);
	

	$code 	= $codeKV2;
	$codeV2 = $codeKV2V2;
	
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
	
	foreach($codeV2 AS $k=>$v) {
		$codeV2[$k]['size'] = $dataTypesSize[$codeV2[$k]['type']]['size'];
		$codeV2[$k]['code'] = $dataTypesSize[$codeV2[$k]['type']]['code'];	
	};
	

	/*
		size/length row
	*/
	$rowLength 		= count($code);
	$rowLengthV2 	= count($codeKV2V2);
	$rowSize = 0;
	foreach($code AS $k=>$v) {		
		$rowSize += $code[$k]['size'];	
	};
	

	$handlefolder = opendir ('data_kv');
	while ($file = readdir ($handlefolder)) {		
		if (substr($file, -4) == '.bin') {
			echo 'data_kv/'.$file."\n";
			$handle = fopen('data_kv/'.$file, 'rb');
			
			while ($contents = fread($handle, $rowSize)) {
				$tmpObject = array();
				$morekeyvalue 	= 0;
				$recordsize 	= 0;
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
						$data = substr(bcsub($data*-1, 4294967296), 1);			
					};
					if ($code[$i]['name'] == 'NoKeywordEntries') {
						$morekeyvalue = $data;
					};
					if ($code[$i]['name'] == 'RecordSize') {
						$recordsize = $data;
					};
					$tmpObject[$i] = $data;	
				};			
				if ($recordsize > $rowSize) {			
					$record = $recordsize-$rowSize;			
					$tmpObject[16] = array();
					$tmpObject[17] = array();
					$tmpObject[18] = array();		
					$recordPointer = 0;
					$contents = fread($handle, $record);				
					for ($i=0; $i<$morekeyvalue; $i++) {
						for ($iV2=0; $iV2<$rowLengthV2; $iV2++) {					
							$codeCode = $codeV2[$iV2]['code'];
							$codeSize = $codeV2[$iV2]['size']; 
							if ($iV2 == 2) {											
								if ($codeSize>$record-$recordPointer) {
									$codeCode = 'a'.($record-$recordPointer);
									$codeSize = $record-$recordPointer;
								};						
							};					
							$data = unpack($codeCode, substr($contents, $recordPointer, $codeSize));	
							$recordPointer += $codeSize;
							$data = $data[1];					
							if ($codeV2[$iV2]['name'] == 'KeyId1') {
								array_push($tmpObject[16], $data);
							} elseif ($codeV2[$iV2]['name'] == 'ExpressionId1') {
								array_push($tmpObject[17], $data);
							} elseif ($codeV2[$iV2]['name'] == 'ValueString1') {
								array_push($tmpObject[18], $data);
							};
						};
					};
				};				
				$sqli = 'INSERT INTO kv 
				(VersionID, RecordSize, SequenceId, PlcNetworkId, 
				PlcSubNetworkId,WebsiteId, PlacementId, CmgnNetworkId, 
				CmgnSubNetworkId, CampaignId, ExtensionType, PhraseId, 
				NoKeywordEntries, KeyId1, ExpressionId1, ValueString1)  
				VALUES ( 
				"'.$tmpObject[0].'", "'.$tmpObject[1].'", "'.$tmpObject[2].'", "'.$tmpObject[3].'", 
				"'.$tmpObject[4].'", "'.$tmpObject[5].'", "'.$tmpObject[6].'", "'.$tmpObject[7].'", 
				"'.$tmpObject[8].'", "'.$tmpObject[9].'", "'.$tmpObject[10].'", "'.$tmpObject[11].'", 
				"'.$tmpObject[12].'", "'.$tmpObject[13].'", "'.$tmpObject[14].'", "'.$tmpObject[15].'")';
				
			//echo $tmpObject[39];
			$insert = $connect->query($sqli);
			};
			if($insert === FALSE) {
			    echo "Insert Error: " . $connect->error. "\n";
			}else{			
			    echo "Document inserted successfully. \n";
			}
			@fclose($handle);
			//@chmod('data/'.$file, 0666);
			//@rename('data/'.$file, 'data/'.$file.'.done');
		};
	};
			
	$debugTimeEnd = microtime(true); 
	
	echo "\n\n".'runtime: '.($debugTimeEnd-$debugTimeStart).' s';
    echo "\n";

?>