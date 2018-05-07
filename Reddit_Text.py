import urllib
import urllib.request
from bs4 import BeautifulSoup

def get_reddit_links(url):
    thepage = urllib.request.urlopen("https://www.reddit.com/r/" + url +"/") # Go to the reddit page
    soupdata = BeautifulSoup(thepage,"html.parser") # get all of the html
    title_list = soupdata.findAll('a', {"class": "title"}) # find all of the links with the class title in the html
    return title_list # return the list

def print_link_data(subreddit_name):
    subreddit_data = get_reddit_links(subreddit_name) # go to the web page and get the list of links
    for title in subreddit_data: # run through the list and print the text
        try:
            print(title.text)
        except:
            pass

print_link_data("askreddit")