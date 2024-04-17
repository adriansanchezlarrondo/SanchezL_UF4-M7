<?php
require("abstract.databoundobject.php");
require("class.pdofactory.php");

class InSight extends DataBoundObject {

    protected $AT;
    protected $HWS;
    protected $PRE;
    protected $SolHoursRequired;
    protected $SolsChecked;

    protected function DefineTableName() {
        return("insight");
    }

    protected function DefineRelationMap() {
        return(array(
            "id" => "ID",
            "at" => "AT",
            "hws" => "HWS",
            "pre" => "PRE",
            "sol_hours_required" => "SolHoursRequired",
            "sols_checked" => "SolsChecked"));
    }
}

$strDSN = "pgsql:dbname=usuaris;host=localhost;port=5432";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root", array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$objInSight = new InSight($objPDO, 1);
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detalles de la API InSight</title>
    </head>
    <body>
        <h1>Detalles de la API InSight</h1>
        <table border="1">
            <tr>
                <th>AT</th>
                <th>HWS</th>
                <th>PRE</th>
                <th>Sol Hours Required</th>
                <th>Sols Checked</th>
            </tr>
            <tr>
                <td><?php print $objInSight->getAT(); ?></td>
                <td><?php print $objInSight->getHWS(); ?></td>
                <td><?php print $objInSight->getPRE(); ?></td>
                <td><?php print $objInSight->getSolHoursRequired(); ?></td>
                <td><?php print $objInSight->getSolsChecked(); ?></td>
            </tr>
        </table>
    </body>
</html>
