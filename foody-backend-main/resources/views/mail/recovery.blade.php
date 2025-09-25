<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verification Code</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .containerParent {
            background-color: #18181b;
            font-family: "Lucida Sans", "Lucida Sans Regular", "Lucida Grande",
                "Lucida Sans Unicode", Geneva, Verdana, sans-serif;
            padding: 3rem;
        }

        h1 {
            margin-bottom: 1.25rem;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 1.875rem;
            line-height: 2.25rem;
        }

        .container {
            background-color: #f1f5f9;
            border-radius: 2%;
            padding: 2rem;
            row-gap: 1.5rem;
            text-align: center;
        }

        a {
            color: white;
            transition: 0.3s all;
            text-decoration: none;
        }

        a:hover {
            color: goldenrod;
        }
    </style>
</head>

<body>
    <div class="containerParent">
        <table style="margin: auto">
            <thead>
                <tr>
                    <td>
                        <h1>ExpoNex</h1>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="container">
                            <img width="100" height="100" src="https://img.icons8.com/cute-clipart/100/sms.png"
                                alt="sms" />
                            <div style="text-align: center">
                                <h2>Here is your One Time Password</h2>
                                <p>to recovery your account</p>
                            </div>
                            <div style="text-align: center">
                                <div style="font-size: xx-large">{{ $pin_code }}</div>

                                <p style="color: red; font-size: small">
                                    valid for 10 minutes only.
                                </p>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="text-align: center; color: #fff; margin-top: 2rem">
                            <span><a href="">FAQs</a>&nbsp;|&nbsp;</span>
                            <span><a href="">Terms and Conditions</a>&nbsp;|&nbsp;</span>
                            <span><a href="">Contact Us</a></span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
