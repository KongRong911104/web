import pandas as pd
import sys
import json as js
import os
df = pd.read_excel(sys.argv[1], usecols=[0,1,2], engine='openpyxl', dtype={
                               "學號": 'str', "姓名": 'str',"成績": 'int32'})
l=["學號", "姓名","成績"]
os.remove(sys.argv[1])
# df=df[l].groupby('cour_cname').head(3)
html_table = df.to_html(index=False)
html_table = html_table.replace('<tr style="text-align: right;">', '<tr style="text-align: center;width:fit-content;font-size:25px">')
html_table = html_table.replace('<tr>', '<tr style="text-align: center;width:fit-content;font-size:25px">')
# html_table=""+html_table
print(js.dumps(html_table))