<html>
<head>
    <title>Printen</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js" integrity="sha512-YcsIPGdhPK4P/uRW6/sruonlYj+Q7UHWeKfTAkBW+g83NKM+jMJFJ4iAPfSnVp7BKD4dKMHmVSvICUbE/V1sSw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        thead {
            text-align: left;
        }
        table {
            border: 1px solid black;
            margin: 30px;
        }
        th, td {
            padding: 13px;
            text-align: left;
        }
    </style>
</head>
<body>
    <table id="element-to-print">
        <thead>
            <tr>
                <th>Artikel</th>
                <th>Aantal</th>
                <th>Totaal</th>
            </tr>
        </thead>
        <tr>
            <td>Hertog-Jan</td>
            <td>3</td>
            <td>&euro; 6,-</td>
        </tr>
        <tr>
            <td>Rode Wijn</td>
            <td>2</td>
            <td>&euro; 6,-</td>
        </tr>
        <tr>
            <td>Biefstuk met brood</td>
            <td>2</td>
            <td>&euro; 30,-</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><hr></td>
        </tr>
        <tr>
            <td colspan="2">totaal te betalen</td>
            <td>&euro; 42,-</td>
        </tr>
    </table>
    <script>
        var element = document.getElementById('element-to-print');
        html2pdf(element);
    </script>
</body>
</html>