<?
include_once('classes.php');
$pdo=Tools::connect();
$role='CREATE TABLE Roles(ID int not null auto_increment primary key,role varchar(32)not null unique)default charset="utf8"';
$customer='CREATE TABLE Customers(ID int not null auto_increment primary key,login varchar(32)not null unique,
pass varchar(128)not null, roleID int, foreign key(roleID) references Roles(ID) on update cascade, discount int, total int,
imagepath varchar(255))default charset="utf8"';
$cat='CREATE TABLE Categories(ID int not null auto_increment primary key,category varchar(64)not null unique)
default charset="utf8"';
$sub='CREATE TABLE SubCategories(ID int not null auto_increment primary key,sucategory varchar(64)not null unique,catID int,
foreign key(catID) references Categories(ID) on update cascade)default charset="utf8"';
$item='CREATE TABLE Items(ID int not null auto_increment primary key,itemname varchar(128)not null,catID int,
foreign key(catid) references Categories(ID) on update cascade,pricein int not null,pricesale int not null,
info varchar(256) not null,rate double,imagepath varchar(256) not null,action int) default charset="utf8"';
$images='CREATE TABLE Images(ID int not null auto_increment primary key,itemID int,foreign key(itemid) references Items(ID) on 
delete cascade,imagepath varchar(255))default charset="utf8"';
$sale='CREATE TABLE Sales(ID int not null auto_increment primary key,customername varchar(32),itemname varchar(128),
pricein int,pricesale int,datesale date)default charset="utf8"';
if ($pdo){
    $pdo->exec($role);
    $pdo->exec($customer);
    $pdo->exec($cat);
    $pdo->exec($sub);
    $pdo->exec($item);
    $pdo->exec($images);
    $pdo->exec($sale);
}