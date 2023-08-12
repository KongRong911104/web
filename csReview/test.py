import os
import sys
import json as js
# pip install fake-useragent
from fake_useragent import UserAgent
# pip install pandas
import pandas as pd
# pip install python-docx
import docx
from docx.shared import RGBColor
from docx.shared import Pt
from docx.enum.text import WD_ALIGN_PARAGRAPH
from docx.oxml.ns import qn
# pip install urllib3
import urllib.request as req
# pip install beautifulsoup4
import bs4
# pip install fake-useragent
from fake_useragent import UserAgent
file=[]
readExcelFile = pd.read_excel(file[0], usecols=[7, 11, 10, 15, 17],engine='openpyxl', dtype={
                              "score": 'int32', "curr_code": 'int32', "cour_cname": 'str', "curr_cname": 'str', 'teac_name': 'str'})
for i in range(1,len(file)):
    readExcelFile2 = pd.read_excel(file[i], usecols=[7, 11, 10, 15, 17],engine='openpyxl', dtype={
                              "score": 'int32', "curr_code": 'int32', "cour_cname": 'str', "curr_cname": 'str', 'teac_name': 'str'})
    os.remove(file[i])
    readExcelFile = pd.concat([readExcelFile, readExcelFile2], axis=0)
ExcelFile = pd.DataFrame(readExcelFile)