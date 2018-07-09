<!DOCTYPE html>
<html lang="en">

<head>
    <title>jQuery keypad.js Demo Page</title>
    <meta charset="UTF-8">
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?=base_url()?>assets/css/keypad.css" rel="stylesheet">

</head>

<body>



    <input id="inputText" type="text" placeholder="Enter value"/>

    <div class="keypadContainer">

    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
    <script src="<?=base_url()?>assets/js/keypad.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#inputText').keyPad({
                template : '#tpl-keypad',
                isRandom : false,
            });
        });
    </script>

    <script id="tpl-keypad" type="script/template">
        <div class="keypad">
            <table>
                <colgroup>
                    <col width="33.33%">
                    <col width="33.33%">
                    <col width="33.33%">
                </colgroup>
                <tbody>
                    <tr>
                        <td><button type="button" class="1">1</button></td>
                        <td><button type="button" class="2">2</button></td>
                        <td><button type="button" class="3">3</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="4">4</button></td>
                        <td><button type="button" class="5">5</button></td>
                        <td><button type="button" class="6">6</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="7">7</button></td>
                        <td><button type="button" class="8">8</button></td>
                        <td><button type="button" class="9">9</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="text-sm" cmd="clear">Clear</button></td>
                        <td><button type="button" class="0">0</button></td>
                        <td><button type="button" class="text-sm" cmd="back">Back</button></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </script>
</body>

</html>
