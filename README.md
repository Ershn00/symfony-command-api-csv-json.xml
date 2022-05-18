# Project Description

CLI command to convert the input CSV file (see last section) to a JSON and XML file.
<ul>
<li>Console command: php bin/console app:convert-csv</li>
<li>CSV file is placed under "public" folder.</li>
<li>Full URL path for .csv file required. (E.g. http://127.0.0.1:8000/convert/csv/data.csv)</li>
</ul>

REST API to serve the contents of the JSON and XML file filterable by name and
discount_percentage.
<ul>
<li>CSV file is placed under "public" folder.</li>
<li>Only .csv file name in url (E.g. URL name/convert/csv/data.csv)</li>
</ul>

# Incomplete Features
<ul>
<li>Filtering JSON response by name and discount_percentage.</li>
</ul>