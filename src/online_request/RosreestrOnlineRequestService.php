<?php

namespace unapi\rosreestr\online_request;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\RejectedPromise;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use unapi\interfaces\ServiceInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class RosreestrOnlineRequestService implements ServiceInterface, LoggerAwareInterface
{
    /** @var ClientInterface */
    private $client;
    /** @var LoggerInterface */
    private $logger;

    /**
     * @param array $config Service configuration settings.
     */
    public function __construct(array $config = [])
    {
        if (!isset($config['client'])) {
            $this->client = new RosreestrOnlineRequestClient();
        } elseif ($config['client'] instanceof ClientInterface) {
            $this->client = $config['client'];
        } else {
            throw new \InvalidArgumentException('Client must be instance of ClientInterface');
        }

        if (!isset($config['logger'])) {
            $this->logger = new NullLogger();
        } elseif ($config['logger'] instanceof LoggerInterface) {
            $this->setLogger($config['logger']);
        } else {
            throw new \InvalidArgumentException('Logger must be instance of LoggerInterface');
        }
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @param RosreestrOnlineRequestDto $address
     * @return PromiseInterface
     */
    public function getLinks(RosreestrOnlineRequestDto $address): PromiseInterface
    {
        return $this->initialPage($this->getClient())->then(function (ResponseInterface $response) use ($address) {
            $body = $response->getBody()->getContents();
            if (preg_match('/<form action="(p[^"]+)"/im', $body, $matches)) {
                $url = $matches[1];
            } else
                return new RejectedPromise('Form not found');

            if (preg_match('/<base href="([^"]+)"/im', $body, $matches)) {
                $base = $matches[1];
            } else
                return new RejectedPromise('Base href not found');

            return $this->submitForm($base . $url, $address)->then(function (ResponseInterface $response) {

                $result = [];
                $body = $response->getBody()->getContents();

                if (preg_match('/<base href="([^"]+)"/im', $body, $matches)) {
                    $base = $matches[1];
                } else
                    return new RejectedPromise('Base href not found');

                if ($data = preg_match_all('/<tr valign="top" id="js_oTr.*href="(p[^"]+)">([^<]+)<\/a>.*<nobr>([^<]+)<\/nobr>/imUs', $body, $matches)) {

                    foreach ($matches[0] as $key => $html)
                        $result[] = (new RosreestrOnlineRequestCadastreLinkDto())
                            ->setUrl($base . $matches[1][$key])
                            ->setAddress(trim($matches[2][$key]))
                            ->setNumber($matches[3][$key]);
                }
                return new FulfilledPromise($result);
            });
        });
    }

    /**
     * @param string $url
     * @return PromiseInterface
     */
    public function getCadastre(string $url): PromiseInterface
    {
        return $this->client->requestAsync('GET', $url)->then(function (ResponseInterface $response) {
            $result = [];
            if ($data = preg_match_all('/<td align="left" valign="top" width="250" nowrap="true">([^td]+)<\/td>\s+<td width="75%"( valign="top")?>\s+<b>([^<]+)<\/b>\s+<\/td>/imUs', $response->getBody()->getContents(), $matches)) {
                foreach ($matches[0] as $key => $html)
                    $result[trim(strip_tags($matches[1][$key]), " \t\n\r:")] = trim($matches[3][$key]);
            }
            return new FulfilledPromise($result);
        });
    }

    /**
     * @param ClientInterface $client
     * @return PromiseInterface
     */
    protected function initialPage(ClientInterface $client)
    {
        return $client->requestAsync('GET', '/wps/portal/p/cc_ib_portal_services/online_request');
    }

    /**
     * @param string $url
     * @param RosreestrOnlineRequestDto $address
     * @return PromiseInterface
     */
    protected function submitForm(string $url, RosreestrOnlineRequestDto $address): PromiseInterface
    {
        return $this->getClient()->requestAsync('POST', $url, [
            'form_params' => [
                'search_action' => 'true',
                'settlement' => $address->getSettlementId(),
                'cad_num' => $address->getCadastreNumber(),
                'start_position' => 59,
                'search_type' => $address->getCadastreNumber() ? 'CAD_NUMBER' : 'ADDRESS',
                'subject_id' => $address->getSubjectId(),
                'region_id' => $address->getRegionId(),
                'settlement_type' => $address->getSettlementTypeId(),
                'settlement_id' => $address->getSettlementId(),
                'street_type' => $address->getStreetType(),
                'street' => $address->getStreet(),
                'house' => $address->getHouse(),
                'building' => $address->getBuilding(),
                'structure' => $address->getStructure(),
            ]
        ]);
    }
}