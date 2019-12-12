<meta charset="UTF-8">
<?
	shell_exec('SCHTASKS /F /Create /TN predict /TR "predict_CA.bat" /SC DAILY /RU INTERACTIVE');
	shell_exec('SCHTASKS /RUN /TN "predict"');
	shell_exec('SCHTASKS /DELETE /TN "predict" /F');
	sleep(20);
			
	$is_file_exist = file_exists('data/predict/CA_plan.txt');
	if($is_file_exist) {

		$rf = fopen("data/predict/CA_plan.txt", "r") or die("예측 결과 파일을 열 수 없습니다!");
		// 파일 내용 출력

		while(!feof($rf)) {
			$b = fgets($rf);
			if(feof($rf) != " "){
				$b = str_replace("']", "", $b);
				echo substr($b,2)."|";
			}
		}
		// 파일 닫기
		fclose($rf);

		unlink('./data/smiles/A_Descript_data.txt');
		unlink('./data/descriptor/A_Descript.txt');
		unlink('./data/predict/CA_plan.txt');

	}else {
		echo("Failed to create file.<br>");
		unlink('./data/smiles/A_Descript_data.txt');
		unlink('./data/descriptor/A_Descript.txt');
		unlink('./data/predict/CA_plan.txt');
	}
?>
