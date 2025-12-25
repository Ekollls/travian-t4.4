<?php

include("../application/Account.php");
header('Content-Type: application/json; charset=utf-8',true,200);
if($session->access != 9){
	exit(json_encode(['status'=>false,'message'=>'Access Denied']));
}
include("../application/config.php");
$is_ajax = 'xmlhttprequest' == strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ?? '' );
if($is_ajax && strtolower($_SERVER['REQUEST_METHOD'])=="post"){
    if(isset($_POST['ajaxAction'])){
        if(function_exists($_POST['ajaxAction']))
            exit(call_user_func($_POST['ajaxAction']));
    }
	exit(json_encode(['status'=>false,'message'=>'Access Denied']));
}

function paketSil(){
    global $baglanDB;
    $stmt=$baglanDB->prepare("DELETE FROM paketler WHERE id=:id");
    $stmt->execute([':id'=>$_POST['id']]);
    if($stmt->rowCount())
        echo json_encode(['status'=>true,'message'=>"Paket Silindi."]);
    else
        echo json_encode(['status'=>false,'message'=>'Paket Silinemedi.']);
}

function paketCek(){
    global $baglanDB;
    $stmt=$baglanDB->prepare("SELECT * FROM paketler WHERE id=:id LIMIT 1");
    $stmt->execute([':id'=>$_POST['id']]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($row)
        echo json_encode(['status'=>true,'data'=>$row]);
    else
        echo json_encode(['status'=>false,'message'=>'Kayıt Bulunamadı.']);
}

function odulCek(){
    global $baglanDB;
    $stmt=$baglanDB->prepare("SELECT * FROM oduller WHERE id=:id LIMIT 1");
    $stmt->execute([':id'=>$_POST['id']]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($row)
        echo json_encode(['status'=>true,'data'=>$row]);
    else
        echo json_encode(['status'=>false,'message'=>'Kayıt Bulunamadı.']);
}

function vahaCek(){
    global $baglanDB;
    $stmt=$baglanDB->prepare("SELECT * FROM `wdata` where x=? and y=?  LIMIT 1");
    $stmt->execute([$_POST['x'],$_POST['y']]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function paketKaydet(){
    global $baglanDB;
    if($_POST['id']==0){
        $stmt=$baglanDB->prepare("INSERT INTO paketler SET paketadi = ?, fiyat = ?,miktar=?,cark=?,tip=?");
        $stmt->execute([$_POST['paketadi'],$_POST['fiyat'],$_POST['miktar'],$_POST['cark'],$_POST['tip']]);
        if($stmt->rowCount())
            exit(json_encode(['status'=>true,'message'=>"Paket Eklendi"]));
        exit(json_encode(['status'=>false,'message'=>"Paket Eklenemedi"]));
    }else{
        $stmt=$baglanDB->prepare("UPDATE paketler SET paketadi = ?, fiyat = ?,miktar=?,cark=?,tip=? WHERE id = ?");
        $stmt->execute([$_POST['paketadi'],$_POST['fiyat'],$_POST['miktar'],$_POST['cark'],$_POST['tip'],$_POST['id']]);
        if($stmt->rowCount())
            exit(json_encode(['status'=>true,'message'=>"Paket Güncellendi"]));
        exit(json_encode(['status'=>false,'message'=>"Paket Güncellenemedi"]));
    }
        echo json_encode(['status'=>false,'message'=>'Kayıt Bulunamadı.']);
}
function odulKaydet(){
    global $baglanDB;
    if($_POST['id']==0)
        exit(json_encode(['status'=>false,'message'=>'Kayıt Bulunamadı.']));
    if($_POST['oran']<1)
        exit(json_encode(['status'=>false,'message'=>'Ödül Çıkma Oranı Minimum 1 Olabilir!']));
    $stmt=$baglanDB->prepare("UPDATE oduller SET odul = ?, oran = ?, miktar=?,tip=? WHERE id = ?");
    $stmt->execute([$_POST['odul'],$_POST['oran'],$_POST['miktar'],$_POST['tip'],$_POST['id']]);
    if($stmt->rowCount())
        exit(json_encode(['status'=>true,'message'=>"Ödül Güncellendi"]));
    exit(json_encode(['status'=>false,'message'=>"Ödül Güncellenemedi. Sebebi Ödülde Değişiklik Yapmamış Olmanız Olabilir!"]));
}