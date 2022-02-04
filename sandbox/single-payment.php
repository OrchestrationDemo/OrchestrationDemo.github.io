<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Donate to save puppies</title>
        <style>iframe {border: 0;width: 100%;height: 300px;}</style>
    </head>

    <body>

        <div class="container">
            <div class="col-sm-5">
                <h1>Donate to save puppies</h1>
                <form id="donation_form" method="post" action="form.php">
                    <div class="form-group">
                        <label>Donate </label>
                        <select class="form-control" name="donation">
                            <option value="100">$100</option>
                            <option value="50">$50</option>
                        </select>
                    </div>
                    <div class="form-group" id="iframeForm">
                    </div>
                    <input type="hidden" id="payment_source" name="payment_source">
                </form>
            </div>
        </div>

        <script src="https://app.paydock.com/v1/widget.umd.min.js"></script>
        <script>
            var widget = new paydock.HtmlWidget('#iframeForm', '97c2d87402dd063610f641b46b4c764ae0b4df79'); // public key, gateway_id here
            widget.setEnv('sandbox');
            widget.onFinishInsert('#payment_source', 'payment_source');

            widget.on('finish', function (data) {
                 document.forms[0].submit();
            });

            widget.load();
        </script>

    </body>
</html>

<?php
$chargeSvc = new Charges();
$res = $chargeSvc->create(10, "AUD")
    ->withToken($_POST["payment_source"])
    ->call();
?>