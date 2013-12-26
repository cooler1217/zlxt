#!/usr/bin/env python  
import sys  
from datetime import datetime,timedelta

tableName = "request_%s" %(datetime.now()-timedelta(days=5)).strftime("%Y_%m_%d_%H")
print tableName