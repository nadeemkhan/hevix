<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="assets/main.min.css"/>

    <script src="assets/jquery.min.js"></script>
    <script src="assets/main.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header row text-center">
            <h3>CSS 3 Button Generator</h3>
        </div>
        <div class="generator row">
            <div class="col-md-offset-1 col-md-4">
                <div class="generator--label">Border-radius:</div>
                <input id="border-radius" type="range" min="0" max="10" step="1" value="5">

                <div class="generator--label">Border-width:</div>
                <input id="border-width" type="range" min="0" max="10" step="1" value="3">

                <div class="generator--label">Text:</div>
                <input id="button-text" value="Button">
            </div>
            <div class="col-md-7 text-center">
                <div class="button-preview">Button</div>
            </div>
        </div>
        <form id="result_form" class="result row">
            <div class="row">
                <div class="col-md-offset-3 col-md-3">
                    <textarea name="" id="htmlResult" readonly></textarea>
                </div>
                <div class="col-md-3">
                    <textarea name="" id="cssResult" readonly></textarea>
                </div>
            </div>
            <div class="row text-center">
                <input type="email" id="sender-email" placeholder="E-mail" required>
            </div>
            <div class="row text-center">
                <input value="Send" type="submit" id="send-form"></input>
            </div>

        </form>

    </div>
</body>
</html>