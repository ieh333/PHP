<!DOCTYPE html>
<!--
Страница с теоритична информация за ПРЕНУМЕРАНДНА РЕНТА.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/styles.css" />
        <title>Пренумерандна рента</title>
    </head>
    <body class="color2">
        <?php
        $data=array();
        $doc=new DOMDocument();
        $doc->load("../xml/renti.xml");
        $tag=$doc->getElementsByTagName('renta');
        $element=$tag->item(1);
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
        <math display="block">
        <mrow>
        <msubsup>
        <mi>S</mi>
        <mi>n</mi>
        <mi>'</mi>
        </msubsup>
        <mo>=</mo>
        </mrow>
        <mrow>
        <mi>r</mi>
        <mo>.</mo>
        <mi>q</mi>
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
        <mi>q</mi>
        <mo>-</mo>
        <mn>1</mn>
        </mrow>
        </mfrac>
        </mrow>
        <mrow>
        <mo>=</mo>
        <msub>
        <mi>S</mi>
        <mi>n</mi>
        </msub>
        <mo>.</mo>
        <mi>q</mi>
        </mrow>
        </math>
        <p>
            <strong>Където:</strong><br /><br />
            <strong>r</strong> - сумата на всяко едно рентно плащане<br />
            <strong>i</strong> - годишна лихва<br />
            <strong>n</strong> - продължителност на рентните плащания<br />
            <strong>S<sup>'</sup><sub>n</sub></strong> - нараснала сума на рентата след n-годишни плащания<br />
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
