<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 2/2/2018
 * Time: 1:09 PM
 */

namespace busRegistration\Http\PaymentGateway\Moneris\Classes;


/******************* AMEX Level23 *******************/
class mpgAxLevel23
{

    private $template = array	(
        'axlevel23' => array ('table1' => null, 'table2' => null, 'table3' => null)
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setTable1($big04, $big05, $big10, axN1Loop $axN1Loop)
    {
        $this->data['axlevel23']['table1']['big04'] = $big04;
        $this->data['axlevel23']['table1']['big05'] = $big05;
        $this->data['axlevel23']['table1']['big10'] = $big10;
        $this->data['axlevel23']['table1']['n1_loop'] = $axN1Loop->getData();
    }

    public function setTable2(axIt1Loop $axIt1Loop)
    {
        $this->data['axlevel23']['table2']['it1_loop'] = $axIt1Loop->getData();
    }

    public function setTable3(axTxi $axTxi)
    {
        $this->data['axlevel23']['table3']['txi'] = $axTxi->getData();
    }

    public function toXML()
    {
        $xmlString=$this->toXML_low($this->data, "axlevel23");

        return $xmlString;
    }

    private function toXML_low($dataArray, $root)
    {
        $xmlRoot = "";

        foreach ($dataArray as $key => $value)
        {
            if(!is_numeric($key) && $value != "" && $value != null)
            {
                $xmlRoot .= "<$key>";
            }
            else if(is_numeric($key) && $key != "0")
            {
                $xmlRoot .= "</$root><$root>";
            }

            if(is_array($value))
            {
                $xmlRoot .= $this->toXML_low($value, $key);
            }
            else
            {
                $xmlRoot .= $value;
            }

            if(!is_numeric($key) && $value != "" && $value != null)
            {
                $xmlRoot .= "</$key>";
            }
        }

        return $xmlRoot;
    }

    public function getData()
    {
        return $this->data;
    }
}

class axN1Loop
{
    private $template = array (
        'n101' => null ,
        'n102' => null ,
        'n301' => null ,
        'n401' => null ,
        'n402' => null ,
        'n403' => null ,
        'ref' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setN1Loop($n101, $n102, $n301, $n401, $n402, $n403, axRef $ref)
    {
        $this->template['n101'] = $n101;
        $this->template['n102'] = $n102;
        $this->template['n301'] = $n301;
        $this->template['n401'] = $n401;
        $this->template['n402'] = $n402;
        $this->template['n403'] = $n403;
        $this->template['ref'] = $ref->getData();

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}

class axRef
{
    private $template = array (
        'ref01' => null , 'ref02' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setRef($ref01, $ref02)
    {
        $this->template['ref01'] = $ref01;
        $this->template['ref02'] = $ref02;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}

class axIt1Loop
{
    private $template = array(
        'it102' => null, 'it103'  => null, 'it104' => null, 'it105' => null, 'it106s' => null , 'txi' => null , 'pam05' => null, 'pid05' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setIt1Loop($it102, $it103, $it104, $it105, axIt106s $it106s, axTxi $txi, $pam05, $pid05)
    {
        $this->template['it102'] = $it102;
        $this->template['it103'] = $it103;
        $this->template['it104'] = $it104;
        $this->template['it105'] = $it105;
        $this->template['it106s'] = $it106s->getData();
        $this->template['txi'] = $txi->getData();
        $this->template['pam05'] = $pam05;
        $this->template['pid05'] = $pid05;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}

class axIt106s
{
    private $template = array (
        'it10618' => null, 'it10719' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setIt10618($it10618)
    {
        $this->data['it10618'] = $it10618;
    }

    public function setIt10719($it10719)
    {
        $this->data['it10719'] = $it10719;
    }

    public function getData()
    {
        return $this->data;
    }
}

class axTxi
{
    private $template = array (
        'txi01' => null, 'txi02' => null, 'txi03' => null, 'txi06' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setTxi($txi01, $txi02, $txi03, $txi06)
    {
        $this->template['txi01'] = $txi01;
        $this->template['txi02'] = $txi02;
        $this->template['txi03'] = $txi03;
        $this->template['txi06'] = $txi06;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }

}

class mpgAxRaLevel23
{

    private $template = array(
        'axralevel23' => array(
            'airline_process_id' => null,
            'invoice_batch' => null,
            'establishment_name' => null,
            'carrier_name' => null,
            'ticket_id' => null,
            'issue_city' => null,
            'establishment_state' => null,
            'number_in_party' => null,
            'passenger_name' => null,
            'taa_routing' => null,
            'carrier_code' => null,
            'fare_basis' => null,
            'document_type' => null,
            'doc_number' => null,
            'departure_date' => null
        )
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setAxRaLevel23($airline_process_id, $invoice_batch, $establishment_name, $carrier_name, $ticket_id, $issue_city, $establishment_state, $number_in_party, $passenger_name, $taa_routing, $carrier_code, $fare_basis, $document_type, $doc_number, $departure_date)
    {
        $this->data['axralevel23']['airline_process_id'] = $airline_process_id;
        $this->data['axralevel23']['invoice_batch'] = $invoice_batch;
        $this->data['axralevel23']['establishment_name'] = $establishment_name;
        $this->data['axralevel23']['carrier_name'] = $carrier_name;
        $this->data['axralevel23']['ticket_id'] = $ticket_id;
        $this->data['axralevel23']['issue_city'] = $issue_city;
        $this->data['axralevel23']['establishment_state'] = $establishment_state;
        $this->data['axralevel23']['number_in_party'] = $number_in_party;
        $this->data['axralevel23']['passenger_name'] = $passenger_name;
        $this->data['axralevel23']['taa_routing'] = $taa_routing;
        $this->data['axralevel23']['carrier_code'] = $carrier_code;
        $this->data['axralevel23']['fare_basis'] = $fare_basis;
        $this->data['axralevel23']['document_type'] = $document_type;
        $this->data['axralevel23']['doc_number'] = $doc_number;
        $this->data['axralevel23']['departure_date'] = $departure_date;
    }

    public function setAirlineProcessId($airline_process_id)
    {
        $this->data['axralevel23']['airline_process_id'] = $airline_process_id;
    }

    public function setInvoiceBatch($invoice_batch)
    {
        $this->data['axralevel23']['invoice_batch'] = $invoice_batch;
    }

    public function setEstablishmentName($establishment_name)
    {
        $this->data['axralevel23']['establishment_name'] = $establishment_name;
    }

    public function setCarrierName($carrier_name)
    {
        $this->data['axralevel23']['carrier_name'] = $carrier_name;
    }

    public function setTicketId($ticket_id)
    {
        $this->data['axralevel23']['ticket_id'] = $ticket_id;
    }

    public function setIssueCity($issue_city)
    {
        $this->data['axralevel23']['issue_city'] = $issue_city;
    }

    public function setEstablishmentState($establishment_state)
    {
        $this->data['axralevel23']['establishment_state'] = $establishment_state;
    }

    public function setNumberInParty($number_in_party)
    {
        $this->data['axralevel23']['number_in_party'] = $number_in_party;
    }

    public function setPassengerName($passenger_name)
    {
        $this->data['axralevel23']['passenger_name'] = $passenger_name;
    }

    public function setTaaRouting($taa_routing)
    {
        $this->data['axralevel23']['taa_routing'] = $taa_routing;
    }

    public function setCarrierCode($carrier_code)
    {
        $this->data['axralevel23']['carrier_code'] = $carrier_code;
    }

    public function setFareBasis($fare_basis)
    {
        $this->data['axralevel23']['fare_basis'] = $fare_basis;
    }

    public function setDocumentType($document_type)
    {
        $this->data['axralevel23']['document_type'] = $document_type;
    }

    public function setDocNumber($doc_number)
    {
        $this->data['axralevel23']['doc_number'] = $doc_number;
    }

    public function setDepartureDate($departure_date)
    {
        $this->data['axralevel23']['departure_date'] = $departure_date;
    }

    public function toXML()
    {
        $xmlString=$this->toXML_low($this->data, "axralevel23");

        return $xmlString;
    }

    private function toXML_low($dataArray, $root)
    {
        $xmlRoot = "";

        foreach ($dataArray as $key => $value)
        {
            if(!is_numeric($key) && $value != "" && $value != null)
            {
                $xmlRoot .= "<$key>";
            }
            else if(is_numeric($key) && $key != "0")
            {
                $xmlRoot .= "</$root><$root>";
            }

            if(is_array($value))
            {
                $xmlRoot .= $this->toXML_low($value, $key);
            }
            else
            {
                $xmlRoot .= $value;
            }

            if(!is_numeric($key) && $value != "" && $value != null)
            {
                $xmlRoot .= "</$key>";
            }
        }

        return $xmlRoot;
    }

    public function getData()
    {
        return $this->data;
    }
}//end class