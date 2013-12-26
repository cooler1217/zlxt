#-*- coding:utf-8 -*-
#!/usr/bin/python
import socket

import urllib2

socket.setdefaulttimeout(10)

def getUrlListFromFile():
    f = open('cooler.skip','r')
    for line in f.readlines():
        print line.replace("\n","").split("\001")[1]

def getUrlContent(webURL):
    try:
        flag = 0
        for i in range(3):
            open = urllib2.urlopen(webURL)
            content = open.read()
            print len(content)
            # print res.info()
            # head_str=res.info()
            # head_arr = str(head_str).split("\r\n")
            # for head in head_arr:
            #     if head.find("Content-Length: ") >= 0:
            #         flag = int(head[len("Content-Length: "):len(head)])
            # if(flag>0):
            #     break
        return flag
    except :
        return flag

if __name__ == '__main__':
    # print getUrlContent('http://www.sina.com.cn')
    getUrlListFromFile()

