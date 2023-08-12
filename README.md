# OS  
ubuntu20.04適用  

# 環境設定  
套件安裝  
```
sudo apt install php7.4 php7.4-gd mysql-server python3-pip php-mysqli  
```
```
pip install pymysql fake-useragent urllib3 beautifulsoup4 openpyxl python-docx pandas  
``` 

cd至適合的位置
```
git clone https://github.com/KongRong911104/web.git
```
# 資料庫設定
登入mysql，密碼預設:無
```
mysql -u root -p
```
創建帳號
```
CREATE USER '你的帳號'@'localhost' IDENTIFIED BY '您的密碼';
GRANT ALL PRIVILEGES ON *.* TO '您的帳號'@'localhost';
FLUSH PRIVILEGES;
```
匯入資料
```
CREATE DATABASE 您的資料庫名稱;
USE 您的資料庫名稱;
SOURCE 下載的檔案路徑/web.sql;

```
```
sudo cp -r 你下載的檔案位置/cash /var/www/
```
設定資料庫
```
sudo nano /var/www/cash/database_setting.txt
```
# 設定apache2
```
sudo nano /etc/apache2/sites-available/000-default.conf
```
註解沒用到的內容，並新增
```
<VirtualHost *:80>
                ServerAdmin root@localhost
                DocumentRoot /var/www/cash
                ErrorLog ${APACHE_LOG_DIR}/error.log
                <Directory /var/www/cash>
                        Options Indexes FollowSymLinks
                        AllowOverride All
                        Require all granted
                </Directory>
</VirtualHost>
```
最後一步，重整apache2
```
sudo service apache2 restart
```
