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
    customerFname = ['bob','steve','sally','johns','michael']
    customerLname = ['johnson','lilly','grey','upper','downs']
    email = '@stuff.com'
    query = "INSERT INTO Customers\nVALUES\n"
    
    for i in range(6):
        tmpF = random.choice(customerFname)
        tmpL = random.choice(customerLname)
        query += "c" + str(i) + email + ", " + randStreet() + ", " + randState() + ", " + randZip() + ", " + tmpF + str(i) + ", " + tmpF + ", " + tmpL + ",\n"
    s = list(query)
    s[len(s)-3] = ";"
    query = "".join(s)
    print query
main()
