<!DOCTYPE html>
<!--
Страница с теоритична информация за P-СРОЧНА РЕНТА.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../css/styles.css" />
        <title>P-срочна рента</title>
    </head>
    <body class="color4">
        <?php
        $data=array();
        $doc=new DOMDocument();
        $doc->load("../xml/renti.xml");
        $tag=$doc->getElementsByTagName('renta');
        $element=$tag->item(3);
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
            <msubsup>
            <mi>s</mi>
            <mi>n;i</mi>
            <mi>(p)</mi>
            </msubsup>
            <mo>=</mo>
            </mrow>
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
            <mi>p</mi>
            <mo>.</mo>
            <mo>[</mo>
            <msup>
            <mi>q</mi>
            <mi>i/p</mi>
            </msup>
            <mo>-</mo>
            <mn>1</mn>
            <mo>]</mo>
            </mrow>
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
                <mi>R</mi>
                <mo>.</mo>
                <msubsup>
                <mi>s</mi>
                <mi>n;i</mi>
                <mi>(p)</mi>
                </msubsup>
                </mrow>
                </math>
            </li>
        </ol>
        <p>
            <strong>Където:</strong><br /><br />
            <strong>p</strong> - срок на рентата<br />
            <strong>R</strong> - сумата на всяко едно рентно плащане<br />
            <strong>i</strong> - годишна лихва<br />
            <strong>n</strong> - продължителност на рентните плащания<br />
            <strong>s<sub>n;i</sub><sup>(p)</sup></strong> - коефициент на нарастване на <strong>p</strong>-срочна рента<br />
            <strong>S<sub>n</sub></strong> - нараснала сума на рентата след n-годишни плащания<br />
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
