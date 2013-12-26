#-*- coding:utf-8 -*-
#!/usr/bin/python
import sys
#sys.path.append('/home/zhoujie/Downloads/hive-0.7.0-cdh3u0/lib/py')
sys.path.append('/usr/lib/python2.7/py')
from hive_service import ThriftHive
from hive_service.ttypes import HiveServerException
from thrift import Thrift
from thrift.transport import TSocket
from thrift.transport import TTransport
from thrift.protocol import TBinaryProtocol
from datetime import datetime
from urllib2 import urlopen


hive_server_ip='120.72.37.42'
hive_server_port=10000
#hive_sql='select count(*) from ssp_factbids'
hive_sql="select * from href limit 10 "


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
    f=open('hreftable.log','a')
    f.write(output_str)
    f.close()

def getUrlContent(webURL):
    try:
        flag = 0
        for i in range(3):
            res = urlopen(webURL)
            content = res.read()
            flag = len(content)/1024
        return flag
    except :
        return flag

if __name__ == '__main__':
    global urlList
    urlList = hiveExe(hive_sql)
    print urlList
    