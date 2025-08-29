<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/skeleton.css">
    <link rel="stylesheet" href="styles/menu.css">
    <title>{{ site-name }}:{{ title }}</title>
</head>

<body>
    <header class="container">
        <div class="row">
            <h1 class="twelve columns">{{ site-name }}</h1>
            <h2 class="twelve columns">{{ title }}</h2>
        </div>
        <nav>
            <ul class="menu row">
                <li class="two columns"><a href="/" class="button u-full-width">Main</a></li>
                <li class="two columns"><a href="/?page=about" class="button u-full-width">About</a></li>
                <li class="two columns"><a href="/?page=contacts" class="button u-full-width">Contacts</a></li>
            </ul>
        </nav>
    </header>
    <article class="container">
        <div class="row">

            <body class="twelve columns">
                {{ content }}
            </body>
        </div>

    </article>
</body>

</html>