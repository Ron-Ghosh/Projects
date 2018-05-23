import urllib
import urllib.request
from bs4 import BeautifulSoup

def make_soup(url):
    thepage = urllib.request.urlopen(url)
    soupdata = BeautifulSoup(thepage,"html.parser")
    return soupdata

for val in range(1,9):
    page = make_soup("https://www.goodreads.com/list/show/6.Best_Books_of_the_20th_Century?page=" +str(val))
    titles = page.findAll("a", {"class", "bookTitle"})
    author = page.findAll("a", {"class", "authorName"})

    for x, y in zip(titles,author):
        try:
            print("Insert into books (name, author) values ('" + x.text.strip() + "', '" + y.text.strip() + "');")
        except:
            pass