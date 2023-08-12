import datetime
# from fake_useragent import UserAgent
import urllib.request as req
import bs4
import datetime
import concurrent.futures
import os

output_path="./spider/"

# 遍歷資料夾內的所有檔案
for filename in os.listdir(output_path):
    file_path = os.path.join(output_path, filename)
    if os.path.isfile(file_path):
        # 刪除檔案
        os.remove(file_path)
currentDateTime = datetime.datetime.now()
date = currentDateTime.date()
year = int(date.strftime("%Y"))-1911
def spider(part=0,year=0,semester=1, cs={}):
    # ua = UserAgent()
    PATH=""
    if part==0:
        PATH="https://course.thu.edu.tw/view-dept/{}/{}/350".format(year,semester)
    else:
        PATH="https://course.thu.edu.tw/view-dept/{}/{}/357".format(year,semester)
    request = request = req.Request(PATH, headers={
    "User-Agent": "Mozilla/5.0",
    "Cache-Control": "no-cache",
    "Pragma": "no-cache"
})
    with req.urlopen(request) as response:
        data = response.read().decode("utf-8")
    root = bs4.BeautifulSoup(data, "html.parser")
    titles = [i for i in root.find_all("td", {"data-title": "課程名稱"})]
    y = 0
    c = ""
    for i in titles:
        a_element = i.find("a")
        sn = int(a_element["href"].split("/")[-1])
        text = a_element.get_text(strip=True).split("-")[0]

        a_element= a_element.contents[0].strip().split("-")[1]
        text2 = a_element

        if part == 0:
            if y == 0:
                c = str(sn)[0]
                y = 1
            if str(sn)[0] == c:
                cs[sn] = [text, "日間部",text2]
            else:
                cs[sn] = [text, "碩士班",text2]
        else:
            cs[sn] = [text, "碩士在職專班",text2]
    # return cs

def spider_0(year, j):
    # 執行 spider(0, year, j) 的程式碼
    cs = {}
    spider(0, year, j,cs)
    spider(1, year, j, cs)
    output_file = output_path+str(year)+"_"+str(j)+".txt"  # 指定輸出檔案名稱
    with open(output_file, "w",encoding="utf-8") as file:
        for key, value in cs.items():
            line = "{}:{},{},{}\n".format(str(key),value[0],value[1],value[2])
            file.write(line)
    return cs

def spider_wrapper(year, num):
    spider_0(year, num)

threads = []

with concurrent.futures.ThreadPoolExecutor() as executor:
    for i in range(6):
        threads.append(executor.submit(spider_wrapper, year-i, 1))
        threads.append(executor.submit(spider_wrapper, year-i, 2))

# 等待所有线程完成
for thread in threads:
    thread.result()
