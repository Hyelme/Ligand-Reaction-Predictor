<meta charset="UTF-8">
<?
	shell_exec('SCHTASKS /F /Create /TN predict /TR "predict_CPA.bat" /SC DAILY /RU INTERACTIVE');
	shell_exec('SCHTASKS /RUN /TN "predict"');
	shell_exec('SCHTASKS /DELETE /TN "predict" /F');
	sleep(20);
			
	$is_file_exist = file_exists('data/predict/CPA_Plan.txt');
	if($is_file_exist) {

		$rf = fopen("data/predict/CPA_Plan.txt", "r") or die("예측 결과 파일을 열 수 없습니다!");
		// 파일 내용 출력

		while(!feof($rf)) {
			$b = fgets($rf);
			if(feof($rf) != " "){
				$b = str_replace("']", "", $b);
				echo substr($b,2)."|";
				//echo nl2br("\n");
			}
		}
		// 파일 닫기
		fclose($rf);

		unlink('./data/smiles/P_Action_descript.txt');
		unlink('./data/descriptor/P_Action_Descript.txt');
		unlink('./data/predict/CPA_Plan.txt');

	}else {
		echo("파일이 생성에 실패 했습니다.<br>");
		unlink('./data/smiles/P_Action_descript.txt');
		unlink('./data/descriptor/P_Action_Descript.txt');
		unlink('./data/predict/CPA_Plan.txt');

	}

?>
