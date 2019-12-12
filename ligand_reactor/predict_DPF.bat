@echo off
java -jar C:\\APM_Setup\\htdocs\\ligand_reactor\\P_Family.jar

java -jar C:\\APM_Setup\\htdocs\\ligand_reactor\\Family_change.jar

"C:\python36\python.exe" "C:\APM_Setup\htdocs\ligand_reactor\data\descriptor\dpf_predict.py"