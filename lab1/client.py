#!/usr/bin/python

import os, xlsxwriter, subprocess
from datetime import datetime

number= input('Choose a N for N calls to the service:')
i=0

#init excel file
workbook = xlsxwriter.Workbook('lab1.xlsx')
worksheet = workbook.add_worksheet()
row = 0
col=0

#calls
while(i<number):
    now = datetime.now()

    cmd= 'curl -o /dev/null -s -w "%{http_code}" --data "value=100" http://localhost/cgi-bin/lab1.py'
    http_code=subprocess.check_output(cmd, shell=True)
    os.system('sleep 2')
    if(http_code == "200"):
        after = datetime.now()
        worksheet.write(row,0,after-now)
        row += 1
    i += 1

worksheet.write(row, 0, 'Medium')
worksheet.write(row, 1, '=AVERAGE(A1:A5)*10^5')

workbook.close()