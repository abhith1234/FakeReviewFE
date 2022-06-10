

#from keras.models import load_model
import pymysql as mdb

import os
#model = load_model('my_model.h5')
import time
import pickle
print('k')
model=pickle.load(open('model.pkl','rb'))
print('k')
with open('tfidf.pickle', 'rb') as fid:
    countV = pickle.load(fid)




def clear():            
            con = mdb.connect('localhost', \
                              'root', \
                              '', \
                              'tms' );
            cur = con.cursor()
            cur.execute("TRUNCATE TABLE `review1`")
                     
            con.commit()
def push1(a,b):            
            con = mdb.connect('localhost', \
                              'root', \
                              '', \
                              'tms' );
            cur = con.cursor()
            
            cur.execute("""INSERT INTO review1(post,res) \
                       VALUES(%s,%s)""", (a,b))            
            con.commit()
def upd(ids):
    
    mydb = mdb.connect(
      host="127.0.0.1",
      user="root",
      passwd="",
      database="tms"
    )

    mycursor = mydb.cursor()

   

    sql = "UPDATE review SET flg = %s WHERE id = %s"
    val = ('', ids)

    mycursor.execute(sql, val)

    mydb.commit()
    mydb.close()
def updu(res,ids):
    
    mydb = mdb.connect(
      host="127.0.0.1",
      user="root",
      passwd="",
      database="tms"
    )

    mycursor = mydb.cursor()

   

    sql = "UPDATE review2 SET res = %s WHERE id = %s"
    val = (res,ids)

    mycursor.execute(sql, val)

    mydb.commit()
    mydb.close()
while True:
  
##    mydb = mdb.connect(
##              host="127.0.0.1",
##              user="root",
##              passwd="",
##              database="tms"
##            )
##
##    mycursor = mydb.cursor()
##
##    sql = "SELECT fl,flg,id FROM review"
##
##
##    mycursor.execute(sql)
##    fine=0
##    myresult = mycursor.fetchall()
##    mydb.close()
##    for x in myresult:            
##            fl=str(x[0])
##            flg=str(x[1])
##            ids=str(x[2])
##    print(fl,flg,ids)
##
##    if flg=='':
##        print('process')
##        
##        file1 = open('upload/'+fl, 'r')
##        Lines = file1.readlines()
##         
##        count = 0
##        clear()
##        # Strips the newline character
##        for line in Lines:
##            l1=line.strip()
##            print(l1)
##            print('k')
##            a=[]
##            comm=str(l1)
##            a.append(comm)
##            ne=countV.transform(a)
##            pred=model.predict(ne)
##            res=str(pred[0])
##            print(res)
##            push1(l1,res)
            #upd(ids)
    mydb = mdb.connect(
          host="127.0.0.1",
          user="root",
          passwd="",
          database="tms"
        )

    mycursor = mydb.cursor()

    sql = "SELECT post,res,id FROM review2"


    mycursor.execute(sql)
   
    myresult = mycursor.fetchall()
    mydb.close()
    for x in myresult:            
        comm=str(x[0])
        chu=str(x[1])
        ids=str(x[2])
        
        if(chu==' '):
            
            a=[]
            comm=str(comm)
            a.append(comm)
            ne=countV.transform(a)
            print(ne.shape)
            pred=model.predict(ne)
            print(pred)
            res=str(pred[0])
            updu(res,ids)
        
