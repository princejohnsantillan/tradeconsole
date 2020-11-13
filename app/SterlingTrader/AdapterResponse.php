<?php

namespace App\SterlingTrader;

use App\SterlingTrader\Exceptions\WebSocketException;
use App\SterlingTrader\Struct\OrderStruct;

class AdapterResponse
{
    public const WEBSOCKETEXCEPTION = 'WebSocketException';
    public const NOTIFY = 'Notify';
    public const SENDMETADATA = 'SendMetadata';
    public const SENDMESSAGEBOX = 'SendMessageBox';
    public const GETACCOUNTINFO = 'GetAccountInfo';
    public const MAINTAINACCOUNT = 'MaintainAccount';
    public const MAINTAINSYMBOLCONTROL = 'MaintainSymbolControl';
    public const REPLACEORDERSTRUCT = 'ReplaceOrderStruct';
    public const SUBMITORDERSTRUCT = 'SubmitOrderStruct';
    public const CANCELALLORDER = 'CancelAllOrder';
    public const CANCELORDER = 'CancelOrder';
    public const CANCELORDEREX = 'CancelOrderEx';
    public const GETORDERINFO = 'GetOrderInfo';
    public const GETORDERLIST = 'GetOrderList';
    public const GETORDERLISTEX = 'GetOrderListEx';
    public const GETTRADERLISTEX = 'GetTraderListEx';
    public const GETPOSITIONINFOSTRUCT = 'GetPositionInfoStruct';
    public const GETPOSITIONLIST = 'GetPositionList';
    public const GETPOSLISTBYACCOUNT = 'GetPosListByAccount';
    public const GETPOSLISTBYSYM = 'GetPosListBySym';

    /**
     * @param  string $event
     * @param  string|array $data
     * @return string
     */
    private static function render(string $event, $data): string
    {
        //TODO: Add signature to increase security.
        return json_encode([
            'event' => $event,
            'data' => $data,
            // 'signature' => $signature,
        ]);
    }

    public static function webSocketException(WebSocketException $exception): string
    {
        return static::render(static::WEBSOCKETEXCEPTION, [
            'Code' => $exception->getCode(),
            'Message' => $exception->getMessage(),
        ]);
    }

    public static function notify(string $message): string
    {
        return static::render(static::NOTIFY, ['Message' => $message]);
    }

    public static function sendMetadata(): string
    {
        return static::render(static::SENDMETADATA, []);
    }

    public static function sendMessageBox(string $trader, string $text): string
    {
        return static::render(static::SENDMESSAGEBOX, [
            'Trader' => $trader,
            'Text' => $text,
        ]);
    }

    public static function getAccountInfo(string $account): string
    {
        return static::render(static::GETACCOUNTINFO, [
            'Account' => $account,
        ]);
    }

    public static function maintainAccount(): string
    {
        return static::render(static::MAINTAINACCOUNT, []);
    }

    public static function maintainSymbolControl(): string
    {
        return static::render(static::MAINTAINSYMBOLCONTROL, []);
    }

    public static function replaceOrderStruct(OrderStruct $order, string $oldOrderRecordId, string $oldClientOrderId): string
    {
        return static::render(static::REPLACEORDERSTRUCT, [
            'Order' => $order->asXML(),
            'OldOrderRecordID' => $oldOrderRecordId,
            'OldClientOrderID' => $oldClientOrderId,
        ]);
    }

    public static function submitOrderStruct(OrderStruct $order): string
    {
        return static::render(static::SUBMITORDERSTRUCT, $order->asXML());
    }

    public static function cancelAllOrder(): string
    {
        return static::render(static::CANCELALLORDER, []);
    }

    public static function cancelOrder(string $account, string $orderRecordId, string $oldClientOrderId, string $clientOrderId): string
    {
        return static::render(static::CANCELORDER, [
            'Account' => $account,
            'OrderRecordID' => $orderRecordId,
            'OldClientOrderID' => $oldClientOrderId,
            'ClientOrderID' => $clientOrderId,
        ]);
    }

    public static function cancelOrderEx(string $account, string $orderRecordId, string $oldClientOrderId, string $clientOrderId, string $instrument): string
    {
        return static::render(static::CANCELORDEREX, [
            'Account' => $account,
            'OrderRecordID' => $orderRecordId,
            'OldClientOrderID' => $oldClientOrderId,
            'ClientOrderID' => $clientOrderId,
            'Instrucment' => $instrument,
        ]);
    }

    public static function getOrderInfo(string $clientOrderId): string
    {
        return static::render(static::GETORDERINFO, [
            'ClientOrderID' => $clientOrderId,
        ]);
    }

    public static function getOrderList(): string
    {
        return static::render(static::GETORDERLIST, [
            'OpenOnly' => '',
        ]);
    }

    public static function getOrderListEx(): string
    {
        return static::render(static::GETORDERLISTEX, []);
    }

    public static function getTraderListEx(): string
    {
        return static::render(static::GETTRADERLISTEX, []);
    }

    public static function getPositionInfoStruct(string $symbol, string $exchange, string $account): string
    {
        return static::render(static::GETPOSITIONINFOSTRUCT, [
            'Symbol' => $symbol,
            'Exchange' => $exchange,
            'Account' => $account,
        ]);
    }

    public static function getPositionList(): string
    {
        return static::render(static::GETPOSITIONLIST, []);
    }

    public static function getPosListByAccount(string $account): string
    {
        return static::render(static::GETPOSLISTBYACCOUNT, [
            'Account' => $account,
        ]);
    }

    public static function getPosListBySym(string $symbol): string
    {
        return static::render(static::GETPOSLISTBYSYM, [
            'Symbol' => $symbol,
        ]);
    }
}
