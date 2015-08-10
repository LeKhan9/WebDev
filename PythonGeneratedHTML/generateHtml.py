
#----------------------------------------------------------------------------------
#                 Mohammad Khan contribution | Isaiah Snelling contribution
# Khan rate:                 93%             |            93%
# Snelling rate:             93%             |            93%
#
# -- Web Technologies and Mobile Computing HW1 due 2/16/15 11:59 PM --
# The python program generates an HTML string/file based off of a
# provided text file. Has the ability to interpret the text and output
# letters or images depending on what is specified. Pictures resized to 100
# pixels on large side. The current time is provided and a browser window opens
# as program runs. The output is displayed in a table in alternating color cells.
#
#                                     CITED SOURCES:
#       Virginia Gresham - worked on structure of HTML formatting and styling
#       Jules Tamagnan - helped with alternating table color generating cells
#----------------------------------------------------------------------------------
import random
import string
import datetime
import webbrowser 


# strips < and > and takes only starting value of tag and no specifications 
def wrap(tag,content):
    tag = tag[1:-1] 
    firstTag = tag.split()[0] 
    return "<" + tag + ">" + content + "</" + firstTag + ">"

# depending on user specification, this produces random letters to be put
# into the table as content 
def letters(lines):
    # will return number value from file line string 
    rows, columns = eval(lines[8].replace("x",","))

    tableContent = ""

    # we shuffle the ascii list of letters, and hence no repeats!
    letterList = list(string.ascii_letters)
    random.shuffle(letterList)
    
    # Jules Tamagnan helped with figuring out how to alternate checkerboard pattern here
    # %52 is used here since there are a total of 52 possible mappings (lowercase and uppercase)
    for i in range(rows):
        rowData = ""
        for j in range(columns):
            rowData += wrap("<td>", letterList[(j+i*columns)%52])
        tableContent += wrap("<tr>",rowData) + "\n"
    return tableContent

# depending on user specification, this produces calls images to be put into the table as content 
def pictures(lines):
    # assigns the number of rows and columns of pictures [columns is constant],
    # 8th line is chosen to get column value because that might be the maximum row
    rows = len(lines)-8
    columns = len(lines[8].split())
    tableContent = ""

    # Jules Tamagnan helped with figuring out how to alternate checkerboard pattern here
    for i in range(rows):
        rowData = ""
        for j in range(columns):
            rowData += wrap("<td>", '<img src="images/' + lines[8+i].split()[j] + '"></img>')
            
        tableContent += wrap("<tr>",rowData) + "\n"
    return tableContent

# formatting of header styling is modeled after provided Moodle file
def generateHtml():
    # returns all the lines of the file, we can target each by indexing at each line
    lines = open("config.txt").readlines()
    styleHead = "\nbody {background-color:" + lines[0].split()[1] + ";\n text-align: center;}\n"
    
    # these stylings work with the pictures and numbers functions to alternate colors
    styleHead += "tr:nth-child(odd) td:nth-child(odd){background-color:" + lines[1].split()[1] + ";}\n"
    styleHead += "tr:nth-child(even) td:nth-child(even) {background-color:" + lines[1].split()[1] + ";}\n"
    styleHead += "tr:nth-child(odd) td:nth-child(even){background-color:" + lines[2].split()[1] + ";}\n"
    styleHead += "tr:nth-child(even) td:nth-child(odd) {background-color:" + lines[2].split()[1] + ";}\n"
    
    styleHead += "td {border:" + lines[4].split()[1] + "px solid " + lines[3].split()[1] + ";\n text-align: center; \n font-size: 2.5em;}\n"
    # This restricts the table to 60% of the browser window
    styleHead += ".tableFormat {width:60%; margin: 0 20%}\n" 

    #defines all the styles under a heading tag and displays the heading from the file
    headContent = wrap("<head>", wrap("<style type='text/css'>", styleHead))
    
    #join command allows us to take words separated and wrap them, such as "random letters"
    bodyContent = "\n" + wrap("<h1>", "----" + " ".join(lines[6].split()[1:]) + "----") + "<br>\n"

    tableContent = ""

    # This determines the content of the table and have catch condition if its not IMAGES or LETTERS
    if(lines[7] == "LETTERS\n"):
        tableContent = letters(lines)
    elif(lines[7] == "IMAGES\n"):
        tableContent = pictures(lines)
    else:
        tableContent =("PLEASE SPECIFY IF YOU WANT IMAGE OR NUMBERS IN THE TEXT FILE!")

    tableContent = wrap("<table class='tableFormat'>",tableContent)

    # returns the current time of the creation of the file and outputs it on screen 
    footer = "Automatically Created for Web Tech. HW1 on: " + datetime.datetime.today().ctime()
    bodyContent += tableContent + "\n" + wrap("<h2>", footer) + " \n" + wrap("<h3>","Authors: " + " ".join(lines[5].split()[1:]))
    bodyContent = wrap("<body>",bodyContent + "\n")

    # wrap everything between html tags
    content = wrap("<html>",headContent + "\n" + bodyContent + "\n")

    # inserting document type to be on safe side if certain methods won't work without this :)
    lastFeed = "<!DOCTYPE html>\n" +content
    #print(lastFeed)

    file = open("hw1.html","w")
    file.write(lastFeed)

    # This will open up the HTML file in its specified default program
    # if it does not open in the browser - the default program must be an editor
    # you can change that by right clicking and changing this with "Open With..."
    webbrowser.open_new_tab('hw1.html')

generateHtml()
