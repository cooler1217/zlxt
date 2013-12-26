#!/usr/bin/env python

import sys

sys.path.append('/usr/lib/hive/lib/py')
from hive_service import ThriftHive
from hive_service.ttypes import HiveServerException
from thrift import Thrift
from thrift.transport import TSocket
from thrift.transport import TTransport
from thrift.protocol import TBinaryProtocol

try:
    transport = TSocket.TSocket('localhost', 10000)
    transport = TTransport.TBufferedTransport(transport)
    protocol = TBinaryProtocol.TBinaryProtocol(transport)

    client = ThriftHive.Client(protocol)
    transport.open()

    client.execute("CREATE TABLE cooler (foo INT, bar STRING) ROW FORMAT DELIMITED FIELDS TERMINATED BY '\t'")
    print "1-----------"
    client.execute("LOAD DATA LOCAL INPATH '/root/cooler/c.txt' OVERWRITE INTO TABLE r")
    print "2-----------"
    client.execute("SELECT * FROM r")
    while (1):
      row = client.fetchOne()
      if (row == None):
        break
      print row
    client.execute("SELECT * FROM r")
    print client.fetchAll()

    transport.close()

except Thrift.TException, tx:
    print '%s' % (tx.message)