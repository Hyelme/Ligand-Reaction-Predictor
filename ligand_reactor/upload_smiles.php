<meta charset="UTF-8">
<?			
	$is_file_exist = file_exists('data/smiles/smiles.txt');
	if($is_file_exist) {

		$sf = fopen("data/smiles/smiles.txt", "r") or die("smiles 파일을 열 수 없습니다!");

		while(feof($sf) != " "){
			$a = fgets($sf);
			if(feof($sf) != " ") {
				if(strlen($a) <= 30) {
					echo $a."|";
				}else if(strlen($a) > 30) {
					echo substr($a,0,30)."..."."|";
				}
			}
		}

		fclose($sf);
	}else {
		echo("파일이 생성에 실패 했습니다.<br>");
	}
?>