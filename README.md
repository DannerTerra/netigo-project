# XML Page-Parser (EN)

# Run the project

- `docker-compose up -d`

- localhost:8888

# Introduction

The given XML document should be processed so that a page tree including subpages is generated as a web

page. The goal is to react as variable as possible to the contents of the XML document. Also consider that the

document could be extended by further pages and subpages, the parser should also be able to react to this.

# Task

- Create a parser for the XML document
    Note that (theoretically) an infinite number of nestings of subpages should be possible (subpage, sub-
    subpage, sub-sub-subpage, ...)
-
- Pay attention to "Pretty URLs" which result from the field "slug" of the respective page/subpage
- Output the contents of the XML document in the given HTML framework
    - Create a navigation of all pages including subpages
    - Output the contents of the field "content" on the selected page
    - Output a breadcrumb navigation
       Set the current page in the breadcrumb navigation as "active", so that the user recognizes on
       which page he is located
    - The generation of the pages should happen "on the fly"

## Hints

- For the PHP code no(!) framework may be used
- The programming should be object oriented



