<?php
//用PHPExcel类库完成管理员对应院系的成绩结果输出
require_once('PHPExcel/PHPExcel.php');
$objPHPExcel = new PHPExcel();//实例化PHPExcel类
$objsheet = $objPHPExcel->getActiveSheet();//获取活动表
$objsheet->setTitle('成绩');//表名

$ID = $_GET['ID'];

require_once('linktodb.php');
$db = linkToDB();
//数据获取
$q = "SELECT * FROM 考生信息 WHERE 学号 LIKE '".$ID."%'";
$result = mysqli_query($db, $q);
$rownum = mysqli_num_rows($result);
//表头
$objsheet->setCellValue('A1', '学号')
         ->setCellValue('B1', '一卡通号')
         ->setCellValue('C1', '姓名')
         ->setCellValue('D1', '成绩');
//数据写入xls文件
for($i = 0; $i < $rownum; $i++){
  $po = $i + 2;
  $row = mysqli_fetch_assoc($result);
  $objsheet->setCellValueExplicit("A$po", $row['学号'], PHPExcel_Cell_DataType::TYPE_STRING)
           ->setCellValueExplicit("B$po", $row['一卡通号'], PHPExcel_Cell_DataType::TYPE_STRING)
           ->setCellValueExplicit("C$po", $row['姓名'], PHPExcel_Cell_DataType::TYPE_STRING);
  if($row['成绩'] == null){
    $objsheet->setCellValueExplicit("D$po", '未答题', PHPExcel_Cell_DataType::TYPE_STRING);
  }else{
    $objsheet->setCellValue("D$po", $row['成绩']);
  }
}
//xls文件输出
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$filename =  mb_convert_encoding('成绩', 'GBK', 'UTF-8').'.xls';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='.$filename);
header('Cache-Control: max-age=0');
$objWriter->save('php://output');

mysqli_free_result($result);
mysqli_close($db);

unset($_COOKIE);
 ?>
