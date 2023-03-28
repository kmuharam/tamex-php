<?php

namespace Kmuharam\Tamex\Requests;

class CreateShipmentRequest
{
    /**
     * @var string
     */
    public string $apiKey = '';

    /**
     * Enum: [1: Delivery, 2: Pickup].
     *
     * @var string
     */
    public string $packType = '';

    /**
     * @var string
     */
    public string $packAWB = '';

    /**
     * @var string
     */
    public string $packVendorId = '';

    /**
     * @var string
     */
    public string $packReciverName = '';

    /**
     * @var string
     */
    public string $packReciverPhone = '';

    /**
     * @var string
     */
    public string $packReciverCountry = '';

    /**
     * @var string
     */
    public string $packReciverCity = '';

    /**
     * @var string
     */
    public string $packReciverDist = '';

    /**
     * @var string
     */
    public string $packReciverEmail = '';

    /**
     * @var string
     */
    public string $packReciverStreet = '';

    /**
     * @var string
     */
    public string $packReciverZipcode = '';

    /**
     * @var string
     */
    public string $packReciverBuilding = '';

    /**
     * @var string
     */
    public string $packReciverExtra = '';

    /**
     * @var string
     */
    public string $packReciverExtraAddress = '';

    /**
     * @var string
     */
    public string $packReciverLongitude = '';

    /**
     * @var string
     */
    public string $packReciverLatitude = '';

    /**
     * @var string
     */
    public string $packDesc = '';

    /**
     * @var string
     */
    public string $packNumPcs = '';

    /**
     * @var string
     */
    public string $packWeight = '';

    /**
     * @var string
     */
    public string $packCodAmount = '';

    /**
     * @var string
     */
    public string $packCurrencyCode = '';

    /**
     * @var string
     */
    public string $packExtraNote = '';

    /**
     * @var string
     */
    public string $packLiveTime = '';

    /**
     * @var string
     */
    public string $packSenderName = '';

    /**
     * @var string
     */
    public string $packSenderPhone = '';

    /**
     * @var string
     */
    public string $packSenderEmail = '';

    /**
     * @var string
     */
    public string $packSendCountry = '';

    /**
     * @var string
     */
    public string $packSendCity = '';

    /**
     * @var string
     */
    public string $packSenderDist = '';

    /**
     * @var string
     */
    public string $packSenderStreet = '';

    /**
     * @var string
     */
    public string $packSenderZipcode = '';

    /**
     * @var string
     */
    public string $packSenderBuilding = '';

    /**
     * @var string
     */
    public string $packSenderExtra = '';

    /**
     * @var string
     */
    public string $packSenderExtraAddress = '';

    /**
     * @var string
     */
    public string $packSenderLongitude = '';

    /**
     * @var string
     */
    public string $packSenderLatitude = '';

    /**
     * @var string
     */
    public string $packDimension = '';

    /**
     * @var string
     */
    public string $packInvoiceNo = '';

    /**
     * Returns an array representation of the request body payload.
     *
     * @return array
     */
    public function buildBodyPayload(): array
    {
        return [
            'apikey' => $this->apiKey,
            'pack_type' => $this->packType,
            'pack_awb' => $this->packAWB,
            'pack_vendor_id' => $this->packVendorId,
            'pack_reciver_name' => $this->packReciverName,
            'pack_reciver_phone' => $this->packReciverPhone,
            'pack_reciver_country' => $this->packReciverCountry,
            'pack_reciver_city' => $this->packReciverCity,
            'pack_reciver_dist' => $this->packReciverDist,
            'pack_reciver_email' => $this->packReciverEmail,
            'pack_reciver_street' => $this->packReciverStreet,
            'pack_reciver_zipcode' => $this->packReciverZipcode,
            'pack_reciver_building' => $this->packReciverBuilding,
            'pack_reciver_extra' => $this->packReciverExtra,
            'pack_reciver_extra_address' => $this->packReciverExtraAddress,
            'pack_reciver_longitude' => $this->packReciverLongitude,
            'pack_reciver_latitude' => $this->packReciverLatitude,
            'pack_desc' => $this->packDesc,
            'pack_num_pcs' => $this->packNumPcs,
            'pack_weight' => $this->packWeight,
            'pack_cod_amount' => $this->packCodAmount,
            'pack_currency_code' => $this->packCurrencyCode,
            'pack_extra_note' => $this->packExtraNote,
            'pack_live_time' => $this->packLiveTime,
            'pack_sender_name' => $this->packSenderName,
            'pack_sender_phone' => $this->packSenderPhone,
            'pack_sender_email' => $this->packSenderEmail,
            'pack_send_country' => $this->packSendCountry,
            'pack_send_city' => $this->packSendCity,
            'pack_sender_dist' => $this->packSenderDist,
            'pack_sender_street' => $this->packSenderStreet,
            'pack_sender_zipcode' => $this->packSenderZipcode,
            'pack_sender_building' => $this->packSenderBuilding,
            'pack_sender_extra' => $this->packSenderExtra,
            'pack_sender_extra_address' => $this->packSenderExtraAddress,
            'pack_sender_longitude' => $this->packSenderLongitude,
            'pack_sender_latitude' => $this->packSenderLatitude,
            'pack_dimension' => $this->packDimension,
            'pack_invoice_no' => $this->packInvoiceNo,
        ];
    }
}
