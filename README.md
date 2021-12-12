# COMP2001_template
A template repo for use for the COMP2001 Information Management &amp; Retrieval Module

## Part 1
Part 1 of the coursework is to create a RESTful API as per the specification found in the Assignment Brief.  The code for this part is to be found in the API folder of the repository.  The API is to be hosted on the web.socem server - in the student/API folder provided for the module.  The API is written using .NET and links to a Microsoft SQL Server database hosted on the University infrastructure.

The API is a representation of machine to machine communication and the endpoints are as per the swagger file provided for the module.  

## Part 2
Part 2 of the coursework is to create a Linked Data application based on a chosen dataset from the [Data Place Plymouth](https://plymouth.thedata.place/dataset) initiative.  The code for this is to be found in the Linked_Data folder.  The application is coded in PHP and is hosted on the web.socem server - in the student/public folder provided for this module.

The application has three pages:

**index.php**, which displays a link to the original data set, a link to the data.php page, a link to the resource directory with the JSON-LD output, and finally, the project vision.

**data.php**, which displays the JSON data in a human readable format (in this case, an HTML table, and an optional modern card-based layout).

**resource name**, which simply outputs the JSON data in a JSON-LD format. Both browsers and REST clients can use a GET request to fetch the data.  The resource name itself will depend on the data set chosen.

## Credits
Plymouth DATA Place: https://plymouth.thedata.place/dataset

