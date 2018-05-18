import urllib
import urllib.request
from bs4 import BeautifulSoup

def make_soup(html_page):
    the_page = urllib.request.urlopen(html_page)
    soupdata = BeautifulSoup(the_page,"html.parser")
    return soupdata

page = make_soup("https://www.goodreads.com/list/show/5742.Best_of_Fyodor_Dostoevsky")

title_anchors = page.findAll('a', {"class": "bookTitle"})

book_links = []

for link in title_anchors:
    temp_link = "https://www.goodreads.com" + link.get('href')
    book_links.append(temp_link)

list_of_all_book_info = []

for book_info_page in book_links:
    soup = make_soup(book_info_page)
    title = soup.find('h1', {"class": "bookTitle"})
    author = soup.find('a', {"class": "authorName"})
    description = soup.find('div', {"id": "description"})
    try:
        info_string = title.text.strip() + "|||" + author.text.strip() + "|||" + description.text.strip()
    except:
        pass
    list_of_all_book_info.append(info_string)

for info in list_of_all_book_info:
    print(info + "\r\n")
