import pandas as pd
import sys
from pandas import DataFrame
import json as js
df = pd.read_excel(sys.argv[1], usecols=[ 11, 10, 7, 15, 17], engine='openpyxl', dtype={
                               "curr_code": 'int32', "cour_cname": 'str',"score": 'int32', "curr_cname": 'str', 'teac_name': 'str'})
l=["cour_cname","curr_code","score","curr_cname","teac_name"]
df=df[l].groupby('cour_cname').head(3)
html_table = df.to_html(index=False)
html_table = html_table.replace('<tr style="text-align: right;">', '<tr style="text-align: center;">')
html_table = html_table.replace('<tr>', '<tr style="text-align: center;">')
# html_table=""+html_table
print(js.dumps(html_table))