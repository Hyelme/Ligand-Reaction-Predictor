import pandas as pd
import numpy as np
import  tensorflow as tf
from sklearn import preprocessing
from sklearn.preprocessing import LabelEncoder
from keras.utils import np_utils
from sklearn.metrics import classification_report, confusion_matrix
from keras.layers.core import Reshape
import csv

#A_Plan_Boruta_Data_comma_4
csv1 = pd.read_csv('C:\APM_Setup\htdocs\ligand_reactor\data\descriptor\P_Family_Descript.txt')  #test data
csv2 = pd.read_csv('C:\APM_Setup\htdocs\ligand_reactor\data\descriptor\P_Family_Label.txt')  #label data
# csv 파일 열기

csv1 = csv1.replace('na',0)

y = csv2.select_dtypes(include=['object'])

# Bool = True, False를 나타내야 함.
#  객체를 포함하는 카테고리형 데이터로 csv 데이터를 제한한다.
# print(y.shape)
# 카테고리는 1개에 150개의 객체가 있음을 알려준다.

le = LabelEncoder()
#  문자형태의 데이터로 구성된 피쳐를 수치화한다.

Y = y.apply(le.fit_transform)

# 인코딩된 라벨은 0,1,2로 나타낸다
#  apply()를 사용하여 모든 열에 변형을 적용한다.

enc = preprocessing.OneHotEncoder(sparse='auto')

# oneHotEncoder 숫자로 표현된 범주형 데이터를 인코딩한다.
# OneHotEncoder 객체를 생성한다.

enc.fit(Y)

Y = enc.transform(Y).toarray()

#print(Y)
X = np.array(csv1.values)[:,2:981].astype(float)

x2=np.array(csv1.values)[:,1:2]




#cnn_aplan_model.h5
new_model = tf.keras.models.load_model('C:\APM_Setup\htdocs\ligand_reactor\data\descriptor\P_family_dmlp.h5')
#X[y,x,z] 형태
#print(X[0,:,:])
#print(X[1,:,0])
#print(np.expand_dims(X[1,:,:],axis=0).shape)   #(996,1,1) (x,y,z)

#y_pred =[]

f=open('C:\APM_Setup\htdocs\ligand_reactor\data\predict\DPF_plan.txt', mode='wt')
for i in range(0, len(X)):
    x = np.expand_dims(X[i:i+1],axis=1)

    d_pred = new_model.predict(x)
    l_pred = new_model.predict_proba(x)
    #y_pred.append(d_pred)
    Prob = new_model.predict_proba(x)

    f.write(format(csv2['Label'].unique()[new_model.predict_classes(np.array(x))]).replace('lhr','nhr'))
    f.writelines('\n')


#y_pred_class = np.argmax(y_pred, axis=1)
#print(y_pred_class)
#  tf.argmax(X, a) : X 배열에서 가장 큰 값을 ‘열(1)’ 기준 몇번째인지 index를 반환,  axis: 인덱스는 평평한 배열로, 그렇지 않으면 지정된 축을 따라 배치된다.
#print(test_set)