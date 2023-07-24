<?php
require "dbinfo.php";
require "RestService.php";
require "Country.php";
require "CarbonIntensity.php";

class CarbonIntensityRestService extends RestService
{
	private $countries;

	public function __construct()
	{
		// calls are matched to be sure they are in the form http://server/countries/x/y/z 
		parent::__construct("countries");
	}

	public function performGet($url, $parameters, $requestBody, $accept)
	{
		switch (count($parameters)) {
			case 1:
				// Note that we need to specify that we are sending JSON back or
				// the default will be used (which is text/html).
				header('Content-Type: application/json; charset=utf-8');
				// This header is needed to stop IE cacheing the results of the GET	
				header('no-cache,no-store');
				$this->getAllCountries();
				echo json_encode($this->countries);
				break;

			case 2:
				$id = $parameters[1];
				$carbonIntensity = $this->getCarbonIntensity($id);
				if ($carbonIntensity != null) {
					header('Content-Type: application/json; charset=utf-8');
					header('no-cache,no-store');
					echo json_encode($carbonIntensity);
				} else {
					$this->notFoundResponse();
				}
				break;

			default:
				$this->methodNotAllowedResponse();
		}
	}

	private function getAllCountries()
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error) {
			$query = "SELECT * FROM countries";
			if ($result = $connection->query($query)) {
				while ($row = $result->fetch_assoc()) {
					$this->countries[] = new Country($row["country_code"], $row["country_name"]);
				}
				$result->close();
			}
			$connection->close();
		}
	}

	private function getCarbonIntensity($id)
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error) {
			$query = "SELECT year, carbon_intensity FROM carbon_intensity WHERE country_code = ?";
			$statement = $connection->prepare($query);
			$statement->bind_param('s', $id);
			$statement->execute();
			$result = $statement->get_result();
			if ($result->num_rows != 0) {
				$carbonIntensity = new CarbonIntensity($id);
				while ($row = $result->fetch_assoc()) {
					$carbonIntensity->setIntensity($row["year"], (float)$row["carbon_intensity"]);
				}
				$result->close();
				return $carbonIntensity;
			}
			$statement->close();
			$connection->close();
			return null;
		}
		return null;
	}
}
