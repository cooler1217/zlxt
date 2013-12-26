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


hive_server_ip='120.72.37.42'
hive_server_port=10000
#hive_sql='select count(*) from ssp_factbids'
hive_sql="select distinct bar from pokes  "


def hiveExe(sql):
    try:
        transport = TSocket.TSocket(hive_server_ip, hive_server_port)
        transport = TTransport.TBufferedTransport(transport)
        protocol = TBinaryProtocol.TBinaryProtocol(transport)
        client = ThriftHive.Client(protocol)
        transport.open()

        client.execute(sql)

        print "The return value is : "
        print client.fetchAll()
        print "............"
        transport.close()
    except Thrift.TException, tx:
        print '%s' % (tx.message)

if __name__ == '__main__':
    hiveExe(hive_sql)



#!/usr/bin/env python  
# import sys  
# sys.path.append('/home/q/hive-0.10.0/lib/py')  
# from hive_service import ThriftHive  
# from hive_service.ttypes import HiveServerException  
# from thrift import Thrift  
# from thrift.transport import TSocket  
# from thrift.transport import TTransport  
# from thrift.protocol import TBinaryProtocol  
  
# def hiveExe(sql):  
  
#         try:  
#                 transport = TSocket.TSocket('192.168.232.200', 10001)  
#                 transport = TTransport.TBufferedTransport(transport)  
#                 protocol = TBinaryProtocol.TBinaryProtocol(transport)  
#                 client = ThriftHive.Client(protocol)  
#                 transport.open()  
  
#                 sqls = sql.split(";")  
#                 for s in sqls:  
#                         print s  
#                         client.execute(s)  
  
#                 #       print "The return value is : "  
#                         print client.fetchAll()  
#                 print "............"  
#                 transport.close()  
#         except Thrift.TException, tx:  
#                 print '%s' % (tx.message)  
  
# if __name__ == '__main__':  
#         hiveExe("use flightdata;show tables") 