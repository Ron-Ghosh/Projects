import urllib
import urllib.request
from bs4 import BeautifulSoup

def make_soup(url):
    thepage = urllib.request.urlopen(url)
    soupdata = BeautifulSoup(thepage,"html.parser")
    return soupdata

page = make_soup("https://www.reddit.com/r/all/")
title = page.findAll('a', {"class": "title"})
sub = page.findAll('a', {"class": "subreddit"})

counter = 1

for link in title:
    try:
        print(str(counter) + ": " + link.text + " ["  + sub[counter -1].text + "]")
        counter = counter + 1
    except:
        pass

