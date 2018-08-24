<?php

$number = range(0,2);

foreach ($number as $key) {
    # code...

  $url = `echo https://myip.ms/browse/sites/$key/url/shirt/countryID/USA/rank/0/rankii/100000000 `;
  $html = file_get_contents($url);
    libxml_use_internal_errors(true);
    $doc = new \DOMDocument();
    if($doc->loadHTML($html))
    {
        $result = new \DOMDocument();
        $result->formatOutput = true;
        echo "<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;

}

td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    background-color:gray;
    color:white;
}

th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    background-color:gray;

}
</style>";
        $table = $result->appendChild($result->createElement("table"));
        $thead = $table->appendChild($result->createElement("thead"));
        $tbody = $table->appendChild($result->createElement("tbody"));

        $xpath = new \DOMXPath($doc);

        $newRow = $thead->appendChild($result->createElement("tr"));

        foreach($xpath->query("//table[@id='sites_tbl']/thead/tr/th[class='nobackgroundimage']") as $header)
        {
            $newRow->appendChild($result->createElement("th", trim($header->nodeValue)));
        }

        foreach($xpath->query("//table[@id='sites_tbl']/tbody/tr") as $row)
        {
            $newRow = $tbody->appendChild($result->createElement("tr"));

            foreach($xpath->query("./td[position()>1 and position()<7]", $row) as $cell)
            {
                $newRow->appendChild($result->createElement("td", trim($cell->nodeValue)));
            }
        }

        echo $result->saveXML($result->documentElement);
   
    }
}


?>