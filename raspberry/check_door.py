import RPi.GPIO as GPIO
import time
import datetime
import locale

import urllib
import urllib2
response ={}
url = "POST先のURL"
headers ={
  "pragma":"no-cache",
}

led = 11
button = 3
status = 0
prestatus= 0

GPIO.setmode(GPIO.BOARD)

GPIO.setup(led, GPIO.OUT)
GPIO.setup(button, GPIO.IN)

GPIO.output(led, 0)

while 1==1:
	if GPIO.input(button) :
		GPIO.output(led, 0)
		time.sleep(0.2)
                status=0
                if status != prestatus :
			d = datetime.datetime.today()
                        print d.strftime("%Y-%m-%d %H:%M:%S")+ " : Door is open"
			try :
				params = urllib.urlencode({'status':'0'})
 				req = urllib2.Request(url, params ,headers )
				res = urllib2.urlopen(req)
				response["body"] = res.read()
 				response["headers"] =  res.info().dict
			except URLError, e:
				print e
				exit()
			print   response["body"]
                prestatus = 0
	else :
		GPIO.output(led, 1)
		time.sleep(0.2)
                status=1
                if status != prestatus :
                        d = datetime.datetime.today()
                        print d.strftime("%Y-%m-%d %H:%M:%S")+ " : Door is closed"
                        try :
                                params = urllib.urlencode({'status':'1'})
                                req = urllib2.Request(url, params ,headers )
                                res = urllib2.urlopen(req)
                                response["body"] = res.read()
                                response["headers"] =  res.info().dict
                        except URLError, e:
                                print e
                                exit()
                        print   response["body"]
                prestatus = 1
#GPIO.cleanup()
