<?php

namespace App\SterlingTrader;

use App\SterlingTrader\Exceptions\WebSocketException;

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

    private static function render(string $event, array $data): string
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

    public static function sendMessageBox(): string
    {
        return static::render(static::SENDMESSAGEBOX, []);
    }

    public static function getAccountInfo(): string
    {
        return static::render(static::GETACCOUNTINFO, []);
    }

    public static function maintainAccount(): string
    {
        return static::render(static::MAINTAINACCOUNT, []);
    }

    public static function maintainSymbolControl(): string
    {
        return static::render(static::MAINTAINSYMBOLCONTROL, []);
    }

    public static function replaceOrderStruct(): string
    {
        return static::render(static::REPLACEORDERSTRUCT, []);
    }

    public static function submitOrderStruct(): string
    {
        return static::render(static::SUBMITORDERSTRUCT, []);
    }

    public static function cancelAllOrder(): string
    {
        return static::render(static::CANCELALLORDER, []);
    }

    public static function cancelOrder(): string
    {
        return static::render(static::CANCELORDER, []);
    }

    public static function cancelOrderEx(): string
    {
        return static::render(static::CANCELORDEREX, []);
    }

    public static function getOrderInfo(): string
    {
        return static::render(static::GETORDERINFO, []);
    }

    public static function getOrderList(): string
    {
        return static::render(static::GETORDERLIST, []);
    }

    public static function getOrderListEx(): string
    {
        return static::render(static::GETORDERLISTEX, []);
    }

    public static function getTraderListEx(): string
    {
        return static::render(static::GETTRADERLISTEX, []);
    }

    public static function getPositionInfoStruct(): string
    {
        return static::render(static::GETPOSITIONINFOSTRUCT, []);
    }

    public static function getPositionList(): string
    {
        return static::render(static::GETPOSITIONLIST, []);
    }

    public static function getPosListByAccount(): string
    {
        return static::render(static::GETPOSLISTBYACCOUNT, []);
    }

    public static function getPosListBySym(): string
    {
        return static::render(static::GETPOSLISTBYSYM, []);
    }
}
