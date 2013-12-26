#!/usr/bin/env python

import sys  
sys.path.append('/usr/lib/hive/lib/py')
from hive_service import ThriftHive
from hive_service.ttypes import HiveServerException
from thrift import Thrift
from thrift.transport import TSocket
from thrift.transport import TTransport
from thrift.protocol import TBinaryProtocol
from datetime import datetime, timedelta

try:
    transport = TSocket.TSocket('127.0.0.1', 10000)
    transport = TTransport.TBufferedTransport(transport)
    protocol = TBinaryProtocol.TBinaryProtocol(transport)

    client = ThriftHive.Client(protocol)
    transport.open()

    tableName = "request_%s" %((datetime.now()-timedelta(days=5)).strftime("%Y_%m_%d_%H"))
    tableName = "request_2013_12_26_15"
    client.execute("CREATE TABLE %s (jordanGUID STRING, domain STRING, sfrom STRING, location_url STRING, request_datetime STRING) ROW FORMAT DELIMITED FIELDS TERMINATED BY '\t'" %(tableName))
    print "1-----------"
    # client.execute("LOAD DATA LOCAL INPATH '/home/jordan_log/%s.log' OVERWRITE INTO TABLE %s" %(tableName,tableName)) 
    client.execute("LOAD DATA LOCAL INPATH '/home/jordan_logs/%s.log' INTO TABLE %s" %(tableName,tableName)) 
    print "2-----------"
    # client.execute("SELECT * FROM pokes")
    # while (1):
    #   row = client.fetchOne()
    #   if (row == None):
    #     break
    #   print row
    # client.execute("SELECT * FROM pokes")
    # print client.fetchAll()

    transport.close()

except Thrift.TException, tx:
    print '%s' % (tx.message)