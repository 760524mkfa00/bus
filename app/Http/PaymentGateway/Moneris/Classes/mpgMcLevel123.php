<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 2/2/2018
 * Time: 1:11 PM
 */

namespace busRegistration\Http\PaymentGateway\Moneris\Classes;


/**************** MasterCard Level23 ****************/

class mpgMcLevel23
{

    private $template = array(
        'mccorpac' => null,
        'mccorpai' => null,
        'mccorpas' => null,
        'mccorpal' => null,
        'mccorpar' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setMcCorpac(mcCorpac $mcCorpac)
    {
        $this->data['mccorpac'] = $mcCorpac->getData();
    }

    public function setMcCorpai(mcCorpai $mcCorpai)
    {
        $this->data['mccorpai'] = $mcCorpai->getData();
    }

    public function setMcCorpas(mcCorpas $mcCorpas)
    {
        $this->data['mccorpas'] = $mcCorpas->getData();
    }

    public function setMcCorpal(mcCorpal $mcCorpal)
    {
        $this->data['mccorpal'] = $mcCorpal->getData();
    }

    public function setMcCorpar(mcCorpar $mcCorpar)
    {
        $this->data['mccorpar'] = $mcCorpar->getData();
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


class mcCorpac
{

    private $template = array(
        'customer_code1' => null,
        'additional_card_acceptor_data' => null,
        'austin_tetra_number' => null,
        'naics_code' => null,
        'card_acceptor_type' => null,
        'card_acceptor_tax_id' => null,
        'corporation_vat_number' => null,
        'card_acceptor_reference_number' => null,
        'freight_amount1' => null,
        'duty_amount1' => null,
        'ship_to_pos_code' => null,
        'destination_province_code' => null,
        'destination_country_code' => null,
        'ship_from_pos_code' => null,
        'order_date' => null,
        'card_acceptor_vat_number' => null,
        'customer_vat_number' => null,
        'unique_invoice_number' => null,
        'commodity_code' => null,
        'authorized_contact_name' => null,
        'authorized_contact_phone' => null,
        'tax' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setMcCorpac($customer_code1, $additional_card_acceptor_data, $austin_tetra_number, $naics_code, $card_acceptor_type, $card_acceptor_tax_id, $corporation_vat_number, $card_acceptor_reference_number, $freight_amount1, $duty_amount1, $ship_to_pos_code, $destination_province_code, $destination_country_code, $ship_from_pos_code, $order_date, $card_acceptor_vat_number, $customer_vat_number, $unique_invoice_number, $commodity_code, $authorized_contact_name, $authorized_contact_phone, mcTax $mctax)
    {
        $this->data['customer_code1'] = $customer_code1;
        $this->data['additional_card_acceptor_data'] = $additional_card_acceptor_data;
        $this->data['austin_tetra_number'] = $austin_tetra_number;
        $this->data['naics_code'] = $naics_code;
        $this->data['card_acceptor_type'] = $card_acceptor_type;
        $this->data['card_acceptor_tax_id'] = $card_acceptor_tax_id;
        $this->data['corporation_vat_number'] = $corporation_vat_number;
        $this->data['card_acceptor_reference_number'] = $card_acceptor_reference_number;
        $this->data['freight_amount1'] = $freight_amount1;
        $this->data['duty_amount1'] = $duty_amount1;
        $this->data['ship_to_pos_code'] = $ship_to_pos_code;
        $this->data['destination_province_code'] = $destination_province_code;
        $this->data['destination_country_code'] = $destination_country_code;
        $this->data['ship_from_pos_code'] = $ship_from_pos_code;
        $this->data['order_date'] = $order_date;
        $this->data['card_acceptor_vat_number'] = $card_acceptor_vat_number;
        $this->data['customer_vat_number'] = $customer_vat_number;
        $this->data['unique_invoice_number'] = $unique_invoice_number;
        $this->data['commodity_code'] = $commodity_code;
        $this->data['authorized_contact_name'] = $authorized_contact_name;
        $this->data['authorized_contact_phone'] = $authorized_contact_phone;
        $this->data['tax'] = $mctax->getData();
    }

    public function setCustomerCode1($customer_code1)
    {
        $this->data['customer_code1'] = $customer_code1;
    }

    public function setAdditionalCardAcceptorData($additional_card_acceptor_data)
    {
        $this->data['additional_card_acceptor_data'] = $additional_card_acceptor_data;
    }

    public function setAustinTetraNumber($austin_tetra_number)
    {
        $this->data['austin_tetra_number'] = $austin_tetra_number;
    }

    public function setNaicsCode($naics_code)
    {
        $this->data['naics_code'] = $naics_code;
    }

    public function setCardAcceptorType($card_acceptor_type)
    {
        $this->data['card_acceptor_type'] = $card_acceptor_type;
    }

    public function setCardAcceptorTaxTd($card_acceptor_tax_id)
    {
        $this->data['card_acceptor_tax_id'] = $card_acceptor_tax_id;
    }

    public function setCorporationVatNumber($corporation_vat_number)
    {
        $this->data['corporation_vat_number'] = $corporation_vat_number;
    }

    public function setCardAcceptorReferenceNumber($card_acceptor_reference_number)
    {
        $this->data['card_acceptor_reference_number'] = $card_acceptor_reference_number;
    }

    public function setFreightAmount1($freight_amount1)
    {
        $this->data['freight_amount1'] = $freight_amount1;
    }

    public function setDutyAmount1($duty_amount1)
    {
        $this->data['duty_amount1'] = $duty_amount1;
    }

    public function setShipToPosCode($ship_to_pos_code)
    {
        $this->data['ship_to_pos_code'] = $ship_to_pos_code;
    }

    public function setDestinationProvinceCode($destination_province_code)
    {
        $this->data['destination_province_code'] = $destination_province_code;
    }

    public function setDestinationCountryCode($destination_country_code)
    {
        $this->data['destination_country_code'] = $destination_country_code;
    }

    public function setShipFromPosCode($ship_from_pos_code)
    {
        $this->data['ship_from_pos_code'] = $ship_from_pos_code;
    }

    public function setOrderDate($order_date)
    {
        $this->data['order_date'] = $order_date;
    }

    public function setCardAcceptorVatNumber($card_acceptor_vat_number)
    {
        $this->data['card_acceptor_vat_number'] = $card_acceptor_vat_number;
    }

    public function setCustomerVatNumber($customer_vat_number)
    {
        $this->data['customer_vat_number'] = $customer_vat_number;
    }

    public function setUniqueInvoiceNumber($unique_invoice_number)
    {
        $this->data['unique_invoice_number'] = $unique_invoice_number;
    }

    public function setCommodityCode($commodity_code)
    {
        $this->data['commodity_code'] = $commodity_code;
    }

    public function setAuthorizedContactName($authorized_contact_name)
    {
        $this->data['authorized_contact_name'] = $authorized_contact_name;
    }

    public function setAuthorizedContactPhone($authorized_contact_phone)
    {
        $this->data['authorized_contact_phone'] = $authorized_contact_phone;
    }

    public function setTax(mcTax $mcTax)
    {
        $this->data['tax'] = $mcTax->getData();
    }

    public function getData()
    {
        return $this->data;
    }
}//end class


class mcCorpai
{

    private $template = array(
        'passenger_name1' => null,
        'ticket_number1' => null,
        'issuing_carrier' => null,
        'customer_code1' => null,
        'issue_date' => null,
        'travel_agency_code' => null,
        'travel_agency_name' => null,
        'total_fare' => null,
        'total_fee' => null,
        'total_taxes' => null,
        'commodity_code' => null,
        'restricted_ticket_indicator' => null,
        'exchange_ticket_amount' => null,
        'exchange_fee_amount' => null,
        'travel_authorization_code' => null,
        'iata_client_code' => null,
        'tax' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = $this->template;
    }

    public function setMcCorpai($passenger_name1, $ticket_number1, $issuing_carrier, $customer_code1, $issue_date, $travel_agency_code, $travel_agency_name, $total_fare, $total_fee, $total_taxes, $commodity_code, $restricted_ticket_indicator, $exchange_ticket_amount, $exchange_fee_amount, $travel_authorization_code, $iata_client_code, mcTax $mctax)
    {
        $this->data['passenger_name1'] = $passenger_name1;
        $this->data['ticket_number1'] = $ticket_number1;
        $this->data['issuing_carrier'] = $issuing_carrier;
        $this->data['customer_code1'] = $customer_code1;
        $this->data['issue_date'] = $issue_date;
        $this->data['travel_agency_code'] = $travel_agency_code;
        $this->data['travel_agency_name'] = $travel_agency_name;
        $this->data['total_fare'] = $total_fare;
        $this->data['total_fee'] = $total_fee;
        $this->data['total_taxes'] = $total_taxes;
        $this->data['commodity_code'] = $commodity_code;
        $this->data['restricted_ticket_indicator'] = $restricted_ticket_indicator;
        $this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
        $this->data['exchange_fee_amount'] = $exchange_fee_amount;
        $this->data['travel_authorization_code'] = $travel_authorization_code;
        $this->data['iata_client_code'] = $iata_client_code;
        $this->data['tax'] = $mctax->getData();
    }

    public function setPassengerName1($passenger_name1)
    {
        $this->data['passenger_name1'] = $passenger_name1;
    }

    public function setTicketNumber1($ticket_number1)
    {
        $this->data['ticket_number1'] = $ticket_number1;
    }

    public function setIssuingCarrier($issuing_carrier)
    {
        $this->data['issuing_carrier'] = $issuing_carrier;
    }

    public function setCustomerCode1($customer_code1)
    {
        $this->data['customer_code1'] = $customer_code1;
    }

    public function setIssueDate($issue_date)
    {
        $this->data['issue_date'] = $issue_date;
    }

    public function setTravelAgencyCode($travel_agency_code)
    {
        $this->data['travel_agency_code'] = $travel_agency_code;
    }

    public function setTravelAgencyName($travel_agency_name)
    {
        $this->data['travel_agency_name'] = $travel_agency_name;
    }

    public function setTotalFare($total_fare)
    {
        $this->data['total_fare'] = $total_fare;
    }

    public function setTotalFee($total_fee)
    {
        $this->data['total_fee'] = $total_fee;
    }

    public function setTotalTaxes($total_taxes)
    {
        $this->data['total_taxes'] = $total_taxes;
    }

    public function setCommodityCode($commodity_code)
    {
        $this->data['commodity_code'] = $commodity_code;
    }

    public function setRestrictedTicketIndicator($restricted_ticket_indicator)
    {
        $this->data['restricted_ticket_indicator'] = $restricted_ticket_indicator;
    }

    public function setExchangeTicketAmount($exchange_ticket_amount)
    {
        $this->data['exchange_ticket_amount'] = $exchange_ticket_amount;
    }

    public function setExchangeFeeAmount($exchange_fee_amount)
    {
        $this->data['exchange_fee_amount'] = $exchange_fee_amount;
    }

    public function setTravelAuthorizationCode($travel_authorization_code)
    {
        $this->data['travel_authorization_code'] = $travel_authorization_code;
    }

    public function setIataClientCode($iata_client_code)
    {
        $this->data['iata_client_code'] = $iata_client_code;
    }

    public function setTax(mcTax $mcTax)
    {
        $this->data['tax'] = $mcTax->getData();
    }


    public function getData()
    {
        return $this->data;
    }
}//end class


class mcCorpas
{

    private $template = array(
        'travel_date' => null,
        'carrier_code1' => null,
        'service_class' => null,
        'orig_city_airport_code' => null,
        'dest_city_airport_code' => null,
        'stop_over_code' => null,
        'conjunction_ticket_number1' => null,
        'exchange_ticket_number' => null,
        'coupon_number1' => null,
        'fare_basis_code1' => null,
        'flight_number' => null,
        'departure_time' => null,
        'arrival_time' => null,
        'fare' => null,
        'fee' => null,
        'taxes' => null,
        'endorsement_restrictions' => null,
        'tax' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setMcCorpas($travel_date, $carrier_code1, $service_class, $orig_city_airport_code, $dest_city_airport_code, $stop_over_code, $conjunction_ticket_number1, $exchange_ticket_number1, $coupon_number1, $fare_basis_code1, $flight_number, $departure_time, $arrival_time, $fare, $fee, $taxes, $endorsement_restrictions, mcTax $mcTax)
    {
        $this->template['travel_date'] = $travel_date;
        $this->template['carrier_code1'] = $carrier_code1;
        $this->template['service_class'] = $service_class;
        $this->template['orig_city_airport_code'] = $orig_city_airport_code;
        $this->template['dest_city_airport_code'] = $dest_city_airport_code;
        $this->template['stop_over_code'] = $stop_over_code;
        $this->template['conjunction_ticket_number1'] = $conjunction_ticket_number1;
        $this->template['exchange_ticket_number1'] = $exchange_ticket_number1;
        $this->template['coupon_number1'] = $coupon_number1;
        $this->template['fare_basis_code1'] = $fare_basis_code1;
        $this->template['flight_number'] = $flight_number;
        $this->template['departure_time'] = $departure_time;
        $this->template['arrival_time'] = $arrival_time;
        $this->template['fare'] = $fare;
        $this->template['fee'] = $fee;
        $this->template['taxes'] = $taxes;
        $this->template['endorsement_restrictions'] = $endorsement_restrictions;
        $this->template['tax'] = $mcTax->getData();

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}//end class



class mcCorpal
{

    private $template = array(
        'customer_code1' => null,
        'line_item_date' => null,
        'ship_date' => null,
        'order_date' => null,
        'medical_services_ship_to_health_industry_number' => null,
        'contract_number' => null,
        'medical_services_adjustment' => null,
        'medical_services_product_number_qualifier' => null,
        'product_code1' => null,
        'item_description' => null,
        'item_quantity' => null,
        'unit_cost' => null,
        'item_unit_measure' => null,
        'ext_item_amount' => null,
        'discount_amount' => null,
        'commodity_code' => null,
        'type_of_supply' => null,
        'vat_ref_num' => null,
        'tax' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setMcCorpal($customer_code1, $line_item_date, $ship_date, $order_date, $medical_services_ship_to_health_industry_number, $contract_number, $medical_services_adjustment, $medical_services_product_number_qualifier, $product_code1, $item_description, $item_quantity, $unit_cost, $item_unit_measure, $ext_item_amount, $discount_amount, $commodity_code, $type_of_supply, $vat_ref_num, mcTax $mcTax)
    {
        $this->template['customer_code1'] = $customer_code1;
        $this->template['line_item_date'] = $line_item_date;
        $this->template['ship_date'] = $ship_date;
        $this->template['order_date'] = $order_date;
        $this->template['medical_services_ship_to_health_industry_number'] = $medical_services_ship_to_health_industry_number;
        $this->template['contract_number'] = $contract_number;
        $this->template['medical_services_adjustment'] = $medical_services_adjustment;
        $this->template['medical_services_product_number_qualifier'] = $medical_services_product_number_qualifier;
        $this->template['product_code1'] = $product_code1;
        $this->template['item_description'] = $item_description;
        $this->template['item_quantity'] = $item_quantity;
        $this->template['unit_cost'] = $unit_cost;
        $this->template['item_unit_measure'] = $item_unit_measure;
        $this->template['ext_item_amount'] = $ext_item_amount;
        $this->template['discount_amount'] = $discount_amount;
        $this->template['commodity_code'] = $commodity_code;
        $this->template['type_of_supply'] = $type_of_supply;
        $this->template['vat_ref_num'] = $vat_ref_num;
        $this->template['tax'] = $mcTax->getData();

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}//end class



class mcCorpar
{

    private $template = array(
        'passenger_name1' => null,
        'ticket_number1' => null,
        'travel_agency_code' => null,
        'travel_agency_name' => null,
        'travel_date' => null,
        'sequence_number' => null,
        'procedure_id' => null,
        'service_type' => null,
        'service_nature' => null,
        'service_amount' => null,
        'full_vat_gross_amount' => null,
        'full_vat_tax_amount' => null,
        'half_vat_gross_amount' => null,
        'half_vat_tax_amount' => null,
        'traffic_code' => null,
        'sample_number' => null,
        'start_station' => null,
        'destination_station' => null,
        'generic_code' => null,
        'generic_number' => null,
        'generic_other_code' => null,
        'generic_other_number' => null,
        'reduction_code' => null,
        'reduction_number' => null,
        'reduction_other_code' => null,
        'reduction_other_number' => null,
        'transportation_other_code' => null,
        'number_of_adults' => null,
        'number_of_children' => null,
        'class_of_ticket' => null,
        'transportation_service_provider' => null,
        'transportation_service_offered' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setMcCorpar($passenger_name1, $ticket_number1, $travel_agency_code, $travel_agency_name, $travel_date, $sequence_number, $procedure_id, $service_type, $service_nature, $service_amount, $full_vat_gross_amount, $full_vat_tax_amount, $half_vat_gross_amount, $half_vat_tax_amount, $traffic_code, $sample_number, $start_station, $destination_station, $generic_code, $generic_number, $generic_other_code, $generic_other_number, $reduction_code, $reduction_number, $reduction_other_code, $reduction_other_number, $transportation_other_code, $number_of_adults, $number_of_children, $class_of_ticket, $transportation_service_provider, $transportation_service_offered)
    {
        $this->template['passenger_name1'] = $passenger_name1;
        $this->template['ticket_number1'] = $ticket_number1;
        $this->template['travel_agency_code'] = $travel_agency_code;
        $this->template['travel_agency_name'] = $travel_agency_name;
        $this->template['travel_date'] = $travel_date;
        $this->template['sequence_number'] = $sequence_number;
        $this->template['procedure_id'] = $procedure_id;
        $this->template['service_type'] = $service_type;
        $this->template['service_nature'] = $service_nature;
        $this->template['service_amount'] = $service_amount;
        $this->template['full_vat_gross_amount'] = $full_vat_gross_amount;
        $this->template['full_vat_tax_amount'] = $full_vat_tax_amount;
        $this->template['half_vat_gross_amount'] = $half_vat_gross_amount;
        $this->template['half_vat_tax_amount'] = $half_vat_tax_amount;
        $this->template['traffic_code'] = $traffic_code;
        $this->template['sample_number'] = $sample_number;
        $this->template['start_station'] = $start_station;
        $this->template['destination_station'] = $destination_station;
        $this->template['generic_code'] = $generic_code;
        $this->template['generic_number'] = $generic_number;
        $this->template['generic_other_code'] = $generic_other_code;
        $this->template['generic_other_number'] = $generic_other_number;
        $this->template['reduction_code'] = $reduction_code;
        $this->template['reduction_number'] = $reduction_number;
        $this->template['reduction_other_code'] = $reduction_other_code;
        $this->template['reduction_other_number'] = $reduction_other_number;
        $this->template['transportation_other_code'] = $transportation_other_code;
        $this->template['number_of_adults'] = $number_of_adults;
        $this->template['number_of_children'] = $number_of_children;
        $this->template['class_of_ticket'] = $class_of_ticket;
        $this->template['transportation_service_provider'] = $transportation_service_provider;
        $this->template['transportation_service_offered'] = $transportation_service_offered;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}//end class


class mcTax
{
    private $template = array (
        'tax_amount' => null,
        'tax_rate' => null,
        'tax_type' => null,
        'tax_id' => null,
        'tax_included_in_sales' => null
    );

    private $data;

    public function __construct()
    {
        $this->data = array();
    }

    public function setTax($tax_amount, $tax_rate, $tax_type, $tax_id, $tax_included_in_sales)
    {
        $this->template['tax_amount'] = $tax_amount;
        $this->template['tax_rate'] = $tax_rate;
        $this->template['tax_type'] = $tax_type;
        $this->template['tax_id'] = $tax_id;
        $this->template['tax_included_in_sales'] = $tax_included_in_sales;

        array_push($this->data, $this->template);
    }

    public function getData()
    {
        return $this->data;
    }
}