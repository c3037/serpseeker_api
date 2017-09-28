<?php

error_reporting(-1);
ini_set("display_errors", 1);
echo "<pre>";
require_once 'serpseeker.php';
$ss = new SERPSeeker('bdb8cbaa83ccfc71eef1e19b83c12ede');

/** Проекты */

// Добавление проекта
//$tmpArray = $ss->addProject('TestVI', 'http://www.vseinstrumenti.ru/');
//$result = !empty($tmpArray['id']) ? (int)$tmpArray['id'] : false;
//var_dump($result);

// Измененение проекта
//$result = (bool)$ss->changeProject(103999, 'TestVI2');
//var_dump($result);

// Получение инфы о проекте
//$data = $ss->getProjectInfo(103999);
//var_dump($data);

// Получение списка проектов
//$data = $ss->getProjectsList();
//var_dump($data);

// Удаление проекта
//$tmpArray = $ss->dropProject(103999);
//$result = !empty($tmpArray['result']) ? (bool)$tmpArray['result'] : false;
//var_dump($result);

/** Поисковые системы / Зоны / Регионы */

// Список поисковых систем
//$data = $ss->getSearchEngines();
//var_dump($data);

// Список доступных поисковых зон для Яндекса
//$data = $ss->getSearchEngineZones(1);
//var_dump($data);

// Список достпуных регионов для Яндекса в зоне "Россия"
//$data = $ss->getSearchEngineRegions(1, 257);
//var_dump($data); // 1 - Москва

// Интервалы проверки в поисковых системах
//$data = $ss->getSearchEngineIntervals();
//var_dump($data); // 101 - Разово | 99 - После апдейта Яндекса

// Привязка ПС к проекту
//$tmpArray = $ss->addSearchEngineToProject(103998, 1, 257, 1, 99);
//$result = !empty($tmpArray['id']) ? (int)$tmpArray['id'] : false;
//var_dump($result); // 54996

// Изменение интервала проверки
//$tmpArray = $ss->changeSearchEngineTimeInterval(103998, 54996, 101);
//$result = !empty($tmpArray['result']) ? (bool)$tmpArray['result'] : false;
//var_dump($result);

// Поисковые системы, привязанные к проекту
//$data = $ss->getSearchEnginesLinkedToProject(103998);
//var_dump($data);

// Удаление ПС из проекта
//$tmpArray = $ss->dropSearchEngineFromProject(103998, 54996);
//$result = !empty($tmpArray['result']) ? (bool)$tmpArray['result'] : false;
//var_dump($result);

/** Фразы */

// Добавление ключевОЙ фразы в проект
//$tmpArray = $ss->addPhrase(103998, 'инструмент');
//$result = !empty($tmpArray['id']) ? (int)$tmpArray['id'] : false;
//var_dump($result);

// Добавление ключевЫЧ фраз в проект
//$array = $ss->addPhrasesByList(103998, ['инструмент4', 'инструмент5']);
//var_dump($array); // [[id, phrase],...

// Список поисковых фраз в проекте
//$data = $ss->getPhrasesList(103998);
//var_dump($data); // [[id, phrase],...]

// Удаление поисковой фразы из проекта
//$tmpArray = $ss->dropPhrase(103998, 3357678);
//$result = !empty($tmpArray['result']) ? (bool)$tmpArray['result'] : false;
//var_dump($result);

/** Позиции */

// Отправка запроса на проверку позиций
//$result = $ss->sendCheckPositions(103998, 54998);
//var_dump($result);

// Статус текущей проверки
//$tmpArray = $ss->getCheckProgress(103998, 54998);
//$result = !empty($tmpArray['percent']) && $tmpArray['percent'] == 100 ? 'done' : 'in-progress';
//var_dump($result);

// Даты успешных проверок
//$result = $ss->getDatesOfTotalCheckPositions(103998, 54998);
//var_dump($result);

// Результаты проверок
//$result = $ss->getHistoryOfPositions(103998, 54998);
//var_dump($result);

// Top100 по выдаче
//$data = $ss->getTop100(103998, 55008, 3357676); // 0.06 р
//var_dump($data); // date | se_results | SERP [position|url]