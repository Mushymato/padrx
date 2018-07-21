import sys
from html.parser import HTMLParser


class MyHTMLParser(HTMLParser):
    def __init__(self):
        HTMLParser.__init__(self)
        self.tbl = 0
        self.tblData = []

    def handle_starttag(self, tag, attrs):
        if tag == "tr":
            self.tbl += 1

    def handle_endtag(self, tag):
        if tag == "tr" and self.tbl:
            self.tbl -= 1
            self.tblData.append("\n")

    def handle_data(self, data):
        if self.tbl:
            self.tblData.append(data)


parser = MyHTMLParser()

with open("monstermedal.html", encoding='utf-8') as page:
    for l in page:
        parser.feed(str(l))

with open("monstermedal.txt", "w", encoding='utf-8') as out:
    for i in parser.tblData:
        out.write("\"")
        out.write(i)
        out.write("\"")
        if i != "\n":
            out.write(",")
