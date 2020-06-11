<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 22.07.2019
 * Time: 17:30
 */

class Record
{
    var $ib;
    var $entity;
    function __construct($hblock)
    {
        CModule::IncludeModule("highloadblock");
        $this->ib=$hblock;
        if (is_numeric($hblock)) {
            $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('ID' => $hblock)));
        }else{
            $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $hblock)));
        }
        if ( !($arData = $rsData->fetch()) ){
            echo 'Инфоблок не найден';
        }
        $this->entity =\Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);
        return $this;

    }
    public static function init($hblock)
    {
        return new Record($hblock);
    }

    function getCount($arFilter=array()){
        $DataClass = $this->entity->getDataClass();
        return $DataClass::getCount($arFilter);
    }

    function Add($arFields=[])
    {
        $DataClass = $this->entity->getDataClass();
        $result = $DataClass::add($arFields);
        if(!$result->isSuccess()){
            echo implode(', ', $result->getErrorMessages()); //выведем ошибки
            return false;
        }
        return $result->getId();//Id нового элемента
    }
    function Update($id, $arFields=[])
    {
        $DataClass = $this->entity->getDataClass();
        $result = $DataClass::update($id, $arFields);
        if(!$result->isSuccess()){ //произошла ошибка
            echo implode(', ', $result->getErrorMessages()); //выведем ошибки
            return false;
        }
        return true;
    }
    function Delete($id)
    {
        $DataClass = $this->entity->getDataClass();
        $result = $DataClass::delete($id);
        if(!$result->isSuccess()){ //произошла ошибка
            echo implode(', ', $result->getErrorMessages()); //выведем ошибки
            return false;
        }
        return true;
    }


    function GetList($arOrder=[], $arFilter=[], $arSelect=["*"], $doArray=false)
    {
        //Создадим объект - запрос
        $Query = new \Bitrix\Main\Entity\Query($this->entity);
        //Зададим параметры запроса, любой параметр можно опустить
        $Query->setSelect($arSelect);
        $Query->setFilter($arFilter);
        $Query->setOrder($arOrder);
        //Выполним запрос
        $result = $Query->exec();
        //Получаем результат по привычной схеме
        $result = new CDBResult($result);
        $arLang = array();

        while ($row = $result->Fetch()){

            $arLang[$row['ID']] = $row;
        }
        if(count($arLang)==1 && $doArray)
        {
            $arLang=array_values($arLang)[0];
        }
        return $arLang;
    }
    function GetListWP($arOrder=[], $arFilter=[], $arSelect=["*"], $doArray=false, $limit = false)
    {
        //Создадим объект - запрос
        $Query = new \Bitrix\Main\Entity\Query($this->entity);
        //Зададим параметры запроса, любой параметр можно опустить
        $Query->setSelect($arSelect);
        $Query->setFilter($arFilter);
        $Query->setOrder($arOrder);
        if ($limit){
            $nav = new \Bitrix\Main\UI\PageNavigation("page");
            $nav->allowAllRecords(true)
                ->setPageSize($limit)
                ->initFromUri();
            $nav->setCurrentPage($_REQUEST["page"]?:1);
            $Query->setOffset($nav->getOffset());
            $Query->setLimit($nav->getLimit());
        }
        //Выполним запрос
        $result = $Query->exec();
        //Получаем результат по привычной схеме
        $result = new CDBResult($result);
        $arLang = array();

        while ($row = $result->Fetch()){

            $arLang[$row['ID']] = $row;
        }
        if(count($arLang)==1 && $doArray)
        {
            $arLang=array_values($arLang)[0];
        }
        return $arLang;
    }
    function GetBy($by, $val, $field)
    {
        if($GLOBALS["hl"][$this->ib][$by][$val][$field]) return $GLOBALS["hl"][$this->ib][$by][$val][$field];
        $arF=array($by=>$val);
        $arSelect=array("ID", $field);
        $res=array_values($this->GetList(array(), $arF, $arSelect));
        $GLOBALS["hl"][$this->ib][$by][$val][$field]=$res[0][$field];
        return $GLOBALS["hl"][$this->ib][$by][$val][$field];
    }
}