apk add php
apk add python3
apk add sqlite
apk add php-session
apk add php-sqlite3
apk add figlet
echo "cwtp.db" >> ~/ic470-cwtp-pub/.git/info/exclude
cat ~/ic470-cwtp-pub/create_table.txt | sqlite3 ~/ic470-cwtp-pub/cwtp.db 
chmod +x run
cp run ~
./run
