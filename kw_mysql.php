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

		$sql = "CREATE TABLE IF NOT EXISTS kw (
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
			  ExtensionType tinyint(4) NOT NULL,
			  TimeStamp int(4) NOT NULL,
			  KeywordTextLength smallint(4) NOT NULL,
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
						'char(40)'=> array('code'=>'a40', 'size'=>''),
						'char(50)'=> array('code'=>'a50', 'size'=>''),
						'char(150)'=> array('code'=>'a150', 'size'=>''),
						'char(200)'=> array('code'=>'a200', 'size'=>''),
						'char(1000)'=> array('code'=>'a1000', 'size'=>''),
						'varchar(1000)'=> array('code'=>'a999', 'size'=>''),
				);
		
	$codeKW = array(
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
				array('name'=>'ExtensionType', 'type'=>'tinyint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'TimeStamp', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordId1', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordId2', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordId3', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordId4', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordId5', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordId6', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordId7', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordId8', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordId9', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordId10', 'type'=>'int', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordText', 'type'=>'char(40)', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				array('name'=>'KeywordTextLength', 'type'=>'smallint', 'size'=>'', 'code'=>'', 'accumulatedPointer'=>''),
				
			);

	$code = $codeKW;
	
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


	$handlefolder = opendir ('data_kw');
	while ($file = readdir ($handlefolder)) {		
		if (substr($file, -4) == '.bin') {
			echo 'data_kw/'.$file."\n";
			$handle = fopen('data_kw/'.$file, 'rb');		
			$k=0;
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
				$sqli = 'INSERT INTO kw 
				(VersionID, SequenceId, PlcNetworkId, 
				PlcSubNetworkId,WebsiteId, PlacementId, PageId,
				CmgnNetworkId, CmgnSubNetworkId, CampaignId, 
				MasterCampaignId, ExtensionType, TimeStamp, 
				KeywordTextLength)  
				VALUES ( 
				"'.$tmpObject[0].'", "'.$tmpObject[1].'", "'.$tmpObject[2].'", "'.$tmpObject[3].'", 
				"'.$tmpObject[4].'", "'.$tmpObject[5].'", "'.$tmpObject[6].'", "'.$tmpObject[7].'", 
				"'.$tmpObject[8].'", "'.$tmpObject[9].'", "'.$tmpObject[10].'", "'.$tmpObject[11].'", 
				"'.$tmpObject[12].'", "'.$tmpObject[13].'")';
				
			//echo $tmpObject[39];
			$insert = $connect->query($sqli);
			};
			if($insert === FALSE) {
			    echo "Insert Error: " . $connect->error. "\n";
			}else{			
			    echo "Document inserted successfully. \n";
			}
			@fclose($handle);
			//@chmod('data/kw/'.$file, 0666);
			//@rename('data/kw/'.$file, 'data/kw/'.$file.'.done');
		};
	};
	$debugTimeEnd = microtime(true); 
	
	echo "\n\n".'runtime: '.($debugTimeEnd-$debugTimeStart).' s';
	echo "\n";

?>