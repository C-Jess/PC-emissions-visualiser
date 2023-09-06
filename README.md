# PC Emissions Visualiser

<table>
<tr>
<td>
PC Emissions Visualiser is a website to visualise estimated CO2 emissions from PC usage as the distance travelled by an average car, accessing country-specific electricity emissions data to display for a selected country and year.
</td>
</tr>
</table>

## Demo
Take a look at the live site [here](https://pc-emmisions-visualiser.jessicachristensen.com/).
![Demo](/Demo.gif)

## Technologies
- **PHP** is used in the backend, served by apache, to create the REST API to interface with the **MySQL** database.
- Frontend is written using **JavaScript**, **HTML** and **CSS**.
- Hosted using Heroku.

## API Endpoints

Here are some of the API endpoints you can interact with:

### List Countries
- **Endpoint**: `/countries`
- **Method**: `GET`
- **Description**: Retrieves a list of all countries and their corresponding country code.

### Get Country Carbon Intensities
- **Endpoint**: `/countries/[country_code]`
- **Method**: `GET`
- **Description**: Retrieves the carbon intensity for each year for a given country.

## Acknowledgments
This project was developed as part of a university coursework assignment. Special thanks to Wayne Rippin for providing the initial starting point with [`RestService.php`](https://github.com/C-Jess/PC-emmissions-visualiser/blob/main/RestService.php).
