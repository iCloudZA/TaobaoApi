<?php
/*
 * @Date: 2022-12-28 13:17:31
 * @LastEditors: CloudZA(云之安) &
 * @LastEditTime: 2022-12-28 13:57:44
 * @hitokoto: 一场秋雨一场凉，秋心酌满泪为霜。
 * Copyright (c) 2022 by CloudZA, All Rights Reserved. 
 */
 
// 读取文件内容并将其按换行符分割为数组
$fileContent = file_get_contents('./static/img.txt');
$lines = explode("\n", $fileContent);
// 如果提供了page和num参数，则进行分页输出
if (isset($_GET['page']) && isset($_GET['num'])) {
	// 转换page和num参数为整
	$page = (int)$_GET['page'];
	// 页码（从1开始）
	$itemsPerPage = (empty((int)$_GET['num'])) ? '10' : (int)$_GET['num'];
	// 每页要输出的数据数量
	// 计算用于选择数组片段的偏移量
	$offset = ($page - 1) * $itemsPerPage;
	// 使用array_slice函数从数组中选择特定范围的元素
	$linesPage = array_slice($lines, $offset, $itemsPerPage);
	// 初始化结果数组
	$arr = array();
	// 遍历数组中的每个元素，并将其作为JSON对象输出
	foreach ($linesPage as $line) {
		$result = array('imgUrl' => $line);
		array_push($arr, $result);
	}
	// 将结果数组编码为JSON对象并输出
	echo json_encode($arr);
} else {
	// 否则，随机输出一个图像URL
	$line = $lines[array_rand($lines)];
	$result = array('imgUrl' => $line);
	echo json_encode($result);
}
