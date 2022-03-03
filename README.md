# cats
I used this docker LAMP + Redis image: https://github.com/sprintcube/docker-compose-lamp

Task: make website which has URL: whateverdomain.com/N, where N is a digit from 1 to 1000000.
In every single URL - print 3 different cat breeds from the cats.txt list in order: Cat1, Cat2, Cat3. You have to cache cats' combinations for 60 seconds, to be clear, if combinations Cat1, Cat2, Cat3 were printed in /N, that same URL has to print same combinations for 60 seconds. Page has to collect visitors stats: countAll - sum of all page's visitors with N values; countN - sum of specific N value. In addition, page writes log file (in JSON format), every single web request from a new line.
