
<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- ICONSCOUNT -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <link rel="stylesheet" href="./site_sign.css">

        <!-- BOOTSTRAP CSS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>PASSWORD MESSAGE</title>
        <style>
            /* -- GOOGLE FONTS -- */
            @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,900;1,300;1,700;1,900&display=swap');
            *{
                font-family: 'Roboto', sans-serif;
            }
            /* -- SIGN IN -- */
            .form_notify {
                display: flex;
                justify-content: center;
                align-content: center;
                margin-top: 16%;
            }
            .form_notify  form{
                background-color: #fff;
                width: 36%;
                border-radius: 18px;
                padding: 1% 4%;
            }
            .form_notify  form table, th, td{
                width: 500px;
                width: 100%;
            }
            .form_notify form table td h1 {
                padding-top: 5%;
            }
            .form_notify form table td h2{
                padding: 0 0 6% 4%;
                font-size: 40px;
                font-weight: 700;
            }
            .form_notify  form table th {
                width: 20%;
            }
            .form_notify  form table th,
            .form_notify  form table td {
                padding: 2% 0;
            }
            .form_notify  form table td {
                width: 100%;
            }
            .form_notify  form table td input {
                width: 100%;
            }
            .form_notify  form table th i {
                font-size: 30px;
                text-align: center;
            }
        </style>
    </head>
    <body style="background-color: #91d2bd;">
    
        <div class="form_notify">
            <form style="background-color: #fff; border: 0;">
                <table>
                    <tr>
                        <td colspan="2">
                            <h1><i class="uil uil-info-circle"></i></h1>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">
                            <h2>NEW PASSWORD</h2>
                        </th>
                    </tr>
                    <tr class="new">
                        <th><i class="uil uil-key-skeleton"></i></th>
                        <td>
                            <input class="form-control form-control-lg" type="text" value="{{$data}}" name="newpass">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <!-- <br> -->
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>


