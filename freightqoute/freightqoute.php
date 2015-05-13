<?php
class GetRatingEngineQuote {
  public $request; // QuoteRequest
  public $user; // UserCredential
}

class QuoteRequest {
  public $CustomerId; // int
  public $QuoteType; // QuoteTypeList
  public $ServiceType; // ServiceTypeList
  public $QuoteShipment; // Shipment
  public $BillCollect; // BillCollectType
}

class QuoteTypeList {
  const B2B = 'B2B';
  const eBay = 'eBay';
  const Freightview = 'Freightview';
}

class ServiceTypeList {
  const LTL = 'LTL';
  const Truckload = 'Truckload';
  const Europe = 'Europe';
  const Groupage = 'Groupage';
  const Haulage = 'Haulage';
  const All = 'All';
}

class Shipment {
  public $ShipmentLabel; // string
  public $IsBlind; // boolean
  public $HazardousMaterialContactName; // string
  public $HazardousMaterialContactPhone; // string
  public $PickupDate; // dateTime
  public $SortAndSegregate; // boolean
  public $UseStackableFlag; // boolean
  public $ShipmentLocations; // ArrayOfLocation
  public $ShipmentProducts; // ArrayOfProduct
  public $ShipmentContacts; // ArrayOfContactAddress
  public $AdditionalServices; // ArrayOfString
  public $COD; // COD
}

class Location {
  public $LocationName; // string
  public $LocationType; // LocationTypeList
  public $RequiresArrivalNotification; // boolean
  public $HasLoadingDock; // boolean
  public $IsConstructionSite; // boolean
  public $RequiresInsideDelivery; // boolean
  public $IsTradeShow; // boolean
  public $TradeShow; // string
  public $IsResidential; // boolean
  public $RequiresLiftgate; // boolean
  public $ContactName; // string
  public $ContactPhone; // string
  public $ContactEmail; // string
  public $ContactFax; // string
  public $BeforeTime; // string
  public $AfterTime; // string
  public $LocationReference; // string
  public $LocationNote; // string
  public $NotificationMethod; // NotificationMethodList
  public $HasDeliveryAppointment; // boolean
  public $IsLimitedAccess; // boolean
  public $LocationAddress; // PostalAddress
  public $AdditionalServices; // ArrayOfString
}

class LocationTypeList {
  const Origin = 'Origin';
  const Destination = 'Destination';
  const StopoffPickupDelivery = 'StopoffPickupDelivery';
  const StopoffDelivery = 'StopoffDelivery';
  const StopoffPickup = 'StopoffPickup';
}

class NotificationMethodList {
  const None = 'None';
  const Email = 'Email';
  const Fax = 'Fax';
  const InternalEmail = 'InternalEmail';
}

class PostalAddress {
  public $AddressName; // string
  public $StreetAddress; // string
  public $AdditionalAddress; // string
  public $City; // string
  public $StateCode; // string
  public $PostalCode; // string
  public $CountryCode; // string
}

class ContactAddress {
  public $ContactName; // string
  public $ContactPhone; // string
  public $ContactFax; // string
  public $EmailAddress; // string
  public $ContactAddressType; // ContactAddressTypeList
  public $ContactNote; // string
}

class ContactAddressTypeList {
  const Unknown = 'Unknown';
  const ThirdPartyBillTo = 'ThirdPartyBillTo';
  const CanadianBroker = 'CanadianBroker';
  const Insurance = 'Insurance';
  const IntermediateConsignee = 'IntermediateConsignee';
  const FreightForwarder = 'FreightForwarder';
}

class Product {
  public $Class; // string
  public $Weight; // int
  public $Length; // int
  public $Width; // int
  public $Height; // int
  public $ProductDescription; // string
  public $PackageType; // PackageTypeList
  public $IsStackable; // boolean
  public $DeclaredValue; // double
  public $CommodityType; // CommodityTypeList
  public $ContentType; // ContentTypeList
  public $IsHazardousMaterial; // boolean
  public $NMFC; // string
  public $DimWeight; // int
  public $EstimatedWeight; // int
  public $PieceCount; // int
  public $ItemNumber; // int
  public $STC; // int
  public $Cube; // int
}

class PackageTypeList {
  const Unknown = 'Unknown';
  const Pallets_48x40 = 'Pallets_48x40';
  const Pallets_other = 'Pallets_other';
  const Bags = 'Bags';
  const Bales = 'Bales';
  const Boxes = 'Boxes';
  const Bundles = 'Bundles';
  const Carpets = 'Carpets';
  const Coils = 'Coils';
  const Crates = 'Crates';
  const Cylinders = 'Cylinders';
  const Drums = 'Drums';
  const Pails = 'Pails';
  const Reels = 'Reels';
  const Rolls = 'Rolls';
  const TubesPipes = 'TubesPipes';
  const Motorcycle = 'Motorcycle';
  const ATV = 'ATV';
  const Pallets_120x120 = 'Pallets_120x120';
  const Pallets_120x100 = 'Pallets_120x100';
  const Pallets_120x80 = 'Pallets_120x80';
  const Pallets_europe = 'Pallets_europe';
  const Pallets_48x48 = 'Pallets_48x48';
  const Pallets_60x48 = 'Pallets_60x48';
  const SlipSheets = 'SlipSheets';
  const Unit = 'Unit';
}

class CommodityTypeList {
  const GeneralMerchandise = 'GeneralMerchandise';
  const Machinery = 'Machinery';
  const HouseholdGoods = 'HouseholdGoods';
  const FragileGoods = 'FragileGoods';
  const ComputerHardware = 'ComputerHardware';
  const BottledProducts = 'BottledProducts';
  const BottleBeverages = 'BottleBeverages';
  const NonPerishableFood = 'NonPerishableFood';
  const SteelSheet = 'SteelSheet';
  const BrandedGoods = 'BrandedGoods';
  const PrecisionInstruments = 'PrecisionInstruments';
  const ChemicalsHazardous = 'ChemicalsHazardous';
  const FineArt = 'FineArt';
  const Automobiles = 'Automobiles';
  const CellPhones = 'CellPhones';
  const NewMachinery = 'NewMachinery';
  const UsedMachinery = 'UsedMachinery';
  const HotTubs = 'HotTubs';
}

class ContentTypeList {
  const NewCommercialGoods = 'NewCommercialGoods';
  const UsedCommercialGoods = 'UsedCommercialGoods';
  const HouseholdGoods = 'HouseholdGoods';
  const FragileGoods = 'FragileGoods';
  const Automobile = 'Automobile';
  const Motorcycle = 'Motorcycle';
  const AutoOrMotorcycle = 'AutoOrMotorcycle';
}

class COD {
  public $Amount; // decimal
  public $RemitTo; // string
  public $Addr1; // string
  public $Addr2; // string
  public $City; // string
  public $State; // string
  public $Zip; // string
  public $CareOf; // string
  public $Type; // int
  public $PaymentType; // int
}

class BillCollectType {
  const NONE = 'NONE';
  const SITE = 'SITE';
  const SHIPPER = 'SHIPPER';
  const RECEIVER = 'RECEIVER';
}

class UserCredential {
  public $Name; // string
  public $Password; // string
}

class BaseDomain {
}

class GetRatingEngineQuoteResponse {
  public $GetRatingEngineQuoteResult; // QuoteResponse
}

class QuoteResponse {
  public $QuoteId; // int
  public $QuoteDateTime; // dateTime
  public $QuoteExpiration; // dateTime
  public $QuoteDurationMilliseconds; // int
  public $UnitOfMeasureType; // UnitOfMeasureTypeList
  public $QuoteCarrierOptions; // ArrayOfCarrierOption
  public $ValidationErrors; // ArrayOfB2BError
}

class UnitOfMeasureTypeList {
  const English = 'English';
  const Meteric = 'Meteric';
}

class CarrierOption {
  public $CarrierOptionId; // int
  public $CarrierName; // string
  public $QuoteAmount; // double
  public $Currency; // CurrencyList
  public $IsGuaranteed; // boolean
  public $IsTMS; // boolean
  public $Transit; // string
  public $TariffMultiplier; // double
  public $Mode; // string
  public $ProviderList; // ArrayOfInt
  public $CarrierAccessorials; // ArrayOfAccessorial
  public $CarrierLiability; // Liability
  public $CarrierBrandName; // string
}

class CurrencyList {
  const USD = 'USD';
  const EUR = 'EUR';
  const GBP = 'GBP';
}

class Accessorial {
  public $AccessorialId; // int
  public $AccessorialDescription; // string
  public $AccessorialCharge; // double
}

class Liability {
  public $CostPerWeight; // double
  public $MaximumLimit; // double
  public $CurrencyCode; // CurrencyList
  public $ExchangeRate; // double
  public $CurrencySymbol; // string
  public $IsNoReclass; // boolean
}

class FVCarrierOption {
  public $CarrierCost; // double
  public $CarrierID; // int
}

class B2BError {
  public $ErrorType; // B2BErrorTypeList
  public $ErrorMessage; // string
}

class B2BErrorTypeList {
  const Unknown = 'Unknown';
  const Validation = 'Validation';
  const Communication = 'Communication';
  const AccessDenied = 'AccessDenied';
  const CustomerAccount = 'CustomerAccount';
  const Booking = 'Booking';
}

class RequestShipmentPickup {
  public $request; // PickupRequest
  public $user; // UserCredential
}

class PickupRequest {
  public $CustomerId; // int
  public $QuoteId; // int
  public $OptionId; // int
  public $ShipmentNote; // string
  public $QuoteShipment; // Shipment
  public $QuoteCustomer; // Customer
  public $BillOfLadingType; // int
}

class Customer {
  public $CustomerId; // int
  public $CustTypeId; // short
  public $CustomerName; // string
  public $AssociationId; // int
  public $CustomerDiscount; // short
  public $BillCollect; // string
  public $ChannelId; // int
  public $TotalOwed; // double
  public $CreditLimit; // double
  public $CommissionRepId; // int
  public $IsTestAccount; // boolean
  public $PhoneNumber; // string
  public $Currency; // CurrencyList
  public $ExchangeRate; // double
  public $Culture; // string
  public $FreightviewAuthenticationId; // int
  public $FreightviewAuthenticationKey; // int
  public $FreightviewLocationId; // int
}

class RequestShipmentPickupResponse {
  public $RequestShipmentPickupResult; // PickupResponse
}

class PickupResponse {
  public $QuoteId; // int
  public $BillToAddress; // BillingAddress
  public $BillOfLadingURL; // string
  public $ValidationErrors; // ArrayOfB2BError
  public $SpecialInstructions; // string
  public $TerminalProfileOrigination; // TerminalProfile
  public $TerminalProfileDestination; // TerminalProfile
}

class BillingAddress {
  public $ContactName; // string
  public $ContactPhone; // string
}

class TerminalProfile {
  public $CarrierId; // int
  public $TerminalCode; // string
  public $TerminalType; // int
  public $Name; // string
  public $Address1; // string
  public $Address2; // string
  public $City; // string
  public $State; // string
  public $Zip; // string
  public $Contact; // string
  public $Title; // string
  public $Phone; // string
  public $Fax; // string
  public $Email; // string
  public $Phone800; // string
  public $SCAC; // string
  public $LastReceiving; // string
  public $TerminalServiceType; // int
}

class RequestCustomQuote {
  public $request; // CustomQuote
  public $user; // UserCredential
}

class CustomQuote {
  public $ContactEmail; // string
  public $SpecialInstructions; // string
  public $QuoteId; // int
  public $ServiceLevel; // ServiceLevelList
  public $QuoteRequest; // QuoteRequest
  public $ValidationErrors; // ArrayOfB2BError
}

class ServiceLevelList {
  const RoadStandard = 'RoadStandard';
  const RoadExpress = 'RoadExpress';
  const WorldwideAir = 'WorldwideAir';
  const WorldwideSea = 'WorldwideSea';
  const Road = 'Road';
}

class RequestCustomQuoteResponse {
  public $RequestCustomQuoteResult; // QuoteResponse
}

class RequestPalletPacking {
  public $request; // PackingRequest
  public $user; // UserCredential
}

class PackingRequest {
  public $PalletLength; // double
  public $PalletWidth; // double
  public $PalletHeight; // double
  public $TruckLength; // double
  public $TruckWidth; // double
  public $TruckHeight; // double
  public $LinearFootFactor; // double
  public $Items; // ArrayOfProduct
}

class RequestPalletPackingResponse {
  public $RequestPalletPackingResult; // PackingResponse
}

class PackingResponse {
  public $PalletSpaces; // int
  public $UsedLength; // int
  public $UsedWidth; // int
  public $UsedArea; // int
  public $LinearFeet; // int
  public $IsOverflowed; // boolean
  public $Effiency; // double
  public $ValidationErrors; // ArrayOfB2BError
}

class GetTrackingInformation {
  public $request; // TrackingRequest
}

class TrackingRequest {
  public $BOLNumber; // int
}

class GetTrackingInformationResponse {
  public $GetTrackingInformationResult; // TrackingResponse
}

class TrackingResponse {
  public $BOLNumber; // int
  public $EstimatedDelivery; // dateTime
  public $TrackingLogs; // ArrayOfTrackingLog
  public $ValidationErrors; // ArrayOfB2BError
}

class TrackingLog {
  public $Date; // dateTime
  public $Status; // string
  public $StatusDescription; // string
}


/**
 * QuoteService class
 * 
 *  
 * 
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */
class QuoteService extends SoapClient {

  private static $classmap = array(
                                    'GetRatingEngineQuote' => 'GetRatingEngineQuote',
                                    'QuoteRequest' => 'QuoteRequest',
                                    'QuoteTypeList' => 'QuoteTypeList',
                                    'ServiceTypeList' => 'ServiceTypeList',
                                    'Shipment' => 'Shipment',
                                    'Location' => 'Location',
                                    'LocationTypeList' => 'LocationTypeList',
                                    'NotificationMethodList' => 'NotificationMethodList',
                                    'PostalAddress' => 'PostalAddress',
                                    'ContactAddress' => 'ContactAddress',
                                    'ContactAddressTypeList' => 'ContactAddressTypeList',
                                    'Product' => 'Product',
                                    'PackageTypeList' => 'PackageTypeList',
                                    'CommodityTypeList' => 'CommodityTypeList',
                                    'ContentTypeList' => 'ContentTypeList',
                                    'COD' => 'COD',
                                    'BillCollectType' => 'BillCollectType',
                                    'UserCredential' => 'UserCredential',
                                    'BaseDomain' => 'BaseDomain',
                                    'GetRatingEngineQuoteResponse' => 'GetRatingEngineQuoteResponse',
                                    'QuoteResponse' => 'QuoteResponse',
                                    'UnitOfMeasureTypeList' => 'UnitOfMeasureTypeList',
                                    'CarrierOption' => 'CarrierOption',
                                    'CurrencyList' => 'CurrencyList',
                                    'Accessorial' => 'Accessorial',
                                    'Liability' => 'Liability',
                                    'FVCarrierOption' => 'FVCarrierOption',
                                    'B2BError' => 'B2BError',
                                    'B2BErrorTypeList' => 'B2BErrorTypeList',
                                    'RequestShipmentPickup' => 'RequestShipmentPickup',
                                    'PickupRequest' => 'PickupRequest',
                                    'Customer' => 'Customer',
                                    'RequestShipmentPickupResponse' => 'RequestShipmentPickupResponse',
                                    'PickupResponse' => 'PickupResponse',
                                    'BillingAddress' => 'BillingAddress',
                                    'TerminalProfile' => 'TerminalProfile',
                                    'RequestCustomQuote' => 'RequestCustomQuote',
                                    'CustomQuote' => 'CustomQuote',
                                    'ServiceLevelList' => 'ServiceLevelList',
                                    'RequestCustomQuoteResponse' => 'RequestCustomQuoteResponse',
                                    'RequestPalletPacking' => 'RequestPalletPacking',
                                    'PackingRequest' => 'PackingRequest',
                                    'RequestPalletPackingResponse' => 'RequestPalletPackingResponse',
                                    'PackingResponse' => 'PackingResponse',
                                    'GetTrackingInformation' => 'GetTrackingInformation',
                                    'TrackingRequest' => 'TrackingRequest',
                                    'GetTrackingInformationResponse' => 'GetTrackingInformationResponse',
                                    'TrackingResponse' => 'TrackingResponse',
                                    'TrackingLog' => 'TrackingLog',
                                   );

  public function QuoteService($wsdl = "http://b2b.freightquote.com/WebService/QuoteService.asmx?WSDL", $options = array()) {
    foreach(self::$classmap as $key => $value) {
      if(!isset($options['classmap'][$key])) {
        $options['classmap'][$key] = $value;
      }
    }
    parent::__construct($wsdl, $options);
  }

  /**
   *  
   *
   * @param GetRatingEngineQuote $parameters
   * @return GetRatingEngineQuoteResponse
   */
  public function GetRatingEngineQuote(GetRatingEngineQuote $parameters) {
    return $this->__soapCall('GetRatingEngineQuote', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param RequestShipmentPickup $parameters
   * @return RequestShipmentPickupResponse
   */
  public function RequestShipmentPickup(RequestShipmentPickup $parameters) {
    return $this->__soapCall('RequestShipmentPickup', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param RequestCustomQuote $parameters
   * @return RequestCustomQuoteResponse
   */
  public function RequestCustomQuote(RequestCustomQuote $parameters) {
    return $this->__soapCall('RequestCustomQuote', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param RequestPalletPacking $parameters
   * @return RequestPalletPackingResponse
   */
  public function RequestPalletPacking(RequestPalletPacking $parameters) {
    return $this->__soapCall('RequestPalletPacking', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetTrackingInformation $parameters
   * @return GetTrackingInformationResponse
   */
  public function GetTrackingInformation(GetTrackingInformation $parameters) {
    return $this->__soapCall('GetTrackingInformation', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

}
