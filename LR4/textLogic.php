<?php

    if (!empty($_GET['preset']))
    {

        if ($_GET["preset"] == "1")
        {
            $text = file_get_contents('C:\xampp\htdocs\LR4\kinorinhi.htm');

        } elseif ($_GET["preset"] == "2")
        {
            $text = file_get_contents('C:\xampp\htdocs\LR4\echomsk.htm');

        } elseif ($_GET["preset"] == "3")
        {
            $text = file_get_contents('C:\xampp\htdocs\LR4\vinni.htm');

        }
        else{
            $text = $_POST['text'];
        }
        $textVerify = construct($text);
    }
    else{
        if (!empty($_POST["text"])) {
            $text = $_POST["text"];
            $textVerify = construct($text);
        }
    }

    if (!empty($_POST["text"]))
    {
        $text = $_POST['text'];
        $textVerify = construct($text);
        $text5 = text5($text);
        $text10 = text10($text);
        $text15 = text15($text);
        $text20 = text20($text);
    }


function construct($text){
    $textItem = selectItem($text);
    return $textItem;
}

function selectItem($text){
    $regularExpression = "/<body[\s\S]+?<\/body>/";
    $resMatch = preg_match($regularExpression, $text,$resText);
    if ($resMatch>0) {
        return $resText[0];
    }
    return $text;
}



function text5()
{
    $text = $_POST['text'];
    $value = " &ndash; ";
    $regex = "/ - /";
    $value1 = "&nbsp;'&mdash; ";
    $regex1 = "/ -- /";
    $textItem = preg_replace($regex, $value, $text);
    $textItem = preg_replace($regex1, $value1, $text);
    echo $textItem;
}

function text10()
{
    $text = $_POST['text'];
    $link = 'automaticallyGeneratedLinkForP';
    $doc = new DOMDocument();
    $doc->loadHTML($text);
    $p_list = $doc->getElementsByTagName('p');
    $len = 0;
    $i = 0;
    if ($p_list->length > 0) {
        $theLongest = $doc->createElement('div');
        $doc->insertBefore($theLongest, $doc->firstChild);
        $p = $doc->createElement('p');
        $theLongest->appendChild($p);
        $a = $doc->createElement('a');
        $p->appendChild($a);
        while ($test = $p_list->item($i++)) {
            if (strlen($test->nodeValue) > $len) {
                $len = strlen($test->nodeValue);
                $theLongest = $test->nodeValue;
                if ($test->attributes && $test->attributes->getNamedItem('id')) {//Если у таблицы есть id, берем его
                    $linkVal = $test->attributes->getNamedItem('id')->value;
                } else {//Иначе добавляем ей новый
                    $linkVal = $link . $i;
                    $test->setAttribute('id', $linkVal);
                }

                $a->setAttribute('href', '#' . $linkVal);

            }
        }
        $arr = explode(".", $theLongest);
        $len = 0;
        foreach ($arr as $i) {
//            echo $i . "<br>";
            if (strlen($i) > $len) {
                $theLongest123 = $i;
                $len = strlen($i);
            }
        }
        $a->nodeValue = "...";

        $p->nodeValue = mb_substr($theLongest123, 0, 80);
        $p->appendChild($a);
    }
    $text = html_entity_decode($doc->saveHTML());
    $text = mb_convert_encoding($text, 'HTML-ENTITIES', 'utf-8');
    echo $text;
}

function text15()
{
    $text = $_POST['text'];
    $regex_error_word = "(./?<![_\d\p{L}](?:это|как|так|и|в|над|к|до|не|на|но|за|то|с|ли|а|во|от|со|для|о|же|ну|вы|бы|что|кто|он|она)(?![_\d\p{L}]))";
    header('Content-Type: text/html; charset=utf-8');
    $check_regex = preg_match($regex_error_word, $text, $matches);

    if (!$check_regex)
    {
        $matches = preg_split("/([^[:alnum:]]|['-])+/us", $text);
        $matches = array_unique($matches);
        $arr = array();
        foreach ($matches as $word)
        {
            $arr[$word] = substr_count($text, $word);
        }
        arsort($arr);
// выводим
        foreach ($arr as $city => $count)
        {
            if (count($matches) <= 100)
            {
                echo $city . ' - ' . $count . '<br>';
            }
        }
    }
}


 function text20() {
    $text = $_POST['text'];
    $listElementStyle = array();
    $listStyle = array();
    $domBody= new DOMDocument();
    @$domBody->loadHTML('<?xml encoding="utf-8" ?>' . $text);
    $nodeBody = $domBody->getElementsByTagName("body")->item(0);
    $nodeStyle = $domBody->createElement("style");
    $nodeBody->appendChild($nodeStyle);
    $allElements = $domBody->getElementsByTagName('*');

    $textStyle = "";
    foreach ($allElements as $element) {
        if ($element->hasAttribute("style")) {
            array_push($listElementStyle, array($element, $element->getAttribute("style")));
            array_push($listStyle, $element->getAttribute("style"));
        }
    }
    $groupsElementStyle = array_count_values($listStyle);

    foreach ($groupsElementStyle as $key=>$value) {
        //key - стили
        if ($value>1) {
            $className = hash("md2", $key);
            foreach ($listElementStyle as &$valueListElementStyle) {
                //$valueListElementStyle[1] - стили $valueListElementStyle[0] - элемент
                if ($valueListElementStyle[1] == $key) {
                    $valueListElementStyle[0]->removeAttribute("style");
                    if ($valueListElementStyle[0]->hasAttribute("class")) {
                        $attributeClass = $valueListElementStyle[0]->getAttribute("class");
                        $valueListElementStyle[0]->setAttribute("class", $attributeClass . " " . $className);
                    }
                    else {
                        $valueListElementStyle[0]->setAttribute("class", $className);
                    }
                }
            }

            $textStyle .= "{$className} {{$key}}\n";

        }
    }
    $domBody->getElementsByTagName("style")[0]->nodeValue = $textStyle;
    $text = $domBody->saveHTML();
    echo $text;
}
