<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title><?=$title?></title>
    
    <style>
        html, body {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            text-align: center;
            margin: 0;
            width: 100%;
            height: 100%;
        }

        h1 {
            font-weight: normal;
        }

        table, td {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                <h1><?=$title?></h1>
                <?=$description?>
            </td>
        </tr>
    </table>
</body>
<!-- Just for developers :D
<?=$stacktrace?> 
-->
</html>