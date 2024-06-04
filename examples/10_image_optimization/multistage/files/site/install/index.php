<?php
/*
 * The MIT License
 *
 * Copyright 2019 Croitor Mihail <mcroitor@gmail.com>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf8" />
        <link rel="stylesheet" href="../themes/normalize.css" />
        <link rel="stylesheet" href="../themes/skeleton.css" />
        <script type="text/javascript" src="../lib/api.js"></script>
        <script type="text/javascript">
            client.http.onload = function () {
                _d.get("stage").innerHTML = client.http.responseText;
                console.log('response: ' + client.http.responseText);
            };
            function get_stage() {
                var data = null;
                if (_d.forms.stageform) {
                    data = new FormData(document.forms.stageform);
                }
                console.log('data to send: ' + data);
                result = client.request('/install/stages.php', data);
                _d.get('stage').innerHTML = result;
            }
            window.onload = get_stage();
        </script>
        <title>yacms installation</title>
    </head>
    <body>
        <article>
            <header><h2>Setup</h2></header>
        </article>
        <main id="stage"></main>
    </body>
</html>