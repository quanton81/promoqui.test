<?php

use Promoqui\Services\OrganizationalChart;

require 'vendor/autoload.php';

function returnJsonHttpResponse($success, $data)
{
    ob_clean();
    header_remove();
    header("Content-type: application/json; charset=utf-8");

    if ($success) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }
    echo json_encode($data);
    exit();
}

$PDO = require dirname(__DIR__) . '/html/src/db/pdo.php';

$nodeTreeRepository = new Promoqui\Repository\NodeTree($PDO);

$nodeId = !empty($_GET["node_id"]) ? intval(htmlspecialchars($_GET["node_id"])) : null;
$language = !empty($_GET["language"]) ? htmlspecialchars($_GET["language"]) : null;
$searchKeyword = !empty($_GET["search_keyword"]) ? htmlspecialchars($_GET["search_keyword"]) : null;
$pageNum = !empty($_GET["page_num"]) ? intval(htmlspecialchars($_GET["page_num"])) : null;
$pageSize = !empty($_GET["page_size"]) ? htmlspecialchars($_GET["page_size"]) : null;

$input = [
    'nodeId' => $nodeId,
    'language' => $language,
    'searchKeyword' => $searchKeyword,
    'pageNum' => $pageNum,
    'pageSize' => $pageSize,
];

$organizationalChart = new OrganizationalChart($PDO);

$data = $organizationalChart->fetchNodes($input);

$success = empty($data->error());

returnJsonHttpResponse($success, $data);
