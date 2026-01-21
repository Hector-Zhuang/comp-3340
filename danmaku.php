<?php
$数据文件 = 'danmaku.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $新消息 = [
        '内容' => $_POST['text'] ?? '',
        '时间' => time()
    ];

    if (!empty($新消息['内容'])) {
        $当前数据 = file_exists($数据文件) ? json_decode(file_get_contents($数据文件), true) : [];
        $当前数据[] = $新消息;
        
        if (count($当前数据) > 100) {
            array_shift($当前数据);
        }
        
        file_put_contents($数据文件, json_encode($当前数据, JSON_UNESCAPED_UNICODE));
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json; charset=utf-8');
    echo file_exists($数据文件) ? file_get_contents($数据文件) : json_encode([]);
    exit;
}
?>