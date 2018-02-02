<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 2/2/2018
 * Time: 1:10 PM
 */

namespace busRegistration\Http\PaymentGateway\Moneris\Classes;


/******************* Visa Level23 *******************/
class mpgVsLevel23
{

    private $template = array(
        'corpai' => null,
        'corpas' => null,
        'vspurcha' => null,
        'vspurchl' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setVsCorpa(vsCorpai $vsCorpai, vsCorpas $vsCorpas)
    {
        $this->data['vspurcha'] = null;
        $this->data['vspurchal'] = null;

        $this->data['corpai'] = $vsCorpai->getData();
        $this->data['corpas'] = $vsCorpas->getData();
    }

    public function setVsPurch(vsPurcha $vsPurcha, vsPurchl $vsPurchl)
    {
        $this->data['corpai'] = null;
        $this->data['corpas'] = null;

        $this->data['vspurcha'] = $vsPurcha->getData();
        $this->data['vspurchl'] = $vsPurchl->getData();
    }

    public function toXML()
    {
        $xmlString=$this->toXML_low($this->data, "0");

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

class vsPurcha
{

    private $template = array(
        'buyer_name' => null,
        'local_tax_rate' => null,
        'duty_amount' => null,
        'discount_treatment' => null,
        'discount_amt' => null,
        'freight_amount' => null,
        'ship_to_pos_code' => null,
        'ship_from_pos_code' => null,
        'des_cou_code' => null,
        'vat_ref_num' => null,
        'tax_treatment' => null,
        'gst_hst_freight_amount' => null,
        'gst_hst_freight_rate' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setVsPurcha($buyer_name, $local_tax_rate, $duty_amount, $discount_treatment, $discount_amt, $freight_amount, $ship_to_pos_code, $ship_from_pos_code, $des_cou_code, $vat_ref_num, $tax_treatment, $gst_hst_freight_amount, $gst_hst_freight_rate)
    {
        $this->data['buyer_name'] = $buyer_name;
        $this->data['local_tax_rate'] = $local_tax_rate;
        $this->data['duty_amount'] = $duty_amount;
        $this->data['discount_treatment'] = $discount_treatment;
        $this->data['discount_amt'] = $discount_amt;
        $this->data['freight_amount'] = $freight_amount;
        $this->data['ship_to_pos_code'] = $ship_to_pos_code;
        $this->data['ship_from_pos_code'] = $ship_from_pos_code;
        $this->data['des_cou_code'] = $des_cou_code;
        $this->data['vat_ref_num'] = $vat_ref_num;
        $this->data['tax_treatment'] = $tax_treatment;
        $this->data['gst_hst_freight_amount'] = $gst_hst_freight_amount;
        $this->data['gst_hst_freight_rate'] = $gst_hst_freight_rate;
    }

    public function setBuyerName($buyer_name)
    {
        $this->data['buyer_name'] = $buyer_name;
    }

    public function setLocalTaxRate($local_tax_rate)
    {
        $this->data['local_tax_rate'] = $local_tax_rate;
    }

    public function setDutyAmount($duty_amount)
    {
        $this->data['duty_amount'] = $duty_amount;
    }

    public function setDiscountTreatment($discount_treatment)
    {
        $this->data['discount_treatment'] = $discount_treatment;
    }

    public function setDiscountAmt($discount_amt)
    {
        $this->data['discount_amt'] = $discount_amt;
    }

    public function setFreightAmount($freight_amount)
    {
        $this->data['freight_amount'] = $freight_amount;
    }

    public function setShipToPostalCode($ship_to_pos_code)
    {
        $this->data['ship_to_pos_code'] = $ship_to_pos_code;
    }

    public function setShipFromPostalCode($ship_from_pos_code)
    {
        $this->data['ship_from_pos_code'] = $ship_from_pos_code;
    }

    public function setDesCouCode($des_cou_code)
    {
        $this->data['des_cou_code'] = $des_cou_code;
    }

    public function setVatRefNum($vat_ref_num)
    {
        $this->data['vat_ref_num'] = $vat_ref_num;
    }

    public function setTaxTreatment($tax_treatment)
    {
        $this->data['tax_treatment'] = $tax_treatment;
    }

    public function setGstHstFreightAmount($gst_hst_freight_amount)
    {
        $this->data['gst_hst_freight_amount'] = $gst_hst_freight_amount;
    }

    public function setGstHstFreightRate($gst_hst_freight_rate)
    {
        $this->data['gst_hst_freight_rate'] = $gst_hst_freight_rate;
    }

    public function getData()
    {
        return $this->data;
    }
}//end class

class vsPurchl
{

    private $template = array(
        'item_com_code' => null,
        'product_code' => null,
        'item_description' => null,
        'item_quantity' => null,
        'item_uom' => null,
        'unit_cost' => null,
        'vat_tax_amt' => null,
        'vat_tax_rate' => null,
        'discount_treatment' => null,
        'discount_amt' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setVsPurchl($item_com_code, $product_code, $item_description, $item_quantity, $item_uom, $unit_cost, $vat_tax_amt, $vat_tax_rate, $discount_treatment, $discount_amt)
    {
        $this->template['item_com_code'] = $item_com_code;
        $this->template['product_code'] = $product_code;
        $this->template['item_description'] = $item_description;
        $this->template['item_quantity'] = $item_quantity;
        $this->template['item_uom'] = $item_uom;
        $this->template['unit_cost'] = $unit_cost;
        $this->template['vat_tax_amt'] = $vat_tax_amt;
        $this->template['vat_tax_rate'] = $vat_tax_rate;
        $this->template['discount_treatment'] = $discount_treatment;
        $this->template['discount_amt'] = $discount_amt;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}//end class

class vsCorpai
{

    private $template = array(
        'ticket_number' => null,
        'passenger_name1' => null,
        'total_fee' => null,
        'exchange_ticket_number' => null,
        'exchange_ticket_amount' => null,
        'travel_agency_code' => null,
        'travel_agency_name' => null,
        'internet_indicator' => null,
        'electronic_ticket_indicator' => null,
        'vat_ref_num' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setCorpai($ticket_number, $passenger_name1, $total_fee, $exchange_ticket_number, $exchange_ticket_amount, $travel_agency_code, $travel_agency_name, $internet_indicator, $electronic_ticket_indicator, $vat_ref_num)
    {
        $this->data['ticket_number'] = $ticket_number;
        $this->data['passenger_name1'] = $passenger_name1;
        $this->data['total_fee'] = $total_fee;
        $this->data['exchange_ticket_number'] = $exchange_ticket_number;
        $this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
        $this->data['travel_agency_code'] = $travel_agency_code;
        $this->data['travel_agency_name'] = $travel_agency_name;
        $this->data['internet_indicator'] = $internet_indicator;
        $this->data['electronic_ticket_indicator'] = $electronic_ticket_indicator;
        $this->data['vat_ref_num'] = $vat_ref_num;
    }

    public function setTicketNumber($ticket_number)
    {
        $this->data['ticket_number'] = $ticket_number;
    }

    public function setPassengerName1($passenger_name1)
    {
        $this->data['passenger_name1'] = $passenger_name1;
    }

    public function setTotalFee($total_fee)
    {
        $this->data['total_fee'] = $total_fee;
    }

    public function setExchangeTicketNumber($exchange_ticket_number)
    {
        $this->data['exchange_ticket_number'] = $exchange_ticket_number;
    }

    public function setExchangeTicketAmount($exchange_ticket_amount)
    {
        $this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
    }

    public function setTravelAgencyCode($travel_agency_code)
    {
        $this->data['travel_agency_code'] = $travel_agency_code;
    }

    public function setTravelAgencyName($travel_agency_name)
    {
        $this->data['travel_agency_name'] = $travel_agency_name;
    }

    public function setInternetIndicator($internet_indicator)
    {
        $this->data['internet_indicator'] = $internet_indicator;
    }

    public function setElectronicTicketIndicator($electronic_ticket_indicator)
    {
        $this->data['electronic_ticket_indicator'] = $electronic_ticket_indicator;
    }

    public function setVatRefNum($vat_ref_num)
    {
        $this->data['vat_ref_num'] = $vat_ref_num;
    }

    public function getData()
    {
        return $this->data;
    }
}//end class

class vsCorpas
{

    private $template = array(
        'conjunction_ticket_number' => null,
        'trip_leg_info' => null,
        'control_id' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setCorpas($conjunction_ticket_number, vsTripLegInfo $vsTripLegInfo, $control_id)
    {
        $this->template['conjunction_ticket_number'] = $conjunction_ticket_number;
        $this->template['trip_leg_info'] = $vsTripLegInfo->getData();
        $this->template['control_id'] = $control_id;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}//end class

class vsTripLegInfo
{

    private $template = array(
        'coupon_number' => null,
        'carrier_code1' => null,
        'flight_number' => null,
        'service_class' => null,
        'orig_city_airport_code' => null,
        'stop_over_code' => null,
        'dest_city_airport_code' => null,
        'fare_basis_code' => null,
        'departure_date1' => null,
        'departure_time' => null,
        'arrival_time' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setTripLegInfo($coupon_number, $carrier_code1, $flight_number, $service_class, $orig_city_airport_code, $stop_over_code, $dest_city_airport_code, $fare_basis_code, $departure_date1, $departure_time, $arrival_time)
    {
        $this->template['coupon_number'] = $coupon_number;
        $this->template['carrier_code1'] = $carrier_code1;
        $this->template['flight_number'] = $flight_number;
        $this->template['service_class'] = $service_class;
        $this->template['orig_city_airport_code'] = $orig_city_airport_code;
        $this->template['stop_over_code'] = $stop_over_code;
        $this->template['dest_city_airport_code'] = $dest_city_airport_code;
        $this->template['fare_basis_code'] = $fare_basis_code;
        $this->template['departure_date1'] = $departure_date1;
        $this->template['departure_time'] = $departure_time;
        $this->template['arrival_time'] = $arrival_time;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}//end class