<!DOCTYPE html>
<!--
Страница с теоритична информация за РЕНТА С ПЕРИОД ПО-ГОЛЯМ ОТ 1 ГОДИНА.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/styles.css" />
        <title>Рента с период по-голям от 1 година</title>
    </head>
    <body class="color5">
        <?php
        $data=array();
        $doc=new DOMDocument();
        $doc->load("../xml/renti.xml");
        $tag=$doc->getElementsByTagName('renta');
        $element=$tag->item(4);
        $children=$element->childNodes;
        foreach ($children as $child)
        {
            $data[$child->nodeName]=$child->nodeValue;
        }
        $title=$data['name'];
        $description=$data['description'];
        print "<h1 class='text'>";
        print $title;
        print "</h1>";
        print "<p>";
        print $description;
        print "</p>";
        ?>
        <ol>
            <li>Коефициент на нарастване на p-срочната рента
            <math display="block">
            <mrow>
            <msub>
            <mi>S</mi>
            <mi>n;i</mi>
            </msub>
            <mo>=</mo>
            </mrow>
            <mfrac>
            <mrow>
            <msup>
            <mi>q</mi>
            <mi>r</mi>
            </msup>
            <mo>-</mo>
            <mn>1</mn>
            </mrow>
            <mi>i</mi>
            </mfrac>
            </math>
            </li>
            <li>Нараснала сума
                <math display="block">
                <mrow>
                <msub>
                <mi>S</mi>
                <mi>n</mi>
                </msub>
                <mo>=</mo>
                </mrow>
                <mrow>
                <msub>
                <mi>R</mi>
                <mi>r</mi>
                </msub>
                <mo>.</mo>
                <mfrac>
                <mrow>
                <msup>
                <mi>q</mi>
                <mi>n</mi>
                </msup>
                <mo>-</mo>
                <mn>1</mn>
                </mrow>
                <mrow>
                <msup>
                <mi>q</mi>
                <mi>r</mi>
                </msup>
                <mo>-</mo>
                <mn>1</mn>
                </mrow>
                </mfrac>
                <mo>=</mo>
                </mrow>
                <mrow>
                <msub>
                <mi>R</mi>
                <mi>r</mi>
                </msub>
                <mo>.</mo>
                <mfrac>
                <msub>
                <mi>S</mi>
                <mi>n;i</mi>
                </msub>
                <msub>
                <mi>S</mi>
                <mi>r;i</mi>
                </msub>
                </mfrac>
                </mrow>
                </math>
            </li>
        </ol>
        <p>
            <strong>Където:</strong><br /><br />
            <strong>r</strong> - период на рентата<br />
            <strong>Rr</strong> - член на рентата, изплащана след <strong>r</strong>-година<br />
            <strong>i</strong> - годишна лихва<br />
            <strong>n</strong> - срок на рентата<br />
            <strong>s<sub>n;i</sub></strong> - коефициент на нарастване на годишната рента<br />
            <strong>S<sub>n</sub></strong> - нараснала сума на рентата с период по-голяма от <strong>1 година</strong><br />
        </p>
        <math display="inline">
        <mrow>
        <mi>q</mi>
        <mo>=</mo>
        <mn>1</mn>
        <mo>+</mo>
        <mi>i</mi>
        </mrow>
        <mtext>;</mtext>
        <mspace linebreak="newline" />
        <mrow>
        <mi>i</mi>
        <mo>=</mo>
        <mfrac>
        <mn>1</mn>
        <mn>100</mn>
        </mfrac>
        </mrow>
        </math>
        <br />
        <br /> 
        <div style="text-align: center"><a href="information.php"><img src="../jpeg/Nachalo.jpg" alt="Начало" /></a></div>
    </body>
</html>
