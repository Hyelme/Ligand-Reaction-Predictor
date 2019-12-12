@echo off
java -jar C:\\APM_Setup\\htdocs\\ligand_reactor\\P_Action.jar

java -jar C:\\APM_Setup\\htdocs\\ligand_reactor\\Action_change.jar

"C:\python36\python.exe" "C:\APM_Setup\htdocs\ligand_reactor\data\descriptor\dpa_predict.py"