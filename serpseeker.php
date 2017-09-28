<?php

require_once 'rest.php';

/**
 * Class SERPSeeker.
 * @docs https://ru.serpseeker.com/api
 * @author https://github.com/c3037
 */
class SERPSeeker
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var Rest
     */
    private $rest;

    /**
     * SERPSeeker constructor.
     * @param string $authToken
     */
    public function __construct($authToken = "")
    {
        $this->baseUrl = 'https://ru.serpseeker.com/api';
        $this->rest = new Rest();
        $this->rest->setAuthToken($authToken);
    }

    /**
     * Список проектов.
     * @docs https://ru.serpseeker.com/api/methods/9
     * @return array|bool
     */
    public function getProjectsList()
    {
        $url = $this->baseUrl . '/projects';
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Информация о проекте.
     * @docs https://ru.serpseeker.com/api/methods/1
     * @param int $projectID
     * @return array|bool
     */
    public function getProjectInfo($projectID)
    {
        $url = $this->baseUrl . '/project/' . $projectID;
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Добавление проекта.
     * @docs https://ru.serpseeker.com/api/methods/2
     * @param string $projectName
     * @param string $projectUrl
     * @return array|bool
     */
    public function addProject($projectName, $projectUrl)
    {
        $url = $this->baseUrl . '/project';
        $body = [
            'name' => $projectName,
            'url'  => $projectUrl,
        ];
        $content = $this->rest->sendPost($url, $body);
        return json_decode($content, true) ?: false;
    }

    /**
     * Удаление проекта.
     * @docs https://ru.serpseeker.com/api/methods/3
     * @param int $projectID
     * @return array|bool
     */
    public function dropProject($projectID)
    {
        $url = $this->baseUrl . '/project/' . $projectID;
        $content = $this->rest->sendDelete($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Редактирование информации о проекте.
     * @docs https://ru.serpseeker.com/api/methods/4
     * @param int $projectID
     * @param string $projectName
     * @return array|bool
     */
    public function changeProject($projectID, $projectName)
    {
        $url = $this->baseUrl . '/project/' . $projectID;
        $body = [
            'project_id' => $projectID,
            'name'       => $projectName,
        ];
        $content = $this->rest->sendPost($url, $body);
        return json_decode($content, true) ?: false;
    }

    /**
     * Список доступных поисковых систем.
     * @docs https://ru.serpseeker.com/api/methods/13
     * @return array|bool
     */
    public function getSearchEngines()
    {
        $url = $this->baseUrl . '/engines';
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Список доступных зон для указанной поисковой системы.
     * @docs https://ru.serpseeker.com/api/methods/14
     * @param int $engineID
     * @return array|bool
     */
    public function getSearchEngineZones($engineID)
    {
        $url = $this->baseUrl . '/engine/' . $engineID . '/zones';
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Список доступных регионов для указанной поисковой системы и зоны.
     * @docs https://ru.serpseeker.com/api/methods/15
     * @param int $engineID
     * @param int $zoneID
     * @return array|bool
     */
    public function getSearchEngineRegions($engineID, $zoneID)
    {
        $url = $this->baseUrl . '/engine/' . $engineID . '/zone/' . $zoneID . '/regions';
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Список интервалов проверки.
     * @docs https://ru.serpseeker.com/api/methods/16
     * @return array|bool
     */
    public function getSearchEngineIntervals()
    {
        $url = $this->baseUrl . '/engines/intervals';
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Список поисковых систем, подключенных к проекту.
     * @docs https://ru.serpseeker.com/api/methods/17
     * @param int $projectID
     * @return array|bool
     */
    public function getSearchEnginesLinkedToProject($projectID)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/engines';
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Привязка новой поисковой системы к проекту.
     * @docs https://ru.serpseeker.com/api/methods/18
     * @param int $projectID
     * @param int $engineID
     * @param int $zoneID
     * @param int $regionID
     * @param int $checkInterval
     * @return array|bool
     */
    public function addSearchEngineToProject($projectID, $engineID, $zoneID, $regionID, $checkInterval)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/engine';
        $body = [
            'engine_id'             => $engineID,
            'engine_zone_id'        => $zoneID,
            'engine_zone_region_id' => $regionID,
            'check_interval'        => $checkInterval,
        ];
        $content = $this->rest->sendPost($url, $body);
        return json_decode($content, true) ?: false;
    }

    /**
     * Отвязка поисковой системы от проекта.
     * @docs https://ru.serpseeker.com/api/methods/19
     * @param int $projectID
     * @param int $projectEngineID
     * @return array|bool
     */
    public function dropSearchEngineFromProject($projectID, $projectEngineID)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/engine/' . $projectEngineID;
        $content = $this->rest->sendDelete($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Изменение интервала проверки для поисковой системы.
     * @docs https://ru.serpseeker.com/api/methods/20
     * @param int $projectID
     * @param int $projectEngineID
     * @param int $checkInterval
     * @return array|bool
     */
    public function changeSearchEngineTimeInterval($projectID, $projectEngineID, $checkInterval)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/engine/' . $projectEngineID . '/change-interval';
        $body = [
            'check_interval' => $checkInterval,
        ];
        $content = $this->rest->sendPost($url, $body);
        return json_decode($content, true) ?: false;
    }

    /**
     * Список ключевых слов проекта.
     * @docs https://ru.serpseeker.com/api/methods/21
     * @param int $projectID
     * @return array|bool
     */
    public function getPhrasesList($projectID)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/phrases';
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Добавление ключевого слова.
     * @docs https://ru.serpseeker.com/api/methods/22
     * @param int $projectID
     * @param string $phrase
     * @return array|bool
     */
    public function addPhrase($projectID, $phrase)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/phrase';
        $body = [
            'phrase' => $phrase,
        ];
        $content = $this->rest->sendPost($url, $body);
        return json_decode($content, true) ?: false;
    }

    /**
     * Добавление ключевых слов списком.
     * @docs https://ru.serpseeker.com/api/methods/23
     * @param int $projectID
     * @param array $phrasesList
     * @return array|bool
     */
    public function addPhrasesByList($projectID, array $phrasesList)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/phrases';
        $body = [
            'phrases' => implode("\n", $phrasesList),
        ];
        $content = $this->rest->sendPost($url, $body);
        return json_decode($content, true) ?: false;
    }

    /**
     * Удаление ключевого слова.
     * @docs https://ru.serpseeker.com/api/methods/24
     * @param int $projectID
     * @param int $phraseID
     * @return array|bool
     */
    public function dropPhrase($projectID, $phraseID)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/phrase/' . $phraseID;
        $content = $this->rest->sendDelete($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Отправка на перепроверку позиций проекта по указанной поисковой системе.
     * @docs https://ru.serpseeker.com/api/methods/7
     * @param int $projectID
     * @param int $projectEngineID
     * @param int $checkAll
     * @return array|bool
     */
    public function sendCheckPositions($projectID, $projectEngineID, $checkAll = 0)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/positions/' . $projectEngineID . '/check';
        $body = [
            'check_all' => $checkAll,
        ];
        $content = $this->rest->sendPost($url, $body);
        return json_decode($content, true) ?: false;
    }

    /**
     * Показывает прогресс текущей проверки позиций.
     * @docs https://ru.serpseeker.com/api/methods/8
     * @param int $projectID
     * @param int $projectEngineID
     * @return array|bool
     */
    public function getCheckProgress($projectID, $projectEngineID)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/positions/' . $projectEngineID . '/check-progress';
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Даты полных проверок позиций проекта по указанной поисковой системе.
     * @docs https://ru.serpseeker.com/api/methods/8
     * @param int $projectID
     * @param int $projectEngineID
     * @return array|bool
     */
    public function getDatesOfTotalCheckPositions($projectID, $projectEngineID)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/positions/' . $projectEngineID . '/check-dates';
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * История позиций проекта по указанной поисковой системе
     * @docs https://ru.serpseeker.com/api/methods/5
     * @param int $projectID
     * @param int $projectEngineID
     * @param int $competitorID
     * @param date string $dateBegin
     * @param date string $dateEnd
     * @return array|bool
     */
    public function getHistoryOfPositions($projectID, $projectEngineID, $competitorID = 0, $dateBegin = null, $dateEnd = null) {
        $url = $this->baseUrl . '/project/' . $projectID . '/positions/' . $projectEngineID;
        $dateBegin = $dateBegin ?: date("Y-m-d", strtotime('yesterday'));
        $dateEnd = $dateEnd ?: date("Y-m-d", strtotime('today'));
        $urlParams = [
            'competitor_id' => $competitorID,
            'date_begin'    => $dateBegin,
            'date_end'      => $dateEnd,
        ];
        $url .= "?" . http_build_query($urlParams);
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }

    /**
     * Выдача топ 100 поисковой системы по ключевому слову.
     * @docs https://ru.serpseeker.com/api/methods/10
     * @param int $projectID
     * @param int $projectEngineID
     * @param int $projectPhraseID
     * @return array|bool
     */
    public function getTop100($projectID, $projectEngineID, $projectPhraseID)
    {
        $url = $this->baseUrl . '/project/' . $projectID . '/serp/' . $projectEngineID . '/' . $projectPhraseID;
        $content = $this->rest->sendGet($url);
        return json_decode($content, true) ?: false;
    }
}