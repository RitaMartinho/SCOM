import numpy as np

f = open("../lostconnection.txt", "r")
lines= f.readlines()

array_hour_minute=[]
array_hour=[]
hits_by_hour = [0]*24

for line in lines:
    line= line.split()
    array_hour_minute.append(line[1])

for entry in array_hour_minute:

    entry=entry.split(':')[0]
    array_hour.append(entry)

for i in range(24):
    for entries in array_hour:
        
        if int(entries) == i:
            hits_by_hour[i]+=1
       

with open('../txtfiles_todisplay/hitsbyhour.txt', 'w+') as f1:
    for item in hits_by_hour:
        f1.write("%s\n" % item)

f.close() 
f1.close()
