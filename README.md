# Project Description

## CLI Command
<b>CLI command</b> to convert the input CSV file (see last section) to a JSON and XML file.
<ul>
<li>Console command: php bin/console app:convert-csv</li>
<li>CSV file should be placed under "public" folder in order to be read.</li>
<ul>
<li>This could be set up in various ways. In real-world scenario, CSV file should be uploaded.</li>
</ul>
<li>Full URL path for .csv file required in the command line. (E.g. http://127.0.0.1:8000/convert/csv/data.csv)</li>
<li>Result Json prints in the console.</li>
<li>Result XML file saves under src/Data directory.</li>
</ul>

## REST API
<b>REST API</b> serves the contents of the JSON file filterable by name and
discount_percentage. Serving filtered response in JSON and XML formats.
<ul>
<li>CSV file should be placed under "public" folder in order to be read.</li>
<ul>
<li>This could be set up in various ways. In real-world scenario, CSV file should be uploaded, and it should be a POST request.</li>
</ul>
</ul>

### API Endpoints

#### All results
<ul>
<li>$URL/convert/csv/{csv_file}</li>
<li>(E.g. https://url.com/convert/csv/data.csv)</li>
</ul>

#### Filtering Json API
<ul>
<li>By name: URL/convert/csv/{csv_file}/filter/name/{name}
<ul>
<li>Name parameter is not case-sensitive (E.g. $URL/convert/csv/data.csv/filter/name/atlantis)</li>
<li>Name can be partial (E.g. Instead of "Atlantis The Palm", only "atlantis" or "palm".)</li>
</ul>
</li>
<li>By discount_percentage: $URL/convert/csv/{csv_file}/filter/discount/{discount_percentage}</li>
</ul>

## Tech Stack
Framework: Symfony 6 <br />
PHP Version: 8.1