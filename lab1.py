#!/usr/bin/python

import cgi, cgitb 

#retrieve from form
form = cgi.FieldStorage()
searchterm =  form.getvalue('value')
n = int(searchterm)

#math part
my_sum=sum(range(n+1))

#retrieve result as html page
print "Content-type:text/html\r\n\r\n"
print "<html>"
print "<head>"
print "<title>Lab 1</title>"
print "</head>"
print "<body>"
print "<h2> Calculation is : %d</h2>" %my_sum
print "</body>"
print "</html>"