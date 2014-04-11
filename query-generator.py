#! /bin/python -w

import string
import random

def id_gen(size):
    return ''.join(random.choice(string.ascii_uppercase + string.digits) for _ in range(size))
    
def randState():
    return ''.join(random.choice(string.ascii_uppercase) for _ in range(2))

def randZip():
    return ''.join(random.choice(string.digits) for _ in range(5))

def randStreet():
    number = ''.join(random.choice(string.digits) for _ in range(3))
    name = ''.join(random.choice(string.ascii_uppercase) for _ in range(4))
    return number + " " + name + " RD"

def main():
    Fname = ['bob','steve','sally','johns','michael']
    Lname = ['johnson','lilly','grey','upper','downs']
    city = ['Lexington','Louisville','New York','Paris']
    email = '@stuff.com'
#insert Customers
    query = "INSERT INTO Customers\nVALUES\n"
    for i in range(6):
        tmpF = random.choice(Fname)
        tmpL = random.choice(Lname)
        query += "('c" + str(i) + email + "', '" + randStreet() + "', '" + random.choice(city) + "', '" + randState() + "', '" + randZip() + "', '" + tmpF + str(i) + "', '" + tmpF + "', '" + tmpL + "'),\n"
    s = list(query)
    s[len(s)-2] = ";"
    query = "".join(s)
    #print query
#insert staff
    query = "INSERT INTO Staff\nVALUES\n"
    for i in range(4):
        tmpF = random.choice(Fname)
        tmpL = random.choice(Lname)
        query += "('" + id_gen(8) + "', '" + tmpF + "', '" + tmpL + "', " + str(0) + ", '" + tmpF + str(i) + "'),\n"
    s = list(query)
    s[len(s)-2] = ";"
    query = "".join(s)
    #print query
    #insert managers
    query = "INSERT INTO Staff\nVALUES\n"
    for i in range(2):
        tmpF = random.choice(Fname)
        tmpL = random.choice(Lname)
        query += "('" + id_gen(8) + "', '" + tmpF + "', '" + tmpL + "', " + str(1) + ", '" + tmpF + str(i) + "'),\n"
    s = list(query)
    s[len(s)-2] = ";"
    query = "".join(s)
    #print query
#insert Items for sale with no promotion
    query = "INSERT INTO Items\nVALUES\n"
    for i in range(8):
        query += "('wingding" + str(i) + "', " + str(random.randrange(1000)/12) + ", 0" + ", " + str(random.randrange(100)+1) + ", '" + id_gen(random.randrange(30)) + "', '" + id_gen(6) + "'),\n"
    s = list(query)
    s[len(s)-2] = ";"
    query = "".join(s)
    print query

#insert Items for sale with promotional rate
    query = "INSERT INTO Items\nVALUES\n"
    for i in range(4):
        query += "('wingding" + str(i+8) + "', " + str(float(random.randrange(1000)/13)) + ", " + str(round(random.random(),3)) + ", " + str(random.randrange(100)+1) + ", '" + id_gen(random.randrange(40)) + "', '" + id_gen(6) + "'),\n"
    s = list(query)
    s[len(s)-2] = ";"
    query = "".join(s)
    print query

main()
