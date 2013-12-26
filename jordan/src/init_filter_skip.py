# encoding=utf-8
'''
Created on 2012-9-28

@author: cooler
'''
import subprocess, threading , time, traceback
from datetime import datetime, timedelta
import sys
reload(sys) 
sys.setdefaultencoding('utf8')
sys.path.append('/usr/lib/python2.7/py')
from hive_service import ThriftHive
from hive_service.ttypes import HiveServerException
from thrift import Thrift
from thrift.transport import TSocket
from thrift.transport import TTransport
from thrift.protocol import TBinaryProtocol
from datetime import datetime
import socket
import urllib2
socket.setdefaulttimeout(10)


hive_server_ip='120.72.37.42'
hive_server_port=10000
hive_sql='select * from href limit 100'
# hive_sql="select * from href limit 100 "

# Try and reduce the stack size.
try:
    threading.stack_size(409600)
except:
    pass


class Beat(threading.Thread):
    def __init__(self ):
        threading.Thread.__init__(self)

    def run(self):
        while True:
            try:
                self.retry_error_task(3000)
            except Exception, e:
                pass
            break 
            # time.sleep(10)
                
    def retry_error_task(self,num):
        global taskList ,count, mutex 
        count = 0
        if len(taskList)>0:
            threads = []
            # 创建一个锁
            mutex = threading.Lock()
            # 先创建线程对象
            for x in xrange(0, num):
                threads.append(threading.Thread(target=retry_task, args=()))
            # 启动所有线程
            for t in threads:
                t.start()
            # 主线程中等待所有子线程退出
            for t in threads:
                t.join()  
        else :
            print "there is no taskList"   

def retry_task():
    global taskList, count, mutex 
    while count<len(taskList):
        mutex.acquire()
        task = taskList[count]
        count = count + 1
        # 释放锁
        mutex.release()
        threadname = threading.currentThread().getName()
        try:
            # print getUrlContent(task[0])
            output_str =  str(task[0]) + "\t" + str(task[1]) + "\t" + str(getUrlContent(task[0])) + "\n"
            outputToFile(output_str)
            if count%100 == 0:
                print count

        except:
            print "---------"
            # print task

def getUrlListFromFile():
    f = open('cooler.skip','r')
    urlList = []
    for line in f.readlines():
        urlList.append(line.replace("\n","").split("\001"))
    return urlList

def hiveExe(sql):
    urlList=[]
    try:
        transport = TSocket.TSocket(hive_server_ip, hive_server_port)
        transport = TTransport.TBufferedTransport(transport)
        protocol = TBinaryProtocol.TBinaryProtocol(transport)
        client = ThriftHive.Client(protocol)
        transport.open()

        print "begin time is : " + str(datetime.now())
        client.execute(sql)
        for val in client.fetchAll():
            webURL = val.split("\t")
            urlList.append(webURL);
        print "end time is : " + str(datetime.now())
        transport.close()
    except Thrift.TException, tx:
        print '%s' % (tx.message)
    return urlList

def outputToFile(output_str):
    f=open('skiptable.log','a')
    f.write(output_str)
    f.close()

def getUrlContent(webURL):
    try:
        flag = 0
        for i in range(3):
            res = urllib2.urlopen(webURL)
            content = res.read()
            flag = len(content)/1024
            res.close()
        return flag
    except :
        return flag




if __name__ == "__main__":
    # monitor = Monitor(db_session())
    global taskList ,count, mutex
    # taskList = hiveExe(hive_sql)
    taskList = getUrlListFromFile()
    print len(taskList);
    beat = Beat()
    beat.setName('retry_beat')
    beat.setDaemon(True)
    beat.run()
