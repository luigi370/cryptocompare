<?php
/**
 * User: Luis Ernesto Assandri
 * Date: 09/10/2017
 * Time: 15:43
 */

namespace common\models;

/**
 * Class Cryptocompare
 * @package common\models
 */
class CryptoCompare
{
    const OLD_BASE_URL = 'https://www.cryptocompare.com/api/data';
    const BASE_URL = 'https://min-api.cryptocompare.com/data';

    /**
     * @param $url
     * @param null $params
     * @return mixed
     */
    private function executeCurl($url, $params = null)
    {
        if ($params) {
            $first = true;
            foreach ($params as $key => $value) {
                if ($value) {
                    if ($first) {
                        $url .= '?';
                        $first = false;
                    } else {
                        $url .= '&';
                    }
                    $url .= $key . '=' . $value;
                }
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($result, true);

        return $response;
    }

    /**
     * @return mixed
     */
    public function getCoinList()
    {
        $url = CryptoCompare::OLD_BASE_URL . "/coinlist";
        return $this->executeCurl($url);
    }

    /**
     * @param $fsym
     * @param $tsyms
     * @param null $e
     * @param null $extraParams
     * @param null $sign
     * @param null $tryConversion
     * @return mixed
     */
    public function getPrice($fsym, $tsyms, $e = null, $extraParams = null, $sign = null, $tryConversion = null)
    {
        $url = CryptoCompare::BASE_URL . "/price";
        return $this->executeCurl(
            $url,
            [
                'fsym' => $fsym,
                'tsyms' => $tsyms,
                'e' => $e,
                'extraParams' => $extraParams,
                'sign' => $sign,
                'tryConversion' => $tryConversion,
            ]
        );
    }

    /**
     * @param $fsyms
     * @param $tsyms
     * @param null $e
     * @param null $extraParams
     * @param null $sign
     * @param null $tryConversion
     * @return mixed
     */
    public function getPriceMulti($fsyms, $tsyms, $e = null, $extraParams = null, $sign = null, $tryConversion = null)
    {
        $url = CryptoCompare::BASE_URL . "/pricemulti";
        return $this->executeCurl(
            $url,
            [
                'fsyms' => $fsyms,
                'tsyms' => $tsyms,
                'e' => $e,
                'extraParams' => $extraParams,
                'sign' => $sign,
                'tryConversion' => $tryConversion,
            ]
        );
    }

    /**
     * @param $fsyms
     * @param $tsyms
     * @param null $e
     * @param null $extraParams
     * @param null $sign
     * @param null $tryConversion
     * @return mixed
     */
    public function getPriceMultiFull(
        $fsyms,
        $tsyms,
        $e = null,
        $extraParams = null,
        $sign = null,
        $tryConversion = null
    ) {
        $url = CryptoCompare::BASE_URL . "/pricemultifull";
        return $this->executeCurl(
            $url,
            [
                'fsyms' => $fsyms,
                'tsyms' => $tsyms,
                'e' => $e,
                'extraParams' => $extraParams,
                'sign' => $sign,
                'tryConversion' => $tryConversion,
            ]
        );
    }

    /**
     * @param $fsym
     * @param $tsym
     * @param string $markets
     * @param null $extraParams
     * @param null $sign
     * @param null $tryConversion
     * @return mixed
     */
    public function getAvg($fsym, $tsym, $markets = 'CCAGG', $extraParams = null, $sign = null, $tryConversion = null)
    {
        $url = CryptoCompare::BASE_URL . "/generateAvg";
        return $this->executeCurl(
            $url,
            [
                'fsym' => $fsym,
                'tsym' => $tsym,
                'markets' => $markets,
                'extraParams' => $extraParams,
                'sign' => $sign,
                'tryConversion' => $tryConversion,
            ]
        );
    }

    /**
     * @param $fsym
     * @param $tsym
     * @param null $e
     * @param null $extraParams
     * @param null $sign
     * @param null $tryConversion
     * @param null $avgType
     * @param null $UTCHourDiff
     * @param null $toTs
     * @return mixed
     */
    public function getDayAvg(
        $fsym,
        $tsym,
        $e = null,
        $extraParams = null,
        $sign = null,
        $tryConversion = null,
        $avgType = null,
        $UTCHourDiff = null,
        $toTs = null
    ) {
        $url = CryptoCompare::BASE_URL . "/dayAvg";
        return $this->executeCurl(
            $url,
            [
                'fsym' => $fsym,
                'tsym' => $tsym,
                'e' => $e,
                'extraParams' => $extraParams,
                'sign' => $sign,
                'tryConversion' => $tryConversion,
                'avgType' => $avgType,
                'UTCHourDiff' => $UTCHourDiff,
                'toTs' => $toTs
            ]
        );
    }

    /**
     * @param $fsym
     * @param $tsyms
     * @param null $ts
     * @param string $markets
     * @param null $extraParams
     * @param null $sign
     * @param null $tryConversion
     * @return mixed
     */
    public function getPriceHistorical(
        $fsym,
        $tsyms,
        $markets = 'CCAGG',
        $ts = null,
        $extraParams = null,
        $sign = null,
        $tryConversion = null
    ) {
        $url = CryptoCompare::BASE_URL . "/pricehistorical";
        return $this->executeCurl(
            $url,
            [
                'fsym' => $fsym,
                'tsyms' => $tsyms,
                'ts' => $ts,
                'markets' => $markets,
                'extraParams' => $extraParams,
                'sign' => $sign,
                'tryConversion' => $tryConversion,
            ]
        );
    }

    /**
     * @param $fsym
     * @param $tsym
     * @return mixed
     */
    public function getCoinSnapshot($fsym, $tsym)
    {
        $url = CryptoCompare::OLD_BASE_URL . "/coinsnapshot";
        return $this->executeCurl(
            $url,
            [
                'fsym' => $fsym,
                'tsym' => $tsym
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCoinSnapshotFullById($id)
    {
        $url = CryptoCompare::OLD_BASE_URL . "/coinsnapshotfullbyid";
        return $this->executeCurl(
            $url,
            [
                'id' => $id
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getSocialStats($id)
    {
        $url = CryptoCompare::OLD_BASE_URL . "/socialstats";
        return $this->executeCurl(
            $url,
            [
                'id' => $id
            ]
        );
    }

    /**
     * @param $fsym
     * @param $tsym
     * @param string $e
     * @param null $extraParams
     * @param null $sign
     * @param null $tryConversion
     * @param null $aggregate
     * @param null $limit
     * @param null $toTs
     * @return mixed
     */
    public function getHistoMinute(
        $fsym,
        $tsym,
        $e = 'CCAGG',
        $limit = null,
        $extraParams = null,
        $sign = null,
        $tryConversion = null,
        $aggregate = null,
        $toTs = null
    ) {
        $url = CryptoCompare::BASE_URL . "/histominute";
        return $this->executeCurl(
            $url,
            [
                'fsym' => $fsym,
                'tsym' => $tsym,
                'e' => $e,
                'extraParams' => $extraParams,
                'sign' => $sign,
                'tryConversion' => $tryConversion,
                'aggregate' => $aggregate,
                'limit' => $limit,
                'toTs' => $toTs
            ]
        );
    }

    /**
     * @param $fsym
     * @param $tsym
     * @param string $e
     * @param null $limit
     * @param null $extraParams
     * @param null $sign
     * @param null $tryConversion
     * @param null $aggregate
     * @param null $toTs
     * @return mixed
     */
    public function getHistoHour(
        $fsym,
        $tsym,
        $e = 'CCAGG',
        $limit = null,
        $extraParams = null,
        $sign = null,
        $tryConversion = null,
        $aggregate = null,
        $toTs = null
    ) {
        $url = CryptoCompare::BASE_URL . "/histohour";
        return $this->executeCurl(
            $url,
            [
                'fsym' => $fsym,
                'tsym' => $tsym,
                'e' => $e,
                'extraParams' => $extraParams,
                'sign' => $sign,
                'tryConversion' => $tryConversion,
                'aggregate' => $aggregate,
                'limit' => $limit,
                'toTs' => $toTs
            ]
        );
    }

    /**
     * @param $fsym
     * @param $tsym
     * @param string $e
     * @param null $limit
     * @param null $extraParams
     * @param null $sign
     * @param null $tryConversion
     * @param null $aggregate
     * @param null $toTs
     * @return mixed
     */
    public function getHistoDay(
        $fsym,
        $tsym,
        $e = 'CCAGG',
        $limit = null,
        $extraParams = null,
        $sign = null,
        $tryConversion = null,
        $aggregate = null,
        $toTs = null
    ) {
        $url = CryptoCompare::BASE_URL . "/histoday";
        return $this->executeCurl(
            $url,
            [
                'fsym' => $fsym,
                'tsym' => $tsym,
                'e' => $e,
                'extraParams' => $extraParams,
                'sign' => $sign,
                'tryConversion' => $tryConversion,
                'aggregate' => $aggregate,
                'limit' => $limit,
                'toTs' => $toTs
            ]
        );
    }

    /**
     * @param $fsym
     * @param $tsym
     * @param null $limit
     * @param null $sign
     * @return mixed
     */
    public function getTopPairs(
        $fsym,
        $tsym = null,
        $limit = null,
        $sign = null
    ) {
        $url = CryptoCompare::BASE_URL . "/top/pairs";
        return $this->executeCurl(
            $url,
            [
                'fsym' => $fsym,
                'tsym' => $tsym,
                'limit' => $limit,
                'sign' => $sign
            ]
        );
    }


}