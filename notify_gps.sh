#!/bin/bash
OLD=$(cat files_count.txt | sed 's|[^0-9]||g' | bc -l) 
ACTUAL=`ls -l trips | wc -l`
echo $ACTUAL
if [ $ACTUAL -gt $OLD ]; then
    echo "Nowy plik"
    echo $ACTUAL > files_count.txt
    /Applications/Utilities/terminal-notifier.app/Contents/MacOS/terminal-notifier -title "GPS tracking" -subtitle "Auto ruszyło" -message "Dane zapisują się w /Users/ja/trips"
    mail -s "BMW w ruchu" your@email.here < email.txt
else
    echo "Brak nowych plików"
fi
