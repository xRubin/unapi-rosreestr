<?php

use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use PHPUnit\Framework\TestCase;
use unapi\rosreestr\online_request\SubjectSelector;
use unapi\rosreestr\online_request\RosreestrServletClient;

class RosreestrOnlineRequestSelectorTest extends TestCase
{
    public function testSubjectSelector()
    {
        $handler = HandlerStack::create(new MockHandler([
            new Response(200, [], '<!DOCTYPE html>
<html lang="ru" xml:lang="ru">
<body>
<select name="o_subject_id" id="oSubjectId" style="background:#FFFFFF;border:solid 1px #828E98;width:300px;height:19px" onfocus="javascript:document.ns_Z7_01HA1A42KODT90AR30VLN22001_searchForm.search_type[2].checked=\'true\';">
                                                <option disabled="disabled" selected="selected">Выберите субъект</option>
                                                                    <option value="101000000000">Алтайский край</option>
                                                                    <option value="110000000000">Амурская область</option>
                                                                    <option value="111000000000">Архангельская область</option>
                                                                    <option value="112000000000">Астраханская область</option>
                                                                    <option value="114000000000">Белгородская область</option>
                                                                    <option value="115000000000">Брянская область</option>
                                                                    <option value="117000000000">Владимирская область</option>
                                                                    <option value="118000000000">Волгоградская область</option>
                                                                    <option value="119000000000">Вологодская область</option>
                                                                    <option value="120000000000">Воронежская область</option>
                                                                    <option value="199000000000">Еврейская А.обл.</option>
                                                                    <option value="176000000000">Забайкальский край</option>
                                                                    <option value="124000000000">Ивановская область</option>
                                                                    <option value="125000000000">Иркутская область</option>
                                                                    <option value="183000000000">Кабардино-Балкарская Республика</option>
                                                                    <option value="127000000000">Калининградская область</option>
                                                                    <option value="129000000000">Калужская область</option>
                                                                    <option value="130000000000">Камчатский край</option>
                                                                    <option value="191000000000">Карачаево-Черкесская Республика</option>
                                                                    <option value="132000000000">Кемеровская область</option>
                                                                    <option value="133000000000">Кировская область</option>
                                                                    <option value="134000000000">Костромская область</option>
                                                                    <option value="103000000000">Краснодарский край</option>
                                                                    <option value="104000000000">Красноярский край</option>
                                                                    <option value="137000000000">Курганская область</option>
                                                                    <option value="138000000000">Курская область</option>
                                                                    <option value="141000000000">Ленинградская область</option>
                                                                    <option value="142000000000">Липецкая область</option>
                                                                    <option value="144000000000">Магаданская область</option>
                                                                    <option value="145000000000">Москва</option>
                                                                    <option value="146000000000">Московская область</option>
                                                                    <option value="147000000000">Мурманская область</option>
                                                                    <option value="111100000000">Ненецкий АО</option>
                                                                    <option value="122000000000">Нижегородская область</option>
                                                                    <option value="149000000000">Новгородская область</option>
                                                                    <option value="150000000000">Новосибирская область</option>
                                                                    <option value="152000000000">Омская область</option>
                                                                    <option value="153000000000">Оренбургская область</option>
                                                                    <option value="154000000000">Орловская область</option>
                                                                    <option value="156000000000">Пензенская область</option>
                                                                    <option value="157000000000">Пермский край</option>
                                                                    <option value="105000000000">Приморский край</option>
                                                                    <option value="158000000000">Псковская область</option>
                                                                    <option value="179000000000">Республика Адыгея</option>
                                                                    <option value="184000000000">Республика Алтай</option>
                                                                    <option value="180000000000">Республика Башкортостан</option>
                                                                    <option value="181000000000">Республика Бурятия</option>
                                                                    <option value="182000000000">Республика Дагестан</option>
                                                                    <option value="126000000000">Республика Ингушетия</option>
                                                                    <option value="185000000000">Республика Калмыкия</option>
                                                                    <option value="186000000000">Республика Карелия</option>
                                                                    <option value="187000000000">Республика Коми</option>
                                                                    <option value="39100000000000">Республика Крым</option>
                                                                    <option value="188000000000">Республика Марий Эл</option>
                                                                    <option value="189000000000">Республика Мордовия</option>
                                                                    <option value="198000000000">Республика Саха (Якутия)</option>
                                                                    <option value="190000000000">Республика Северная Осетия</option>
                                                                    <option value="192000000000">Республика Татарстан</option>
                                                                    <option value="193000000000">Республика Тыва</option>
                                                                    <option value="195000000000">Республика Хакасия</option>
                                                                    <option value="160000000000">Ростовская область</option>
                                                                    <option value="161000000000">Рязанская область</option>
                                                                    <option value="136000000000">Самарская область</option>
                                                                    <option value="140000000000">Санкт-Петербург</option>
                                                                    <option value="163000000000">Саратовская область</option>
                                                                    <option value="164000000000">Сахалинская область</option>
                                                                    <option value="165000000000">Свердловская область</option>
                                                                    <option value="39200000000000">Севастополь</option>
                                                                    <option value="166000000000">Смоленская область</option>
                                                                    <option value="107000000000">Ставропольский край</option>
                                                                    <option value="168000000000">Тамбовская область</option>
                                                                    <option value="128000000000">Тверская область</option>
                                                                    <option value="169000000000">Томская область</option>
                                                                    <option value="170000000000">Тульская область</option>
                                                                    <option value="171000000000">Тюменская область</option>
                                                                    <option value="194000000000">Удмуртская Республика</option>
                                                                    <option value="173000000000">Ульяновская область</option>
                                                                    <option value="108000000000">Хабаровский край</option>
                                                                    <option value="171100000000">Ханты-Мансийский АО</option>
                                                                    <option value="175000000000">Челябинская область</option>
                                                                    <option value="196000000000">Чеченская Республика</option>
                                                                    <option value="197000000000">Чувашская Республика</option>
                                                                    <option value="177000000000">Чукотский АО</option>
                                                                    <option value="102000000000">Ямало-Ненецкий АО</option>
                                                                    <option value="178000000000">Ярославская область</option>
                                                </select>
</body>'),
        ]));

        $selector = new SubjectSelector(new RosreestrServletClient(['handler' => $handler]));
        $this->assertContains('Чувашская Республика', $selector->getList());
    }
}