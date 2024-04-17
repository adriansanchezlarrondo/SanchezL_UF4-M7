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

print "Running...<br />";

$strDSN = "pgsql:dbname=usuaris;host=localhost;port=5432";
$objPDO = PDOFactory::GetPDO($strDSN, "postgres", "root", array());
$objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$objInSight = new InSight($objPDO);

$html = file_get_contents("https://api.nasa.gov/insight_weather/?api_key=nIKLFRCfmjEf5l4BzxDPbtIno12QGgizlZvWZq0Q&feedtype=json&ver=1.0");

$data = json_decode($html);

$validity_checks = $data->validity_checks;
$AT = $validity_checks->{1219}->AT->valid === "false" ? false : true;
$HWS = $validity_checks->{1219}->HWS->valid === "false" ? false : true;
$PRE = $validity_checks->{1219}->PRE->valid === "false" ? false : true;
$SolHoursRequired = $validity_checks->sol_hours_required;
$SolsChecked = $validity_checks->sols_checked[0];

$objInSight->setAT($AT);
$objInSight->setHWS($HWS);
$objInSight->setPRE($PRE);
$objInSight->setSolHoursRequired($SolHoursRequired);
$objInSight->setSolsChecked($SolsChecked);

print "AT es " . $objInSight->getAT() . "<br />";
print "HWS es " . $objInSight->getHWS() . "<br />";
print "PRE es " . $objInSight->getPRE() . "<br />";
print "SolHoursRequired es " . $objInSight->getSolHoursRequired() . "<br />";
print "SolsChecked es " . $objInSight->getSolsChecked() . "<br />";

print "<br />Saving...<br />";
$objInSight->Save();
